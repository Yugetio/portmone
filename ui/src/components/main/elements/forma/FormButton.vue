<template>
<router-link to='/'>
  <input
    @click="sendData"
    name="submit"
    type="button"
    v-bind:value="nameButton"
    class="button"
   />
</router-link>
</template>

<script>
  // import { mapActions } from 'vuex'

export default {
  props: ['inputData', 'nameButton'],
  data() {
    return {
      // model: {
      //   email: this.inputData.login,
      //   password: this.inputData.pass
      // }
    }
  },
  methods: {
    // ...mapActions(['auth']),
    sendData() {
      let dataToJson = {
        "login": this.inputData.login,
        "password": this.inputData.pass
      };
      let xmlhttp = new XMLHttpRequest(); // new HttpRequest instance
      xmlhttp.open("GET", "/");
      xmlhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
      xmlhttp.send(JSON.stringify(dataToJson));
      console.log(JSON.stringify(dataToJson));
    }
  }
}
</script>

<style>

</style>
