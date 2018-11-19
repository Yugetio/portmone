<template>
<section class="content">
  <newElem></newElem>
  <h1 v-if="this.$store.state.folder.currentFolder.id" class="name-folder">
    {{ this.$store.getters.getCurrentFolder.name }}
  </h1>  
  <div class="wallet-list">
    <ul>
      <li class="folder" v-for="folder in folders">
        <router-link :to="`/workpage/${folder.id}`">
          <button @click="setCurrentFolder(folder)"> {{ folder.name }} </button>
        </router-link>  
      </li>
      <li class="wallet-folder" v-for="card in cards">
        {{ card }}
      </li>
    </ul>
  </div>
</section>
</template>

<script>
import newElem from '../../main/elements/popUp/createEl.vue';
import { GET_CURRENT_FOLDER, SET_CURRENT_FOLDER, GET_FOLDERS } from '../../../store/names/folder'
import { GET_CARDS } from '../../../store/names/card'

export default {
  data() {
    return {
      folders: this.$store.getters.getFolders,
      cards: this.$store.getters.getCards
    }
  },
  methods: {
    currentDataUpdate(id) {
      this.$store.dispatch(GET_FOLDERS, id);
      this.$store.dispatch(GET_CARDS, id);
    },
    setCurrentFolder(folder) {
      this.$store.commit(SET_CURRENT_FOLDER, folder);
      this.currentDataUpdate(folder.id);
    }
  },
  components: {
    newElem
  },
  created: function () {
    const id = Object.keys( this.$route.params ).length ? this.$route.params.id : null;

    //sync get current folder -  this.$store.dispatch('getCurrentFolder', id);
    //if - res = true 
      //call currentDataUpdate - this.currentDataUpdate(id);
    //else 
      // this.$router.push('/error');

    // this.$store.dispatch(GET_CURRENT_FOLDER, id);
    this.currentDataUpdate(id);
  }
}

</script>

<style scoped>
  @import '../../../assets/style/workPage.css';
  @import '../../../assets/style/profilePage.css';
</style>

