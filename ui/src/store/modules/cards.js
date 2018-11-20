import { SET_CARDS, GET_CARDS, CREATE_CARD, EDIT_CARD, DELETE_CARD } from '../names/card';
import axios from 'axios';

const state = {
  cards: []
}

const mutations = {
  /**
   * 
   * @param {Object} playload
   */
  addCard(state, playload) {//переробити
    state.cards.push(playload);
  },
  [SET_CARDS]: (state, playload) => {
    state.cards = playload;
  }
}

const actions = {
  /**
   * 
   * @param {Integer} playload, get folder id
   */
  [GET_CARDS]: ({ commit }, playload = null) => {
     axios.post('/cards', playload)
    .then(res => {
      commit('setCards', res.data)
      resolve()
    })
    .catch(error => {
      console.error('Error: ' + error.message)
    }); 
  },
  [CREATE_CARD]: ({ dispatch }, playload) => {
    axios.post('/createCard', playload)
    .then(res => {
      dispatch('getCards')
      resolve()
    })
    .catch(error => {
      console.error('Error: ' + error.message)
    });
  },
  [EDIT_CARD]: () => {},
  [DELETE_CARD]: () => {}
}

const getters = {
  getCards(state) {
    return state.cards;
  }
}

export default {
  state,
  mutations,
  actions,
  getters
}
