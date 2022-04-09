<template>
  <div id="login" class="h-full flex flex-col">
    <div class="logo pt-6">
      <h1>
        <img class="mx-auto" src="@/assets/logos/covoit.svg" alt="">
      </h1>
    </div>
    <div class="grow flex flex-col justify-between gap-4 pb-20">
      <div>
        <h2 class="text-2xl font-bold m-6 dark:text-white">Vos voyages en cours</h2>
        <div class="flex flex-col gap-4">
          <div class="flex flex-col gap-4 dark:shadow-[0_-5px_15px_-8px_rgba(255,255,255,0.5)]">
            <div v-for="trip in Trips" v-bind:key="trip.startingTime">
              <Trip :trip="trip" />
            </div>
          </div>
          <div class="flex flex-col gap-4">
            <div v-for="trip in TripsPassenger" v-bind:key="trip.startingTime">
              <Trip :trip="trip" />
            </div>
          </div>
        </div>
      </div>
      <!-- <button @click="$router.go(-1)" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-white p-2 rounded-full text-neutral-900 font-bold">Retour</button> -->
    </div>
  </div>
  <navbar/>
</template>

<script>
import Navbar from '@/components/Navbar.vue';
import Trip from '@/components/Trip.vue';
import axios from 'axios';

export default {
  components: { Navbar, Trip },
  data() {
    return {
      Trips: [],
      TripsPassenger: [],
    };
  },
  methods: {
    fetchallTripForUser() {
      axios.post('http://localhost/actions.php', {
        action: 'fetchall_trip_for_user_up_to_date',
        tel: localStorage.tel,
      }).then((response) => {
        if (response.data !== ' ') {
          this.Trips = response.data;
        }
      });
    },
    fetchallTripForUserPassenger() {
      axios.post('http://localhost/actions.php', {
        action: 'fetchall_trip_for_user_passenger_up_to_date',
        tel: localStorage.tel,
      }).then((response) => {
        if (response.data !== ' ') {
          this.TripsPassenger = response.data;
        }
      });
    },
  },
  mounted() {
    this.fetchallTripForUser();
    this.fetchallTripForUserPassenger();
    // console.log(this.formatNum('0625306813'));
    // console.log(this.formatNum('725306813'));
    if (!localStorage.tel) {
      this.$router.push({ path: '/' });
    }
  },
};
</script>
