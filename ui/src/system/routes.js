import main from '../components/main/pages/MainPage.vue'
import workPage from '../components/main/pages/WorkPage.vue'
import profilePage from '../components/main/pages/ProfilePage.vue'
import filePage from '../components/main/pages/CardsPage.vue'
import ErrorPage from '../components/main/pages/Error.vue'
export const routes = [{
    path: '/',
    component: main
  },
  {
    path: '/registration',
    component: main
  },
  {
    path: '/workpage',
    component: workPage
  },
  {
    path: '/profile',
    component: profilePage
  },
  {
    path: '/filepage',
    component: filePage
  },
  {
    path: '/index',
    redirect: '/'
  },
  {
    path: '*',
    component: ErrorPage
  }
];
