<template>
<div id="input">
  <input
    required
    v-model="inputData.email"
    name="username"
    type="text"
    class="input username"
    value="Username"
    placeholder="Email"
  />
  <input
    required
    v-model="inputData.pass"
    name="password"
    type="password"
    class="input password"
    value="Password"
    placeholder="Password"
   />
</div>
</template>

<script>
export default {
  data() {
    return {
      inputData: {
        email: '',
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
