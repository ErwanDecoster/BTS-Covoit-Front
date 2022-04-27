<template>
  <div id="createTrip" class="dark:text-white w-96 mx-auto max-w-sm">
    <div class="logo pt-6">
      <h1>
        <img class="mx-auto" src="@/assets/logos/covoit.svg" alt="">
      </h1>
      <form class="flex flex-col gap-4 " @submit.stop.prevent="CreateTripValidation">
        <h2 class="text-2xl font-bold m-6">Créer un itinéraire :</h2>
        <p v-show="!allVehiclesForUser" class="bg-red-500 p-2 rounded-lg text-white font-bold text-left">Attention vous n'avez pas encore de vehicule enregistré ! <router-link to="/CreateVehicle" class="w-full underline rounded-full text-white font-bold">Crée un vehicule</router-link></p>
        <p v-for="error in errors" :key="error" @click="this.errors = [];" class="bg-red-500 p-2 rounded-lg text-white font-bold text-left">{{ error }}</p>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="date_of_travel">Date de départ : </label>
          <input v-model="date_of_travel" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg dark:text-[#000000]" type="date" name="date_of_travel" id="date_of_travel">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="houre_of_travel">Heure de départ : </label>
          <input v-model="houre_of_travel" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg dark:text-[#000000]" type="time" name="houre_of_travel" id="houre_of_travel">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="starting_point">Point de départ : </label>
          <input v-model="starting_point" @input="allCityStartingPointFiltred" autocomplete="off" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg form-control dark:text-[#000000]" list="starting_point_list" name="starting_point" id="starting_point">
          <datalist id="starting_point_list">
            <option v-for="city in sugestedCityStartingPoint" :key="city" :value="city.ville_nom_reel">{{ city.ville_nom_reel }} - {{ city.ville_code_postal }}</option>
          </datalist>
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="end_point">Point d'arrivée : </label>
          <input v-model="end_point" @input="allCityEndPointFiltred" autocomplete="off" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg dark:text-[#000000]" list="end_point_list" name="end_point" id="end_point">
          <datalist id="end_point_list">
            <option v-for="city in sugestedCityEndPoint" :key="city" :value="city.ville_nom_reel">{{ city.ville_nom_reel }} - {{ city.ville_code_postal }}</option>
          </datalist>
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="vehicle">Véhicule : </label>
          <select v-show="allVehiclesForUser != ''" v-model="id_vehicles" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg dark:text-[#000000]" name="" id="">
            <option v-for="vehicle in allVehiclesForUser" v-bind:key="vehicle" :value="vehicle.id_vehicles">{{ vehicle.vehicle_name }} - {{ vehicle.color }}</option>
          </select>
          <p v-show="!allVehiclesForUser" class="text-red-500 text-left">Aucun vehicule n'est enregistré ! <router-link to="/CreateVehicle" class="w-full underline rounded-full font-bold">Crée un vehicule</router-link></p>
        </div>
        <button class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-neutral-800 p-2 rounded-full text-white font-bold dark:shadow-[0_-5px_15px_-8px_rgba(255,255,255,0.5)] mt-5">Créer</button>
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
      errors: [],
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
        tel: localStorage.tel,
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
    CreateTripValidation() {
      this.errors = [];
      if (this.date_of_travel !== '') {
        if (this.houre_of_travel !== '') {
          if (this.starting_point !== '') {
            if (this.end_point !== '') {
              if (this.id_vehicles !== '') {
                this.CreateTrip();
              } else {
                this.errors.push('Un véhicule doit être selectionné.');
              }
            } else {
              this.errors.push('Un point de d\'arrivée doit être selectionné parmis ceux proposés.');
            }
          } else {
            this.errors.push('Un point de départ doit être selectionné parmis ceux proposés.');
          }
        } else {
          this.errors.push('Une heure de départ doit être selectionnée.');
        }
      } else {
        this.errors.push('Une date de départ doit être choisie.');
      }
    },
    CreateTrip() {
      axios.post('http://localhost/actions.php', {
        action: 'create_trip',
        starting_date: this.date_of_travel,
        departure_time: this.houre_of_travel,
        id_vehicles: this.id_vehicles,
        userTel: localStorage.tel,
        id_end_point_city: this.allCity.find((city) => city.ville_nom_reel === this.end_point).ville_id,
        id_starting_point_city: this.allCity.find((city) => city.ville_nom_reel === this.starting_point).ville_id,
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
      const result = citys.filter((city) => city.ville_nom_reel.toLowerCase().replace('-', ' ').normalize('NFD').replace(/\p{Diacritic}/gu, '')
        .startsWith(starting));
      this.sugestedCityStartingPoint = result.slice(0, 20);
      return result;
    },
    allCityEndPointFiltred() {
      const citys = this.allCity;
      const end = this.end_point.toLowerCase().replace('-', ' ').normalize('NFD').replace(/\p{Diacritic}/gu, '');
      const result = citys.filter((city) => city.ville_nom_reel.toLowerCase().replace('-', ' ').normalize('NFD').replace(/\p{Diacritic}/gu, '')
        .startsWith(end));
      this.sugestedCityEndPoint = result.slice(0, 20);
      return result;
    },
  },
  mounted() {
    this.fetchAllVehiclesForUser();
    this.fetchAllCity();
    // Permet de ne pas aller sur la page si on est pas connecter
    if (!localStorage.tel) {
      this.$router.push({ path: '/' });
    }
  },
};
</script>
