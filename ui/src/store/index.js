import Vue from 'vue'
import Vuex from 'vuex'
import user from './modules/user'
import form from './modules/form'

Vue.use(Vuex);

const store = new Vuex.Store({
  modules: {
    user,
    form
  }
})

export default store
