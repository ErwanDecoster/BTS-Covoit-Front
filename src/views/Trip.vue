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

export default {
  components: { Navbar, Trip },
  data() {
    return {
      Trips: [
        {
          startingTime: '12h00',
          startingPoint: 'Vienne',
          driver: 'Erwan',
          vehicle: 'Clio 2',
          vehicleColor: 'Rouge',
          img: 'erwan_profil_picture',
          stars: 4,
          paths: [
            {
              startingTime: '12h30',
              startingPoint: 'Lyon',
              people: 'Lyna',
            },
            {
              startingTime: '13h00',
              startingPoint: 'Marseille',
              people: 'Ludivine',
            },
          ],
          endPoint: 'Paris',
          endTime: '14h00',
        },
        {
          startingTime: '12h00',
          startingPoint: 'Vienne',
          driver: 'Erwan',
          vehicle: 'Clio 2',
          vehicleColor: 'Rouge',
          img: 'erwan_profil_picture',
          stars: 4,
          paths: [
            {
              startingTime: '12h30',
              startingPoint: 'Lyon',
              people: 'Lyna',
            },
          ],
          endPoint: 'Paris',
          endTime: '14h00',
        },
      ],
    };
  },
};
</script>
