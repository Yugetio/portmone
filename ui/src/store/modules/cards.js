import { SET_CARDS, GET_CARDS, CREATE_CARD, EDIT_CARD, DELETE_CARD } from '../names/card';

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
    fetch("/cards", {
      method: "POST",
      body: playload
    })
    .then(res => {
      if(res.ok) {
        return res.json()
      } else {
        throw new Error('Network response was not ok.')
      }
    })
    .then(res =>
      commit('setCards', res)
    )
    .catch(error => {
      console.error('Error: ' + error.message)
    });
  },
  [CREATE_CARD]: ({ dispatch }, playload) => {
    fetch("/createCard", {
      method: "POST",
      body: playload //name, $
    })
    .then(res => {
      if(res.ok) {
        dispatch('getCards')
      } else {
        throw new Error('Network response was not ok.')
      }
    })
    .catch(error => {
      console.error('Error: ' + error.message)
    });
  },//додати методи: удалити та редагувати
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
