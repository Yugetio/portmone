
<template>



</template>

<script>

</script>

<style>
.user-icon, .pass-icon {
	width: 46px;
	height: 47px;
	display: block;
	position: absolute;
	left: 0px;
	padding-right: 2px;
	z-index: 3;

	-moz-border-radius-topleft: 5px;
	-moz-border-radius-bottomleft: 5px;
	-webkit-border-top-left-radius: 5px;
	-webkit-border-bottom-left-radius: 5px;
}

.user-icon {
	top:147px; /* Positioning fix for slide-in, got lazy to think up of simpler method. */
	background: rgba(65,72,72,0.75) url(../assets/images/user-icon.png) no-repeat center;
}

.pass-icon {
	top:221px;
	background: rgba(65,72,72,0.75) url(../assets/images/pass-icon.png) no-repeat center;
}
</style>
