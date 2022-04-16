<template>
  <div id="login" class=" dark:text-white w-96 mx-auto">
    <div class="logo pt-6">
      <h1>
        <img class="mx-auto" src="@/assets/logos/covoit.svg" alt="">
      </h1>
      <form class="flex flex-col gap-4 ">
        <h2 class="text-2xl font-bold m-6">Rechercher un voyage</h2>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="date_of_travel">Date : </label>
          <input v-model="date_of_travel" class="w-full drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg dark:text-[#000000]" type="date" name="date_of_travel" id="date_of_travel">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="houre_of_travel">Heure de départ : </label>
          <input v-model="houre_of_travel" class="w-full drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg dark:text-[#000000]" type="time" name="houre_of_travel" id="houre_of_travel">
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
        <router-link class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-neutral-800 p-2 rounded-full text-white font-bold dark:shadow-[0_-5px_15px_-8px_rgba(255,255,255,0.5)] mt-5" :to="{ name: 'SearchTripResult', params: { endpointCity: this.end_point, startingPoint: this.starting_point, dateOfTravel: this.date_of_travel, houreOfTravel: this.houre_of_travel}}">Rechercher</router-link>
      </form>
    </div>
  </div>
  <navbar/>
</template>
<script>
import Navbar from '@/components/Navbar.vue';
import axios from 'axios';

export default {
  name: 'App',
  components: { Navbar },
  data() {
    return {
      date_of_travel: '',
      houre_of_travel: '',
      starting_point: '',
      end_point: '',
      sugestedCityStartingPoint: '',
      sugestedCityEndPoint: '',
    };
  },
  methods: {
    fetchAllCity() {
      axios.post('http://localhost/actions.php', {
        action: 'fetchall_city',
      }).then((response) => {
        if (response.data !== ' ') {
          this.allCity = response.data;
        }
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
    this.fetchAllCity();
    // Permet de ne pas aller sur la page si on est pas connecter
    if (!localStorage.tel) {
      this.$router.push({ path: '/' });
    }
  },
};
</script>
