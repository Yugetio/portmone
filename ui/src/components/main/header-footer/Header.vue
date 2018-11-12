<template>
<div class="nav">
  <div class="header">
    <template v-if="this.$route.path === '/' || this.$route.path === '/registration'">
      <Logo></Logo>
      <LoginButton></LoginButton>
    </template>
    <template v-else-if="checkPath">
      <Search></Search>
      <Account></Account>
    </template>
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
  methods: {
    checkPath() {
      return this.$route.path == '/profile' || /\/workpage?\/\d/.test(this.$route.path);
    }
  }
}
</script>

<style>
@import './../../../assets/style/header.css';
</style>
