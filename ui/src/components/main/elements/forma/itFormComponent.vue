<template>
<div id="input">
  <input placeholder="Email" v-model="inputData.login" name="username" type="text" class="input username" value="Username" />
  <input placeholder="Password" v-model="inputData.pass" name="password" type="password" class="input password" value="Password" />
</div>
</template>

<script>
export default {
  data() {
    return {
      inputData: {
        login: '',
        pass: '',
      },
    }
  },
  created() {
    this.$emit("sendInputData", this.inputData);
  }
}
</script>

<style>

</style>
