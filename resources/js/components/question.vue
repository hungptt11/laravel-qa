<template>
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <form class="card-body" v-if="editing" @submit.prevent="update">
          <div class="card-title">
            <div class="form-group">
              <input v-model="title" class="form-control form-control-lg" required name="title" />
            </div>
          </div>
          <div class="media">
            <div class="media-body">
              <div class="form-group">
                <textarea rows="10" v-model="body" class="form-control" required></textarea>
              </div>
              <button class="btn btn-outline-primary" :disabled="isInvalid">Update</button>
              <button class="btn btn-outline-dark" type="button" @click.prevent="cancel">Cancel</button>
            </div>
          </div>
        </form>
        <div class="card-body" v-else>
          <div class="card-title">
            <div class="d-flex align-items-center">
              <h4>{{title}}</h4>
              <div class="ml-auto">
                <a class="btn btn-outline-secondary" href="/question/">Back to Questions</a>
              </div>
            </div>
          </div>
          <hr />
          <div class="media">
            <!--@include('shared._vote', [
                        'model' => $question
            ])-->
            <vote-infor :model="question" name="question"></vote-infor>
            <div class="media-body">
              <div v-html="body_html"></div>
              <div class="row">
                <div class="col-4">
                  <a
                    v-if="authorize('modify', question)"
                    class="btn btn-sm btn-outline-info"
                    @click.prevent="edit"
                  >Edit</a>
                  <button
                    v-if="authorize('delete_ques', question)"
                    @click.prevent="destroy"
                    class="btn btn-sm btn-outline-danger ml-3"
                  >Delete</button>
                </div>
                <div class="col-4"></div>
                <div class="col-4">
                  <author-infor :model="question" lable="Asked"></author-infor>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    question: Object
  },
  data() {
    return {
      title: this.question.title,
      body_html: this.question.body_html,
      editing: false,
      id: this.question.id,
      boforeEditCache: {},
      body: this.question.body,
      questions_count: this.question.questions_count
    };
  },
  computed: {
    isInvalid() {
      return this.body.length < 10 || this.title.length < 10;
    },
    endPoint() {
      return `/question/${this.id}`;
    }
  },
  methods: {
    edit() {
      this.boforeEditCache = {
        body: this.body_html,
        title: this.title
      };
      this.editing = true;
    },
    cancel() {
      this.body = this.boforeEditCache.body;
      this.title = this.boforeEditCache.title;
      this.editing = false;
    },
    update() {
      axios
        .put(this.endPoint, {
          body: this.body,
          title: this.title
        })
        .then(result => {
          this.$toast.success(
            result.data.message,
            "OK",
            this.notificationSystem.options.success
          );
          this.body_html = result.data.body_html;
          this.editing = false;
        })
        .catch(err => {
          this.$toast.warning(
            "Update Error!",
            "OK",
            this.notificationSystem.options.warning
          );
          this.cancel();
        });
    },
    destroy() {
      this.$toast.question("Are you sure about that?", "Hi", {
        timeout: 20000,
        close: false,
        overlay: true,
        displayMode: "once",
        id: "question",
        zindex: 999,
        title: "Hey",
        position: "center",
        buttons: [
          [
            "<button><b>YES</b></button>",
            (instance, toast) => {
              axios
                .delete(`/question/${this.id}`)
                .then(res => {
                  setTimeout(() => {
                    window.location.href = "/question";
                  }, 3000);
                })
                .catch(err => {
                  this.$toast.warning(
                    "Delete Error!",
                    "OK",
                    this.notificationSystem.options.warning
                  );
                });

              instance.hide({ transitionOut: "fadeOut" }, toast, "button");
            },
            true
          ],
          [
            "<button>NO</button>",
            function(instance, toast) {
              instance.hide({ transitionOut: "fadeOut" }, toast, "button");
            }
          ]
        ]
      });
    }
  }
};
</script>

<style>
</style>
