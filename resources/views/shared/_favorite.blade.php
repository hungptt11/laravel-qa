<a title="click to mark as favorite question(click again to undo)"
    onclick="event.preventDefault; document.getElementById('favorite-question-{{$model->id}}').submit()"
    class="favorite mt-2 {{ Auth::guest() ? 'off' : ($model->is_favorited ? 'favorited' : '') }}">
    <svg class="bi bi-star-fill" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor"
        xmlns="http://www.w3.org/2000/svg">
        <path
            d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
    </svg>
    <span class="favorites_count">{{$model->favorites->count()}}</span>
</a>
<form style="display:none" id="favorite-question-{{$model->id}}" action="{{$model->id}}/favorites" method="POST">
    @csrf
    @if($model->is_favorited)
    @method('DELETE');
    @endif
</form>

