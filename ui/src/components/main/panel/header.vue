<template>
    <div class="header">
        <div class="logo"> <img src="./../../../assets/images/logo.png" alt="logo"></div>
        <LoginButton></LoginButton>
    </div>
</template>

<script>
import LoginButton from './topImages.vue';

  export default {
    components: {
      LoginButton
    }
  }
</script>

<style>
@import './../../../assets/style/header.css';
</style>
