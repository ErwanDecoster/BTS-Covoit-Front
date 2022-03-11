<template>
  <div id="createTrip" class="">
    <div class="logo pt-6">
      <h1>
        <img class="mx-auto" src="@/assets/logos/covoit.svg" alt="">
      </h1>
      <form class="flex flex-col gap-4 " @submit.stop.prevent="CreateTrip">
        <h2 class="text-2xl font-bold m-6">Créer un intinéraire :</h2>
        <p v-show="!allVehiclesForUser" class="bg-red-500 p-2 rounded-lg text-white font-bold text-left">Attention vous n'avez pas encore de vehicule enregistré ! <router-link to="/CreateVehicle" class="w-full underline rounded-full text-white font-bold">Crée un vehicule</router-link></p>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="date_of_travel">Date de départ : </label>
          <input v-model="date_of_travel" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="date" name="date_of_travel" id="date_of_travel">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="houre_of_travel">Heure de départ : </label>
          <input v-model="houre_of_travel" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="time" name="houre_of_travel" id="houre_of_travel">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="starting_point">Point de départ : </label>
          <input v-model="starting_point" @input="allCityStartingPointFiltred" autocomplete="off" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg form-control" list="starting_point_list" name="starting_point" id="starting_point">
          <datalist id="starting_point_list">
            <option v-for="city in sugestedCityStartingPoint" :key="city" :value="city.ville_nom_reel">{{ city.ville_nom_reel }} - {{ city.ville_code_postal }}</option>
          </datalist>
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="end_point">Point d'arriver : </label>
          <input v-model="end_point" @input="allCityEndPointFiltred" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" list="end_point_list" name="end_point" id="end_point">
          <datalist id="end_point_list">
            <option v-for="city in sugestedCityEndPoint" :key="city" :value="city.ville_nom_reel">{{ city.ville_nom_reel }} - {{ city.ville_code_postal }}</option>
          </datalist>
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="vehicle">Vehicule : </label>
          <select v-show="allVehiclesForUser != ''" v-model="id_vehicles" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" name="" id="">
            <option v-for="vehicle in allVehiclesForUser" v-bind:key="vehicle" :value="vehicle.id_vehicles">{{ vehicle.vehicle_name }} - {{ vehicle.color }}</option>
          </select>
          <p v-show="!allVehiclesForUser" class="text-red-500 text-left">Aucun vehicule n'est enregistré ! <router-link to="/CreateVehicle" class="w-full underline rounded-full font-bold">Crée un vehicule</router-link></p>
          <!-- <input class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="text" name="vehicle" id="vehicle"> -->
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
      date_of_travel: '',
      houre_of_travel: '',
      starting_point: '',
      end_point: '',
      id_vehicles: '',
      allVehiclesForUser: '',
      allCity: '',
      sugestedCityStartingPoint: '',
      sugestedCityEndPoint: '',
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
      });
    },
    fetchAllCity() {
      axios.post('http://localhost/actions.php', {
        action: 'fetchall_city',
      }).then((response) => {
        if (response.data !== ' ') {
          this.allCity = response.data;
        }
      });
    },
    CreateTrip() {
      axios.post('http://localhost/actions.php', {
        action: 'create_trip',
        starting_date: this.date_of_travel,
        departure_time: this.houre_of_travel,
        id_vehicles: this.id_vehicles,
        id_user: 1,
        id_end_point_city: this.allCity.find((city) => city.ville_nom_reel === this.end_point).ville_id,
        id_starting_point_city: this.allCity.find((city) => city.ville_nom_reel === this.starting_point).ville_id,
        // id_end_point_city: this.end_point,
        // id_starting_point_city: this.starting_point,
      }).then((response) => {
        if (response.data !== ' ') {
          console.log(response.data);
        }
        this.$router.push({ path: '/Trip' });
      });
    },
    allCityStartingPointFiltred() {
      const citys = this.allCity;
      const starting = this.starting_point.toLowerCase().replace('-', ' ').normalize('NFD').replace(/\p{Diacritic}/gu, '');
      // console.log(citys);
      // console.log('executed');
      const result = citys.filter((city) => city.ville_nom_reel.toLowerCase().replace('-', ' ').normalize('NFD').replace(/\p{Diacritic}/gu, '')
        .startsWith(starting));
      // console.log(result);
      this.sugestedCityStartingPoint = result.slice(0, 20);
      return result;
    },
    allCityEndPointFiltred() {
      const citys = this.allCity;
      const end = this.end_point.toLowerCase().replace('-', ' ').normalize('NFD').replace(/\p{Diacritic}/gu, '');
      // console.log(citys);
      // console.log('executed');
      const result = citys.filter((city) => city.ville_nom_reel.toLowerCase().replace('-', ' ').normalize('NFD').replace(/\p{Diacritic}/gu, '')
        .startsWith(end));
      // console.log(result);
      this.sugestedCityEndPoint = result.slice(0, 20);
      return result;
    },
  },
  mounted() {
    this.fetchAllVehiclesForUser();
    this.fetchAllCity();
    // console.log(this.allCityFiltred(this.words));
  },
};
</script>
