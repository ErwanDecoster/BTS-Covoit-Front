<template>
  <div id="" class="h-full flex flex-col dark:text-white w-96 mx-auto">
    <div class="logo pt-6">
      <h1>
        <img class="mx-auto" src="@/assets/logos/covoit.svg" alt="">
      </h1>
    </div>
    <div class="grow flex flex-col justify-between gap-4 pb-20">
      <div>
        <h2 class="text-2xl font-bold m-6">Mon compte</h2>
        <div class="flex flex-col gap-4">
          <router-link to="/Personalinformation" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-neutral-800 p-2 rounded-full text-white font-bold dark:shadow-[0_-5px_15px_-8px_rgba(255,255,255,0.5)]">Informations personnelles</router-link>
          <router-link to="/Vehicles" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-neutral-800 p-2 rounded-full text-white font-bold dark:shadow-[0_-5px_15px_-8px_rgba(255,255,255,0.5)]">Mes vehicules</router-link>
          <router-link to="/TripHistory" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-neutral-800 p-2 rounded-full text-white font-bold dark:shadow-[0_-5px_15px_-8px_rgba(255,255,255,0.5)]">Historique des voyages</router-link>
        </div>
      </div>
      <button @click="logout" class="w-full drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-neutral-800 p-2 rounded-full text-white font-bold dark:shadow-[0_-5px_15px_-8px_rgba(255,255,255,0.5)]">Me déconnecter</button>
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
    };
  },
  methods: {
    logout() {
      localStorage.clear();
      this.$router.push({ path: '/' });
    },
  },
  mounted() {
    if (!localStorage.tel) {
      this.$router.push({ path: '/' });
    }
  },
};
</script>
