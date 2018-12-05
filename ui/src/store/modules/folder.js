import { SET_CURRENT_FOLDER, SET_FOLDERS, GET_CURRENT_FOLDER, GET_FOLDERS, CREATE_FOLDER, DELETE_FOLDER, RENAME_FOLDER } from '../names/folder';
import axios from 'axios';

const state = {
  folders: [],
  currentFolder: {}
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
  [SET_FOLDERS]: (state, playload) => {

    state.folders = playload;
  }
}

const actions = {
  /**
   * 
   * @param { Integer or Null } id
   */
  [GET_CURRENT_FOLDER]: ({ commit }, id = null) => {
    return new Promise((resolve, reject) => {
      const url = '/api/currentFolder' + (id ? `/${id}` : '');
      axios.get(url)
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
    const url = '/api/folder' + (id ? `/${id}` : '');
    axios.get(url)
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
      axios.post('/api/folder', nameFolder)
      .then(() => {
        // dispatch(GET_FOLDERS)
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
    axios.delete(`/api/folder/${id}`) // В DELETE метода немає body
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
      axios.put('/api/folder/' + folder.id, { // в PUT кразе передавати id в url
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
  getCurrentFolder: state => state.currentFolder,
}

export default {
  state,
  mutations,
  actions,
  getters
}
