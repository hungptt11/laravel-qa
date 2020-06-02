<template></template>

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
      beforeEditCache: null,
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
