
<template>
<div class="topImages">
  <div
    v-if="this.$route.path === '/'">
    <router-link to="/registration"><img src="./../../../assets/images/user.png" alt="user"> </router-link>
  </div>

  <div v-else>
    <router-link to="/"><img src="./../../../assets/images/exit.png" alt="exit"> </router-link>
  </div>
</div>
</template>

<script>

</script>

<style>

</style>
