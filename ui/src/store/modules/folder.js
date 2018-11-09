const state = {
  folders: [],
  perentID: null,
  current: '',
  new: ''
}

const mutations = {
  setCurrentFolder(state, payload) {
    state.current = payload;
    console.log('setCurrentFolder');
  },
  addFolder(state, payload) {
    state.folders.push(payload);
  },
  setFolders(stage, playload) {
    stage.folders = playload;
  }
}

const actions = {

}

const getters = {
  getFolders(state) {
    return state.folders;
  },
  getCurrentFolder(state){
    return state.current;
  }
}

export default {
  state,
  mutations,
  actions,
  getters
}
