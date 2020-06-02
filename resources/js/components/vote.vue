<template>
  <div class="d-flex flex-column vote-controls">
    <a @click.prevent="voteUp" :title="title('up')" class="vote-up" :class="classes">
      <svg
        class="bi bi-caret-up-fill"
        width="2em"
        height="2em"
        viewBox="0 0 16 16"
        fill="currentColor"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          d="M7.247 4.86l-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 00.753-1.659l-4.796-5.48a1 1 0 00-1.506 0z"
        />
      </svg>
    </a>
    <span class="votes-count">{{ votes_count }}</span>
    <a @click.prevent="voteDown" :title="title('down')" class="vote-down" :class="classes">
      <svg
        class="bi bi-caret-down-fill"
        width="2em"
        height="2em"
        viewBox="0 0 16 16"
        fill="currentColor"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 01.753 1.659l-4.796 5.48a1 1 0 01-1.506 0z"
        />
      </svg>
    </a>
    <!--@if($model instanceof App\Question)-->
    <!--@include('shared._favorite', [
    'model' => $model
    ])-->
    <favorite-infor v-if="name === 'question'" :question="model"></favorite-infor>
    <!--@elseif($model instanceof App\Answer)-->
    <!--@include('shared._accept', [
    'model' => $model
    ])-->
    <accept-infor v-else :answer="model"></accept-infor>
    <!--@endif-->
  </div>
</template>

<script>
import Favorite from "./favorite.vue";
import Accept from "./accept.vue";
export default {
  props: {
    name: String,
    model: Object
  },
  data() {
    return {
      votes_count: this.model.votes_count,
      id: this.model.id
    };
  },
  computed: {
    classes() {
      return this.signedIn ? "" : "off";
    },
    endpoint() {
      return `/${this.name === "question" ? "question" : "answers"}/${
        this.id
      }/vote`;
    }
  },
  components: {
    Favorite,
    Accept
  },
  methods: {
    title(voteType) {
      const titles = {
        up: `this ${this.name} is useful`,
        down: `this ${this.name} is not useful`
      };
      return titles[voteType];
    },
    voteUp() {
      this._vote(1);
    },
    voteDown() {
      this._vote(-1);
    },
    _vote(voteSign) {
      if (!this.signedIn) {
        this.$toast.warning(
          "Please login to vote",
          "OK",
          this.notificationSystem.options.warning
        );
        return;
      }
      axios
        .post(this.endpoint, {
          vote: voteSign
        })
        .then(res => {
          this.$toast.success(
            res.data.message,
            "OK",
            this.notificationSystem.options.success
          );
          this.votes_count = res.data.votes_count;
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
