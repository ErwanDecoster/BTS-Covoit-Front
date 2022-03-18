<template>
  <div id="edit_password" class="flex flex-col h-full">
    <div class="logo pt-6">
      <h1>
        <img class="mx-auto" src="@/assets/logos/covoit.svg" alt="">
      </h1>
    </div>
    <div class="grow flex flex-col justify-between gap-4 pb-20">
      <form class="flex flex-col gap-4" @submit.stop.prevent="AddNewPersonalInformation">
        <h2 class="text-2xl font-bold my-6">Modification des données personnelles :</h2>
        <p v-show="erreurModification" class="bg-red-500 p-2 rounded-lg text-white font-bold text-left">Votre ancien téléphone est incorrecte</p>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="actual_password">Nom : </label>
          <input v-model="surname" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="text" name="nom" id="nom">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="actual_password">Prénom : </label>
          <input v-model="name" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="text" name="prenom" id="prenom">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="name">Téléphone actuel : </label>
          <input v-model="old_tel" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="text" name="tel" id="tel">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="name">Nouveau téléphone : </label>
          <input v-model="tel" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="text" name="tel" id="tel">
        </div>
        <div class="grid gap-4">
          <button @click="persist" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-neutral-800 p-2 rounded-full text-white font-bold">Sauvegarder</button>
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
      surname: '',
      name: '',
      old_tel: '',
      tel: '',
      modifOk: '',
      erreurModification: '',
    };
  },
  methods: {
    persist() {
      localStorage.surname = this.surname;
      localStorage.name = this.name;
      localStorage.tel = this.tel;
    },
    AddNewPersonalInformation() {
      this.fetchEditPersonalInformation();
    },
    fetchEditPersonalInformation() {
      axios.post('http://localhost/actions.php', {
        action: 'fetch_edit_personal_information',
        surname: this.surname,
        name: this.name,
        old_tel: this.old_tel,
        tel: this.tel,
      }).then((response) => {
        console.log(response.data);
        if (response.data === 'modification_ok') {
          this.$router.push({ name: 'Personalinformation', params: { modifOk: true } });
        } else {
          this.erreurModification = !this.erreurModification;
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
