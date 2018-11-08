<template>
  <div class="wrapper-form">
    <form
      name="login-form"
      class="login-form"
      action=""
      method="post">
      <div class="content-forms">
        <div class="header-forms">
          <h1>Registration</h1>
          <span>Enter login information</span>
        </div>
        <div id="input">
          <input
            required
            v-model="inputData.email"
            name="username"
            type="email"
            class="input email"
            value="Username"
            placeholder="Email"
          />
          <input
            required
            v-model="inputData.pass"
            name="password"
            type="password"
            class="input password"
            value="Password"
            min="6"
            placeholder="Password"
           />
        </div>
      </div>
      <div class="footer-forms">
        <router-link to='/'>
          <div id="app">
          <input
            @click="sendData"
            name="submit"
            type="button"
            :value="nameButton"
            class="button"
           />
          </div>
        </router-link>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      inputData: {
        email: '',
        pass: ''
      },
      nameButton: "Sign up"
    }
  },
  methods: {
    sendData() {
      let dataToJson = {
        "email": this.inputData.email,
        "password": this.inputData.pass
      };
      console.log(dataToJson, this.nameButton)

      
        // fetch("/user", {
        //  method: 'post',
        //   body: dataToJson
        // });
      
    }
  }
}
</script>

<style>
@import './../../../../assets/style/forma.css';
</style>
