<template>
  <div id="edit_password" class="flex flex-col h-full">
    <div class="logo pt-6">
      <h1>
        <img class="mx-auto" src="@/assets/logos/covoit.svg" alt="">
      </h1>
    </div>
    <div class="grow flex flex-col justify-between gap-4 pb-20">
      <form class="flex flex-col gap-4" @submit.stop.prevent="NewPassword">
        <h2 class="text-2xl font-bold my-6">Modification du mot de passe :</h2>
        <p v-show="passOk" class="bg-green-500 p-2 rounded-lg text-white font-bold text-left">Le mot de passe a été changer avec succès !</p>
        <p v-show="passIncorrect" class="bg-red-500 p-2 rounded-lg text-white font-bold text-left">Le mot de passe de confirmation ou l'ancien mot de passe est incorrecte</p>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="actual_password">Mot de passe actuel : </label>
          <input v-model="old_password" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="password" name="actual_password" id="actual_password">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="actual_password">Téléphone : </label>
          <input v-model="tel" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="tel" name="actual_tel" id="actual_tel">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="name">Nouveau mot de passe : </label>
          <input v-model="new_password" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="password" name="new_password" id="new_password">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="name">Confirmation du nouveau mot de passe : </label>
          <input v-model="new_password_confirmed" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="password" name="new_password_confirmed" id="new_password_confirmed">
        </div>
        <div class="grid gap-4">
          <button class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-neutral-800 p-2 rounded-full text-white font-bold">Sauvegarder</button>
          <button @click="$router.go(-1)" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-white p-2 rounded-full text-neutral-900 font-bold">Retour</button>
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
      passIncorrect: '',
    };
  },
  methods: {
    NewPassword() {
      // console.log('test');
      this.fetchEditPassword();
    },
    fetchEditPassword() {
      axios.post('http://localhost/actions.php', {
        action: 'fetch_edit_password',
        old_password: this.old_password,
        new_password: this.new_password,
        new_password_confirmed: this.new_password_confirmed,
        tel: this.tel,
      }).then((response) => {
        // if (response.data === 'password_confirmed_ok') {
        //   // this.$router.push({ path: '/Personalinformation' });
        //   this.passOk = !this.passOk;
        // } else {
        //   this.passIncorrect = !this.passIncorrect;
        // }
        // if (response.data === 'old_password_incorrect') {
        //   this.oldPassIncorrect = !this.oldPassIncorrect;
        // } else {
        //   console.log('test');
        // }

        if (response.data === 'password_confirmed_ok') {
          // this.$router.push({ path: '/Personalinformation' });
          this.passOk = !this.passOk;
        } else {
          this.passIncorrect = !this.passIncorrect;
        }
      });
    },
    mounted() {
      if (!localStorage.tel) {
        this.$router.push({ path: '/' });
      }
    },
  },
};
</script>
