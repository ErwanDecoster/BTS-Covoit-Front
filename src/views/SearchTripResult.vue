<template>
  <div id="login" class="h-full flex flex-col dark:text-white w-96 mx-auto">
    <div class="logo pt-6">
      <h1>
        <img class="mx-auto" src="@/assets/logos/covoit.svg" alt="">
      </h1>
    </div>
    <div class="grow flex flex-col justify-between gap-4 pb-20">
      <div v-show="Trips.length > 0">
        <h2 class="text-2xl font-bold m-6">Voyages disponibles</h2>
        <div class="flex flex-col gap-4">
          <div v-for="trip in Trips" v-bind:key="trip.startingTime">
            <JoinableTrip :trip="trip" :startingPoint="startingPoint" :houreOfTravel="houreOfTravel" />
          </div>
        </div>
        <div v-show="OtherTrips.length > 0 && Trips.length === 0">
          <p class="bg-red-500 p-2 rounded-lg text-white font-bold text-left">Aucun voyage n'existe pour cette date</p>
        </div>
      </div>
      <div v-show="OtherTrips.length > 0">
        <h2 class="text-2xl font-bold m-6">Voyage disponible pour des dates similaires</h2>
        <div class="flex flex-col gap-4">
          <div v-for="trip in OtherTrips" v-bind:key="trip.startingTime">
            <JoinableTrip :trip="trip" :startingPoint="startingPoint" :houreOfTravel="houreOfTravel" />
          </div>
        </div>
      </div>
      <div v-show="OtherTrips.length === 0 && Trips.length === 0">
        <p class="bg-red-500 p-2 rounded-lg text-white font-bold text-left">Nous sommes desolés aucun trajet ne correspond à votre recherche.</p>
      </div>
      <button @click="$router.go(-1)" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-white p-2 rounded-full text-neutral-900 font-bold dark:shadow-[0_-5px_15px_-8px_rgba(255,255,255,0.5)]">Retour</button>
    </div>
  </div>
  <navbar/>
</template>

<script>
import Navbar from '@/components/Navbar.vue';
import JoinableTrip from '@/components/JoinableTrip.vue';
import axios from 'axios';

export default {
  components: { Navbar, JoinableTrip },
  props: ['endpointCity', 'startingPoint', 'dateOfTravel', 'houreOfTravel'],
  data() {
    return {
      Trips: [],
      OtherTrips: [],
    };
  },
  methods: {
    fetchallTripForUser() {
      axios.post('http://localhost/actions.php', {
        action: 'fetchall_trip_for_endcity_up_to_date',
        endpointCity: this.endpointCity,
        dateOfTravel: this.dateOfTravel,
      }).then((response) => {
        if (response.data !== ' ') {
          this.Trips = response.data;
        }
      });
    },
    fetchallOtherTripForUser() {
      axios.post('http://localhost/actions.php', {
        action: 'fetchall_trip_for_endcity_aproximative_up_to_date',
        endpointCity: this.endpointCity,
        dateOfTravel: this.dateOfTravel,
      }).then((response) => {
        if (response.data !== ' ') {
          this.OtherTrips = response.data;
        }
      });
    },
  },
  mounted() {
    this.fetchallTripForUser();
    this.fetchallOtherTripForUser();
    // Permet de ne pas aller sur la page si on est pas connecter
    if (!localStorage.tel) {
      this.$router.push({ path: '/' });
    }
  },
};
</script>
