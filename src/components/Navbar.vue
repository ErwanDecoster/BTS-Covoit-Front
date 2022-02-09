<template>
  <div class="bg-white fixed inset-x-0 shadow-[0_-5px_15px_-8px_rgba(0,0,0,0.5)] rounded-2xl flex justify-evenly py-3 fixed bottom-0">
    <router-link to="/SearchTrip" class="block">
      <img src="@/assets/logos/search.svg" alt="">
    </router-link>
    <router-link to="/Trip">
      <img src="@/assets/logos/car.svg" alt="">
    </router-link>
    <router-link to="/CreateTrip">
      <img src="@/assets/logos/carplus.svg" alt="">
    </router-link>
    <router-link to="/ProfilSetting">
      <img src="@/assets/logos/people.svg" alt="">
    </router-link>
  </div>
</template>
