@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>All Question</h2>
                        <div class="ml-auto">
                            <a class="btn btn-outline-secondary" href="{{route('question.create')}}">Ask new
                                Question</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('layouts._message')
                    @foreach ($questions as $question)
                    <div class="media">
                        <div class="d-flex flex-column counters">
                            <div class="vote">
                                <strong>{{ $question->votes_count }}</strong>
                                {{ Str::plural('vote', $question->votes_count) }}
                            </div>
                            <div class="status {{$question->status}}">
                                <strong>{{ $question->answers_count }}</strong>
                                {{ Str::plural('answer', $question->answers_count) }}
                            </div>
                            <div class="views">
                                {{ $question->views . " " . Str::plural('view', $question->views) }}
                            </div>
                        </div>
                        <div class="media-body">
                            <div class="d-flex  align-items-center">
                                <h3 class="mt-0">
                                    <a href="{{ $question->url }}"> {{$question->title}}</a>
                                </h3>
                                <div class="ml-auto">
                                    <div class="d-flex justify-content-between">
                                        @auth
                                        @can('update', $question)
                                        <a class="btn btn-sm btn-outline-info"
                                            href="{{route('question.edit', $question->id)}}">Edit</a>
                                        @endcan
                                        @if(Auth::user()->can('delete', $question))
                                        <form style="margin-left: 10px"
                                            action="{{route('question.destroy', $question->id)}}" method="POST">
                                            {{method_field('DELETE')}}
                                            @csrf
                                            <button type="submit" onclick="return confirm('Are you sure')"
                                                class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                        @endif
                                        @endauth
                                    </div>
                                </div>
                            </div>
                            <p class="lead">
                                Asked by
                                <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                                <small class="text-muted">{{ $question->created_date }}</small>
                            </p>
                            <div class="nothing">
                                {{ $question->excerpt  }}
                            </div>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                    <div class="justify-content-center">{{$questions->links()}}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
