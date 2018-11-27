import main from '../components/main/pages/MainPage.vue'
import workPage from '../components/main/pages/WorkPage.vue'
import profilePage from '../components/main/pages/ProfilePage.vue'
import ErrorPage from '../components/main/pages/Error.vue'
import {ifNotAuthenticated, ifAuthenticated } from './redirect';

export const routes = [{
    path: '/',
    component: main,
    beforeEnter: ifNotAuthenticated,
  },
  {
    path: '/registration',
    component: main,
    beforeEnter: ifNotAuthenticated,

  },
  {
    path: '/workpage/:id?',
    component: workPage,
    beforeEnter: ifAuthenticated,

  },
  {
    path: '/profile',
    component: profilePage,
    beforeEnter: ifAuthenticated,

  },
  {
    path: '*',
    component: ErrorPage
  }
];
