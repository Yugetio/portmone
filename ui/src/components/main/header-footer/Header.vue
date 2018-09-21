<template>
<div class="nav">
  <div class="header">
    <Logo v-show="show"></Logo>
    <LoginButton v-show="show"></LoginButton>
    <Search v-show="!show"></Search>
    <Account v-show="!show"></Account>
  </div>
</div>
</template>

<script>
import Logo from './LogoButton.vue';
import LoginButton from './RegistrationButton.vue';
import Search from './SearchButton.vue';
import Account from './AccountButton.vue';

export default {
  components: {
    LoginButton,
    Logo,
    Search,
    Account
  },
  data() {
    return {
      show: Boolean
    }
  },
  created() {
    if (this.$route.path === '/' || this.$route.path === '/registration') {
      this.show = true;
    } else {
      this.show = false;
    }
  }
}
</script>

<style>
@import './../../../assets/style/header.css';
</style>
