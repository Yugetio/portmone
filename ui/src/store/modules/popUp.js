const state = {
  show: null
}

const mutations = {
  showCreateBlock(state, playload) {
    state.show = playload
  },
  hideCreateBlock(state) {
    state.show = null;
  }

}

export default {
  state,
  mutations
}