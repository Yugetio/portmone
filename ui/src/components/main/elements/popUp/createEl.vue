<template>
<div>
  <div class="createOrEditEl">
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
import { SHOW_CREATE_OR_EDIT_BLOCK } from '../../../../store/names/popUp'
import { GET_CURRENT_FOLDER, GET_FOLDERS } from '../../../../store/names/folder'
import { GET_CARDS } from '../../../../store/names/card'

export default {
  methods: {
    setShowBlock(name) {
      this.$store.commit(SHOW_CREATE_OR_EDIT_BLOCK, { name })
    },
    updateFolder() { //переробити щоб перенаправлення робило тільки після того як всі запроси відпрацюют успішно 
      const parentId = this.$store.state.folder.currentFolder.parentId;

      this.$store.dispatch(GET_CURRENT_FOLDER, parentId)
      this.$store.dispatch(GET_FOLDERS, parentId)
      this.$store.dispatch(GET_CARDS, parentId)
    },
    toBackFolder(){
      const parentId = this.$store.state.folder.currentFolder.parentId;
      const workdir = '/workpage';

      if (parentId) {
        return `${workdir}/${parentId}`        
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
  @import '../../../../assets/style/createOrEditEl.css';
</style>