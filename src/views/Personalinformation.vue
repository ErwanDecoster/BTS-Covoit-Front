<template>
  <div id="" class="h-full flex flex-col">
    <div class="logo pt-6">
      <h1>
        <img class="mx-auto" src="@/assets/logos/covoit.svg" alt="">
      </h1>
    </div>
    <div class="grow flex flex-col justify-between gap-4 pb-20">
      <form class="flex flex-col gap-4 ">
        <h2 class="text-2xl font-bold m-6">Informations personnelles :</h2>
        <div class="rounded-full bg-indigo-500 h-20 w-20 mx-auto my-5"><img class="mx-auto h-20 w-20 mx-auto" src="@/assets/logos/people.svg" alt=""></div>
        <div class="flex relative">
          <p class="grow text-1xl text-center">{{ PersonalInformation.l_name }}</p>
          <!-- <button>
            <img src="@/assets/logos/Pen.svg" class="w-8 h-8 mx-1" />
          </button> -->
          <span class="bg-gray-900 h-0.5 w-full absolute bottom-0 rounded-full"></span>
        </div>
        <div class="flex relative">
          <p class="grow text-1xl text-center">{{ PersonalInformation.f_name }}</p>
          <!-- <button>
            <img src="@/assets/logos/Pen.svg" class="w-8 h-8 mx-1" />
          </button> -->
          <span class="bg-gray-900 h-0.5 w-full absolute bottom-0 rounded-full"></span>
        </div>
        <div class="flex relative">
          <p class="grow text-1xl text-center">{{ PersonalInformation.tel }}</p>
          <!-- <button>
            <img src="@/assets/logos/Pen.svg" class="w-8 h-8 mx-1" />
          </button> -->
          <span class="bg-gray-900 h-0.5 w-full absolute bottom-0 rounded-full"></span>
        </div>
        <router-link to="/EditPersonalInformation" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-white p-2 rounded-full text-neutral-900 font-bold">Changer mes informations personnelles</router-link>
        <router-link to="/EditPassword" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-white p-2 rounded-full text-neutral-900 font-bold">Changer de mot de passe</router-link>
      </form>
      <!-- <p v-show="realDelCompte" class="bg-red-500 p-2 rounded-lg text-white font-bold text-center">Voulez-vous vraiment supprimer votre compte ?</p><br>
      <p v-show="realDelCompte" class="bg-red-500 w-20 mx-auto p-2 rounded-lg text-white font-bold text-center"><router-link @click="delConfirm" to="/Registration">Oui</router-link></p>
      <p v-show="realDelCompte" class="bg-red-500 w-20 mx-auto p-2 rounded-lg text-white font-bold text-center"><router-link to="/PersonalInformation">Non</router-link></p> -->
      <div class="grid gap-4">
        <router-link to="/deleteAccount" class=" bg-red-500 drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] p-2 rounded-full text-white font-bold">Supprimer mon compte</router-link>
        <button @click="$router.go(-1)" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-white p-2 rounded-full text-neutral-900 font-bold">Retour</button>
      </div>
    </div>
  </div>
  <navbar/>
</template>
<script>
import Navbar from '@/components/Navbar.vue';
import axios from 'axios';

export default {
  components: { Navbar },
  data() {
    return {
      PersonalInformation: '',
      realDelCompte: '',
    };
  },
  methods: {
    deleteAccount() {
      this.realDelCompte = !this.realDelCompte;
    },
    fetchPersonalInformation() {
      axios.post('http://localhost/actions.php', {
        action: 'fetch_personal_information',
        userTel: localStorage.tel,
        userName: localStorage.name,
        userSurname: localStorage.surname,
      }).then((response) => {
        this.PersonalInformation = response.data;
        console.log(this.PersonalInformation);
      });
    },
  },
  mounted() {
    this.fetchPersonalInformation();
    if (!localStorage.tel) {
      this.$router.push({ path: '/' });
    }
  },
};
</script>
