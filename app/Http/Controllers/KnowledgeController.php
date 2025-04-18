<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use App\Models\CohortBilan;
use App\Models\CohortTest;
use App\Models\CohortUser;
use App\Models\Questions;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use function Webmozart\Assert\Tests\StaticAnalysis\length;

class KnowledgeController extends Controller
{
    /**
     * Display the page
     *
     * @return Factory|View|Application|object
     */
    //index go to the pages with all the information
    public function index() {
        $user = Auth::user();
        $tests = Questions::all()->groupBy('test_id');
        $done = CohortBilan::where('user_id', $user->id)->get();
        $cohorts = Cohort::all();

        //If it's a student
        if(Gate::allows('isStudent',$user)) {
            $tests_done = array();
            //Give all the test he has done
            foreach ($done as $test) {
                $tests_done[] = $test['test_id'];
            }

            //Search for his cohort
            $cohorts = CohortUser::where('user_id', $user->id)->get()->FirstOrFail();
            $temp = CohortTest::where('cohort_id', $cohorts->cohort_id)->get();
            $todo = array();

            //Give all the test he had to do according to his cohort
            foreach ($temp as $test_todo) {
                $todo[] = $test_todo['test_id'];
            }
        }
        else{
            $tests_done=Questions::all();
            $todo=CohortTest::all();
        }
        return view('pages.knowledge.index', compact('tests','tests_done','done','todo','cohorts'));
    }

    //resultTest give the result and save it to the database
    public function resultTest(Request $request){
        $user = Auth::user();
        $test_language = $request->language;
        $test_id = $request->test_id;
        $total=$request->size;

        unset($request['language']);//Remove it from request
        unset($request['test_id']);//Remove it from request
        unset($request['size']);//Remove it from request
        $result = 0;

        //Browse the last things in resquest
        foreach ($request->all() as $key => $value) {
            $result+=(int)$value;

        }
        //create a new result
        $rate = new CohortBilan();
        $rate->test_language=$test_language;
        $rate->test_id=$test_id;
        $rate->ratting=$result;
        $rate->total=$total;
        $rate->user_id=$user->id;
        $rate->save();//save it into the database

        return redirect()->route('knowledge.index');
    }

    //modifyTest modify the cohorts that have to do the test
    function modifyTest(Request $request)
    {
        $id=$request->id;

        $cohort_id=$request->select;

        //If a cohort is now assigned
        if($cohort_id!="Aucune formation"){
            //If the admin choose to give the test to everybody
            if($cohort_id == "everybody") {
                $cohorts = Cohort::all();

                //Browse the cohorts
                foreach($cohorts as $cohort) {
                    //Check if assigning cohorts to test not already exist
                    $exist = CohortTest::where('cohort_id',$cohort->id)->where('test_id',$id)->exists();
                    //If not save it to the database
                    if($exist == false) {
                        //create a new cohort
                        $cohort_test = new CohortTest();
                        $cohort_test->cohort_id= $cohort->id;
                        $cohort_test->test_id = $id;
                        $cohort_test->save();//Save it into the database
                    }
                }
            }
            else{
                //Check if assigning cohorts to test not already exist
                $exist = CohortTest::where('cohort_id',$cohort_id)->where('test_id',$id)->exists();
                //If not save it to the database
                if($exist == false) {
                    //create a new cohort
                    $cohort_test = new CohortTest();
                    $cohort_test->cohort_id = $cohort_id;
                    $cohort_test->test_id = $id;
                    $cohort_test->save();//Save it into the database
                }
            }
        }
        return redirect()->route('knowledge.index');
    }

    //This function delete all the test
    function deleteTest(Request $request){
        $user = Auth::user();

        $id = $request->id;

        //take all the answer in the database with this test id
        $test = Questions::where('test_id',$id);
        $test->delete();//delete-it

        //take all the cohort test in the database with this test id
        $cohort_test = CohortTest::where('test_id',$id);
        $cohort_test->delete();//delete-it

        return redirect()->route('knowledge.index');
    }

    //delete_cohort delete the cohorttest
    public function delete_cohort(request $request) {
        $user = Auth::user();
        //$this->authorize('delete',$user);
        $test_id = $request->test_id;
        $id = $request->select;

        //take the cohort_test
        $cohort_test= CohortTest::where('test_id',$test_id)->where('cohort_id',$id);
        $cohort_test->delete();//delete-it

        return redirect()->route('knowledge.index');
    }
}
