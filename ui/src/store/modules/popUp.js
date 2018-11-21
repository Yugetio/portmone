import { HIDE_CREATE_OR_EDIT_BLOCK, SHOW_CREATE_OR_EDIT_BLOCK } from '../names/popUp';

const state = {
  show: null,
  tempData: null
}

const mutations = {
  /**
   * 
   * @param { String  } name, get 'folder' or 'card'
   * @param { Object  } data, get 'folder' or 'card'
   */
  [SHOW_CREATE_OR_EDIT_BLOCK]: (state, { name, data }) => {
    state.show = name
    state.tempData = data
  },
  [HIDE_CREATE_OR_EDIT_BLOCK]: (state) => {
    state.show = null
    state.tempData = null
  }
}

const getters = {
  getTempDataInPopUp: () => state.tempData
}

export default {
  state,
  mutations,
  getters
}