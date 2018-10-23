<template>
  <section class="content">
    <h1>{{folderName}}</h1>
    <div class="wallet-list">
      <form>
        <input v-model="fileName" type="text" placeholder="Type name" @keydown.prevent.enter="addFile">
      </form>
    </div>
    <div class="wallet-list">
      <ul>
        <li class="wallet-folder" v-for="file in fileNameList">
          {{ file }}
        </li>
      </ul>
    </div>
    <div class="control-wallet">
      <a @click='addFile' class="button7">Add file</a>
    </div>
  </section>
</template>

<script>
    export default {
      data(){
        return{
          fileNameList:[],
          fileName: '',
          folderName:''
        }
      },
      created(){
        this.folderName = sessionStorage.getItem('foldername');
        fetch('/card',{
          method: 'GET',
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          }
        }).then((res) => {
          console.log(res);
          this.fileNameList=JSON.parse(res);
          this.showFiles();
        })
      },
      methods:{
        addFile(){
          fetch('/card', {
            method: 'POST',
            headers: {
              'Accept': 'application/json',
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({'filename':this.fileName})
          }).then((res) => {
            console.log(res);
          });
          this.showFiles();
        },
        getToken(){
          let codeToken = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c';
          let splitToken = codeToken.split('.');
          let atobToken = atob(splitToken[1]);
          let uncodeToken = JSON.parse(atobToken);
          //  JSON.parse(atob(storage.getItem('token').split('.')[1])) - головоломич. Кєк
          return uncodeToken;
        },
        showFiles(){
          this.fileNameList.push(this.fileName)
        }
      }
    }
</script>

<style>
  @import '../../../assets/style/workPage.css';
  @import '../../../assets/style/profilePage.css';
</style>
