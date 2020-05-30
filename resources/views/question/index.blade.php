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
                    @include('question._question')
                    @endforeach
                    <div class="justify-content-center mt-3">{{$questions->links()}}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
