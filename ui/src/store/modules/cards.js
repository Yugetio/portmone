const state = {
  cards: []
}

const mutations = {
  /**
   * 
   * @param {Object} playload
   */
  addCard(state, playload) {
    state.cards.push(playload);
  },
  setCards(state, playload) {
    state.cards = playload;
  }
}

const actions = {
  /**
   * 
   * @param {Integer} playload, get folder id
   */
  getCards({ commit }, playload = null) {
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
  createCard({ dispatch }, playload) {
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
  }
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
