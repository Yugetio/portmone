import store from '../store'

export const ifNotAuthenticated = (to, from, next) => {
  if (!store.state.user.isAuth) {
    next()
    return
  }
  next('/workpage')
}

export const ifAuthenticated = (to, from, next) => {
  if (store.state.user.isAuth) {
    next()
    return
  }
  next('/')
}