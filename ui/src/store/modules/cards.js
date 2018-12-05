import { SET_CARDS, GET_CARDS, CREATE_CARD, EDIT_CARD, DELETE_CARD } from '../names/card';
import axios from 'axios';

const state = {
  cards: []
}

const mutations = {
  /**
   * 
   * @param { Array } playload
   */
  [SET_CARDS]: (state, playload) => {
    state.cards = playload;
  }
}

const actions = {
  /**
   * 
   * @param {Integer} folderId
   */
  [GET_CARDS]: ({ commit }, folderId ) => {
     axios.get('/api/card', folderId)
    .then(res => {
      commit(SET_CARDS, res.data)
    })
    .catch(error => {
      console.error('Error: ' + error.message)
    })
  },
  /**
   * 
   * @param { Object } playload, { number, cash }
   * @param { String or Integer } number
   * @param { String or Integer } cash
   */
  [CREATE_CARD]: ({ dispatch }, { number, cash }) => {
    return new Promise((resolve, reject) => {
      axios.post('/card', {
        number,
        cash
       })
      .then(() => {
        dispatch(GET_CARDS)
        resolve()
      })
      .catch(error => {
        reject(error)
      })
    })
  },
  /**
   * 
   * @param { Object } playload, { id, number, cash }
   */
  [EDIT_CARD]: ({ dispatch }, { id, number, cash }) => {
    return new Promise((resolve, reject) => {
      axios.put('/api/card', {
        id,
        number,
        cash
       })
      .then(() => {
        dispatch(GET_CARDS)
        resolve()
      })
      .catch(error => {
        console.error('Error: ' + error.message)
      })
    })
  },
  /**
   * 
   * @param { Integer } id
   */
  [DELETE_CARD]: ({ dispatch }, id) => {
    axios.delete('/api/card',id)
    .then(() => {
      dispatch(GET_CARDS)
    })
    .catch(error => {
      console.error('Error: ' + error.message)
    })
  }
}

const getters = {
  /**
   * @return { Array }
   */
  getCards: state => state.cards
}

export default {
  state,
  mutations,
  actions,
  getters
}
