<template>
<router-link to='/'>
  <input
    @click="handler"
    name="submit"
    type="button"
    :value="nameButton"
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
      //getData
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
        body: JSON.stringify(dataToJson)
      });
      console.log(JSON.stringify(dataToJson));
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
  // let xmlhttp = new XMLHttpRequest(); // new HttpRequest instance
  // xmlhttp.open("GET", "/");
  // xmlhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
  // xmlhttp.send(JSON.stringify(dataToJson));
  // console.log(JSON.stringify(dataToJson));
</script>

<style>

</style>
