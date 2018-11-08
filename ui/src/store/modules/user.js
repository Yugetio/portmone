//опис авторизації та регістрації користувача + зберіганя та оброблення якихось даних повязаних з кор...
//користувач нашого сайту. null - пока не авторизувався
const state = {
  user: null
}

const mutations = {

}
//користувач робить дію (actions) де викликає (mutations) які змінять стан user
const actions = {
  auth({commit}, {email, password}) {
    // console.log('email, password =', email, password)
    axios.post ('/api/auth',{
      email, password
    })
  }
}
// за допомогою getters отримуєм данні про user
const getters = {

}

export default {
  state,
  mutations,
  actions,
  getters
}
