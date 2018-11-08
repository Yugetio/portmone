<template>
  <p v-if="errors.length" class="errorMessage">
    <ul>
      <li v-for="error in errors">{{ error }}</li>
    </ul>
  </p>
</template>

<script>
export default {
  date() {
    return {
      errors: []
    }
  },
  methods: {
  }
}
</script>

