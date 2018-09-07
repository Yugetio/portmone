<template>

  <div id="wrapper">

   <form name="login-form" class="login-form" action="" method="post">
<div class="content">
  <div class="header">
  <h1>Authorization</h1>
  <span>Enter your registration information to enter your personal account.</span>
  </div>
 <Input></Input>

</div>
<div class="footer">
 <Login></Login>

</div>
   </form>
 </div>
</div>

</template>

<script>

import Login from '../../main/forms/Login.vue';
import Input from '../../main/forms/input.vue';
  export default {
    components: {
      Login,
      Input
    }
  }
</script>

<style>
@import './../../../assets/style/forms.css';
</style>
