
<template>
<div class="topImages">
  <div
    v-if="isRegistration"
    v-on:click="changTopImg">
    <router-link to="/registration"><img src="./../../../assets/images/user.png" alt="user"> </router-link>
  </div>

  <div
    v-else
    v-on:click="changTopImg">
    <router-link to="/"><img src="./../../../assets/images/exit.png" alt="exit"> </router-link>
  </div>
</div>
</template>

<script>
export default {
  data() {
    return {
      isRegistration: this.$route.path === '/' ? true : false
    }
  },
  methods: {
    changTopImg() {
      this.isRegistration = !this.isRegistration;
    }
  }
}
</script>

<style>

</style>
