<template>
  <div id="createTrip" class="h-full flex flex-col">
    <div class="logo pt-6">
      <h1>
        <img class="mx-auto" src="@/assets/logos/covoit.svg" alt="">
      </h1>
      <form class="flex flex-col gap-4 ">
        <h2 class="text-2xl font-bold m-6">Créer un itinéraire :</h2>
        <p v-show="!allVehiclesForUser" class="bg-red-500 p-2 rounded-lg text-white font-bold text-left">Attention vous n'avez pas encore de vehicule enregistré ! <router-link to="/CreateVehicle" class="w-full underline rounded-full text-white font-bold">Crée un vehicule</router-link></p>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="date_of_travel">Date de départ : </label>
          <input v-model="date_of_travel" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="date" name="date_of_travel" id="date_of_travel">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="houre_of_travel">Heure de départ : </label>
          <input v-model="houre_of_travel" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="time" name="" id="">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="starting_point">Point de départ : </label>
          <select v-model="city" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg form-control" name="starting_point" id="starting_point">
            <option v-for="city in allCity" v-bind:key="city" :value="city.id_city">{{ city.city }}</option>
          </select>
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="end_point">Point d'arriver : </label>
          <select v-model="city" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" name="end_point" id="end_point">
             <option v-for="city in allCity" v-bind:key="city" :value="city.id_city">{{ city.city }}</option>
          </select>
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="vehicle">Vehicule : </label>
          <select v-show="allVehiclesForUser != ''" v-model="vehicle" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" name="" id="">
            <option v-for="vehicle in allVehiclesForUser" v-bind:key="vehicle" :value="vehicle.id_vehicles">{{ vehicle.vehicle_name }} - {{ vehicle.color }}</option>
          </select>
          <p v-show="!allVehiclesForUser" class="text-red-500 text-left">Aucun vehicule n'est enregistré ! <router-link to="/CreateVehicle" class="w-full underline rounded-full font-bold">Crée un vehicule</router-link></p>
        </div>
        <button class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-neutral-800 p-2 rounded-full text-white font-bold">Créer</button>
      </form>
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
      vehicle: '',
      allVehiclesForUser: '',
      allCity: '',
    };
  },
  methods: {
    fetchAllVehiclesForUser() {
      axios.post('http://localhost/actions.php', {
        action: 'fetchall_vehicles_for_user',
        tel: '0625306813',
      }).then((response) => {
        if (response.data !== ' ') {
          this.allVehiclesForUser = response.data;
        }
        console.log(response.data);
      });
    },
    fetchAllCity() {
      axios.post('http://localhost/actions.php', {
        action: 'fetchall_city',
      }).then((response) => {
        this.allCity = response.data;
        console.log(response.data);
      });
    },
  },
  mounted() {
    this.fetchAllVehiclesForUser();
    this.fetchAllCity();
  },
};
</script>
