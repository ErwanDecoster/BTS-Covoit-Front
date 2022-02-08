import { createRouter, createWebHistory } from 'vue-router';
import Login from '../views/Login.vue';
import Registration from '../views/Registration.vue';
import SearchTrip from '../views/SearchTrip.vue';
import Trip from '../views/Trip.vue';

const routes = [
  {
    path: '/',
    name: 'Login',
    component: Login,
  },
  {
    path: '/registration',
    name: 'Registration',
    component: Registration,
  },
  {
    path: '/searchtrip',
    name: 'SearchTrip',
    component: SearchTrip,
  },
  {
    path: '/trip',
    name: 'Trip',
    component: Trip,
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
