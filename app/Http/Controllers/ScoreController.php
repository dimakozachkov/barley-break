<?php

namespace App\Http\Controllers;

use App\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{

    public function save(Request $request)
    {
        $score = new Score();

        $score->score = $request->get('score');
        $score->user_id = $request->user()->id;

        $answer = $score->save();

        return response()->json($answer);
    }

    public function show()
    {
        $allScore = request()->user()->score()->orderBy('score', 'desc')->get();

        return view('score.user', compact('allScore'));
    }

}
