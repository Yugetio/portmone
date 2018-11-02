<template>
  <section class="content">
    <h1 class="name-folder">{{folderName}}</h1>
    <div class="wallet-list">
      <form>
        <input v-model="cardName" type="text" placeholder="Type name" @keydown.prevent.enter="addCard">
      </form>
    </div>
    <div class="wallet-list">
      <ul>
        <li class="wallet-folder" v-for="file in cardNameList">
          {{ file }}
        </li>
      </ul>
    </div>
    <div class="control-wallet">
      <a @click='addCard' class="button7">Add card</a>
    </div>
  </section>
</template>

<script>
    export default {
      data(){
        return{
          cardNameList:[],
          cardName: '',
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
          this.cardNameList=JSON.parse(res);
          this.showCards();
        })
      },
      methods:{
        addCard(){
          fetch('/', {
            method: 'POST',
            headers: {
              'Accept': 'application/json',
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({'filename':this.cardName})
          }).then((res) => {
            console.log(res);
          });
          this.showCards();
        },
        showCards(){
          this.cardNameList.push(this.cardName)
        }
      }
    }
</script>

<style>
  @import '../../../assets/style/workPage.css';
  @import '../../../assets/style/profilePage.css';
</style>
