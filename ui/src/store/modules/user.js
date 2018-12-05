import { LOGIN, REG, LOGOUT, DELETE_USER, SET_TOKEN, EDIT_USER_DATA, GET_USER_DATA } from '../names/user';
import axios from 'axios';

const state = {
  user: {
    id: null,
    email: ''
  },
  token: localStorage.auth || ''
}

const mutations = {
  /**
   * 
   * @param { String } token
   */
  [SET_TOKEN]: (state, token) => {
    state.token = token
  },
  [LOGOUT]: (state) => {
    state.token = ''
  }
}

const actions = {
  /**
   * 
   * @param { Object } playload,  { String } = { email, password }
   */
  [LOGIN]: ({ commit }, { email, password }) => {
    return new Promise((resolve, reject) => {
      axios.post('/api/auth', {
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
  /**
   * 
   * @param { Object } playload,  { String } = { email, password }
   */
  [REG]: ({ commit }, { email, password }) => {
    return new Promise((resolve, reject) => {
      axios.post('/api/user', {
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
  /**
   * 
   * @param { Object } playload,  { String } = { email, password } ???
   */
  [EDIT_USER_DATA]: ({ commit }, { email, password }) => {
    return new Promise((resolve, reject) => {
      axios.put('/api/user', {
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
  // Потрібно читати дані user-a [GET_USER_DATA]: ({ commit })
  [LOGOUT]: ({ commit }) => {
    return new Promise((resolve, reject) => {
      delete axios.defaults.headers.common['Authorization']
      commit(LOGOUT)
      localStorage.removeItem('auth')
      resolve()
    })
  },
  /**
   * @param { Integer } id
   */
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
  /**
   * @return { Object }
   */
  getUser: state => state.user,
  /**
   * 
   * @return { String }
   */
  getToken: state => state.token,
  /**
   * 
   * @return { Boolean }
   */
  isAuthenticated: state => !!state.token
}

export default {
  state,
  mutations,
  actions,
  getters
}