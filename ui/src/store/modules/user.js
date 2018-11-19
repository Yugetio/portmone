import { LOGIN, REG, LOGOUT, DELETE } from '../names/user';

const state = {
  email: '',
  isAuth: true //переробити
}

const mutations = {
  setToken(state, playload){ //перенести в другий модуль
    localStorage.auth = playload;
  },
  /**
   * 
   * @param { Boolean } playload 
   */
  setIsAuth(state, playload) { //переробити
    state.isAuth = playload;
  }
}

const actions = {
  [LOGIN]: ({}, playload) => {
    return fetch("/auth", {
      method: "POST",
      body: JSON.stringify(playload)
    })
    .then(res => {
        return res.json()
    })
    .catch(() => {
      throw new Error('Network response was not ok.')
    });
  },
  [REG]: ({}, playload) => {
    return fetch("/user", {
      method: "POST",
      body: JSON.stringify(playload)
    })
    .then( res => {
      return res.json()
    })
    .catch(() => {
      throw new Error('Network response was not ok.')
    });
  }, //створити методи: виход та удалити
  [LOGOUT]: () => {

  },
  [DELETE]: () => {}
}

const getters = {
  getUser(state) {
    return state.email
  },
  getToken() {//перенести в другий модуль
    return localStorage.auth
  }
}

export default {
  state,
  mutations,
  actions,
  getters
}