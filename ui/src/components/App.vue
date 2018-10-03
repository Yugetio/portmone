<template>
<div id="app">
  <Header></Header>
  <router-view></router-view>
  <Footer></Footer>
</div>
</template>

<script>
import Header from './main/header-footer/Header.vue'
import Footer from './main/header-footer/Footer.vue'

new Vue({
  el: '#get',
  data() {
    return {
      info: null
    };
  },
  mounted() {
    this.$http
      .get("/user")
      .then(response => (this.info = response));
      this.$emit("getInfo", this.info);
  }
})
export default {
  components: {
    Header,
    Footer
  }
}

</script>

<style>
@import './../assets/style/general.css';
</style>
