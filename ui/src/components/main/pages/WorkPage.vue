<template>
<section class="content">
  <div class="wallet-list">
    <form>
      <input v-model="fName" type="text" placeholder="Type name">
    </form>
  </div>
  <div class="wallet-list">
    <h3>Folders:</h3>
    <ul>
      <router-link to='/filepage'>
      <li class="folder" v-for="folder in folderNameList">
        <button @click="setFolder(folder)">{{folder}}</button>
      </li>
      </router-link>
    </ul>
    <hr>
    <h3>Files:</h3>
    <ul>
      <li class="folder" v-for="file in fileNameList">
        <button >{{file}}</button>
      </li>
    </ul>
  </div>
  <div class="control-wallet">
    <a @click='addFolder' class="button7">Add folder</a>
    <a v-if="isIncludeFolders==true" @click='addFile' class="button7">Add file</a>
  </div>
</section>
</template>

<script>

  export default {
    data(){
     return{
       folderNameList:[],
       fileNameList:[],
       fName: '',
       isIncludeFolders: true,
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
      addFile(){
          fetch('/', {
            method: 'POST',
            headers: {
              'Accept': 'application/json',
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({'filename':this.fName})
          }).then(this.showFiles() )
            .catch( error => console.error(error) );

      },
      showFolders(){
        console.log('ShowM');
        this.folderNameList.push(this.fName)
      },
      showFiles(){
        console.log('ShowM');
        this.fileNameList.push(this.fName)
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
  button {
    display: block;
    width: 100%;
    height: 28px;
    line-height: 28px;
    font-weight: bold;
    text-decoration: none;
    cursor: pointer;
    border: 2px solid #FFFFFF;
    border-radius: 3px;
  }
  .folder{
    background-color: #84AAB6;
    padding: 20px 30px 20px 80px;
  }
  h3{
    background-color: #84AAB6;
    bottom: 30px;
    border: #eee;
  }
</style>
