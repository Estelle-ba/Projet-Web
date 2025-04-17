<?php

namespace App\Http\Controllers;

use App\Models\Questions;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class KnowledgeController extends Controller
{
    /**
     * Display the page
     *
     * @return Factory|View|Application|object
     */
    public function index() {
        $tests = Questions::all()->groupBy('test_id');
        return view('pages.knowledge.index', compact('tests'));
    }
    public function error() {
        return view('pages.knowledge.mistral-error');
    }
}
