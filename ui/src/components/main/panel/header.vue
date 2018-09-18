<template>
    <div class="header">
        <Logo></Logo>
        <LoginButton></LoginButton>
    </div>
</template>

<script>
import LoginButton from './topImages.vue';
import Logo from './logo.vue';

  export default {
    components: {
      LoginButton,
      Logo
    }
  }
</script>

<style>
@import './../../../assets/style/header.css';
</style>
