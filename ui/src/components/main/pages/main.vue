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
import Forma from '../../main/elements/forma/loginForm.vue';
import Description from '../../main/elements/description/description.vue';
import Registration from '../elements/forma/registrationForm.vue';

export default {
  components: {
    Forma,
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
  background: #eee;
}

.forma {
  display: flex;
  background: url(../../../assets/images/bg.png) repeat;
  height: 500px;
}
</style>
