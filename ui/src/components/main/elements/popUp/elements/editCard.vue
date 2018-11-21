<template>
  <div>
    <div>Edit card</div>
    <div>
      <form class="input-from-card">
        <input v-model="number" type="text" placeholder="Number">
        <input v-model="cash" type="text" placeholder="Cash">
      </form>
      <div class="control-wallet">
        <a @click="editCard" class="button7">Edit</a>
        <a @click="hideBlock" class="button7">Cancel</a>
      </div>
    </div>
  </div>
</template>

<script>
import { HIDE_CREATE_OR_EDIT_BLOCK } from '../../../../../store/names/popUp'
import { EDIT_CARD } from '../../../../../store/names/card'

export default {
  data() {
    return {
      number: this.$store.getters.getTempDataInPopUp.number,
      cash: this.$store.getters.getTempDataInPopUp.cash
    }
  },
  methods: {
    editCard() {
      this.$store.dispatch(EDIT_CARD, {
        number: this.number,
        cash: this.cash
        })
      .then(() => {
        this.$store.commit(HIDE_CREATE_OR_EDIT_BLOCK)
      })
      .catch((error) => {
        console.error(error.message);
      })
    },
    hideBlock(){
      this.$store.commit(HIDE_CREATE_OR_EDIT_BLOCK)
    }
  }
 }
</script>

<style>
</style>