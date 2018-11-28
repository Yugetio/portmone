import { LOGIN, REG, LOGOUT, DELETE_USER, SET_TOKEN, EDIT_USER_DATA } from '../names/user';
import axios from 'axios';

const state = {
  user: '',
  token: localStorage.auth || ''
}

const mutations = {
  [SET_TOKEN]: (state, token) => {
    state.token = token
  },
  [LOGOUT]: (state) => {
    state.token = ''
  }
}

const actions = {
  [LOGIN]: ({ commit }, { email, password }) => {
    return new Promise((resolve, reject) => {
      axios.post('/auth', {
        email,
        password
      })
        .then(res => {
          const token = res.data.token

          axios.defaults.headers.common['Authorization'] = token
          localStorage.auth = token    
          commit(SET_TOKEN, token)

          resolve()
        })
      .catch(err => {
        localStorage.removeItem('auth')
        reject(err)
      })
    })
  },
  [REG]: ({ commit }, { email, password }) => {
    return new Promise((resolve, reject) => {
      axios.post('/user', {
        email,
        password
      })
        .then(res => {
          const token = res.data.token

          axios.defaults.headers.common['Authorization'] = token
          localStorage.auth = token    
          commit(SET_TOKEN, token)

          resolve()
        })
      .catch(err => {
        localStorage.removeItem('auth')
        reject(err)
      })
    })
  },
  [EDIT_USER_DATA]: ({ commit }, { email, password }) => {
    return new Promise((resolve, reject) => {
      axios.post('/user', {
        email,
        password
      })
        .then(res => {
          const token = res.data.token

          axios.defaults.headers.common['Authorization'] = token
          localStorage.auth = token    
          commit(SET_TOKEN, token)

          resolve()
        })
      .catch(err => {
        localStorage.removeItem('auth')
        reject(err)
      })
    })
  },
  [LOGOUT]: ({ commit }) => {
    return new Promise((resolve, reject) => {
      delete axios.defaults.headers.common['Authorization']
      commit(LOGOUT)
      localStorage.removeItem('auth')
      resolve()
    })
  },
  [DELETE_USER]: ({ dispatch }, id) => {
    return new Promise((resolve, reject) => {
      axios.delete('/user', id)
        .then(() => {
          dispatch(LOGOUT)
          resolve()
        })
      .catch(err => {
        console.error(err.message)
      })
    })
  }
}

const getters = {
  getUser: state => state.user,
  getToken: state => state.token,
  isAuthenticated: state => !!state.token
}

export default {
  state,
  mutations,
  actions,
  getters
}