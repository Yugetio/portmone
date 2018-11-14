const state = {
  folders: [{
    id: 1,
    name: 'a',
    parentID: null
  },
  {
    id: 2,
    name: 'b',
    parentID: null
  },
  {
    id: 3,
    name: 'c',
    parentID: null
  }],
   currentFolder: {
     id: null,
     parentID: 1,
     name: ''
   } 
}


const mutations = {
  setCurrentFolder(state, payload) {
    state.currentFolder = payload;
  },
  addFolder(state, payload) { // delete this method
    state.folders.push(payload);
  },
  setFolders(stage, playload) {
    stage.folders = playload;
  }
}

const actions = {
   getCurrentFolder({ commit }, playload = null) {
     fetch("/currentFolder", {
       method: "POST",
       body: playload //id
     })
     .then(res => {
       if(res.ok) {
         return res.json()
       } else {
         throw new Error('Network response was not ok.')
       }
     })
     .then(res =>
       commit('setCurrentFolder', res)
     )
     .catch(error => {
       console.error('Error: ' + error.message)
     });
   },
   getFolders({ commit }, playload = null) {
    fetch("/folders", {
      method: "POST",
      body: playload //id
    })
    .then(res => {
      if(res.ok) {
        return res.json()
      } else {
        throw new Error('Network response was not ok.')
      }
    })
    .then(res =>
      commit('setFolders', res)
    )
    .catch(error => {
      console.error('Error: ' + error.message)
    });
  },
  createFolder({ dispatch }, playload = '') {
    fetch("/createFolder", {
      method: "POST",
      body: playload //name
    })
    .then(res => {
      if(res.ok) {
        dispatch('getFolders')
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
  getFolders(state) {
    return state.folders;
  },
  getCurrentFolder(state){
    return state.currentFolder;
  }
}

export default {
  state,
  mutations,
  actions,
  getters
}
