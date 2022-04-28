<template>
  <div id="edit_password" class="flex flex-col h-full dark:text-white w-96 mx-auto w-96 mx-auto max-w-sm">
    <div class="logo pt-6">
      <h1>
        <img class="mx-auto" src="@/assets/logos/covoit.svg" alt="">
      </h1>
    </div>
    <div class="grow flex flex-col justify-between gap-4 pb-20">
      <form class="flex flex-col gap-4" @submit.stop.prevent="deleteAccount">
        <!-- Message d'erreurs si le compte n'a pas été supprimer -->
        <p v-show="problemAccount === 'true' && visible === true" @click="visible = false" class="bg-red-500 p-2 rounded-lg text-white font-bold text-left">Votre compte n'a malheuresement pas pu être supprimer</p>
        <!-- Informations sur les risques lié à la suppression d'un compte -->
        <div class="text-left text-xl text-center mt-20"><strong>Avant de désactiver votre compte, sachez que:</strong></div>
          <ul>
            <li class="text-left">- La suppression de votre compte est définitive.</li>
            <li class="text-left">- Votre compte sera supprimé de Covoit après confirmation de votre part.</li>
            <li class="text-left">- Toutes vos données personnelles que nous avons collectées seront supprimées en-même temps que la suppresion de votre compte.</li>
          </ul>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="actual_password">Téléphone : </label>
          <input v-model="tel" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg dark:text-[#000000]" type="tel" name="actual_tel" id="actual_tel">
        </div>
        <div class="grid gap-4">
          <button class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-red-500 p-2 rounded-full text-white font-bold mt-20 dark:shadow-[0_-5px_15px_-8px_rgba(255,0,0,0.5)]">Confirmer la suppression de mon compte</button>
          <button @click="$router.go(-1)" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-white p-2 rounded-full text-neutral-900 font-bold dark:shadow-[0_-5px_15px_-8px_rgba(255,255,255,0.5)]">Annuler</button>
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
      PersonalInformation: '',
      tel: '',
      problemAccount: '',
      modifOk: '',
      visible: true,
    };
  },
  methods: {
    deleteAccount() {
      this.fetchConfirmationDelete();
    },
    // Envoie à l'API une confirmation de suppression
    fetchConfirmationDelete() {
      axios.post('https://covoit.erwan-decoster.com/actions.php', {
        action: 'fetch_delete_account',
        tel: this.tel,
      }).then((response) => {
        if (response.data === 'Account_deleted') {
          this.$router.push({ name: 'Login', params: { modifOk: true } });
        } else {
          this.problemAccount = 'true';
        }
      });
    },
    // Permet de ne pas aller sur la page si on est pas connecter
    mounted() {
      if (!localStorage.tel) {
        this.$router.push({ path: '/' });
      }
    },
  },
};
</script>
