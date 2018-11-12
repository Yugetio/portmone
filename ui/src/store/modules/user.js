const state = {
  email: 'email@email.com'
}

const mutations = {

}

const actions = {
  auth({commit}, {email, password}) {
    // console.log('email, password =', email, password)
    axios.post ('/api/auth',{
      email, password
    })
  }
}

const getters = {
  getUser(state) {
    return state.email;
  }
}

export default {
  state,
  mutations,
  actions,
  getters
}

  //   getToken(){
  //     let codeToken = localStorage.getItem('token');
  //     let splitToken = codeToken.split('.');
  //     let atobToken = atob(splitToken[1]);
  //     let uncodeToken = JSON.parse(atobToken);
  //     return uncodeToken;
  //   }

  //   tokenCheck(token){
  //     if(token['expires_in']>Date.now()){
  //       return true;
  //     } else if(localStorage.getItem('token')===dbTokenGet){
  //       return true
  //     } else {
  //       return false;
  //     }
  //   }

  //   tokenTimeDown(){
  //       alert("Session is timedown. Back to login page");
  //       this.$router.push("/");
  //   }