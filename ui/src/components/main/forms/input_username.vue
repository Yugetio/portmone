<template>
    <input name="username" type="text" class="input username" value="Username" onfocus="this.value=''" />
</template>

<script>

</script>

<style>
.login-form {
	width: 300px;
	margin: 0 auto;
	position: relative;
	z-index:5;

	background: #f3f3f3;
	border: 1px solid #fff;
	border-radius: 5px;

	box-shadow: 0 1px 3px rgba(0,0,0,0.5);
	-moz-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
	-webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
}

.login-form .content .password, .login-form .content .pass-icon {
	margin-top: 25px;
}
</style>
