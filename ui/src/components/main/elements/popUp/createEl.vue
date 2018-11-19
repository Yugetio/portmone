<template>
<div>
  <div class="createEl">
    <CreateFolder v-if="this.$store.state.popUp.show === 'folder'"></CreateFolder>
    <CreateCard v-if="this.$store.state.popUp.show === 'card'"></CreateCard>
  </div>
  <div class="btnPanel">
    <router-link  tag="div"  v-if="this.$store.state.folder.currentFolder.id" @click.native="updateFolder" :to="toBackFolder()">
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
import { SHOW_CREATED_BLOCK } from '../../../../store/names/popUp'
import { GET_CURRENT_FOLDER, GET_FOLDERS, CREATE_FOLDER } from '../../../../store/names/folder'
import { GET_CARDS } from '../../../../store/names/card'

export default {
  methods: {
    setShowBlock(name) {
      // this.$store.dispatch(CREATE_FOLDER)
      this.$store.commit(SHOW_CREATED_BLOCK, name)
    },
    updateFolder() {
      const parentID = this.$store.state.folder.currentFolder.parentID;

      this.$store.dispatch(GET_CURRENT_FOLDER, parentID)
      this.$store.dispatch(GET_FOLDERS, parentID)
      this.$store.dispatch(GET_CARDS, parentID)
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