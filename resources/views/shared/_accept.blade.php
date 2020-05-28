@can('accept', $model)
    <a title="mask this answer as best answer"
        onclick="event.preventDefault; document.getElementById('accept-answer-{{$model->id}}').submit()"
        class="vote-accept mt-2 {{$model->status}}">
        <svg class="bi bi-check" width="3em" height="3em" viewBox="0 0 16 16" fill="currentColor"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M13.854 3.646a.5.5 0 010 .708l-7 7a.5.5 0 01-.708 0l-3.5-3.5a.5.5 0 11.708-.708L6.5 10.293l6.646-6.647a.5.5 0 01.708 0z"
                clip-rule="evenodd" />
        </svg>
    </a>
    <form style="display:none" id="accept-answer-{{$model->id}}" action="{{ route('answers.accept', $model->id) }}"
        method="POST">
        @csrf
    </form>
    @else
    @if($model->isBest)
    <a title="mask this answer as best answer" onclick="event.preventDefault;"
        class="vote-accept mt-2 {{$model->status}}">
        <svg class="bi bi-check" width="3em" height="3em" viewBox="0 0 16 16" fill="currentColor"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M13.854 3.646a.5.5 0 010 .708l-7 7a.5.5 0 01-.708 0l-3.5-3.5a.5.5 0 11.708-.708L6.5 10.293l6.646-6.647a.5.5 0 01.708 0z"
                clip-rule="evenodd" />
        </svg>
    </a>
    @endif
    @endcan
