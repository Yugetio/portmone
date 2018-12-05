<template>

<section class="content">
  <section class="forma">
    <LoginForm v-if="this.$route.path === '/'"></LoginForm>
    <Registration v-else></Registration>
  </section>

  <Description></Description> <!-- Не потрібно робити обгортку ... якщо її можна зробити всередині -->

</section>

</template>

<script>

import LoginForm from '../../main/elements/forma/LoginForm.vue';
import Description from '../../main/elements/description/Description.vue';
import Registration from '../../main/elements/forma/RegistrationForm.vue';

export default {
  components: {
    LoginForm,
    Description,
    Registration
  }
}
</script>

<style>

.content {
  flex: 1;
  white-space: pre-line;
  -ms-flex-preferred-size: auto;
  background: none;
}

.forma {
  display: flex;
  background: url(./../../../assets/images/bg-section-welcome.jpg) repeat;
  height: 700px;
  background-size: cover;
}

</style>
