<template>
  <div id="edit_password" class="flex flex-col h-full dark:text-white w-96 mx-auto max-w-sm">
    <div class="logo pt-6">
      <h1>
        <img class="mx-auto" src="@/assets/logos/covoit.svg" alt="">
      </h1>
    </div>
    <div class="grow flex flex-col justify-between gap-4 pb-20">
      <!-- Formulaire pour renseigner les nouveaux champs a enregistrer -->
      <form class="flex flex-col gap-4" @submit.stop.prevent="NewPassword">
        <h2 class="text-2xl font-bold my-6">Modification du mot de passe :</h2>
        <!-- Message d'erreur s'il y a eut un problème lors du changement -->
        <p v-show="passIncorrect === 'true' && visible === true" @click="visible = false" class="bg-red-500 p-2 rounded-lg text-white font-bold text-left">L'identifiant ou le mot de passe est incorrecte</p>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="actual_password">Mot de passe actuel : </label>
          <input v-model="old_password" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg dark:text-[#000000]" type="password" name="actual_password" id="actual_password">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="actual_password">Téléphone : </label>
          <input v-model="tel" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg dark:text-[#000000]" type="tel" name="actual_tel" id="actual_tel">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="name">Nouveau mot de passe : </label>
          <input v-model="new_password" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg dark:text-[#000000]" type="password" name="new_password" id="new_password">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="name">Confirmation du nouveau mot de passe : </label>
          <input v-model="new_password_confirmed" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg dark:text-[#000000]" type="password" name="new_password_confirmed" id="new_password_confirmed">
        </div>
        <div class="grid gap-4">
          <button class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-neutral-800 p-2 rounded-full text-white font-bold dark:shadow-[0_-5px_15px_-8px_rgba(255,255,255,0.5)] mt-5">Sauvegarder</button>
          <button @click="$router.go(-1)" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-white p-2 rounded-full text-neutral-900 font-bold dark:shadow-[0_-5px_15px_-8px_rgba(255,255,255,0.5)]">Retour</button>
        </div>
      </form>
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
      old_password: '',
      new_password: '',
      new_password_confirmed: '',
      tel: '',
      passOk: '',
      passIncorrect: true,
      visible: true,
    };
  },
  methods: {
    NewPassword() {
      this.fetchEditPassword();
    },
    // Envoie à l'API des informations pour changer les informations
    fetchEditPassword() {
      axios.post('https://covoit.erwan-decoster.com/actions.php', {
        action: 'fetch_edit_password',
        old_password: this.old_password,
        new_password: this.new_password,
        new_password_confirmed: this.new_password_confirmed,
        tel: this.tel,
      }).then((response) => {
        // Redirection vers la page des informations personnelles si la requête c'est bien passer
        if (response.data === 'password_confirmed_ok') {
          this.$router.push({ name: 'Personalinformation', params: { passOk: true } });
        } else {
          this.passIncorrect = 'true';
        }
      });
    },
    mounted() {
      // Permet de ne pas aller sur la page si on est pas connecter
      if (!localStorage.tel) {
        this.$router.push({ path: '/' });
      }
    },
  },
};
</script>
