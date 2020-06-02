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
