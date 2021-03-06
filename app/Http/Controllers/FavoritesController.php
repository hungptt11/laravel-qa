<?php

namespace App\Http\Controllers;

use App\Question;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Question $question)
    {
        $question->favorites()->attach(auth()->id());
        if (request()->expectsJson()) {
            //success but no return content
            return response()->json(null, 204);
        }
        return back();
    }

    public function destroy(Question $question)
    {
        $question->favorites()->detach(auth()->id());
        if (request()->expectsJson()) {
            //success but no return content
            return response()->json(null, 204);
        }
        return back();
    }
}
