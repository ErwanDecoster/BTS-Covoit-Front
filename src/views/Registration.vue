<template>
  <div id="registration" class="h-full flex flex-col">
    <div class="logo pt-6">
      <h1>
        <img class="mx-auto" src="@/assets/logos/covoit.svg" alt="">
      </h1>
      <form @submit.stop.prevent="AddRegistration" class="flex flex-col gap-4">
        <h2 class="text-2xl font-bold m-6">Inscription</h2>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="name">Nom : </label>
          <input v-model="surname" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="text" name="nom" id="nom">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="name">Prenom : </label>
          <input v-model="name" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="text" name="prenom" id="prenom">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="email">Téléphone : </label>
          <input v-model="tel" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="text" name="tel" id="tel">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="new_password">Mot de passe : </label>
          <input v-model="password" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="password" name="new_password" id="new_password">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="new_retipe_password">Confirmation de mot de passe : </label>
          <input v-model="password_confirmed" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="password" name="new_retipe_password" id="new_retipe_password">
        </div>
        <button class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-neutral-800 p-2 rounded-full text-white font-bold">S'inscrire</button>
        <router-link to="/"  class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-white p-2 rounded-full text-neutral-900 font-bold">Connection</router-link>
      </form>
    </div>
  </div>
</template>
<script>
import axios from 'axios';

export default {
  name: 'Registration',
  data() {
    return {
      surname: '',
      name: '',
      tel: '',
      password: '',
      password_confirmed: '',
    };
  },
  methods: {
    async AddRegistration() {
      const response = await axios.post('http://localhost/actions.php', {
        action: 'new_registration',
        surname: this.surname,
        name: this.name,
        tel: this.tel,
        password: this.password,
        password_confirmed: this.password_confirmed,
      });

      console.log(response);
      this.$router.push({ path: '/' });
      /* .then((response) => {
          console.log(response);
          this.$router.push({ path: '/' });
        })
        .catch((error) => {
          console.log(error);
        }); */
    },
    /* AddRegistration() {
      this.fetchNewRegistration();
    },
    fetchNewRegistration() {
      axios.post('http://localhost/actions.php', {
        action: 'new_registration',
        surname: this.surname,
        name: this.name,
        tel: this.tel,
        password: this.password,
        password_confirmed: this.password_confirmed,
      }).then((response) => {
        console.log(response);
        this.$router.push({ path: '/' });
      });
    }, */
  },
};
</script>
