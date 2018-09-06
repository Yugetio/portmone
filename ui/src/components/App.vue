<template>

  <div id="app">
    
    <Panel></Panel>
    <div id="wrapper">

      <form name="login-form" class="login-form" action="" method="post">
  <div class="content">
    <Header></Header>
    <Username></Username>
    <Password></Password>
  </div>
  <div class="footer">
    <Login></Login>

  </div>
      </form>
    </div>
  </div>
</template>

<script>
import Login from './main/forms/Login.vue';
import Register from './main/forms/Sign_up.vue';
import Username from './main/forms/input_username.vue';
import Password from './main/forms/input_password.vue';
import Header from './main/forms/header.vue';
import Panel from './main/top-panel/topPanel.vue';
  export default {
    components: {
      Login,
      Register,
      Username,
      Password,
      Header,
      Panel
    }

  }
</script>

<style>
@import '../assets/style/forms.css';
</style>
