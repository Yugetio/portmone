import main from '../components/main/pages/main.vue'
import registrationForm from '../components/main/forms/registrationForm.vue'



export const routes = [
  {
    path: '/',
    component: main
  },
  {
    path: '/registration',
    component: registrationForm
  }
];
