<template>
  <div class="wrapper-form">
    <form
      class="login-form"
      >
      <div class="content-forms">
        <div class="header-forms">
          <h1>Registration</h1>
          <span>Enter login information</span>
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
            @click="registration"
            name="submit"
            type="button"
            value="Sign up"
            class="button"
           />
          </div>
        </router-link>
      </div>
    </form>
  </div>
</template>

<script>
import { REG, SET_TOKEN } from '../../../../store/names/user'

export default {
  data() {
    return {
      email: '',
      password: ''
    }
  },
  methods: {
    registration() {
      this.$store.dispatch(REG, {
        email: this.email,
        password: this.password
      })
      .then(res => {
        this.$router.push('/workpage')
      })
      .catch(error => {
        console.error('Error: ' + error.message)
      })
    }
  }
}
</script>

<style>
@import './../../../../assets/style/forma.css';
</style>
