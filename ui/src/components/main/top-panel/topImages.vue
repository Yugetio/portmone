<template>
  <div class="topImages">
    <div v-if="isRegistration" v-on:click="changTopImg">
      <router-link to="/registration"><img src="./../../../assets/images/user.png" alt=""> </router-link>
    </div>
    <div v-else v-on:click="changTopImg">
      <router-link to="/"><img src="./../../../assets/images/exit.png" alt=""> </router-link>
    </div>
  </div>

</template>

<script>
export default {
  data() { return {
     isRegistration: true
    }
  },
  methods: {
     changTopImg(){
       if (this.isRegistration) {
         this.isRegistration = false;
       }
       else {
         this.isRegistration = true;
       }
    }
  }
}
</script>


<style>

</style>
