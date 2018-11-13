<template>
<div>
  <div class="createEl">
    <CreateFolder v-if="this.$store.state.popUp.show === 'folder'"></CreateFolder>
    <CreateCard v-if="this.$store.state.popUp.show === 'card'"></CreateCard>
  </div>
   <div class="btnPanel">
     <div v-if="this.$store.state.folder.parentID" @click=""><<<</div> <!-- click -->
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