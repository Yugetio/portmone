<template>
  <section class="content">
    <h1 class="name-folder">{{ this.$store.getters.getCurrentFolder }}</h1>
    <div class="wallet-list">
      <form>
        <input v-model="newCard" type="text" placeholder="Type name" @keydown.prevent.enter="addCard">
      </form>
    </div>
    <div class="wallet-list">
      <ul>
        <li class="wallet-folder" v-for="card in cards">
          {{ card }}
        </li>
      </ul>
    </div>
    <div class="control-wallet">
      <a @click='addCard' class="button7">Add card</a>
    </div>
  </section>
</template>

<script>
export default {
  data () {
    return {
      newCard: '',
      cards: this.$store.getters.getCard
    }
  },
  methods: {
    addCard() {
      this.$store.commit('addCard', this.newCard)
    },
    updateCards(){
      this.cards = this.$store.getters.getCard
    }
  }
}
</script>

<style>
  @import '../../../assets/style/workPage.css';
  @import '../../../assets/style/profilePage.css';
</style>
