<template>
  <div class="row mt-4" v-cloak v-if="answers_count > 0">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h2>{{title}}</h2>
          <hr />
          <answer-infor
            @deleted="remove(index)"
            v-for="(model, index) in answers_lst"
            :key="model.id"
            :answer="model"
          ></answer-infor>
          <div class="text-center mt-3" v-if="nextUrl">
            <button
              class="btn btn-outline-secondary"
              @click.prevent="fetch(nextUrl)"
            >Load More Answer</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Answer from "./answer.vue";
export default {
  props: {
    question: Object
  },
  data() {
    return {
      questionId: this.question.id,
      answers_count: this.question.answers_count,
      answers_lst: [],
      nextUrl: ""
    };
  },
  components: {
    Answer
  },
  created() {
    this.fetch(`/question/${this.question.id}/answer`);
  },
  methods: {
    fetch(endPoint) {
      axios.get(endPoint).then(({ data }) => {
        this.answers_lst.push(...data.data);
        this.nextUrl = data.next_page_url;
      });
    },
    remove(index) {
      this.answers_lst.splice(index, 1);
      this.answers_count--;
    }
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
