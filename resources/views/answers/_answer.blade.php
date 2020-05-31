<div class="media post">
    @include('shared._vote', [
    'model' => $answer
    ])
    <div class="media-body">
        {{ strip_tags($answer->body_html) }}
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
                        action="{{ route('question.answer.destroy', [$question->id,$answer->id]) }}" method="POST">
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
                <!--@include('shared._author', [
                                'model' => $answer,
                                'lable' => 'Answered'
                                ])-->
                <author-infor :model="{{ $answer}}" lable="Answered"></author-infor>
            </div>
        </div>

    </div>
</div>
