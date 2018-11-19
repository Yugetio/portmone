import main from '../components/main/pages/MainPage.vue'
import workPage from '../components/main/pages/WorkPage.vue'
import profilePage from '../components/main/pages/ProfilePage.vue'
import ErrorPage from '../components/main/pages/Error.vue'
export const routes = [{
    path: '/',
    component: main,
    meta: {
      notAuth: true
    }
  },
  {
    path: '/registration',
    component: main,
    meta: {
      notAuth: true
    }
  },
  {
    path: '/workpage/:id?',
    component: workPage,
    meta: {
      requiresAuth: true
    }
  },
  {
    path: '/profile',
    component: profilePage,
    meta: {
      requiresAuth: true
    }
  },
  {
    path: '*',
    component: ErrorPage
  }
];
