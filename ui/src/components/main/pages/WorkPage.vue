<template>
<section class="content">
  <div class="wallet-list">
    <form>
      <input v-model="fName" type="text" placeholder="Type name" @keydown.prevent.enter="addFolder">
    </form>
  </div>
  <div class="wallet-list">
    <h3>Folders:</h3>
    <ul>
      <router-link to='/filepage'>
      <li class="folder" v-for="folder in folderNameList" :keydown.enter="addFolder">
        <button @click="setFolder(folder)">{{folder}}</button>
      </li>
      </router-link>  
    </ul>
    <hr>
    <h3 v-if="isHighLvl==true">Files:</h3>
    <ul>
      <li class="folder" v-for="file in fileNameList">
        <button >{{file}}</button>
      </li>
    </ul>
  </div>
  <div class="control-wallet">
    <a @click='addFolder' class="button7">Add folder</a>
    <a v-if="isHighLvl==true" @click='addFile' class="button7">Add file</a>
  </div>
</section>
</template>

<script>

  export default {
    data(){
     return{
       folderNameList:[],
       cardNameList:[],
       fName: '',
       isHighLvl: false,
     }
    },
    created(){
      fetch('/',{
        method: 'GET',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        }
      }).then( response => response.json() )
        .then((data) =>{
          this.folderNameList = data.folders;
          this.fileNameList = data.files;
        })
        .catch( error => console.error(error) );
    },
    watch: {

      },
    methods:{
      addFolder(){
        fetch('/', {
          method: 'POST',
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({'foldername':this.fName})
        }).then(this.showFolders())
          .catch( error => console.error(error) );

      },
      addCard(){
          fetch('/', {
            method: 'POST',
            headers: {
              'Accept': 'application/json',
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({'filename':this.fName})
          }).then(this.showCards() )
            .catch( error => console.error(error) );

      },
      showFolders(){
        console.log('ShowM');
        this.folderNameList.push(this.fName)
      },
      showCards(){
        console.log('ShowM');
        this.cardNameList.push(this.fName)
      },
      setFolder(folderS){
        console.log(folderS);
        localStorage.setItem('foldername',folderS)
      },
      testJsonSend(){
        "use strict";
        a = null + undefined;
        alert(a);
      },
    },
  }
</script>

<style scoped>
  @import '../../../assets/style/workPage.css';
  @import '../../../assets/style/profilePage.css';
</style>
1
