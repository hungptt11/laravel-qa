<template>
  <div class="row mt-4" v-if="this.signedIn">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h2>Your Answer</h2>
          <hr />
          <form @submit.prevent="create">
            <div class="form-group">
              <textarea class="form-control" rows="7" v-model="body" required name="body"></textarea>
            </div>
            <div class="form-group">
              <button
                type="submit"
                :disabled="isInvaild"
                class="btn btn-outline-primary btn-lg"
              >Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    questionId: Number
  },
  data() {
    return {
      body: ""
    };
  },
  computed: {
    isInvaild() {
      return this.body.length < 10;
    },
    endpoint() {
      return `/question/${this.questionId}/answer/`;
    }
  },
  methods: {
    create() {
      axios
        .post(this.endpoint, {
          body: this.body
        })
        .then(res => {
          //console.log(res);
          this.body = "";
          this.$toast.success(
            res.data.message,
            "OK",
            this.notificationSystem.options.success
          );
          this.$emit("created", res.data.answer);
        })
        .catch(err => {
          console.log(err);
        });
    }
  }
};
</script>

<style>
</style>
