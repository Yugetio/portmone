import main from '../components/main/pages/main.vue'
import registrationForm from '../components/main/forms/registration-form.vue'



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
