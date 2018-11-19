const state = {
  show: null
}

const mutations = {
  /**
   * 
   * @param { String  } playload, get 'folder' or 'card'
   */
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