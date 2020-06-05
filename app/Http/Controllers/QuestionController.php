<?php

namespace App\Http\Controllers;

use App\Http\Requests\AskQuestionRequest;
use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show', 'index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //composer require barryvdh/laravel-debugbar --dev
        /*\DB::enableQueryLog();
        $questions = Question::with('user')->latest()->paginate(5);
        view('question.index')->with('questions', $questions)->render();
        dd(\DB::getQueryLog());*/
        $questions = Question::with('user')->latest()->paginate(5);
        return view('question.index')->with('questions', $questions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $question = new Question();
        return view('question.create')->with('question', $question);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AskQuestionRequest $request)
    {
        //dd('store');
        $request->user()->questions()->create($request->only('title', 'body'));
        //return redirect('/question');
        return redirect()->route('question.index')->with('success', 'Your\' question has been submited');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        Question::increment('views');
        return view('question.show')->with('question', $question);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::findOrFail($id);
        if (empty($question)) {
            abort(404);
        }
        $this->authorize("update", $question);
        return view('question.edit')->with('question', $question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(AskQuestionRequest $request, Question $question)
    {
        $this->authorize("update", $question);
        $question->update($request->only('title', 'body'));

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Your question has been updated',
                'body_html' => $question->body_html,
            ]);
        }
        return redirect()->route('question.index')->with('success', 'Your\' question has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $this->authorize("delete", $question);
        $question->delete();
        dd('store');

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Your question has been deleted',
            ]);
        }
        return redirect()->route('question.index')->with('success', 'Your\' question has been deleted');
    }
}
