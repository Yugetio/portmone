<template>
<section class="content">
  <section class="forma">
    <div class="wrapper-form">
      <form
        name="login-form"
        class="login-form"
        action="" method="post">
        <div class="content-forms">
          <div class="header-forms">
            <h1>Registration</h1>
            <span>Enter login information</span>
          </div>
          <Input @sendInputData='receivedInputData' />
        </div>
        <div class="footer-forms">
          <Login
            :inputData="inputData"
            :nameButton="nameButton" />
        </div>
      </form>
    </div>
  </section>

  <section class="description">
    <Description></Description>
  </section>
</section>
</template>

<script>
import Login from '../../../main/elements/forma/FormButton.vue';
import Input from '../../../main/elements/forma/FormInput.vue';
import Description from '../../../main/elements/description/Description.vue';
export default {
  data() {
    return {
      inputData: {},
      nameButton: "Sign up"
    }
  },
  components: {
    Login,
    Input,
    Description
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
@import './../../../../assets/style/main.css';

</style>
