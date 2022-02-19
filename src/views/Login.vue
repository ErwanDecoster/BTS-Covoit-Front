<template>
  <div id="login" class="">
    <div class="logo pt-6">
      <h1>
        <img class="mx-auto" src="@/assets/logos/covoit.svg" alt="">
      </h1>
      <!--<?php if(isset($_GET['login_err'])){
          $err = htmlspecialchars($_GET['login_err']) //vérifie que l'utilisateur ne rentre pas n'importe quoi

          switch($err){
            case 'password':
            breack;

            case 'tel':
            breack;

            case 'already':
            breack;
          }
        }
      ?>-->
      <form class="flex flex-col gap-4" action="actions.php" method="get">
        <h2 class="text-2xl font-bold m-6">Connection</h2>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="tel">Telephone : </label>
          <input class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="tel" name="tel" id="tel">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="password">Mot de passe : </label>
          <input class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="password" name="password" id="password">
        </div>
        <router-link to="/SearchTrip" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-neutral-800 p-2 rounded-full text-white font-bold">Se connecter</router-link>
        <router-link to="/Registration" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-white p-2 rounded-full text-neutral-900 font-bold">Inscription</router-link>
      </form>
    </div>
  </div>
</template>

<!--
<script>

import axios from 'axios';

export default {

  data() {
    return {
      tel: '',
      password: '',
    };
  },
  methods: {
    fetchAllTelephone() {
      axios.post('http://localhost/actions.php', {
        action: 'fetchall_telephone',
      }).then((response) => {
        this.tel = response.data;
        console.log(response);
      });
    },
    fetchAllPassword() {
      axios.post('http://localhost/actions.php', {
        action: 'fetchall_password',
      }).then((response) => {
        this.password = response.data;
        console.log(response);
      });
    },
  },
  mounted() {
    this.fetchAllTelephone();
    this.fetchAllPassword();
    console.log(this.allData);
  },
};
</script>-->
