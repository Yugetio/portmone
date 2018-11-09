<template>
<section class="content">
  <div class="wallet-list">
    <form>
      <input v-model="newFolder" type="text" placeholder="Type name" @keydown.prevent.enter="addFolder">
    </form>
  </div>
    <div class="control-wallet">
    <a @click="addFolder" class="button7">Add folder</a>
  </div>
  <div class="wallet-list">
    <h3>Folders:</h3>
    <ul>
      <router-link to='/filepage'>
      <li class="folder" v-for="folder in folders">
        <button @click="setCurrentFolder(folder)"> {{ folder }} </button>
      </li>
      </router-link>  
    </ul>
  </div>
</section>
</template>

<script>
export default {
  data() {
    return {
      newFolder: '',
      folders: this.$store.getters.getFolders
    }
  },
  methods: {
    addFolder() {
      this.$store.commit('addFolder', this.newFolder); 
      this.updateFolders();
    },
    updateFolders() {
      this.folders = this.$store.getters.getFolders
    },
    setCurrentFolder(folder) {
      this.$store.commit('setCurrentFolder', folder)
    }
  }
}
</script>

<style scoped>
  @import '../../../assets/style/workPage.css';
  @import '../../../assets/style/profilePage.css';
</style>
1
