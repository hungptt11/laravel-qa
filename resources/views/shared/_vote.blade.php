@if($model instanceof App\Question)
@php
$name = 'question';
$firstUrlSegment = 'questions';
@endphp
@elseif($model instanceof App\Answer)
@php
$name = 'answer';
$firstUrlSegment = 'answers';
@endphp
@endif

<div class="d-flex flex-column vote-controls">
    <a title="this {{$name}} is useful" class="vote-up {{ Auth::guest() ? 'off' : '' }}"
        onclick="event.preventDefault; document.getElementById('up-vote-{{$name}}-{{$model->id}}').submit()">
        <svg class="bi bi-caret-up-fill" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M7.247 4.86l-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 00.753-1.659l-4.796-5.48a1 1 0 00-1.506 0z" />
        </svg>
    </a>
    <form style="display:none" id="up-vote-{{$name}}-{{$model->id}}"
        action="{{ route($firstUrlSegment.'.vote', $model->id) }}" method="POST">
        @csrf
        <input type="hidden" name="vote" value="1">
    </form>
    <span class="votes-count">{{$model->votes_count}}</span>
    <a title="this {{$name}} is not useful" class="vote-down {{ Auth::guest() ? 'off' : '' }}"
        onclick="event.preventDefault; document.getElementById('down-vote-{{$name}}-{{$model->id}}').submit()">
        <svg class="bi bi-caret-down-fill" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 01.753 1.659l-4.796 5.48a1 1 0 01-1.506 0z" />
        </svg>
    </a>
    <form style="display:none" id="down-vote-{{$name}}-{{$model->id}}"
        action="{{ route($firstUrlSegment.'.vote', $model->id) }}" method="POST">
        @csrf
        <input type="hidden" name="vote" value="-1">
    </form>
    @if($model instanceof App\Question)
    @include('shared._favorite', [
    'model' => $model
    ])
    @elseif($model instanceof App\Answer)
    @include('shared._accept', [
    'model' => $model
    ])
    @endif
</div>
