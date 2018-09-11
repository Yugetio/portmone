<template>

  <div id="wrapper">

   <form name="login-form" class="login-form" action="" method="post">
     <div class="content">
       <div class="header">
        <h1>Registration</h1>
        <span>Enter login information</span>
  </div>
 <Input @sendInputData='receivedInputData'/>
     </div>
    <div class="footer">
      <Login :inputData="inputData" :nameButton="nameButton" />
    </div>
   </form>
 </div>

</template>

<script>

import Login from '../../main/forms/button.vue';
import Input from '../../main/forms/input.vue';
  export default {
    data() { return {
      inputData: {},
      nameButton: "Sign up"
    }
    },
    components: {
      Login,
      Input
    },
    methods: {
      receivedInputData(obj){
        this.inputData = obj;
      }
    }
  }
</script>

<style>
@import './../../../assets/style/forms.css';
</style>
