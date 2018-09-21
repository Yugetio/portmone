import main from '../components/main/pages/main.vue'
import registrationForm from '../components/main/elements/forma/registrationForm.vue'
import workPage from '../components/main/pages/workPage.vue'
import profilePage from '../components/main/pages/profilePage.vue'


export const routes = [{
    path: '/',
    component: main
  },
  {
    path: '/registration',
    component: registrationForm
  },
  {
    path: '/workpage',
    component: workPage
  },
  {
    path: '/profile',
    component: profilePage
  }
];
