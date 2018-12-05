<template>
<section class="content">
  <NewElem></NewElem>
  <EditElem></EditElem>
  <h1 v-if="getCurrentFolder.id" class="name-folder">
    {{ getCurrentFolder.name }}
  </h1>  
  <div class="wallet-list">
    <ul>
      <li class="folder" v-for="folder in getFolders">
        <router-link tag="div" :to="`/workpage/${folder.id}`">
          <button @click="setCurrentFolder(folder)"> {{ folder.name }} </button>
          <button @click="renameFolder(folder)"> Rename </button>
          <button @click="deletFolder(folder.id)"> Delete </button>
        </router-link>  
      </li>
      <li class="card" v-for="card in getCards">
        <div>
          <div>
            <p>Number: {{ card.number }}</p>
            <p>Cash: {{ card.cash }}</p>
          </div>
          <div>
            <button @click="editCard(card)"> Edit </button>
            <button @click="deleteCard(card.id)"> Delete </button>
          </div>
        </div>
      </li>
    </ul>
  </div>
</section>
</template>

<script>
import NewElem from '../../main/elements/popUp/createEl.vue';
import EditElem from '../../main/elements/popUp/editEl.vue';
import { GET_CURRENT_FOLDER, SET_CURRENT_FOLDER, GET_FOLDERS, DELETE_FOLDER } from '../../../store/names/folder'
import { GET_CARDS, DELETE_CARD } from '../../../store/names/card'
import { SHOW_CREATE_OR_EDIT_BLOCK } from '../../../store/names/popUp.js'

import { mapActions } from 'vuex'
import { mapGetters } from 'vuex'

export default {
  methods: {
    ...mapActions({
      getCurrentFolderAction: GET_CURRENT_FOLDER,
      deletFolder: DELETE_FOLDER,
      deleteCard: DELETE_CARD
    }),
    currentDataUpdate(folderId) {
      this.$store.dispatch(GET_FOLDERS, folderId)
      this.$store.dispatch(GET_CARDS, folderId)
      this.folders = this.$store.getters.getFolders
      this.cards = this.$store.getters.getCards
    },
    setCurrentFolder(folder) {
      this.$store.commit(SET_CURRENT_FOLDER, folder)
      this.currentDataUpdate(folder.id)
    },
    renameFolder(folder) {
      this.$store.commit(SHOW_CREATE_OR_EDIT_BLOCK, { name: 'renameFolder', data: folder })
    },
    editCard(card){
      this.$store.commit(SHOW_CREATE_OR_EDIT_BLOCK, { name: 'editCard', data: card })
    }
  },
  components: {
    NewElem,
    EditElem
  },
  computed: { // Прокидаємо геттери
      ...mapGetters([
          'getCurrentFolder', 'getFolders', 'getCards'
      ])
  },
  beforeMount: function () {
    const id = Object.keys( this.$route.params ).length ? this.$route.params.id : null;
    // Можна прокинути Actions з методом mapActions
    this.getCurrentFolderAction(id).then(() => this.currentDataUpdate(id)).catch(error => console.error(error));
  }
}

</script>

<style scoped>
  @import '../../../assets/style/workPage.css';
  @import '../../../assets/style/profilePage.css';
</style>

