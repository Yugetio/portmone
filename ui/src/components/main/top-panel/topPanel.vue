<template>
<div class="panel">
<LoginButton></LoginButton>

</div>

</template>

<script>
import LoginButton from './login-button.vue';
import RegButton from './registration-button.vue';

  export default {
    components: {
      LoginButton,
      RegButton
    }
  }
</script>

<style>
@import './../../../assets/style/topPanel.css';
</style>
