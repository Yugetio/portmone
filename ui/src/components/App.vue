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
  components: {
    Header,
    Footer
  },
  // data(){
  //   data: ''
  // },
  methods:{
    getToken(){
      let codeToken = localStorage.getItem('token');
      let splitToken = codeToken.split('.');
      let atobToken = atob(splitToken[1]);
      let uncodeToken = JSON.parse(atobToken);
      //  JSON.parse(atob(storage.getItem('token').split('.')[1])) - головоломич. Кєк
      return uncodeToken;
    },

    tokenCheck(token){
      // let dbTokenGet=this.$http
      //   .get("/user")
      //   .then(response => (this.info = response));

      if(token['expires_in']>Date.now()){
        return true;
      } else if(localStorage.getItem('token')===dbTokenGet){
        return true
      } else {
        return false;
      }
    },
    tokenTimeDown(){
        alert("Session is timedown. Back to login page");
        this.$router.push("http://localhost:4000");
    }
  }
}
</script>

<style>
@import './../assets/style/general.css';
</style>
