<template>
<section class="content">
  <section class="forma">
    <Forma></Forma>
  </section>

  <section class="description">
    <Description></Description>
  </section>
</section>
</template>

<script>
import Forma from '../../main/elements/forma/LoginForm.vue';
import Description from '../../main/elements/description/Description.vue';
import Registration from '../../main/elements/forma/RegistrationForm.vue';

export default {
  components: {
    Forma,
    Description,
    Registration
  }
}
</script>

<style>
@import '../../../assets/style/main.css';
</style>
