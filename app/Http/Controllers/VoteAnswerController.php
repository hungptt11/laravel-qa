<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;

class VoteAnswerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function vote(Answer $answer)
    {
        $vote = (int) request()->vote;
        $voteCount = auth()->user()->voteAnswer($answer, $vote);

        if (request()->expectsJson()) {
            return response()->json([
                'message' => 'Thank for the feedback!',
                'votes_count' => $voteCount,
            ]);
        }
        return back();
    }
}
