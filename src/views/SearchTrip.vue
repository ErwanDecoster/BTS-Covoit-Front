<template>
  <div id="login" class="">
    <div class="logo pt-6">
      <h1>
        <img class="mx-auto" src="@/assets/logos/covoit.svg" alt="">
      </h1>
    </div>
      <form class="flex flex-col gap-4 ">
        <h2 class="text-2xl font-bold m-6">Rechercher un voyage</h2>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="date_of_travel">Date : </label>
          <input class="w-full drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="date" name="date_of_travel" id="date_of_travel">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="houre_of_travel">Heure de départ : </label>
          <input class="w-full drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="time" name="houre_of_travel" id="houre_of_travel">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="starting_point">Depart : </label>
          <select v-model="city" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" name="end_point" id="end_point">
             <option v-for="city in allCity" v-bind:key="city" :value="city.id_city">{{ city.city }}</option>
          </select>
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="end_point">Arriver : </label>
          <select v-model="city" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" name="end_point" id="end_point">
             <option v-for="city in allCity" v-bind:key="city" :value="city.id_city">{{ city.city }}</option>
          </select>
        </div>
        <button class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-neutral-800 p-2 rounded-full text-white font-bold">Rechercher</button>
      </form>
  </div>
  <navbar/>
</template>
<script>
import Navbar from '@/components/Navbar.vue';
import axios from 'axios';

export default {
  components: { Navbar },
  props: ['user'],
  async create() {
    const response = await axios.get('user', {
      headers: {
        autorization: `test ${localStorage.getItem('token')}`,
      },
    });

    console.log(response);
  },
  data() {
    return {
      allCity: '',
    };
  },
  methods: {
    fetchAllCity() {
      axios.post('http://localhost/actions.php', {
        action: 'fetchall_city',
      }).then((response) => {
        this.allCity = response.data;
        console.log(response.data);
      });
    },
  },
  mounted() {
    this.fetchAllCity();
    if (!localStorage.tel) {
      this.$router.push({ path: '/' });
    }
  },
};
</script>
