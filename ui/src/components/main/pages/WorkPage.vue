<template>
<section class="content">
  <div class="wallet-list">
    <form>
      <input v-model="fileAndFolderName" type="text" placeholder="Type name">
    </form>
  </div>
  <div class="wallet-list">
    <ul>
      <li v-for="folder in folderList">
        {{ folder.fileAndFolderName }}
      </li>
    </ul>
  </div>
  <!--<li class="wallet-folder">-->
    <!--<span class="title">User</span>-->
  <div class="control-wallet">
    <a @click='addFolder' class="button7">Add folder</a>
    <a @click='addCard' class="button7">Add card</a>
  </div>
</section>
</template>

<script>
  export default {
    data(){
     return{
       folderList:[]
     }
    },
    methods:{
      addFolder(){
        let folderName;
        if (this.tokenCheck(this.getToken()))
        {
          fetch('/folder', {
            method: 'POST',
            body: JSON.stringify({
              id: dataFromToken['id'],
              email: dataFromToken['email'],
              password: dataFromToken['token']
            })
          });
        }else {
          this.tokenTimeDown();
        }
        this.data.push(folderName)
      },
      addCard(){
        let  fileName;
        if (this.tokenCheck(this.getToken()))
        {
          fetch('/card', {
            method: 'POST',
            body: JSON.stringify({
              id: dataFromToken['id'],
              email: dataFromToken['email'],
              password: dataFromToken['token']
            })
          });
        }else {
          this.tokenTimeDown();
        }
        this.data.push(fileName)
      }
    },

  }
  // v-for="component in components"
  //   :is="component.type"
</script>

<style>
  @import '../../../assets/style/workPage.css';
  @import '../../../assets/style/profilePage.css';
</style>
