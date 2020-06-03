<template>
  <div class="row mt-4" v-cloak v-if="answers_count > 0">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h2>{{title}}</h2>
          <hr />
          <answer-infor v-for="model in answers_lst" :key="model.id" :answer="model"></answer-infor>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Answer from "./answer.vue";
export default {
  props: {
    answers_count: Number,
    answers_lst: Array
  },
  components: {
    Answer
  },
  computed: {
    title() {
      return `Total Answers : ${this.answers_count}`;
    }
  }
};
</script>

<style>
</style>
