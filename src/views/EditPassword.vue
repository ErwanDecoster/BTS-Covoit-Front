<template>
  <div id="registration" class="flex flex-col h-full">
    <div class="logo pt-6">
      <h1>
        <img class="mx-auto" src="@/assets/logos/covoit.svg" alt="">
      </h1>
    </div>
    <div class="grow flex flex-col justify-between gap-4 pb-20">
      <form action="@/php/forgot.php" method="POST" class="flex flex-col gap-4">
        <h2 class="text-2xl font-bold my-6">Modification du mot de passe :</h2>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="actual_password">Mot de passe actuel : </label>
          <input v-model="old_password" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="password" name="actual_password" id="actual_password">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="name">Nouveau mot de passe : </label>
          <input v-model="new_password" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="password" name="new_password" id="new_password">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="name">Confirmation du nouveau mot de passe : </label>
          <input v-model="new_password_confirmed" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="password" name="new_password_confirmed" id="new_password_confirmed">
        </div>
      </form>
      <div class="grid gap-4">
        <button @click="submit" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-neutral-800 p-2 rounded-full text-white font-bold">Sauvegarder</button>
        <button @click="$router.go(-1)" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-white p-2 rounded-full text-neutral-900 font-bold">Retour</button>
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
      old_password: '',
      new_password: '',
      new_password_confirmed: '',
    };
  },
  methods: {
    fetchEditPassword() {
      axios.post('http://localhost/actions.php', {
        action: 'fetch_edit_password',
      }).then((response) => {
        this.new_password = response.data;
        console.log(response.data);
      });
    },
    submit() {
      axios.post('http://localhost/actions.php', {
        action: 'fetch_edit_password',
      });
    },
    mounted() {
      this.fetchEditPassword();
    },
  },
};
</script>
