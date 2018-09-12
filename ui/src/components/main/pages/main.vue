<template>
  <div id="app">

    <Forma></Forma>
    <Content></Content>

  </div>
</template>

<script>
import Forma from '../../main/forms/loginForm.vue';
import Content from '../../main/forms/description.vue';
  export default {
    components: {
      Forma,
      Content
    }
  }
</script>

<style>
</style>
