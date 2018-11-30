<template>
<div>
  <div class="createOrEditEl">
    <CreateFolder v-if="this.$store.state.popUp.show === 'folder'"></CreateFolder>
    <CreateCard v-if="this.$store.state.popUp.show === 'card'"></CreateCard>
  </div>
  <div class="btnPanel">
    <!-- <router-link  tag="div"  v-if="this.$store.state.folder.currentFolder.id" @click.native="updateFolder" :to="toBackFolder()"> -->
    <div v-if="this.$store.state.folder.currentFolder.id" @click="goBack">
      <span><<<</span>
    </div>  

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
    goBack() {
      const parentId = this.$store.state.folder.currentFolder.parentId

      this.$store.dispatch(GET_CURRENT_FOLDER, parentId)
      .then(() => {
        this.$store.dispatch(GET_FOLDERS, parentId)
        this.$store.dispatch(GET_CARDS, parentId)
      })
      .then(() => {
        const workdir = '/workpage';
        if (parentId) {
          this.$router.push(`${workdir}/${parentId}`)
        } else {
          this.$router.push(workdir)
        }
      })
      .catch(() => {})
      
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