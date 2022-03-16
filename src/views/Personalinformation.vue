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
          <p class="grow text-1xl text-left">{{ PersonalInformation.l_name }}</p>
          <button>
            <img src="@/assets/logos/Pen.svg" class="w-8 h-8 mx-1" />
          </button>
          <span class="bg-gray-900 h-0.5 w-full absolute bottom-0 rounded-full"></span>
        </div>
        <div class="flex relative">
          <p class="grow text-1xl text-left">{{ PersonalInformation.f_name }}</p>
          <button>
            <img src="@/assets/logos/Pen.svg" class="w-8 h-8 mx-1" />
          </button>
          <span class="bg-gray-900 h-0.5 w-full absolute bottom-0 rounded-full"></span>
        </div>
        <div class="flex relative">
          <p class="grow text-1xl text-left">{{ formatNum(PersonalInformation.tel) }}</p>
          <button>
            <img src="@/assets/logos/Pen.svg" class="w-8 h-8 mx-1" />
          </button>
          <span class="bg-gray-900 h-0.5 w-full absolute bottom-0 rounded-full"></span>
        </div>
        <router-link to="/EditPassword" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-white p-2 rounded-full text-neutral-900 font-bold">Changer de mot de passe</router-link>
      </form>
      <div class="grid gap-4">
        <button class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-neutral-800 p-2 rounded-full text-white font-bold">Sauvegarder</button>
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
    };
  },
  methods: {
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
    formatNum(num) {
      let number = num;
      if (num.length < 10) {
        number = `0${num}`;
      }
      return number.replace(/(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})/, '$1 $2 $3 $4 $5');
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
