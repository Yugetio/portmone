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
            v-model="email"
            name="username"
            type="email"
            class="input email"
            value="Username"
            placeholder="Email"
          />
          <input
            required
            v-model="password"
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
export default {
  data() {
    return {
      email: '',
      password: ''
    }
  },
  methods: {
    async registration() {
      await this.$store.dispatch('reg', {
        email: this.email,
        password: this.password
      });
      if(this.$store.state.user.isAuth) {
        this.$router.push('/workpage');
      } else {
        console.error('error login');
      }
    }
  }
}
</script>

<style>
@import './../../../../assets/style/forma.css';
</style>
