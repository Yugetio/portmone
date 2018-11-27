import { SET_CARDS, GET_CARDS, CREATE_CARD, EDIT_CARD, DELETE_CARD } from '../names/card';
import axios from 'axios';

const state = {
  cards: [
    {
      id: 1,
      number: '1111111111111',
      cash: '121'
    },
    {
      id: 2,
      number: '22222222222222',
      cash: '121'
    },
    {
      id: 3,
      number: '33333333333333',
      cash: '121'
    },
    {
      id: 4,
      number: '444444444444444',
      cash: '121'
    }
  ]
}

const mutations = {
  [SET_CARDS]: (state, playload) => {
    state.cards = playload;
  }
}

const actions = {
  /**
   * 
   * @param {Integer} playload, get folder id
   */
  [GET_CARDS]: ({ commit }, folderId ) => {
     axios.get('/card', folderId)
    .then(res => {
      commit(SET_CARDS, res.data)
    })
    .catch(error => {
      console.error('Error: ' + error.message)
    })
  },
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
  [EDIT_CARD]: ({ dispatch }, { id, number, cash }) => {
    return new Promise((resolve, reject) => {
      axios.put('/card', {
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
  [DELETE_CARD]: ({ dispatch }, id) => {
    axios.delete('/card',id)
    .then(() => {
      dispatch(GET_CARDS)
    })
    .catch(error => {
      console.error('Error: ' + error.message)
    })
  }
}

const getters = {
  getCards: state => state.cards
}

export default {
  state,
  mutations,
  actions,
  getters
}
