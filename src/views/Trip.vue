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
          <div @click="trip.paths.visible = !trip.paths.visible" v-for="trip in Trips" v-bind:key="trip.startingTime" class="bg-white p-4 rounded-2xl drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] flex flex-col gap-4 duration-200">
            <ul class="stop">
              <li class="flex gap-6 items-center">
                <p class="w-14">{{ trip.startingTime }}</p>
                <div class="h-4 w-4 bg-neutral-900 rounded-full relative">
                  <div class="absolute left-1/2 -translate-x-1/2 block content-none bg-neutral-900 h-4 w-1 top-5 "></div>
                </div>
                <p>{{ trip.startingPoint }}</p>
              </li>
            </ul>
            <div v-show="trip.paths.visible" class="flex flex-col gap-4">
              <ul v-for="path in trip.paths" v-bind:key="path.startingTime" class="stop">
                <li class="flex gap-6 items-center">
                  <p class="w-14">{{ path.startingTime }}</p>
                  <div class="h-4 w-4 bg-neutral-900 rounded-full relative">
                    <div class="absolute left-1/2 -translate-x-1/2 block content-none bg-neutral-900 h-4 w-1 top-5"></div>
                  </div>
                  <div class="flex gap-2 content-end">
                    <p>{{ path.startingPoint }} - </p>
                    <p class="text-neutral-500 text-sm leading-6">{{ path.people }}</p>
                  </div>
                </li>
              </ul>
            </div>
            <ul class="stop">
              <li class="flex gap-6 items-center">
                <p class="w-14">{{ trip.endTime }}</p>
                <div class="h-4 w-4 bg-neutral-900 rounded-full"></div>
                <p>{{ trip.endPoint }}</p>
              </li>
            </ul>
            <div class="flex item-center gap-4">
              <img class="h-14 w-14 bg-red-300 rounded-full" :src="trip.img" alt="">
              <div class="flex flex-col justify-center">
                <p>{{ trip.driver }}</p>
                <p>{{ trip.stars }}/5</p>
              </div>
            </div>
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

export default {
  components: { Navbar },
  data() {
    return {
      Trips: [
        {
          startingTime: '12h00',
          startingPoint: 'Vienne',
          driver: 'Erwan',
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
          paths: [
            {
              startingTime: '12h30',
              startingPoint: 'Lyon',
            },
            {
              startingTime: '13h00',
              startingPoint: 'Marseille',
            },
          ],
          endPoint: 'Paris',
          endTime: '14h00',
        },
        {
          startingTime: '12h00',
          startingPoint: 'Vienne',
          paths: [
            {
              startingTime: '12h30',
              startingPoint: 'Lyon',
            },
            {
              startingTime: '13h00',
              startingPoint: 'Marseille',
            },
          ],
          endPoint: 'Paris',
          endTime: '14h00',
        },
        {
          startingTime: '12h00',
          startingPoint: 'Vienne',
          paths: [
            {
              startingTime: '12h30',
              startingPoint: 'Lyon',
            },
            {
              startingTime: '13h00',
              startingPoint: 'Marseille',
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
