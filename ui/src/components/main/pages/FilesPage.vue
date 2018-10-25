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
          fName:''
        }
      },
      created(){
        this.folderName = localStorage.getItem('foldername');
        fetch('/',{
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
          fetch('/', {
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
