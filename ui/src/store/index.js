import Vue from 'vue'
import Vuex from 'vuex'
import user from './modules/user'
import folder from './modules/folder'
import cards from './modules/cards'
import popUp from './modules/popUp'

Vue.use(Vuex);

const store = new Vuex.Store({
  modules: {
    user,
    folder,
    cards,
    popUp
  }
})

export default store
