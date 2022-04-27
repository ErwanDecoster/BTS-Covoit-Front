<template>
  <div id="" class="h-full flex flex-col dark:text-white w-96 mx-auto max-w-sm">
    <div class="logo pt-6">
      <h1>
        <img class="mx-auto" src="@/assets/logos/covoit.svg" alt="">
      </h1>
    </div>
    <div class="grow flex flex-col justify-between gap-4 pb-20">
      <form class="flex flex-col gap-4 ">
        <h2 class="text-2xl font-bold m-6">Informations personnelles :</h2>
        <!-- Affichage des messages d'erreurs -->
        <p v-show="modifOk === 'true' && visible === true" @click="visible = false" class="bg-emerald-500 p-2 rounded-lg text-white font-bold text-left">Vos informations personnelles ont été changer avec succès !</p>
        <p v-show="passOk === 'true' && visible2 === true" @click="visible2 = false" class="bg-emerald-500 p-2 rounded-lg text-white font-bold text-left">Votre mot de passe a été supprimer avec succès !</p>
        <!-- Affichage des informations personnelles comme le nom, prénom, téléphone -->
        <div class="h-14 w-14 bg-[#30A4A8] rounded-full flex flex-col justify-center mx-auto">
          <p class="w-fit mx-auto text-xl text-neutral-800 tracking-widest dark:text-white">{{ PersonalInformation.f_name }}{{  }}</p>
        </div>
        <div class="flex relative">
          <p class="grow text-1xl text-left">{{ PersonalInformation.l_name }}</p>
          <span class="bg-gray-900 h-0.5 w-full absolute bottom-0 rounded-full dark:bg-white"></span>
        </div>
        <div class="flex relative">
          <p class="grow text-1xl text-left">{{ PersonalInformation.f_name }}</p>
          <span class="bg-gray-900 h-0.5 w-full absolute bottom-0 rounded-full dark:bg-white"></span>
        </div>
        <div class="flex relative">
          <p class="grow text-1xl text-left">{{ PersonalInformation.tel }}</p>
          <span class="bg-gray-900 h-0.5 w-full absolute bottom-0 rounded-full dark:bg-white"></span>
        </div>
        <router-link to="/EditPersonalInformation" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-white p-2 rounded-full text-neutral-900 font-bold dark:shadow-[0_-5px_15px_-8px_rgba(255,255,255,0.5)] mt-5">Changer mes informations personnelles</router-link>
        <router-link to="/EditPassword" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-white p-2 rounded-full text-neutral-900 font-bold dark:shadow-[0_-5px_15px_-8px_rgba(255,255,255,0.5)]">Changer de mot de passe</router-link>
      </form>
      <div class="grid gap-4">
        <router-link to="/deleteAccount" class=" bg-red-500 drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] p-2 rounded-full text-white font-bold dark:shadow-[0_-5px_15px_-8px_rgba(255,0,0,0.5)]">Supprimer mon compte</router-link>
        <button @click="$router.go(-1)" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-white p-2 rounded-full text-neutral-900 font-bold dark:shadow-[0_-5px_15px_-8px_rgba(255,255,255,0.5)]">Retour</button>
      </div>
    </div>
  </div>
  <navbar/>
</template>
<script>
import Navbar from '@/components/Navbar.vue';
import axios from 'axios';

export default {
  props: ['modifOk', 'passOk'],
  components: { Navbar },
  data() {
    return {
      PersonalInformation: '',
      realDelCompte: '',
      visible: true,
      visible2: true,
    };
  },
  methods: {
    deleteAccount() {
      this.realDelCompte = !this.realDelCompte;
    },
    // Envoie à l'API des informations pour l'affichage des informations
    fetchPersonalInformation() {
      axios.post('http://localhost/actions.php', {
        action: 'fetch_personal_information',
        userTel: localStorage.tel,
        userName: localStorage.name,
        userSurname: localStorage.surname,
      }).then((response) => {
        this.PersonalInformation = response.data;
      });
    },
  },
  mounted() {
    this.fetchPersonalInformation();
    // Permet de ne pas aller sur la page si on est pas connecter
    if (!localStorage.tel) {
      this.$router.push({ path: '/' });
    }
  },
};
</script>
