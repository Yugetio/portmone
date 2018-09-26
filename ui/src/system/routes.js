import main from '../components/main/pages/MainPage.vue'
import registrationForm from '../components/main/elements/forma/RegistrationForm.vue'
import workPage from '../components/main/pages/WorkPage.vue'
import profilePage from '../components/main/pages/ProfilePage.vue'


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
