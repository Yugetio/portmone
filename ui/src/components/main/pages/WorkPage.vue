<template>
<section class="content">
  <NewElem></NewElem>
  <EditElem></EditElem>
  <h1 v-if="this.$store.state.folder.currentFolder.id" class="name-folder">
    {{ this.$store.getters.getCurrentFolder.nameFolder }}
  </h1>  
  <div class="wallet-list">
    <ul>
      <li class="folder" v-for="folder in folders">
        <router-link tag="div" :to="`/workpage/${folder.id}`">
          <button @click="setCurrentFolder(folder)"> {{ folder.nameFolder }} </button>
          <button @click="renameFolder(folder)"> Rename </button>
          <button @click="deletFolder(folder.id)"> Delete </button>
        </router-link>  
      </li>
      <li class="wallet-folder" v-for="card in cards">
        {{ card.number }}, {{ card.cash }}
      </li>
    </ul>
  </div>
</section>
</template>

<script>
import NewElem from '../../main/elements/popUp/createEl.vue';
import EditElem from '../../main/elements/popUp/editEl.vue';
import { GET_CURRENT_FOLDER, SET_CURRENT_FOLDER, GET_FOLDERS, DELETE_FOLDER } from '../../../store/names/folder'
import { GET_CARDS } from '../../../store/names/card'
import { SHOW_CREATE_OR_EDIT_BLOCK } from '../../../store/names/popUp.js'

export default {
  data() {
    return {
      folders: this.$store.getters.getFolders,
      cards: this.$store.getters.getCards
    }
  },
  methods: {
    currentDataUpdate(folderId) {
      this.$store.dispatch(GET_FOLDERS, folderId);
      this.$store.dispatch(GET_CARDS, folderId);
    },
    setCurrentFolder(folder) {
      this.$store.commit(SET_CURRENT_FOLDER, folder);
      this.currentDataUpdate(folder.id);
    },
    renameFolder(folder) {
      this.$store.commit(SHOW_CREATE_OR_EDIT_BLOCK, { name: 'renameFolder', data: folder })
    },
    deletFolder(folderId) {
      this.$store.dispatch(DELETE_FOLDER, folderId)
    }
  },
  components: {
    NewElem,
    EditElem
  },
  created: function () {
    const id = Object.keys( this.$route.params ).length ? this.$route.params.id : null;

    this.$store.dispatch(GET_CURRENT_FOLDER, id)
    .then(() => {
      this.currentDataUpdate(id);
    })
    .catch(error => {
      console.error(error.message);
      // this.$router.push('/error');
    })   
  }
}

</script>

<style scoped>
  @import '../../../assets/style/workPage.css';
  @import '../../../assets/style/profilePage.css';
</style>

