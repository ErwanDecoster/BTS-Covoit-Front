<template>
  <div id="login" class="">
    <div class="logo ">
      <h1>
        <img class="mx-auto" src="@/assets/logos/covoit.svg" alt="">
      </h1>
      <form class="flex flex-col gap-4 ">
        <h2 class="text-2xl font-bold m-6">Rechercher un voyage</h2>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="date_of_travel">Date : </label>
          <input class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="date" name="date_of_travel" id="date_of_travel">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="starting_point">Depart : </label>
          <input class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="text" name="starting_point" id="starting_point">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="end_point">Arriver : </label>
          <input class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="text" name="end_point" id="end_point">
        </div>
        <button class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-neutral-800 p-2 rounded-full text-white font-bold">Se connecter</button>
        <button class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-white p-2 rounded-full text-neutral-900 font-bold">Inscription</button>
      </form>
    </div>
  </div>
</template>
