<template>
  <div id="" class="h-full flex flex-col">
    <div class="logo pt-6">
      <h1>
        <img class="mx-auto" src="@/assets/logos/covoit.svg" alt="">
      </h1>
    </div>
    <div class="grow flex flex-col justify-between gap-4 pb-20">
      <div>
        <h2 class="text-2xl font-bold m-6 text-left dark:text-white">Hello {{ PersonalInformation.f_name }} !👋</h2>
        <p class="text-2xl font-bold text-left bg-[#A9DE8E] my-9 rounded-2xl p-4 ">Grâce à Covoit, économisez en partageant vos trajets.</p>
        <div class="flex flex-col gap-4">
          <router-link to="/searchtrip" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-neutral-800 p-2.5 rounded-full text-white font-bold text-lg dark:shadow-[0_-5px_15px_-8px_rgba(255,255,255,0.5)]">Recherche un voyage</router-link>
          <router-link to="/CreateTrip" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-neutral-800 p-2.5 rounded-full text-white font-bold text-lg dark:shadow-[0_-5px_15px_-8px_rgba(255,255,255,0.5)]">Créer un voyage</router-link>
          <router-link to="/trip" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-neutral-800 p-2.5 rounded-full text-white font-bold text-lg dark:shadow-[0_-5px_15px_-8px_rgba(255,255,255,0.5)]">Vos voyages</router-link>
        </div>
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
    fetchUserName() {
      axios.post('http://localhost/actions.php', {
        action: 'fetch_home_name',
        userTel: localStorage.tel,
      }).then((response) => {
        this.PersonalInformation = response.data;
        console.log(this.PersonalInformation);
      });
    },
  },
  mounted() {
    this.fetchUserName();
    if (!localStorage.tel) {
      this.$router.push({ path: '/' });
    }
  },
};
</script>
