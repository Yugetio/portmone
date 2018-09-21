<template>
<div id="app">
  <Header></Header>
  <router-view></router-view>
  <Footer></Footer>
</div>
</template>

<script>
import Header from './main/panel/header.vue'

import Footer from './main/panel/footer.vue'

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
