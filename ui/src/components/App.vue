<template>
  <div>
      <Header></Header>
        <Footer></Footer>
      <router-view></router-view>
  </div>
</template>

<script>

import Header from  './main/panel/header.vue';
import Footer from  './main/panel/footer.vue';

export default {
  components: {
    Header,
    Footer

  }
}
</script>

<style>

</style>
