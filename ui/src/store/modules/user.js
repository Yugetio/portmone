const state = {
  email: '',
  isAuth: false
}

const mutations = {
  setToken(state, playload){
    localStorage.auth = playload;
  }
}

const actions = {
  async auth({ commit }, playload) {
   await fetch("/auth", {
      method: "POST",
      body: JSON.stringify(playload)
    })
    .then(res => {
      if(res.ok) {
        return res.json()
      } else {
        throw new Error('Network response was not ok.')
      }
    })
    .then(res =>
      commit('setToken', res)
    )
    .catch(error => {
      console.error('Error: ' + error.message)
    });
  },
  async reg({ commit }, playload) {
    await fetch("/user", {
      method: "POST",
      body: JSON.stringify(playload)
    })
    .then( res => {
      if(res.ok) {
        return res.json()
      } else {
        throw new Error('Network response was not ok.')
      }
    })
    .then(res =>
      commit('setToken', res)
    )
    .catch(error =>
      console.log('Error: ' + error.message)
    );
  }
}

const getters = {
  getUser(state) {
    return state.email
  },
  getToken() {
    return localStorage.auth
  }
}

export default {
  state,
  mutations,
  actions,
  getters
}