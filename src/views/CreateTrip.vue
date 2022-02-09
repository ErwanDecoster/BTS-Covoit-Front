<template>
  <div id="createTrip" class="">
    <div class="logo pt-6">
      <h1>
        <img class="mx-auto" src="@/assets/logos/covoit.svg" alt="">
      </h1>
      <form class="flex flex-col gap-4 ">
        <h2 class="text-2xl font-bold m-6">Créer un intinéraire :</h2>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="date_of_travel">Date de départ : </label>
          <input class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="date" name="date_of_travel" id="date_of_travel">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="houre_of_travel">Heure de départ : </label>
          <input class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="time" name="houre_of_travel" id="houre_of_travel">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="starting_point">Point de départ : </label>
          <input class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="text" name="starting_point" id="starting_point">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="end_point">Point d'arriver : </label>
          <input class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="text" name="end_point" id="end_point">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="vehicle">Vehicule : </label>
          <input class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="text" name="vehicle" id="vehicle">
        </div>
        <button class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-neutral-800 p-2 rounded-full text-white font-bold">Créer</button>
      </form>
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
