<template>
  <div id="app">
    <router-view></router-view>
    <div id="wrapper">
      <form name="login-form" class="login-form" action="" method="post">
  <div class="content">
    <Header></Header>
    <Username></Username>
    <Password></Password>
  </div>
  <div class="footer">
    <Login></Login>
    <Register></Register>
  </div>
      </form>
    </div>
  </div>
</template>

<script>
import Login from './wi-base/Login.vue';
import Register from './wi-base/Sign_up.vue';
import Username from './wi-base/input_username.vue';
import Password from './wi-base/input_password.vue';
import Header from './main/header.vue';
  export default {
    components: {
      Login,
      Register,
      Username,
      Password,
      Header
    }
    //,
  //  methods:(

    //)
  }
</script>

<style>
@import url(http://fonts.googleapis.com/css?family=Bree+Serif);

* {
	margin: 0;
	padding: 0;
	border: 0;
}

body {
	background: url(../assets/images/bg.png) repeat;
	font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
	font-weight:300;
	text-align: left;
	text-decoration: none;
}

#wrapper {
	width: 300px;
	height: 400px;
	position: absolute;
	left: 50%;
	top: 50%;
	margin-left: -150px;
	margin-top: -200px;
}
/*******************
FOOTER
*******************/
.login-form .footer {
	padding: 25px 30px 40px 30px;
	overflow: auto;

	background: #d4dedf;
	border-top: 1px solid #fff;

	box-shadow: inset 0 1px 0 rgba(0,0,0,0.15);
	-moz-box-shadow: inset 0 1px 0 rgba(0,0,0,0.15);
	-webkit-box-shadow: inset 0 1px 0 rgba(0,0,0,0.15);
}

.login-form .content .input {
	width: 188px;
	padding: 15px 25px;

	font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
	font-weight: 400;
	font-size: 14px;
	color: #9d9e9e;
	text-shadow: 1px 1px 0 rgba(256,256,256,1.0);

	background: #fff;
	border: 1px solid #fff;
	border-radius: 5px;

	box-shadow: inset 0 1px 3px rgba(0,0,0,0.50);
	-moz-box-shadow: inset 0 1px 3px rgba(0,0,0,0.50);
	-webkit-box-shadow: inset 0 1px 3px rgba(0,0,0,0.50);
}

.login-form .content {
	padding: 0 30px 25px 30px;
}
</style>
