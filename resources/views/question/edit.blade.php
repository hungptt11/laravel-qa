@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>Edit Question</h2>
                        <div class="ml-auto">
                            <a class="btn btn-outline-secondary" href="{{route('question.index')}}">
                                Back to Questions
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('question.update', $question->id)}}" method="POST">
                        {{method_field('PUT')}}
                        @include('question._form', ['buttonText' => 'Save this question']);
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
