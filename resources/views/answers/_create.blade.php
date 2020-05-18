<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h2>Your Answer</h2>
                <hr>
                <form action="{{ route('question.answer.store', $question->id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <textarea class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" rows="7"
                            name="body"></textarea>
                        @if ($errors->has('body'))
                        <div class="invalid-feedback">
                            <strong>{{$errors->first('body')}}</strong>
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-primary btn-lg">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
