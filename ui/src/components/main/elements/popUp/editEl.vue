<template>
<div class="createOrEditEl">
  <RenameFolder v-if="this.$store.state.popUp.show === 'renameFolder'"></RenameFolder>
  <EditCard v-if="this.$store.state.popUp.show === 'editCard'"></EditCard>
</div>
</template>

<script>
import RenameFolder from './elements/renameFolder.vue';
import EditCard from './elements/editCard.vue';

export default {
  components: {
    RenameFolder,
    EditCard
  }
 }
</script>

<style>
  @import '../../../../assets/style/createOrEditEl.css';
</style>