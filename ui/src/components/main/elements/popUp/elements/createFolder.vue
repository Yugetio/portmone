<template>
  <div>
    <div>Create Folder</div>
    <div>
      <form>
        <input v-model="newFolder" type="text" placeholder="Type name" @keydown.prevent.enter="addFolder">
      </form>
      <div class="control-wallet">
        <a @click="addFolder" class="button7">Add folder</a>
        <a @click="hideBlock" class="button7">Cancel</a>
      </div>
    </div>
  </div>
</template>

<script>
import { HIDE_CREATED_BLOCK } from '../../../../../store/names/popUp'
import { CREATE_FOLDER } from '../../../../../store/names/folder'

export default {
  data() {
    return {
      newFolder: ''
    }
  },
  methods: {
    addFolder() {
      this.$store.dispatch(CREATE_FOLDER, this.newFolder)    
    },
    hideBlock(){
      this.$store.commit(HIDE_CREATED_BLOCK)
    }
  }
 }
</script>

<style>
</style>