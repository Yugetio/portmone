const state = {
  user: null
}

const mutations = {

}

const actions = {
  auth({commit}, {email, password}) {
    // console.log('email, password =', email, password)
    axios.post ('/api/auth',{
      email, password
    })
  }
}

const getters = {

}

export default {
  state,
  mutations,
  actions,
  getters
}
