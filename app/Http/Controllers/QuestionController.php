<?php

namespace App\Http\Controllers;

use App\Http\Requests\AskQuestionRequest;
use App\Question;
use Gate;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
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
         /*       if(Gate::allows('update-question', $question)){
            return view('question.edit')->with('question', $question);
        } */
        if(Gate::denies('update-question', $question)){
            return abort(403, 'Access denied');

        }
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
        $question->update($request->only('title', 'body'));
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
        if(Gate::denies('delete-question', $question)){
            return abort(403, 'Access denied');
        }
        $question->delete();
        return redirect()->route('question.index')->with('success', 'Your\' question has been deleted');
    }
}
