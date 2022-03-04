<template>
  <div id="login" class="">
    <div class="logo pt-6">
      <h1>
        <img class="mx-auto" src="@/assets/logos/covoit.svg" alt="">
      </h1>
      <form @submit="AddLogin" class="flex flex-col gap-4" action="actions.php" method="get">
        <h2 class="text-2xl font-bold m-6">Connection</h2>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="telephone">Telephone : </label>
          <input v-model="tel" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="tel" name="telephone" id="tel">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="pass">Mot de passe : </label>
          <input v-model="password" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="password" name="pass" id="password">
        </div>
        <button class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-neutral-800 p-2 rounded-full text-white font-bold">Se connecter</button>
        <router-link to="/registration" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-white p-2 rounded-full text-neutral-900 font-bold">Inscription</router-link>
      </form>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      tel: '',
      password: '',
    };
  },
  methods: {
    AddLogin() {
      this.fetchNewLogin();
    },
    fetchNewLogin() {
      if (this.tel !== '' && this.password !== '') {
        axios.post('http://localhost/actions.php', {
          action: 'fetch_login',
          tel: this.tel,
          password: this.password,
        }).then((response) => {
          console.log(response);
          this.$router.push({ path: '/searchtrip' });
        });
      } else {
        console.log('Username or password is empty');
      }
    },
  },
  mounted() {
    this.fetchNewLogin();
  },
};
</script>
