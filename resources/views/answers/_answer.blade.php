<answer-infor :answer="{{ $answer }}" inline-template>
    <div class="media post">
        @include('shared._vote', [
        'model' => $answer
        ])
        <div class="media-body">
            <form v-if="editing" @submit.prevent="update">
                <div class="form-group">
                    <textarea rows="10" v-model="body" class="form-control" required name="body"></textarea>
                </div>
                <button class="btn btn-outline-primary" :disabled="isInvalid">Update</button>
                <button class="btn btn-outline-dark" type="button" @click.prevent="cancel">Cancel</button>
            </form>
            <div v-else>
                <div v-html="bodyHtml"></div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="d-flex flex-row mr-3">
                            @auth
                            @can('update', $answer)
                            <a class="btn btn-sm btn-outline-info" @click.prevent="edit">Edit</a>
                            @endcan
                            @if(Auth::user()->can('delete', $answer))
                            <button @click.prevent="destroy" class="btn btn-sm btn-outline-danger">Delete</button>
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
    </div>
</answer-infor>
