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



export default {
  data() {
    return {
      folders: this.$store.getters.getFolders,
      cards: this.$store.getters.getCards
    }
  },
  methods: {
    setCurrentFolder(folder) {
      this.$store.commit('setCurrentFolder', folder)
    }
  },
  components: {
    newElem
  },
  // created: function () {
  //   console.log(this.$route.params);
  // },
  // beforeUpdate: function () {
  //   console.log(this.$route.params);
  // }
}

// Object.keys( $route.params ).length;
</script>

<style scoped>
  @import '../../../assets/style/workPage.css';
  @import '../../../assets/style/profilePage.css';
</style>

