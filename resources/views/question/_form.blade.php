@csrf
<div class="form-group">
    <label for="question-title">Question Title</label>
    <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : ''}}" name="title"
        id="question-title" value="{{ old('title', $question->title)}}">
    @if($errors->has('title'))
    <div class="invalid-feedback">
        <strong>{{$errors->first('title')}}</strong>
    </div>
    @endif
</div>
<div class="form-group">
    <label for="question-body">Explain Your Question</label>
    <textarea class="form-control {{$errors->has('body') ? 'is-invalid' : ''}}" rows=10 name="body"
        id="question-body">{{ old('body', $question->body) }}</textarea>
    @if($errors->has('body'))
    <div class="invalid-feedback">
        <strong>{{$errors->first('body')}}</strong>
    </div>
    @endif
</div>
<div class="form-group">
    <input type="submit" value="{{$buttonText}}" class="btn btn-outline-primary btn-lg">
</div>
