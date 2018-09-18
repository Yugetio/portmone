
<template>
<div class="nav">
  <div class="header" v-if="this.$route.path === '/'">
    <Logo></Logo>
    <LoginButton></LoginButton>
  </div>

  <div class="header" v-else="this.$route.path === '/profile', '/workpage' ">
    <Search></Search>
    <Account></Account>
  </div>
</div>
</template>

<script>
import Logo from './logo.vue';
import LoginButton from './topImages.vue';
import Search from './searchImg.vue';
import Account from './accountImg.vue';

export default {
  components: {
    LoginButton,
    Logo,
    Search,
    Account
  }
}
</script>

<style>
@import './../../../assets/style/header.css';
</style>
