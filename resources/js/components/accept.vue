<template>
  <div>
    <a
      v-if="canAccept"
      title="mask this answer as best answer"
      :class="classes"
      @click.prevent="create"
    >
      <svg
        class="bi bi-check"
        width="3em"
        height="3em"
        viewBox="0 0 16 16"
        fill="currentColor"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          fill-rule="evenodd"
          d="M13.854 3.646a.5.5 0 010 .708l-7 7a.5.5 0 01-.708 0l-3.5-3.5a.5.5 0 11.708-.708L6.5 10.293l6.646-6.647a.5.5 0 01.708 0z"
          clip-rule="evenodd"
        />
      </svg>
    </a>
    <a v-if="accepted" title="mask this answer as best answer" :class="classes">
      <svg
        class="bi bi-check"
        width="3em"
        height="3em"
        viewBox="0 0 16 16"
        fill="currentColor"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          fill-rule="evenodd"
          d="M13.854 3.646a.5.5 0 010 .708l-7 7a.5.5 0 01-.708 0l-3.5-3.5a.5.5 0 11.708-.708L6.5 10.293l6.646-6.647a.5.5 0 01.708 0z"
          clip-rule="evenodd"
        />
      </svg>
    </a>
  </div>
</template>

<script>
import EventBus from "../event_bus";
export default {
  props: {
    answer: Object
  },
  data() {
    return {
      isBest: this.answer.is_best,
      id: this.answer.id
    };
  },
  created() {
    EventBus.$on("accepted", id => {
      this.isBest = id === this.id;
    });
  },
  computed: {
    canAccept() {
      return this.authorize("accept", this.answer);
    },
    accepted() {
      return !this.canAccept && this.isBest;
    },
    classes() {
      return ["vote-accept", "mt-2", this.isBest ? "vote-accepted" : ""];
    },
    endPoint() {
      return `/answers/${this.id}/accept`;
    }
  },
  methods: {
    create() {
      axios
        .post(this.endPoint)
        .then(res => {
          this.$toast.success(
            "You has been marked as accepted answer!",
            "OK",
            this.notificationSystem.options.success
          );
          EventBus.$emit("accepted", this.id);
        })
        .catch(err => {});
    }
  }
};
</script>

<style>
</style>
