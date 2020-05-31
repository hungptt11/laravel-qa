@if($answers_count > 0)
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h2>{{'Total Answers : ' . $answers_count}}</h2>
                <hr>
                @include('layouts._message')
                @foreach ($Answers as $answer)
                    @include('answers._answer')
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif
