<template>
  <div>
    <div>Create Folder</div>
    <div>
      <form>
        <input v-model="newFolder" type="text" placeholder="Type name" @keydown.prevent.enter="addFolder">
      </form>
      <div class="control-wallet">
        <a @click="addFolder" class="button7">Add folder</a>
        <a @click="hideBlock" class="button7">Cancel</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      newFolder: ''
    }
  },
  methods: {
    addFolder() {
      this.$store.commit('addFolder', this.newFolder);      
    },
    hideBlock(){
      this.$store.commit('hideCreateBlock')
    }
  }
 }
</script>

<style>
</style>