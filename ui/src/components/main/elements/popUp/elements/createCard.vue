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
import { HIDE_CREATED_BLOCK } from '../../../../../store/names/popUp'
import { CREATE_CARD } from '../../../../../store/names/card'

export default {
  data() {
    return {
      newCard: ''
    }
  },
  methods: {
    addCard() {
      this.$store.dispatch(CREATE_CARD, this.newCard)    
    },
    hideBlock(){
      this.$store.commit(HIDE_CREATED_BLOCK)
    }
  }
 }
</script>

<style>
</style>