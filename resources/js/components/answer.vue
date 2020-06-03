<template>
  <div class="media post">
    <!--@include('shared._vote', [
        'model' => $answer
    ])-->
    <vote-infor :model="answer" name="answer"></vote-infor>
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
              <a
                v-if="authorize('modify', answer)"
                class="btn btn-sm btn-outline-info"
                @click.prevent="edit"
              >Edit</a>
              <button
                v-if="authorize('delete', answer)"
                @click.prevent="destroy"
                class="btn btn-sm btn-outline-danger ml-3"
              >Delete</button>
            </div>
          </div>
          <div class="col-4"></div>
          <div class="col-4">
            <!--@include('shared._author', [
                                'model' => $answer,
                                'lable' => 'Answered'
            ])-->
            <author-infor :model="answer" lable="Answered"></author-infor>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    answer: Object
  },
  data() {
    return {
      editing: false,
      body: this.answer.body,
      bodyHtml: this.answer.body_html,
      id: this.answer.id,
      questionId: this.answer.question_id,
      beforeEditCache: null
    };
  },
  methods: {
    edit() {
      this.beforeEditCache = this.body;
      this.editing = true;
    },
    cancel() {
      this.body = this.beforeEditCache;
      this.editing = false;
    },
    update() {
      axios
        .patch(this.endpoint, {
          body: this.body
        })
        .then(res => {
          //console.log(res);
          this.editing = false;
          this.bodyHtml = res.data.body_html;
          this.$toast.success(
            res.data.message,
            "OK",
            this.notificationSystem.options.success
          );
        })
        .catch(err => {
          console.log(err);
          this.editing = false;
        });
    },
    destroy() {
      if (
        this.$toast.question(
          "Are you sure about that?",
          "Hi",
          this.notificationSystem.options.question
        )
      ) {
        axios.delete(this.endpoint).then(res => {
          $(this.$el).fadeOut(500, () => {
            this.$toast.success(
              res.data.message,
              "OK",
              this.notificationSystem.options.success
            );
          });
        });
      }
    }
  },
  computed: {
    isInvalid() {
      return this.body.length < 10;
    },

    endpoint() {
      return `/question/${this.questionId}/answer/${this.id}`;
    }
  }
};
</script>

<style>
</style>
