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

export default {
  props['getToken','tokenCheck'],
  components: {
    Header,
    Footer
  },
  methods:{
    getToken(){
      let codeToken = storage.getItem('token');
      let splitToken = codeToken.split('.');
      let atobToken = atob(splitToken[1]);
      let uncodeToken = JSON.parse(atobToken);

      return uncodeToken;
    },
    tokenCheck(token){
      let dbTokenGet=this.$http
        .get("/user")
        .then(response => (this.info = response));

      if(token['expires_in']>Date.now()){
        return true;
      } else if(storage.getItem('token')===dbTokenGet){
        return true
      } else {
        return false;
      }
    }
  }
}
</script>

<style>
@import './../assets/style/general.css';
</style>
