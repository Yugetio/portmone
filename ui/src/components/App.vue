<template>
  <div>
      <TopPanel></TopPanel>
      <router-view></router-view>
  </div>
</template>

<script>
import TopPanel from  './main/top-panel/topPanel.vue';

export default {
  components: {
    TopPanel
  }
}
</script>

<style>

</style>
