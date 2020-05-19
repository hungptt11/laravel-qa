<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h2>{{'Total Answers : ' . $answers_count}}</h2>
                <hr>
                @include('layouts._message')
                @foreach ($Answers as $answer)
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
                        <a title="mask this answer as best answer" class="vote-accept mt-2 {{$answer->status}}">
                            <svg class="bi bi-check" width="3em" height="3em" viewBox="0 0 16 16" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M13.854 3.646a.5.5 0 010 .708l-7 7a.5.5 0 01-.708 0l-3.5-3.5a.5.5 0 11.708-.708L6.5 10.293l6.646-6.647a.5.5 0 01.708 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                    <div class="media-body">
                        {!! $answer->body_html !!}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="d-flex flex-row mr-3">
                                    @auth
                                    @can('update', $answer)
                                    <a class="btn btn-sm btn-outline-info"
                                        href="{{ route('question.answer.edit', [$question->id,$answer->id]) }}">Edit</a>
                                    @endcan
                                    @if(Auth::user()->can('delete', $answer))
                                    <form style="margin-left: 10px"
                                        action="{{ route('question.answer.destroy', [$question->id,$answer->id]) }}"
                                        method="POST">
                                        {{method_field('DELETE')}}
                                        @csrf
                                        <button type="submit" onclick="return confirm('Are you sure')"
                                            class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                    @endif
                                    @endauth
                                </div>
                            </div>
                            <div class="col-4"></div>
                            <div class="col-4">
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
                </div>
                <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>
