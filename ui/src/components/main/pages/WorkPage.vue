<template>
<section class="content">
  <div class="wallet-list">
    <form>
      <input v-model="folderName" type="text" placeholder="Type name">
    </form>
  </div>
  <div class="wallet-list">
    <ul>
      <li @click="" class="wallet-folder" v-for="folder in folderNameList">
        {{ folder }}
      </li>
    </ul>
  </div>
  <div class="control-wallet">
    <a @click='addFolder' class="button7">Add folder</a>
  </div>
</section>
</template>

<script>
  export default {
    data(){
     return{
       folderNameList:[],
       folderName: ''
     }
    },
    methods:{
      addFolder(){
        // if (this.tokenCheck(this.getToken()))
        // {
        //   fetch('/files', {
        //     method: 'POST',
        //     body: JSON.stringify({
        //       id: dataFromToken['id'],
        //       email: dataFromToken['email'],
        //       password: dataFromToken['token']
        //     })
        //   });
        // }else {
        //   this.tokenTimeDown();
        // }
       if (this.folderName!==''){
         this.folderNameList.push(this.folderName)
       }
      },
    },
    create:{
      getData() {
        fetch('/')
          .then(function (response) {
            response.json().then(function (data) {
              console.log('data', data)
            })
          });
        localStorage.setItem('data', data)
      },
    }

  }
  // v-for="component in components"
  //   :is="component.type"
</script>

<style>
  @import '../../../assets/style/workPage.css';
  @import '../../../assets/style/profilePage.css';
</style>
