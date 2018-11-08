import Vue from 'vue'
import Vuex from 'vuex'
import user from './modules/user'
import folder from './modules/folder'
import cards from './modules/cards'

Vue.use(Vuex);

const store = new Vuex.Store({
  modules: {
    user,
    folder,
    cards
  }
})

export default store
