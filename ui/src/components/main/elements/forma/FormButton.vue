<template>
<router-link to='/'>
  <input
    @click="handler"
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
       info: ''
    }
  },
  methods: {
    sendData() {
      let dataToJson = {
        "email": this.inputData.email,
        "password": this.inputData.pass
      };
      let xmlhttp = new XMLHttpRequest(); // new HttpRequest instance
      xmlhttp.open("GET", "/");
      xmlhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
      xmlhttp.send(JSON.stringify(dataToJson));
      console.log(JSON.stringify(dataToJson));
    },
    getData() {
       this.$http
       .get("/user")
       .then(response => (this.info = response));

    },
    handler(){
      this.sendData();
      this.getData();
    }
  },
  watch: {
    info(newInfo) {
      localStorage.info = newInfo;
    }
  }
}
</script>

<style>

</style>
