<template>
<section class="content">
  <div class="panel-navigation">
    <a href="#" @click="$router.go(-1)"><img src="../../../assets/images/back.png" alt="back"></a>
    <a href="#"><img src="../../../assets/images/social.png" alt="social"></a>
    <router-link to="/workpage"><img src="../../../assets/images/exit2.png" alt="exit"></router-link>
  </div>
  <div class="username">
      <img src="./../../../assets/images/user_name.png" alt="user_name">
      <h1>{{ this.$store.getters.getUser }}</h1>
  </div>
  <div class="delete-profile">
      <a @click='editUser' class="button7">Edit</a>
      <a @click='logout' class="button7">Logout</a>
      <a @click='deleteUser' class="button7">Delete</a>
  </div>
</section>
</template>

<script>
  export default {
  data(){
    return{
    }
  },
  methods:{
    editUser() {

    },
    logout() {

    },
    deleteUser() {
      
    }
  }
}
</script>

<style>
@import '../../../assets/style/profilePage.css';
</style>
