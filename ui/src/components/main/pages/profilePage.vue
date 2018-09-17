<template>
<section class="content">
  <div class="panel-navigation">
    <div class="back">
      <a href="#"><img src="../../../assets/images/back.png" alt="back"></a>
      <a href="#"><img src="../../../assets/images/social.png" alt="social"></a>
      <a href="#"><img src="../../../assets/images/exit2.png" alt="exit"></a>
    </div>

  </div>
  <div class="username">

    <img src="./../../../assets/images/user_name.png" alt="user_name">
    <h1>User Name</h1>
  </div>
  <div class="delete-profile">
    <a href="#" class="button7">Delete Profile</a>
  </div>


</section>
</template>

<script>

</script>

<style>
@import '../../../assets/style/profilePage.css';

.panel-navigation {
  height: 30px;
  background: #b0bec5;
  display: flex;
  align-items: center;
  align-content: center;
  justify-content: center;
}

.content {
  flex: 1;
  white-space: pre-line;
  -ms-flex-preferred-size: auto;
  background: url(../../../assets/images/bg.png) repeat;
}

a.button7 {
  font-weight: 700;
  color: white;
  text-decoration: none;
  padding: .8em 1em calc(.8em + 3px);
  border-radius: 3px;
  background: rgb(214, 52, 52);
  box-shadow: 0 -3px rgb(4, 1, 58) inset;
  transition: 0.2s;
}

a.button7:hover {
  background: rgb(210, 7, 7);
}

a.button7:active {
  background: rgb(214, 52, 52);
  box-shadow: 0 3px rgb(4, 1, 58) inset;
}

.delete-profile {
  text-align: center;
  padding: 45px;
  margin-top: 150px;
}
</style>
