<template>

<div class="search">


<form>
 <input type="search">
</form>
		
<!-- <div v-if="isSearch" v-on:click="inputSearch">
   <img src="./../../../assets/images/search.png" alt="search">
  </div>


<div v-else v-on:click="inputSearch">
 <img src="./../../../assets/images/exit.png" alt="exit"> 
  </div> -->
</div>



</template>

<script>

</script>


<style>
input[type=search] {
    background: #e0e0e0 url(./../../../assets/images/search.png) no-repeat 9px center;
    background-size: 50px 45px;
    border: solid 6px #e0e0e0;
    padding: 23px 10px 8px 70px;
    width: 120px;
    -webkit-transition: all .5s;
    -moz-transition: all .5s;
    transition: all .5s;
    cursor: pointer;
}

input[type=search]:focus {
    width: 100%;

    border: 4px solid #a09999;
    background-color: #ffffff;
    outline: none;
    cursor: text;
    font-size: 18px;
}
</style>
