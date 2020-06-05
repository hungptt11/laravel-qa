<template>
  <div class="container">
    <question-info :question="question"></question-info>
    <!--@include('answers._create', [
    'Answers' => $question->Answers,
    'answers_count' => $question->answers->count()
    ])-->

    <!--@include('answers._index', [
    'Answers' => $question->Answers,
    'answers_count' => $question->answers->count()
    ])-->
    <answers-infor :question="question"></answers-infor>
  </div>
</template>

<script>
export default {
  props: {
    question: Object
  }
};
</script>

<style>
</style>
