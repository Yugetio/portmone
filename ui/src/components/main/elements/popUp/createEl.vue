<template>
<div>
  <div class="createEl">
    <CreateFolder v-if="this.$store.state.popUp.show === 'folder'"></CreateFolder>
    <CreateCard v-if="this.$store.state.popUp.show === 'card'"></CreateCard>
  </div>
  <div class="btnPanel">
    <!-- add @click | call menthod setCurrentFolder ...-->
    <router-link  v-if="this.$store.state.folder.currentFolder.id" :to="this.$store.state.folder.currentFolder.parentID === null ? '/workpage' : `/workpage/${ this.$store.state.folder.currentFolder.id }`">
      <div><<<</div>
    </router-link>  

    <div @click="setShowBlock('folder')">Create Folder</div>
    <div @click="setShowBlock('card')">Create Card</div>
  </div>
</div> 
</template>

<script>
import CreateFolder from './elements/createFolder.vue';
import CreateCard from './elements/createCard.vue';

export default {
  methods: {
    setShowBlock(name) {
      this.$store.dispatch('createFolder')
      this.$store.commit('showCreateBlock', name)
    }
  },
  components: {
    CreateFolder,
    CreateCard
  }
 }
</script>

<style>
  @import '../../../../assets/style/createEl.css';
</style>