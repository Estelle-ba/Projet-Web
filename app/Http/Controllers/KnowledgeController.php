<?php

namespace App\Http\Controllers;

use App\Models\CohortBilan;
use App\Models\Questions;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Webmozart\Assert\Tests\StaticAnalysis\length;

class KnowledgeController extends Controller
{
    /**
     * Display the page
     *
     * @return Factory|View|Application|object
     */
    public function index() {
        $user = Auth::user();
        $tests = Questions::all()->groupBy('test_id');
        $done = CohortBilan::where('user_id', $user->id)->get();
        $tests_done = array();
        foreach ($done as $test) {
            $tests_done[] = $test['test_id'];
        }
        return view('pages.knowledge.index', compact('tests', 'tests_done', 'done'));
    }

    public function resultTest(Request $request){
        $user = Auth::user();
        $test_language = $request->language;
        $test_id = $request->test_id;
        $total=$request->size;
        unset($request['language']);
        unset($request['test_id']);
        unset($request['size']);
        $result = 0;

        foreach ($request->all() as $key => $value) {
            $result+=(int)$value;

        }
        $rate = new CohortBilan();
        $rate->test_language=$test_language;
        $rate->test_id=$test_id;
        $rate->ratting=$result;
        $rate->total=$total;
        $rate->user_id=$user->id;
        $rate->save();

        return redirect()->route('knowledge.index');
    }
}
