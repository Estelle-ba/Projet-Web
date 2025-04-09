<?php

namespace App\Http\Controllers;

use App\Models\CommonLife;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommonLifeController extends Controller
{
    public function index() {

        return view('pages.commonLife.index');
    }

    public function create(request $request) {
        $user = Auth::user();
        $title = $request->input('title');
        $description = $request->input('description');
        if($title == null || $description == null) {
            return view('pages.commonLife.index');
        }
        else{
            $CommonLife = CommonLife::create([
                'user_id' => $user -> id,
                'title' => $title,
                'description'=> $description,
            ]);

            $CommonLife->save();
            return view('pages.commonLife.index');
        }
    }
}
