<template>
<section class="content">
  <newElem></newElem>
  <h1 v-if="this.$store.state.folder.parentID" class="name-folder">{{ this.$store.getters.getCurrentFolder }}</h1>  
  <div class="wallet-list">
    <ul>
      <li class="folder" v-for="folder in folders">
        <router-link :to="`/workpage/${1}`">
          <button @click="setCurrentFolder(folder)"> {{ folder }} </button>
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

export default {
  data() {
    return {
      folders: this.$store.getters.getFolders,
      cards: this.$store.getters.getCard
    }
  },
  methods: {
    setCurrentFolder(folder) {
      this.$store.commit('setCurrentFolder', folder)
    }
  },
  components: {
    newElem
  }
}
</script>

<style scoped>
  @import '../../../assets/style/workPage.css';
  @import '../../../assets/style/profilePage.css';
</style>
1
