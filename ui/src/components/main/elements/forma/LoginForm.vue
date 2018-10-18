<template>
<div class="wrapper-form">
  <form
    name="login-form"
    class="login-form"
    action=""
    method="post">
    <div class="content-forms">
      <div class="header-forms">
        <h1>Authorization</h1>
        <span>Enter your registration information to enter your personal account.</span>
      </div>
      <Input @sendInputData='receivedInputData'/>
    </div>
    <div class="footer-forms">
      <Login
        :inputData="inputData"
        :nameButton="nameButton" />
    </div>
  </form>
</div>
</template>

<script>
import Login from '../../../main/elements/forma/FormButton.vue';
import Input from '../../../main/elements/forma/FormInput.vue';
export default {
  data() {
    return {
      inputData: {},
      nameButton: "Login"
    }
  },
  components: {
    Login,
    Input
  },
  methods: {
    receivedInputData(obj) {
      this.inputData = obj;
    }
  }
 }
</script>

<style>
@import './../../../../assets/style/forma.css';
</style>
