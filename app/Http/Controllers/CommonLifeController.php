<?php

namespace App\Http\Controllers;

use App\Models\CommonLife;
use App\Models\User;
use App\Models\UserSchool;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommonLifeController extends Controller
{
    public function index() {
        $user = Auth::user();
        $id = $user->id;
        $roleUser = UserSchool::where('user_id',$id)->get();
        $role = $roleUser[0]->role;
        $tasks = CommonLife::where('done',0)->get();
        if($role=="admin"){
            return view('pages.commonLife.commonLife-admin', compact('tasks'));
        }
        else{
            return view('pages.commonLife.commonLife-student', compact('tasks'));
        }
    }

    public function done(){

    }

    public function create(request $request) {
        $user = Auth::user();
        $title = $request->input('title');
        $description = $request->input('description');
        $done = false;
        if($title == null || $description == null) {
            return redirect()->route('common-life.index');
        }
        else{
            $CommonLife = new CommonLife();
            $CommonLife ->user_id = $user -> id;
            $CommonLife ->title = $title;
            $CommonLife ->description = $description;
            $CommonLife ->done = $done;
            $CommonLife->save();
            return redirect()->route('common-life.index');
        }
    }
    public function delete(request $request) {
        $id = $request->id;
        $task = CommonLife::where('task_id',$id)->delete();
        return redirect()->route('common-life.index');
    }
}
