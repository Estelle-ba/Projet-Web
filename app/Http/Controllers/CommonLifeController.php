<?php

namespace App\Http\Controllers;

use App\Models\CommonLife;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommonLifeController extends Controller
{
    public function index() {
        $tasks = CommonLife::where('done',0)->get();
        return view('pages.commonLife.commonLife-admin', compact('tasks'));
    }

    public function done(){

    }

    public function create(request $request) {
        $tasks = CommonLife::where('done',0)->get();
        $user = Auth::user();
        $title = $request->input('title');
        $description = $request->input('description');
        $done = false;
        if($title == null || $description == null) {
            return view('pages.commonLife.commonLife-admin', compact('tasks'));
        }
        else{
            $CommonLife = CommonLife::create([
                'user_id' => $user -> id,
                'title' => $title,
                'description'=> $description,
                'done' => $done,
            ]);

            $CommonLife->save();
            return view('pages.commonLife.commonLife-admin', compact('tasks'));
        }
    }
    public function delete(request $request) {}
}
