import { SET_CURRENT_FOLDER, SET_FOLDERS, GET_CURRENT_FOLDER, GET_FOLDERS, CREATE_FOLDER, DELETE_FOLDER, RENAME_FOLDER } from '../names/folder';
import axios from 'axios';

const state = {
  folders: [
    {
      nameFolder: 'a',
      id: 1,
      parentId: null
    },
    {
      nameFolder: 'b',
      id: 2,
      parentId: null
    },
    {
      nameFolder: 'c',
      id: 3,
      parentId: null
    }
  ],
   currentFolder: {
     id: null,
     parentId: null,
     nameFolder: ''
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
  [GET_CURRENT_FOLDER]: ({ commit }, id = null) => {
    return new Promise((resolve, reject) => {
      axios.get(`/currentFolder/${id}`)
      .then(res => {
        commit(SET_CURRENT_FOLDER, res.data)
        resolve()
      })
      .catch(error => {
        reject(error)
      });
    });
  },
  [GET_FOLDERS]: ({ commit }, id = null) => {
    axios.get(`/folder/${id}`)
    .then(res => {
      commit(SET_FOLDERS, res.data)
    })
    .catch(error => {
      console.error('Error: ' + error.message)
    });
  },
  [CREATE_FOLDER]: ({ dispatch }, nameFolder = '') => {
    return new Promise((resolve, reject) => {
      axios.post('/folder', nameFolder)
      .then(() => {
        dispatch(GET_FOLDERS)
        resolve()
      })
      .catch(error => {
        reject(error)
      });
    })
  },
  [DELETE_FOLDER]: ({ dispatch }, id) => {
    axios.delete('/folder', id)
    .then(() => {
      dispatch(GET_FOLDERS)
    })
    .catch(error => {
      console.error('Error: ' + error.message)
    });
  },
  [RENAME_FOLDER]: ({ dispatch }, folder, nameFolder = '') => {
    return new Promise((resolve, reject) => {
      axios.put('/folder', {
        id: folder.id,
        nameFolder
      })
      .then(() => {
        dispatch(GET_FOLDERS)
        resolve();
      })
      .catch(error => {
        console.error('Error: ' + error.message)
      })
    })
  }
}

const getters = {
  getFolders: state => state.folders,
  getCurrentFolder: state => state.currentFolder
}

export default {
  state,
  mutations,
  actions,
  getters
}
