<div class="float-right">
    <span class="text-muted">{{$lable}} {{$model->created_date}}</span>
    <div class="media">
        <a href="{{$model->User->url}}" class="pr-2">
            <img src="{{$model->User->avatar}}" alt="{{$model->User->name}}">
        </a>
        <div class="media-body mt-1">
            <a href="{{$model->User->url}}">{{$model->User->name}}</a>
        </div>
    </div>
</div>
