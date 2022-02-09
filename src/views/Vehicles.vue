<template>
  <div id="login" class="h-full flex flex-col">
    <div class="logo pt-6">
      <h1>
        <img class="mx-auto" src="@/assets/logos/covoit.svg" alt="">
      </h1>
    </div>
    <div class="grow flex flex-col justify-between gap-4 pb-20">
      <div>
        <h2 class="text-2xl font-bold m-6">Mes véhicules</h2>
        <div class="flex flex-col gap-4">
          <button class="bg-white p-2 rounded-full text-neutral-900 font-bold border border-neutral-900">Clio 2 - Rouge</button>
          <button class="bg-white p-2 rounded-full text-neutral-900 font-bold border border-neutral-900">Clio 2 - Bleu</button>
          <button class="bg-white p-2 rounded-full text-neutral-900 font-bold border border-neutral-900">Clio 2 - Verte</button>
        <router-link to="/CreateVehicle" class="w-full drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-neutral-800 p-2 rounded-full text-white font-bold">CreateVehicle</router-link>
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
};
</script>
