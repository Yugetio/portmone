<template>
  <div>
    <div>Rename folder</div>
    <div>
      <form>
        <input v-model="nameFolder" type="text" placeholder="Type name" @keydown.prevent.enter="renameFolder">
      </form>
      <div class="control-wallet">
        <a @click="renameFolder" class="button7">Rename</a>
        <a @click="hideBlock" class="button7">Cancel</a>
      </div>
    </div>
  </div>
</template>

<script>
import { HIDE_CREATE_OR_EDIT_BLOCK } from '../../../../../store/names/popUp'
import { RENAME_FOLDER } from '../../../../../store/names/folder'

export default {
  data() {
    return {
      nameFolder: this.$store.getters.getTempDataInPopUp.nameFolder
    }
  },
  methods: {
    renameFolder() {
      this.$store.dispatch(RENAME_FOLDER, this.nameFolder)
      .then(() => {
        this.$store.commit(HIDE_CREATE_OR_EDIT_BLOCK) 
      })
      .catch((error) => {
        console.error(error.message);
      })
    },
    hideBlock(){
      this.$store.commit(HIDE_CREATE_OR_EDIT_BLOCK)
    }
  }
 }
</script>

<style>
</style>