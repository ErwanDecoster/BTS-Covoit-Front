<template>
  <div id="login" class="h-full flex flex-col dark:text-white w-96 mx-auto max-w-sm">
    <div class="logo pt-6">
      <h1>
        <img class="mx-auto" src="@/assets/logos/covoit.svg" alt="">
      </h1>
    </div>
      <form @submit.stop.prevent="AddLogin" class="flex flex-col gap-4">
        <h2 class="text-2xl font-bold m-6">Connexion</h2>
        <!-- Affichage des différents messages d'erreurs -->
          <p v-show="identifiantIncorrecte === 'true' && visible3 === true" @click="visible3 = false" class="bg-red-500 p-2 rounded-lg text-white font-bold text-left">Identifiant incorrecte</p>
          <p v-show="champs === 'true' && visible2 === true" @click="visible2 = false" class="bg-red-500 p-2 rounded-lg text-white font-bold text-left">Les champs sont vides</p>
          <p v-show="modifOk === 'true' && visible === true" @click="visible = false" class="bg-emerald-500 p-2 rounded-lg text-white font-bold text-left">Votre compte a été supprimer avec succès !</p>
        <!-- Renseigner son téléphone et le mot de passe pour se connecter -->
        <div class="grid gap-2">
          <label class="text-left font-bold" for="phone">Téléphone : </label>
          <input v-model="tel" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg dark:text-[#000000]" type="tel" name="phone" id="tel" autocomplete="tel">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="password">Mot de passe : </label>
          <input v-model="password" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg dark:text-[#000000]" type="password" name="password" id="password" autocomplete="current-password">
        </div>
        <button @click="Locale_Storage" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-neutral-800 p-2 rounded-full text-white font-bold dark:shadow-[0_-5px_15px_-8px_rgba(255,255,255,0.5)] mt-5">Se connecter</button>
        <router-link to="/registration" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-white p-2 rounded-full text-neutral-900 font-bold dark:shadow-[0_-5px_15px_-8px_rgba(255,255,255,0.5)]">Inscription</router-link>
      </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: ['modifOk'],
  name: 'Login',
  data() {
    return {
      tel: '',
      password: '',
      identifiantIncorrecte: '',
      champs: '',
      visible: true,
      visible2: true,
      visible3: true,
    };
  },
  methods: {
    // Récupération des différents localstorage pour permettre de se connecter
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
    // On envoie les informations de connection pour savoir s'il est bien connecter
    VerifNewLogin() {
      if (this.tel !== '' && this.password !== '') {
        axios.post('http://localhost/actions.php', {
          action: 'verif_login',
          tel: this.tel,
          password: this.password,
        }).then((response) => {
          console.log(response);
          // Si la réponse est correcte on va rediriger vers la page Home
          if (response.data === 'OK') {
            this.$router.push({ path: '/Home' });
          } else {
            this.identifiantIncorrecte = 'true';
          }
        });
      } else {
        this.champs = 'true';
      }
    },
  },
};
</script>
