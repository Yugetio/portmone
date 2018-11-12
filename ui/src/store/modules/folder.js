const state = {
  folders: [],
  parentID: 1,
  current: 'folder 1'
}

const mutations = {
  setCurrentFolder(state, payload) {
    state.current = payload;
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
