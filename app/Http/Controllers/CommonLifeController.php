<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use App\Models\CohortUser;
use App\Models\CommonLife;
use App\Models\comment_common_task;
use App\Models\promotion_common_task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Gate;

class CommonLifeController extends Controller
{
    use AuthorizesRequests;

    //index go to the pages with all the information
    public function index() {
        $user = Auth::user();
        $id = $user->id;
        $tasks = CommonLife::all();

        //If it's a student
        if(Gate::allows('isStudent',$user)){
            $done = comment_common_task::where('user_id',$id)->get();

            //Search for his cohort
            $cohorts = CohortUser::where('user_id',$id)->get()->FirstOrFail();
            $temp=promotion_common_task::where('promotion',$cohorts->cohort_id)->get();
            $todo = array();

            //Give all the common life task to do
            foreach ($temp as $task_todo) {
                $todo[] = $task_todo['task_id'];
            }
        }

        //Otherwise get all the cohorts and the task done
        else{
            $cohorts = Cohort::all();
            $done = comment_common_task::all();
            $todo = promotion_common_task::all();
        }
        return view('pages.commonLife.index', compact('tasks','done','cohorts','todo'));
    }

    //create: create a new common life task and add it to the database
    public function create(request $request) {
        $user = Auth::user();
        //$this->authorize('create',$user);
        $title = $request->title;
        $description = $request->description;

        //if the title or the description is null, the task is not created
        if($title == null || $description == null) {
            return redirect()->route('common-life.index');
        }
        else{
            //create a new Common life Task
            $CommonLife = new CommonLife();
            $CommonLife ->user_id = $user -> id;
            $CommonLife ->title = $title;
            $CommonLife ->description = $description;
            $CommonLife->save();//Save it into the database

            //Get the id of the common life task that has been created
            $lastCommonLife = CommonLife::latest('task_id')->first();//Get the last commonLife(the one we created)
            $task_id = $lastCommonLife ? $lastCommonLife->task_id : 0;//If there's no common life put 0 as the task_id

            $cohort_id=$request->select;

            //If the admin choose to give the task to everybody
            if($cohort_id == "everybody") {
                $cohorts = Cohort::all();
                //Browse the cohorts
                foreach($cohorts as $cohort) {
                    //create a new cohort
                    $cohorts_task = new promotion_common_task();
                    $cohorts_task->promotion = $cohort->id;
                    $cohorts_task->task_id = $task_id;
                    $cohorts_task->save();//Save it into the database
                }
            }
            else{
                //create a new cohort
                $cohorts_task = new promotion_common_task();
                $cohorts_task->promotion = $cohort_id;
                $cohorts_task->task_id = $task_id;
                $cohorts_task->save();//Save it into the database
            }
            return redirect()->route('common-life.index');
        }
    }

    //Delete, delete a common life task from the database
    public function delete(request $request) {
        $user = Auth::user();
        //$this->authorize('delete',$user);
        $id = $request->id;

        //take the task from the database
        $task = CommonLife::where('task_id',$id)->delete();//delete-it

        //take all the cohort task in the database with this task id
        $cohort_task = promotion_common_task::where('task_id',$id);
        $cohort_task->delete();//delete-it

        return redirect()->route('common-life.index');
    }

    //modify_task modify some information from common life task
    public function modify_task(request $request) {
        $user = Auth::user();
        //$this->authorize('modify_task',$user);
        $id = $request->id;
        $title = $request->title;
        $description = $request->description;
        $task = CommonLife::where('task_id',$id)->firstOrFail();

        //if the title or the description is null, take the last one
        if($title == null) {
            $title = $task->title;
        }
        if($description == null) {
            $description = $task->description;
        }
        $task->update(['title'=>$title, 'description' => $description]);

        $cohort_id=$request->select;
        //If a cohort is now assigned
        if($cohort_id!="Aucune formation"){
            //If the admin choose to give the task to everybody
            if($cohort_id == "everybody") {
                $cohorts = Cohort::all();

                //Browse the cohorts
                foreach($cohorts as $cohort) {
                    //Check if assigning cohorts to task not already exist
                    $exist = promotion_common_task::where('promotion',$cohort->id)->where('task_id',$id)->exists();
                    //If not save it to the database
                    if($exist == false) {
                        //create a new cohort
                        $cohorts_task = new promotion_common_task();
                        $cohorts_task->promotion = $cohort->id;
                        $cohorts_task->task_id = $id;
                        $cohorts_task->save();//Save it into the database
                    }
                }
            }
            else{
                //Check if assigning cohorts to task not already exist
                $exist = promotion_common_task::where('promotion',$cohort_id)->where('task_id',$id)->exists();
                //If not save it to the database
                if($exist == false) {
                    //create a new cohort
                    $cohorts_task = new promotion_common_task();
                    $cohorts_task->promotion = $cohort_id;
                    $cohorts_task->task_id = $id;
                    $cohorts_task->save();//Save it into the database
                }
            }
        }
        return redirect()->route('common-life.index');
    }

    //delete_cohort delete the cohort task
    public function delete_cohort(request $request) {
        $user = Auth::user();
        //$this->authorize('delete',$user);
        $task_id = $request->task_id;
        $id = $request->select;

        //take the cohort_task
        $cohort_task = promotion_common_task::where('task_id',$task_id)->where('promotion',$id);
        $cohort_task->delete();//delete-it

        return redirect()->route('common-life.index');
    }
}
