import { createRouter, createWebHistory } from 'vue-router';
import Login from '../views/Login.vue';
import Registration from '../views/Registration.vue';
import SearchTrip from '../views/SearchTrip.vue';
import SearchTripResult from '../views/SearchTripResult.vue';
import Trip from '../views/Trip.vue';
import TripHistory from '../views/TripHistory.vue';
import ProfilSetting from '../views/ProfilSetting.vue';
import Vehicles from '../views/Vehicles.vue';
import CreateTrip from '../views/CreateTrip.vue';
import CreateVehicle from '../views/CreateVehicle.vue';
import VehiclesEdit from '../views/VehiclesEdit.vue';
import Personalinformation from '../views/Personalinformation.vue';
import EditPassword from '../views/EditPassword.vue';
import EditPersonalInformation from '../views/EditPersonalInformation.vue';
import DeleteAccount from '../views/DeleteAccount.vue';

const routes = [
  {
    path: '/',
    name: 'Login',
    component: Login,
    props: true,
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
    path: '/SearchTripResult',
    props: true,
    name: 'SearchTripResult',
    component: SearchTripResult,
  },
  {
    path: '/trip',
    name: 'Trip',
    component: Trip,
  },
  {
    path: '/TripHistory',
    name: 'TripHistory',
    component: TripHistory,
  },
  {
    path: '/ProfilSetting',
    name: 'ProfilSetting',
    component: ProfilSetting,
  },
  {
    path: '/Vehicles',
    name: 'Vehicles',
    component: Vehicles,
    props: true,
  },
  {
    path: '/CreateTrip',
    name: 'CreateTrip',
    component: CreateTrip,
  },
  {
    path: '/CreateVehicle',
    name: 'CreateVehicle',
    component: CreateVehicle,
  },
  {
    path: '/VehiclesEdit/:id',
    name: 'VehiclesEdit',
    component: VehiclesEdit,
    props: true,
  },
  {
    path: '/Personalinformation',
    name: 'Personalinformation',
    component: Personalinformation,
    props: true,
  },
  {
    path: '/EditPassword',
    name: 'EditPassword',
    component: EditPassword,
  },
  {
    path: '/EditPersonalInformation',
    name: 'EditPersonalInformation',
    component: EditPersonalInformation,
  },
  {
    path: '/deleteAccount',
    name: 'DeleteAccount',
    component: DeleteAccount,
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
