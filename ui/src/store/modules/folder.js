import { SET_CURRENT_FOLDER, SET_FOLDERS, GET_CURRENT_FOLDER, GET_FOLDERS, CREATE_FOLDER, DELETE_FOLDER, RENAME_FOLDER } from '../names/folder';
import axios from 'axios';

const state = {
  folders: [],
   currentFolder: {
     id: null,
     parentID: 1,
     name: ''
   } 
}


const mutations = {

  /**
   * @param { Object } playload
   * 
   */
  [SET_CURRENT_FOLDER]: (state, payload) => {
    state.currentFolder = payload;
  },
  /**
   * @param { Array } playload
   */
  [SET_FOLDERS]: (stage, playload) => {
    stage.folders = playload;
  }
}

const actions = {
  [GET_CURRENT_FOLDER]: ({ commit }, parentID = null) => {
    return new Promise((resolve, reject) => {
      axios.post('/currentFolder', parentID)
      .then(res => {
        commit(SET_CURRENT_FOLDER, res.data)
        resolve()
      })
      .catch(error => {
        reject(error)
      });
    });
  },
  [GET_FOLDERS]: ({ commit }, parentID = null) => {
    axios.post('/folders', parentID)
    .then(res => {
      commit(SET_FOLDERS, res.data)
    })
    .catch(error => {
      console.error('Error: ' + error.message)
    });
  },
  [CREATE_FOLDER]: ({ dispatch }, nameFolder = '') => {
    axios.post('/createFolder', nameFolder)
    .then(() => {
      dispatch(GET_FOLDERS)
    })
    .catch(error => {
      console.error('Error: ' + error.message)
    });
  },
  [DELETE_FOLDER]: () => {},
  [RENAME_FOLDER]: () => {}
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
