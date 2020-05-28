<?php

namespace App\Http\Controllers;

use App\Question;
use App\User;
use Illuminate\Http\Request;

class VoteQuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function vote(Question $question)
    {
        $vote = (int) request()->vote;
        auth()->user()->voteQuestion($question, $vote);
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        $out->writeln($vote);
        return back();
    }
}
