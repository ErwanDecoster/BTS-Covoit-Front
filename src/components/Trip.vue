<template>
  <div @click="extend = !extend" class="bg-white p-4 rounded-2xl drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] flex flex-col gap-4 duration-200">
    <div class="stop" :key="index" v-for="(Trips, index) in Trips">
      <div class="flex gap-6 items-center">
        <p class="w-14">{{ Trips.startingTime }}</p>
        <div class="h-4 w-4 bg-neutral-900 rounded-full relative">
          <div class="absolute left-1/2 -translate-x-1/2 block rounded-full content-none bg-neutral-900 h-4 w-1 top-5 "></div>
        </div>
        <p>{{ Trips.city }}</p>
      </div>
    </div>
    <div v-show="!extend" :key="index" v-for="(Trips, index) in Trips">
      <div class="flex gap-6 items-center">
        <p class="w-14"></p>
        <div class="h-4 w-1 mx-1.5 bg-neutral-900 rounded-full relative">
          <div class="absolute left-1/2 -translate-x-1/2 block rounded-full content-none bg-neutral-900 h-4 w-1 top-5"></div>
        </div>
        <p class="text-neutral-400 text-sm leading-6">{{ trip.paths.length }} etapes</p>
      </div>
    </div>
    <div v-show="extend" class="flex flex-col gap-4">
      <div v-for="path in trip.paths" v-bind:key="path.startingTime" class="stop">
        <div class="flex gap-6 items-center">
          <p class="w-14">{{ path.startingTime }}</p>
          <div class="h-4 w-4 bg-neutral-900 rounded-full relative">
            <div class="absolute left-1/2 -translate-x-1/2 block rounded-full content-none bg-neutral-900 h-4 w-1 top-5"></div>
          </div>
          <div class="flex gap-2 content-end">
            <p>{{ path.startingPoint }} - </p>
            <p class="text-neutral-500 text-sm leading-6">{{ path.people }}</p>
          </div>
        </div>
      </div>
    </div>
    <div class="stop">
      <div class="flex gap-6 items-center">
        <p class="w-14">{{ trip.endTime }}</p>
        <div class="h-4 w-4 bg-neutral-900 rounded-full"></div>
        <p>{{ trip.endPoint }}</p>
      </div>
    </div>
    <div class="flex item-center gap-4">
      <img class="h-14 w-14 bg-red-300 rounded-full" :src="trip.img" alt="">
      <div class="flex flex-col justify-center">
        <p>{{ trip.driver }}</p>
        <p>{{ trip.stars }}/5</p>
      </div>
      <div class="flex flex-col justify-center">
        <p>{{ trip.vehicle }}</p>
        <p>{{ trip.vehicleColor }}</p>
      </div>
    </div>
  </div>
</template>
<script>
import axios from 'axios';

export default ({
  props: ['trip'],
  data() {
    return {
      extend: false,
    };
  },
  methods: {
    fetchTrips() {
      axios.post('http://localhost/actions.php', {
        action: 'fetch_trips',
      }).then((response) => {
        this.Trips = response.data;
        console.log(response.data);
      });
    },
  },
  mounted() {
    this.fetchTrips();
  },
});
</script>
