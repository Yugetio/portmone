<template>
<section class="content">

  <div class="panel-navigation">
    <!-- <div class="back"> -->
        <a @click="$router.go(-1)"><img src="../../../assets/images/back.png" alt="back"></a>
        <a href="#"><img src="../../../assets/images/social.png" alt="social"></a>
        <router-link to="/workpage"><img src="../../../assets/images/exit2.png" alt="exit"></router-link>
    <!-- </div> -->
  </div>
  <div class="username">
      <img src="./../../../assets/images/user_name.png" alt="user_name">
      <h1>{{email}}</h1>
  </div>
  <div class="delete-profile">
      <a @click='updateProfile' class="button7">Update Profile</a>
      <a @click='deleteProfile' class="button7">Delete Profile</a>
  </div>
</section>
</template>

<script>
  export default {
  data(){
    return{
      email: 'user@mail.com'
    }
  },
  methods:{
    deleteProfile(){
      fetch('/user', {
        method: 'DELETE',
        body: JSON.stringify({
          id: dataFromToken['id'],
          email: dataFromToken['email'],
          password: dataFromToken['token']
        }).then( response => console.log(response) )
          .catch( error => console.error(error) )
      });

    },
    updateProfile(){
      fetch('/user', {
        method: 'PUT',
        body: JSON.stringify({
            id: dataFromToken['id'],
            email: dataFromToken['email'],
            password: dataFromToken['token']
          }).then( response => console.log(response) )
            .catch( error => console.error(error) )
        });
    },

  }
}
</script>

<style>
@import '../../../assets/style/profilePage.css';
</style>
