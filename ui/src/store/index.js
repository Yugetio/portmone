import Vue from 'vue'
import Vuex from 'vuex'
import user from './modules/user'
import folder from './modules/folder'
import cards from './modules/cards'
import popUp from './modules/popUp'
import axios from 'axios';

Vue.use(Vuex);

const store = new Vuex.Store({
  modules: {
    user,
    folder,
    cards,
    popUp
  }
})

const token = localStorage.getItem('user-token')
if (token) {
  axios.defaults.headers.common['Authorization'] = token
}

export default store
