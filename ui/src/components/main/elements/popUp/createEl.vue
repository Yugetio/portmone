<template>
<div>
  <div class="createEl">
    <CreateFolder v-if="this.$store.state.popUp.show === 'folder'"></CreateFolder>
    <CreateCard v-if="this.$store.state.popUp.show === 'card'"></CreateCard>
  </div>
  <div class="btnPanel">
    <!-- add @click | call menthod setCurrentFolder ...-->
    <router-link  tag="div" @click.native="updateFolder" v-if="this.$store.state.folder.currentFolder.id" :to="toBackFolder()">
      <span><<<</span>
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
    },
    updateFolder() {
      const parentID = this.$store.state.folder.currentFolder.parentID;

      this.$store.dispatch('getCurrentFolder', parentID)
      this.$store.dispatch('getFolders', parentID)
      this.$store.dispatch('getCards', parentID)
    },
    toBackFolder(){
      const parentID = this.$store.state.folder.currentFolder.parentID;
      const workdir = '/workpage';

      if (parentID) {
        return `${workdir}/${parentID}`        
      }      
      return workdir
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