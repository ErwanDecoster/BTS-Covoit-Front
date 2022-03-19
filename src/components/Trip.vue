<template>
  <div @click="extend = !extend" class="bg-white p-6 rounded-2xl drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] flex flex-col gap-4 duration-200">
    {{ trip.id_trip }}
    <p class="font-bold text-left text-lg">{{ formatDate(trip.starting_date) }}</p>
    <div class="stop">
      <div class="flex gap-6 items-center h-6">
        <p class="w-12 text-left">{{ formatTime(trip.departure_time) }}</p>
        <div class="h-4 w-4 bg-[#30A4A8] rounded-full relative">
          <div class="absolute left-1/2 -translate-x-1/2 block rounded-full content-none bg-[#30A4A8] h-4 w-1 top-5 "></div>
        </div>
        <p class="text-left font-bold">{{ trip.starting_point_city }}</p>
      </div>
    </div>
    <div v-show="!extend && trip.paths" >
      <div class="flex gap-6 items-center">
        <p class="w-12"></p>
        <div class="h-4 w-1 mx-1.5 bg-[#30A4A8] rounded-full relative">
          <div class="absolute left-1/2 -translate-x-1/2 block rounded-full content-none bg-[#30A4A8] h-4 w-1 top-5"></div>
        </div>
        <p :disabled="trip.paths" class="text-neutral-400 text-sm leading-6">{{ countArray(trip.paths) }} etapes</p>
      </div>
    </div>
    <div v-show="extend && trip.paths" class="flex flex-col gap-4">
      <div v-for="path in trip.paths" v-bind:key="path.departure_time" class="stop h-6">
        <div class="flex gap-6 items-center">
          <p class="w-12 text-left">{{ formatTime(path.departure_time) }}</p>
          <div class="h-4 w-4 bg-[#30A4A8] rounded-full relative">
            <div class="absolute left-1/2 -translate-x-1/2 block rounded-full content-none bg-[#30A4A8] h-4 w-1 top-5"></div>
          </div>
          <div class="flex gap-2 flex-col content-end relative w-[50%]">
            <div class="absolute -top-6 left-0 w-full">
              <p class="text-left font-bold w-full">{{ path.ville_nom_reel }}</p>
              <p class="text-left text-neutral-500 text-sm leading-6">{{ path.f_name }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="stop">
      <div class="flex gap-6 items-center h-6">
        <p class="w-12">{{ trip.endTime }}</p>
        <div class="h-4 w-4 bg-[#30A4A8] rounded-full"></div>
        <p class="font-bold">{{ trip.end_point_city }}</p>
      </div>
    </div>
    <span class="w-full bg-[#30A4A8] h-[2px] opacity-20"></span>
    <div class="flex item-center gap-4">
      <div class="h-14 w-14 bg-[#30A4A8] rounded-full flex flex-col justify-center">
        <p class="w-fit mx-auto text-xl text-neutral-800 tracking-widest">{{ returnFirstLetter(trip.f_name) }}{{ returnFirstLetter(trip.l_name) }}</p>
      </div>
      <div class="flex flex-col justify-center">
        <p>{{ trip.f_name }}</p>
        <p>{{ trip.stars }}/5</p>
      </div>
      <div class="flex flex-col justify-center">
        <p>{{ trip.vehicle_name }}</p>
        <p>{{ trip.color }}</p>
      </div>
    </div>
  </div>
</template>
<script>
// import axios from 'axios';

export default ({
  props: ['trip'],
  data() {
    return {
      extend: false,
    };
  },
  methods: {
    countArray(array) {
      if (array) {
        return array.length;
      }
      return false;
    },
    returnFirstLetter(string) {
      return string[0];
    },
    formatTime(str) {
      return str.substring(0, str.length - 3).replace(':', 'h');
    },
    formatDate(dateString) {
      const date = new Date(dateString);
      const days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
      const months = ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Decembre'];
      const dayName = days[date.getDay()];
      const dateNumber = date.getDate();
      const mouthName = months[date.getMonth()];
      return `${dayName} ${dateNumber} ${mouthName}`;
    },
    // fetchTrips() {
    //   axios.post('http://localhost/actions.php', {
    //     action: 'fetch_trips',
    //   }).then((response) => {
    //     this.Trips = response.data;
    //     console.log(response.data);
    //   });
    // },
  },
  mounted() {
    // this.fetchTrips();
  },
});
</script>
