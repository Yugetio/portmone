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
<!--v-for="(element, index) in array"-->
<script>
  export default {
    data(){
     return{
       folderNameList:[],
       folderName: '',
     }
    },
    methods:{
      addFolder(){
        fetch('/user', {
          method: 'POST',
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({'foldername':this.folderName})
        }).then((res) => {
          let statusCode = JSON.parse(res);
          if(statusCode.status == 201){
            this.folderNameList.push(this.folderName)
          }
        });
      },
      setFolder(folderS){
        console.log(folderS);
        localStorage.setItem('foldername',folderS)
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
