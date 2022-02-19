<template>
  <div id="createTrip" class="h-full flex flex-col">
    <div class="logo pt-6">
      <h1>
        <img class="mx-auto" src="@/assets/logos/covoit.svg" alt="">
      </h1>
    </div>
    <div class="grow flex flex-col justify-between gap-4 pb-20">
      <form class="flex flex-col gap-4 ">
        <h2 class="text-2xl font-bold m-6">Créer un véhicule :</h2>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="vehicle_model">Model : </label>
          <input class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="text" name="vehicle_model" id="vehicle_model">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="motorisation">Motorisation : </label>
          <input class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="text" name="motorisation" id="motorisation">
        </div>
        <ul>
          <li v-for="row in allData" v-bind:key="row.motorization"></li>
        </ul>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="number_of_place">Nombres de places : </label>
          <input class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="number" max="6" min="1" name="number_of_place" id="number_of_place">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="password">Couleur : </label>
          <input class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="text" name="color" id="color">
        </div>
        <button class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-neutral-800 p-2 rounded-full text-white font-bold">Créer</button>
        <div v-for="row in allData" v-bind:key="row">
          <p>{{ row.libellet }}</p>
        </div>
      </form>
      <button @click="$router.go(-1)" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-white p-2 rounded-full text-neutral-900 font-bold">Retour</button>
    </div>
  </div>
  <navbar/>
</template>
<script>
import Navbar from '@/components/Navbar.vue';

import axios from 'axios';

export default {
  components: { Navbar },
  data() {
    return {
      allData: [
        { motorization: 'diesel' },
        { motorization: 'hybride' },
      ],
    };
  },
  methods: {
    fetchAllMotorization() {
      axios.post('http://localhost/actions.php', {
        action: 'fetchall_motorization',
      }).then((response) => {
        this.allData = response.data;
        console.log(response);
      });
    },
    fetchAllVehiclesForUser() {
      axios.post('http://localhost/actions.php', {
        action: 'fetchall_vehicles_for_user',
        tel: '0625306813',
      }).then((response) => {
        this.allData = response.data;
        console.log(response);
      });
    },
  },
  mounted() {
    this.fetchAllMotorization();
    console.log(this.allData);
  },
};
</script>
