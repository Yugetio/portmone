import { SET_CURRENT_FOLDER, SET_FOLDERS, GET_CURRENT_FOLDER, GET_FOLDERS, CREATE_FOLDER, DELETE_FOLDER, RENAME_FOLDER } from '../names/folder';
import axios from 'axios';

const state = {
  folders: [
    {
      name: 'a',
      id: 1,
      parentId: null
    },
    {
      name: 'b',
      id: 2,
      parentId: null
    },
    {
      name: 'c',
      id: 3,
      parentId: null
    }
  ],
   currentFolder: {
     id: null,
     parentId: null,
     name: ''
   } 
}


const mutations = {

  /**
   * @param { Object } playload, { id, parentId, name }
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
  /**
   * 
   * @param { Integer or Null } id
   */
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
  /**
   * 
   * @param { Integer or Null } id
   */
  [GET_FOLDERS]: ({ commit }, id = null) => {
    axios.get(`/folder/${id}`)
    .then(res => {
      commit(SET_FOLDERS, res.data)
    })
    .catch(error => {
      console.error('Error: ' + error.message)
    });
  },
  /**
   * 
   * @param { String } name
   */
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
  /**
   * 
   *  @param { Integer } id
   */
  [DELETE_FOLDER]: ({ dispatch }, id) => {
    axios.delete('/folder', id)
    .then(() => {
      dispatch(GET_FOLDERS)
    })
    .catch(error => {
      console.error('Error: ' + error.message)
    });
  },
  /**
   * 
   * @param { Object } folder
   */
  [RENAME_FOLDER]: ({ dispatch }, folder) => {
    return new Promise((resolve, reject) => {
      axios.put('/folder', {
        id: folder.id,
        nameFolder: folder.name
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
  /**
   * @return { Array }
   */
  getFolders: state => state.folders,
  /**
   * @return { Object }
   */
  getCurrentFolder: state => state.currentFolder
}

export default {
  state,
  mutations,
  actions,
  getters
}
