<template>
  <div id="login" class="h-full flex flex-col">
    <div class="logo pt-6">
      <h1>
        <img class="mx-auto" src="@/assets/logos/covoit.svg" alt="">
      </h1>
    </div>
      <form @submit.stop.prevent="AddLogin" class="flex flex-col gap-4">
        <h2 class="text-2xl font-bold m-6">Connection</h2>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="telephone">Téléphone : </label>
          <input v-model="tel" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="tel" name="telephone" id="tel">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="pass">Mot de passe : </label>
          <input v-model="password" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="password" name="pass" id="password">
        </div>
        <button @click="Locale_Storage" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-neutral-800 p-2 rounded-full text-white font-bold">Se connecter</button>
        <router-link to="/registration" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-white p-2 rounded-full text-neutral-900 font-bold">Inscription</router-link>
      </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Login',
  data() {
    return {
      tel: '',
      password: '',
    };
  },
  methods: {
    Locale_Storage() {
      localStorage.surname = this.surname;
      localStorage.name = this.name;
      localStorage.tel = this.tel;
      localStorage.password = this.password;
      localStorage.password_confirmed = this.password_confirmed;
    },
    AddLogin() {
      this.VerifNewLogin();
    },
    VerifNewLogin() {
      if (this.tel !== '' && this.password !== '') {
        axios.post('http://localhost/actions.php', {
          action: 'verif_login',
          tel: this.tel,
          password: this.password,
        }).then((response) => {
          console.log(response);
          if (response.data === 'OK') {
            this.$router.push({ path: '/searchtrip' });
          } else {
            console.log('ERROR');
          }
        });
      } else {
        console.log('Les champs sont vide');
      }
    },
  },
};
</script>
