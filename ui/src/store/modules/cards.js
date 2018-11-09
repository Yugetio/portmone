const state = {
  cards: []
}

const mutations = {
  addCard(state, playload) {
    state.cards.push(playload);
  }
}

const actions = {

}

const getters = {
  getCard(state) {
    return state.cards;
  }
}

export default {
  state,
  mutations,
  actions,
  getters
}
