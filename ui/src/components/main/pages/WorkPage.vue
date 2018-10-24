<template>
<section class="content">
  <div class="wallet-list">
    <form>
      <input v-model="folderName" type="text" placeholder="Type name" @keydown.prevent.enter="addFolder">
    </form>
  </div>
  <div class="wallet-list">
    <ul>
      <router-link to='/filepage'>
      <li class="wallet-folder" v-for="folder in folderNameList">
        <button @click="setFolder(folder)">{{folder}}</button>
      </li>
      </router-link>
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
       folderName: '',
       isIncludeFolders: false,
       insertFoldersName:[],
       route: ''
     }
    },
    created(){
      // fetch('/folder',{
      //   method: 'GET',
      //   headers: {
      //     'Accept': 'application/json',
      //     'Content-Type': 'application/json'
      //   }
      // }).then( response => response.json() )
      //   .then((data) =>{
      //     this.folderNameList = data;
      //   })
      //   .catch( error => console.error(error) );
    },
    watch: {

      },
    methods:{
      addFolder(){
        // fetch('/folder', {
        //   method: 'POST',
        //   headers: {
        //     'Accept': 'application/json',
        //     'Content-Type': 'application/json'
        //   },
        //   body: JSON.stringify({'foldername':this.folderName})
        // }).then( response => response.json() )
        //   .then((data) =>{
        //     this.folderNameList = data;
        //   })
        //   .catch( error => console.error(error) );
        //
        this.showFolders();
      },
      showFolders(){
        console.log('ShowM');
        this.folderNameList.push(this.folderName)
      },
      setFolder(folderS){
        console.log(folderS);
        sessionStorage.setItem('foldername',folderS)
      }

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
</style>
