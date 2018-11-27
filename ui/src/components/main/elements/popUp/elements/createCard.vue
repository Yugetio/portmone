<template>
  <div>
    <div>Create card</div>
    <div>
      <form class="input-from-card">
        <input v-model="namber" type="text" placeholder="Number">
        <input v-model="cash" type="text" placeholder="Cash">
      </form>
      <div class="control-wallet">
        <a @click="addCard" class="button7">Add card</a>
        <a @click="hideBlock" class="button7">Cancel</a>
      </div>
    </div>
  </div>
</template>

<script>
import { HIDE_CREATE_OR_EDIT_BLOCK } from '../../../../../store/names/popUp'
import { CREATE_CARD } from '../../../../../store/names/card'

export default {
  data() {
    return {
      namber: '',
      cash: ''
    }
  },
  methods: {
    addCard() {
      this.$store.dispatch(CREATE_CARD, {
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