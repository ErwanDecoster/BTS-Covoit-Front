<template>
  <div id="createTrip" class="h-full flex flex-col">
    <div class="logo pt-6">
      <h1>
        <img class="mx-auto" src="@/assets/logos/covoit.svg" alt="">
      </h1>
    </div>
    <div class="grow flex flex-col justify-between gap-4 pb-20">
      <form class="flex flex-col gap-4" @submit.stop.prevent="AddVehicleValidation">
        <h2 class="text-2xl font-bold m-6">Créer un véhicule :</h2>
        <p v-for="error in errors" :key="error" @click="this.errors = [];" class="bg-red-500 p-2 rounded-lg text-white font-bold text-left">{{ error }}</p>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="vehicle_model">Modèle : </label>
          <input v-model="vehicle_name" autocomplete="off" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="text" name="vehicle_model" id="vehicle_model">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="motorisation">Motorisation : </label>
          <select v-model="id_motorization" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" name="id_motorization" id="id_motorization">
            <option v-for="row in motorization" v-bind:key="row" :value="row.id_motorization">{{ row.libellet }}</option>
          </select>
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="number_of_place">Nombres de places : </label>
          <input v-model="nb_places" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="number" name="number_of_place" id="number_of_place">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="password">Couleur : </label>
          <select v-model="color" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" name="color" id="color">
            <option v-for="row in VehicleColor" v-bind:key="row" :value="row.color">{{ row.color }}</option>
          </select>
        </div>
        <button class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-neutral-800 p-2 rounded-full text-white font-bold">Créer</button>
      </form>
      <button @click="$router.go(-1)" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-white p-2 rounded-full text-neutral-900 font-bold">Retour</button>
    </div>
  </div>
  <navbar/>
</template>
<script>
import Navbar from '@/components/Navbar.vue';
import axios from 'axios';

export default {
  name: 'createVehicle',
  components: { Navbar },
  data() {
    return {
      errors: [],
      allVehiclesForUser: '',
      motorization: '',
      vehicle_name: '',
      id_motorization: '',
      nb_places: '',
      color: '',
    };
  },
  computed: {
    VehicleColor() {
      return this.$store.state.VehicleColor;
    },
  },
  methods: {
    fetchAllMotorization() {
      axios.post('http://localhost/actions.php', {
        action: 'fetchall_motorization',
      }).then((response) => {
        this.motorization = response.data;
        console.log(response);
      });
    },
    AddVehicleValidation() {
      this.errors = [];
      if (this.vehicle_name.length >= 4) {
        if (this.id_motorization !== '') {
          if (this.nb_places >= 1 && this.nb_places <= 6) {
            if (this.color !== '') {
              this.AddVehicle();
            } else {
              this.errors.push('Une couleur doit etre selectionné.');
            }
          } else {
            this.errors.push('Le nombre de places doit étre compris en 1 et 6.');
          }
        } else {
          this.errors.push('Une motorisation doit etre selectionné.');
        }
      } else {
        this.errors.push('Le modèle du véhicule doit contenir au moins 4 caracteres.');
      }
    },
    AddVehicle() {
      axios.post('http://localhost/actions.php', {
        action: 'add_vehicle',
        userTel: localStorage.tel,
        vehicle_name: this.vehicle_name,
        id_motorization: this.id_motorization,
        nb_places: this.nb_places,
        color: this.color,
      }).then((response) => {
        console.log(response);
        this.$router.push({ name: 'Vehicles', params: { vehiculeAdded: true } });
      });
    },
  },
  mounted() {
    this.fetchAllMotorization();
    if (!localStorage.tel) {
      this.$router.push({ path: '/' });
    }
  },
};
</script>
