<template>
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
</template>

  <!--<get-data :getdata="getData"></get-data>-->

<script>
  // import { mapActions } from 'vuex'

export default {
  props: ['inputData', 'nameButton'],

  data() {
    return {

    }
  },
  methods: {
    sendData() {
      let dataToJson = {
        "email": this.inputData.email,
        "password": this.inputData.pass
      };

      fetch("/", {
        method: 'GET',
        headers: {
          "Content-type": "application/json;charset=UTF-8"
        },

      });
      console.log(JSON.stringify(dataToJson));
    },

  },
  watch: {
    info(newInfo) {
      localStorage.info = newInfo;
    }
  }
}
  // let xmlhttp = new XMLHttpRequest(); // new HttpRequest instance
  // xmlhttp.open("GET", "/");
  // xmlhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
  // xmlhttp.send(JSON.stringify(dataToJson));
  // console.log(JSON.stringify(dataToJson));
</script>

<style>

</style>
