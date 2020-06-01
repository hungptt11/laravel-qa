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
        .patch(`/question/${this.questionId}/answer/${this.id}`, {
          body: this.body
        })
        .then(res => {
          console.log(res);
          this.editing = false;
          this.bodyHtml = res.data.body_html;
        })
        .catch(err => {
          console.log(err);
          this.editing = false;
        });
    }
  },
  computed: {
    isInvalid() {
      return this.body.length < 10;
    }
  }
};
</script>

<style>
</style>
