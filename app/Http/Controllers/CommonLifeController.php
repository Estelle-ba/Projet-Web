<?php

namespace App\Http\Controllers;

use App\Models\CommonLife;
use App\Models\UserSchool;
use App\Models\comment_common_task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommonLifeController extends Controller
{
    use AuthorizesRequests;
    public function index() {
        $user = Auth::user();
        $id = $user->id;
        $tasks = CommonLife::all();
        $done = comment_common_task::where('user_id',$id)->get();
        return view('pages.commonLife.index', compact('tasks','done'));
    }


    public function create(request $request) {
        $user = Auth::user();
        //$this->authorize('create',$user);
        $title = $request->title;
        $description = $request->description;
        if($title == null || $description == null) {
            return redirect()->route('common-life.index');
        }
        else{
            $CommonLife = new CommonLife();
            $CommonLife ->user_id = $user -> id;
            $CommonLife ->title = $title;
            $CommonLife ->description = $description;
            $CommonLife->save();
            return redirect()->route('common-life.index');
        }
    }
    public function delete(request $request) {
        $user = Auth::user();
        //$this->authorize('delete',$user);
        $id = $request->id;
        $task = CommonLife::where('task_id',$id)->delete();
        return redirect()->route('common-life.index');
    }

    public function modify_task(request $request) {
        $user = Auth::user();
        //$this->authorize('modify_task',$user);
        $id = $request->id;
        $title = $request->title;
        $description = $request->description;
        $task = CommonLife::where('task_id',$id)->firstOrFail();
        if($title == null) {
            $title = $task->title;
        }
        if($description == null) {
            $description = $task->description;
        }
        $task->update(['title'=>$title, 'description' => $description]);
        return redirect()->route('common-life.index');
    }
}
