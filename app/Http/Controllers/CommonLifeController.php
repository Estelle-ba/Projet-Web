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

        $user = Auth::user();
        $title = $request->input('title');
        $description = $request->input('description');
        $done = false;
        if($title == null || $description == null) {
            $tasks = CommonLife::where('done',0)->get();
            return redirect()->route('common-life.index');
        }
        else{
            $CommonLife = new CommonLife();
            $CommonLife ->user_id = $user -> id;
            $CommonLife ->title = $title;
            $CommonLife ->description = $description;
            $CommonLife ->done = $done;
            $CommonLife->save();
            $tasks = CommonLife::where('done',0)->get();
            return redirect()->route('common-life.index');
        }
    }
    public function delete(request $request) {}
}
