<template>
  <div id="login" class="h-full flex flex-col dark:text-white w-96 mx-auto">
    <div class="logo pt-6">
      <h1>
        <img class="mx-auto" src="@/assets/logos/covoit.svg" alt="">
      </h1>
    </div>
    <div class="grow flex flex-col justify-between gap-4 pb-20">
      <div>
        <h2 class="text-2xl font-bold m-6">Mes véhicules</h2>
        <div class="flex flex-col gap-4">
          <p v-show="!allVehiclesForUser" class="">Vous n'avez pas encore de véhicule enregisté ! parfait c'est le moment !</p>
          <p v-show="vehiculeAdded === 'true' && visible === true" @click="visible = false" class="bg-emerald-500 p-2 rounded-lg text-white font-bold text-left">Véhicule ajouté avec succés.</p>
          <router-link :to="'/VehiclesEdit/' + vehicle.row_id " v-for="vehicle in allVehiclesForUser" v-bind:key="vehicle" class="bg-white p-2 rounded-full text-neutral-900 font-bold border border-neutral-900">{{ vehicle.vehicle_name }} - {{ vehicle.color }}</router-link>
          <router-link to="/CreateVehicle" class="w-full drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-neutral-800 p-2 rounded-full text-white font-bold dark:shadow-[0_-5px_15px_-8px_rgba(255,255,255,0.5)] mt-5">Créer un nouveau véhicule</router-link>
        </div>
      </div>
      <button @click="$router.go(-1)" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-white p-2 rounded-full text-neutral-900 font-bold dark:shadow-[0_-5px_15px_-8px_rgba(255,255,255,0.5)]">Retour</button>
    </div>
  </div>
  <navbar/>
</template>
<script>
import Navbar from '@/components/Navbar.vue';
import axios from 'axios';

export default {
  props: ['vehiculeAdded'],
  components: { Navbar },
  data() {
    return {
      allVehiclesForUser: '',
      visible: true,
    };
  },
  methods: {
    fetchAllVehiclesForUser() {
      axios.post('http://localhost/actions.php', {
        action: 'fetchall_vehicles_for_user',
        tel: localStorage.tel,
      }).then((response) => {
        if (response.data !== ' ') {
          this.allVehiclesForUser = response.data;
        }
        console.log(response.data);
      });
    },
  },
  mounted() {
    this.fetchAllVehiclesForUser();
    // Permet de ne pas aller sur la page si on est pas connecter
    if (!localStorage.tel) {
      this.$router.push({ path: '/' });
    }
  },
};
</script>
