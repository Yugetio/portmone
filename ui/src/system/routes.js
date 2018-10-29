import main from '../components/main/pages/MainPage.vue'
import registrationForm from '../components/main/elements/forma/RegistrationForm.vue'
import workPage from '../components/main/pages/WorkPage.vue'
import profilePage from '../components/main/pages/ProfilePage.vue'
import filePage from  '../components/main/pages/FilesPage.vue'
import foldersPage from '../components/main/pages/FoldersPage.vue'
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
  },
  {
    path: '/folders',
    component: foldersPage
  },
  {
    path: '/filepage',
    component: filePage
  }
];
