<template>
<div class="wrapper-form">
  <form
    class="login-form"
    >
    <div class="content-forms">
      <div class="header-forms">
        <h1>Authorization</h1>
        <span>Enter your registration information to enter your personal account.</span>
      </div>
      <div id="input">
        <input
          required
          v-model="email"
          type="email"
          class="email"
          placeholder="Email"
        />
        <input
          required
          v-model="password"
          type="password"
          class="password"
          min="6"
          placeholder="Password"
        />
      </div>
    </div>
    <div class="footer-forms">
      <router-link to='/'>
        <div id="app">
          <input
            @click="login"
            name="submit"
            type="button"
            value="Login"
            class="button"
          />
         </div>
        </router-link>
    </div>
  </form>
</div>
</template>

<script>
import { LOGIN } from '../../../../store/names/user'

export default {
  data() {
    return {
      "email": '',
      "password": ''
    }
  },
  methods: {
    login() {
      this.$store.dispatch(LOGIN, {
        email: this.email,
        password: this.password
      })
      .then((res) => {  
        this.$store.commit('setToken', res)
        this.$router.push('/workpage')
      }).catch(error => {
        console.error('Error: ' + error.message)
      })
    }
  }
 }
</script>

<style>
@import './../../../../assets/style/forma.css';
</style>
