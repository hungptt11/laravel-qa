<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;

class AcceptAnswersController extends Controller
{
    public function accept(Answer $answer)
    {
        $this->authorize('accept', $answer);
        $answer->Question->acceptBestAnswer($answer);
        //dd('call accept method');
        if (request()->expectsJson()) {
            //success but no return content
            return response()->json(null, 204);
        }
        return back();
    }   //
}
