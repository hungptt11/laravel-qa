@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h6>{{$question->title}}</h6>
                        <div class="ml-auto">
                            <a class="btn btn-outline-secondary" href="{{route('question.index')}}">
                                Back to Questions
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="media">
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
