<template>
<div>
 <div class="createEl">
   
    <div  v-if="showCreateFolder">
      <div>Create Folder</div>
      <div>
        <form>
          <input v-model="newFolder" type="text" placeholder="Type name" @keydown.prevent.enter="addFolder">
        </form>
        <div class="control-wallet">
          <a @click="addFolder" class="button7">Add folder</a>
          <a @click="closeBlock" class="button7">Cancel</a>
        </div>
      </div>
    </div>

    <div v-if="showCreateCard">
      <div>Create Card</div>
      <div>
        <form>
          <input v-model="newCard" type="text" placeholder="Type name" @keydown.prevent.enter="addCard">
        </form>
        <div class="control-wallet">
          <a @click="addCard" class="button7">Add folder</a>
          <a @click="closeBlock" class="button7">Cancel</a>
        </div>
      </div>
    </div>

  </div>

   <div class="btnAdd">
     <div @click="createFolderBlock">Create Folder</div>
     <div @click="createCardBlock">Create Card</div>
  </div>
</div> 
</template>

<script>

export default {
  data() {
    return {
      showCreateFolder: false,
      showCreateCard: false,
      newFolder: '',
      newCard: ''
    }
  },
  methods: {
    createFolderBlock() {
      this.closeBlock();
      this.showCreateFolder = true;
    },
    createCardBlock() {
      this.closeBlock();
      this.showCreateCard = true;
    },
    closeBlock() {
      this.showCreateFolder = false;
      this.showCreateCard = false;
    },
    addFolder() {
      this.$store.commit('addFolder', this.newFolder); 
    },
    addCard() {
      this.$store.commit('addCard', this.newCard)
    }
  }
 }
</script>

<style>
  @import '../../../../assets/style/createEl.css';
</style>