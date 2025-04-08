<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommonLifeController extends Controller
{
    public function index() {

        return view('pages.commonLife.index');
    }

    public function create() {
        $user = Auth::user();
        return view('pages.commonLife.index', compact('user'));
    }
}
