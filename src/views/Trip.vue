<template>
  <div id="login" class="h-full flex flex-col">
    <div class="logo pt-6">
      <h1>
        <img class="mx-auto" src="@/assets/logos/covoit.svg" alt="">
      </h1>
    </div>
    <div class="grow flex flex-col justify-between gap-4 pb-20">
      <div>
        <h2 class="text-2xl font-bold m-6">Vos voyages</h2>
        <div class="flex flex-col gap-4">
          <div v-for="trip in Trips" v-bind:key="trip.startingTime">
            <Trip :trip="trip" />
          </div>
        </div>
      </div>
      <button @click="$router.go(-1)" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-white p-2 rounded-full text-neutral-900 font-bold">Retour</button>
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
    };
  },
  methods: {
    fetchallTripForUser() {
      axios.post('http://localhost/actions.php', {
        action: 'fetchall_trip_for_user',
        tel: '0625306813',
      }).then((response) => {
        if (response.data !== ' ') {
          this.Trips = response.data;
        }
      });
    },
    formatNum(num) {
      let number = num;
      if (num.length < 10) {
        number = `0${num}`;
      }
      return number.replace(/(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})/, '$1 $2 $3 $4 $5');
    },
  },
  mounted() {
    this.fetchallTripForUser();
    // console.log(this.formatNum('0625306813'));
    // console.log(this.formatNum('725306813'));
  },
};
</script>
