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
                        <div class="d-flex flex-column vote-controls">
                            <a title="this question is useful" class="vote-up">
                                <svg class="bi bi-caret-up-fill" width="2em" height="2em" viewBox="0 0 16 16"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.247 4.86l-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 00.753-1.659l-4.796-5.48a1 1 0 00-1.506 0z" />
                                </svg>
                            </a>
                            <span class="votes-count">1230</span>
                            <a title="this question is not useful" class="vote-down off">
                                <svg class="bi bi-caret-down-fill" width="2em" height="2em" viewBox="0 0 16 16"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 01.753 1.659l-4.796 5.48a1 1 0 01-1.506 0z" />
                                </svg>
                            </a>
                            <a title="click to mark as favorite question(click again to undo)"
                                class="favorite mt-2 favorited">
                                <svg class="bi bi-star-fill" width="2em" height="2em" viewBox="0 0 16 16"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                </svg>
                                <span class="favorites_count">12</span>
                            </a>
                        </div>
                        <div class="media-body">
                            {!! $question->body_html !!}
                            <div class="float-right">
                                <span class="text-muted">Ansered {{$question->created_date}}</span>
                                <div class="media">
                                    <a href="{{$question->User->url}}" class="pr-2">
                                        <img src="{{$question->User->avatar}}" alt="{{$question->User->name}}">
                                    </a>
                                    <div class="media-body mt-1">
                                        <a href="{{$question->User->url}}">{{$question->User->name}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h2>{{'Total Answers : ' . $question->answers_count}}</h2>
                    <hr>
                    @foreach ($question->Answers as $answer)
                    <div class="media">
                        <div class="d-flex flex-column vote-controls">
                            <a title="this answer is useful" class="vote-up">
                                <svg class="bi bi-caret-up-fill" width="2em" height="2em" viewBox="0 0 16 16"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.247 4.86l-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 00.753-1.659l-4.796-5.48a1 1 0 00-1.506 0z" />
                                </svg>
                            </a>
                            <span class="votes-count">1230</span>
                            <a title="this answer is not useful" class="vote-down off">
                                <svg class="bi bi-caret-down-fill" width="2em" height="2em" viewBox="0 0 16 16"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 01.753 1.659l-4.796 5.48a1 1 0 01-1.506 0z" />
                                </svg>
                            </a>
                            <a title="mask this answer as best answer"
                                class="vote-accept mt-2 vote-accepted">
                                <svg class="bi bi-check" width="3em" height="3em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 010 .708l-7 7a.5.5 0 01-.708 0l-3.5-3.5a.5.5 0 11.708-.708L6.5 10.293l6.646-6.647a.5.5 0 01.708 0z" clip-rule="evenodd"/>
                                  </svg>
                            </a>
                        </div>
                        <div class="media-body">
                            {!! $answer->body_html !!}
                            <div class="float-right">
                                <span class="text-muted">Ansered {{$answer->created_date}}</span>
                                <div class="media">
                                    <a href="{{$answer->User->url}}" class="pr-2">
                                        <img src="{{$answer->User->avatar}}" alt="{{$answer->User->name}}">
                                    </a>
                                    <div class="media-body mt-1">
                                        <a href="{{$answer->User->url}}">{{$answer->User->name}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
