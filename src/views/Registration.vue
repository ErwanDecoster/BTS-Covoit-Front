<template>
  <div id="registration" class="h-full flex flex-col dark:text-white w-96 mx-auto">
    <div class="logo pt-6">
      <h1>
        <img class="mx-auto" src="@/assets/logos/covoit.svg" alt="">
      </h1>
    </div>
      <form @submit.stop.prevent="AddRegistration" class="flex flex-col gap-4">
        <h2 class="text-2xl font-bold m-6">Inscription</h2>
        <p v-show="compteExistant === 'true' && visible === true" @click="visible = false" class="bg-red-500 p-2 rounded-lg text-white font-bold text-left">Vous avez déjà un compte</p>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="nom">Nom : </label>
          <input v-model="surname" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg dark:text-[#000000]" type="text" name="family-name" id="nom" autocomplete="family-name">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="prenom">Prénom : </label>
          <input v-model="name" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg dark:text-[#000000]" type="text" name="given-name" id="prenom" autocomplete="given-name">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="tel">Téléphone : </label>
          <input v-model="tel" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg dark:text-[#000000]" type="text" name="tel" id="tel" autocomplete="tel">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="new_password">Mot de passe : </label>
          <input v-model="password" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg dark:text-[#000000]" type="password" name="new_password" id="new_password" autocomplete="new-password">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="new_retipe_password">Confirmation de mot de passe : </label>
          <input v-model="password_confirmed" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg dark:text-[#000000]" type="password" name="new_retipe_password" id="new_retipe_password" autocomplete="new-password">
        </div>
        <button @click="persist" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-neutral-800 p-2 rounded-full text-white font-bold dark:shadow-[0_-5px_15px_-8px_rgba(255,255,255,0.5)] mt-5">S'inscrire</button>
        <router-link to="/"  class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-white p-2 rounded-full text-neutral-900 font-bold dark:shadow-[0_-5px_15px_-8px_rgba(255,255,255,0.5)]">Connection</router-link>
      </form>
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
      compteExistant: '',
      visible: true,
    };
  },
  methods: {
    persist() {
      localStorage.surname = this.surname;
      localStorage.name = this.name;
      localStorage.tel = this.tel;
      localStorage.password = this.password;
      localStorage.password_confirmed = this.password_confirmed;
    },
    AddRegistration() {
      this.addNewRegistration();
    },
    addNewRegistration() {
      axios.post('http://localhost/actions.php', {
        action: 'new_registration',
        surname: this.surname,
        name: this.name,
        tel: this.tel,
        password: this.password,
        password_confirmed: this.password_confirmed,
      }).then((response) => {
        if (response.data === 'Vous avez déjà un compte') {
          this.compteExistant = 'true';
        } else {
          console.log(response);
          this.$router.push({ path: '/' });
        }
      });
    },
  },
};
</script>
