import { SHOW_CREATED_BLOCK, HIDE_CREATED_BLOCK } from '../names/popUp';

const state = {
  show: null
}

const mutations = {
  /**
   * 
   * @param { String  } playload, get 'folder' or 'card'
   */
  [SHOW_CREATED_BLOCK]: (state, playload) => {
    state.show = playload
  },
  [HIDE_CREATED_BLOCK]: (state) => {
    state.show = null;
  }

}

export default {
  state,
  mutations
}