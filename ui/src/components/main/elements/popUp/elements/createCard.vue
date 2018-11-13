<template>
  <div>
    <div>Create Card</div>
    <div>
      <form>
        <input v-model="newCard" type="text" placeholder="Type name" @keydown.prevent.enter="addCard">
      </form>
      <div class="control-wallet">
        <a @click="addCard" class="button7">Add folder</a>
        <a @click="hideBlock" class="button7">Cancel</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      newCard: ''
    }
  },
  methods: {
    addCard() {
      this.$store.commit('addCard', this.newCard)
    },
    hideBlock(){
      this.$store.commit('hideCreateBlock')
    }
  }
 }
</script>

<style>
</style>