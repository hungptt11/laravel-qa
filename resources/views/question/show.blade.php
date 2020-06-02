@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h4>{{$question->title}}</h4>
                            <div class="ml-auto">
                                <a class="btn btn-outline-secondary" href="{{route('question.index')}}">
                                    Back to Questions
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="media">
                        <!--@include('shared._vote', [
                        'model' => $question
                        ])-->
                        <vote-infor :model="{{$question}}" name="question"></vote-infor>
                        <div class="media-body">
                            {!! $question->body_html !!}
                            <author-infor :model="{{ $question}}" lable="Asked"></author-infor>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @auth
    @include('answers._create', [
    'Answers' => $question->Answers,
    'answers_count' => $question->answers->count()
    ])
    @endauth

    @include('answers._index', [
    'Answers' => $question->Answers,
    'answers_count' => $question->answers->count()
    ])

</div>
@endsection
