<template>
  <a
    title="click to mark as favorite question(click again to undo)"
    :class="classes"
    @click.prevent="toggle"
  >
    <svg
      class="bi bi-star-fill"
      width="2em"
      height="2em"
      viewBox="0 0 16 16"
      fill="currentColor"
      xmlns="http://www.w3.org/2000/svg"
    >
      <path
        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
      />
    </svg>
    <span class="favorites_count">{{ count }}</span>
  </a>
</template>

<script>
export default {
  props: {
    question: Object
  },
  data() {
    return {
      isFavorited: this.question.is_favorited,
      count: this.question.favorites_count,
      id: this.question.id
    };
  },
  computed: {
    classes() {
      return [
        "favorite",
        "mt-2",
        !this.signedIn ? "off" : this.isFavorited ? "favorited" : ""
      ];
    },
    endpoint() {
      return `/question/${this.id}/favorites`;
    },
  },
  methods: {
    toggle() {
      if (this.signedIn) {
        this.isFavorited ? this.destroy() : this.create();
      } else {
        this.$toast.warrning(
          "please sigin to vote",
          "warning",
          this.notificationSystem.options.warning
        );
      }
    },
    destroy() {
      axios
        .delete(this.endpoint)
        .then(res => {
          this.count--;
          this.isFavorited = false;
        })
        .catch(err => {});
    },
    create() {
      axios
        .post(this.endpoint)
        .then(res => {
          this.count++;
          this.isFavorited = true;
        })
        .catch(err => {});
    }
  }
};
</script>

<style>
</style>
