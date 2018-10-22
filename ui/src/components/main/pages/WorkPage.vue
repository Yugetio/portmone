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
        <button @click="goIntoFolder">{{folder}}</button>
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
  import { bus } from '../../bus.js';

  export default {
    data(){
     return{
       folderNameList:[],
       folderName: ''
     }
    },
    methods:{
      addFolder(){
       if (this.folderName!==''){
         this.folderNameList.push(this.folderName)
       }
      },
      goIntoFolder(){
        bus.$emit('titleShow',this.folder);
      }
    },
    created: function () {
        fetch('/')
          .then(function (response) {
            response.json().then(function (data) {
              console.log('data', data)
            })
          });
        localStorage.setItem('data', data)
    }
  }
  // v-for="component in components"
  //   :is="component.type"
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
