<template>
  <!-- <div id="nav">
    <router-link to="/">Login</router-link> |
    <router-link to="/registration">Registration</router-link> |
    <router-link to="/SearchTrip">SearchTrip</router-link> |
    <router-link to="/Trip">Trip</router-link> |
    <router-link to="/ProfilSetting">ProfilSetting</router-link> |
    <router-link to="/Vehicles">Vehicles</router-link> |
    <router-link to="/CreateTrip">CreateTrip</router-link> |
    <router-link to="/CreateVehicle">CreateVehicle</router-link> |
    <router-link to="/Personalinformation">Personalinformation</router-link> |
    <router-link to="/EditPassword">EditPassword</router-link> |
  </div> -->
  <div class="max-w-sm mx-auto relative h-screen absolute inset-0 px-2">
    <router-view/>
  </div>
  <div id="App">
    <!-- <div id="Nav">
      <router-link v-if="authenticated" to="/searchtrip" v-on:click="logout()" replace>Logout</router-link>
    </div> -->
  <router-view @authenticated="setAuthenticated" />
    </div>
</template>

<script>
export default {
  name: 'App',
  data() {
    return {
      authenticated: false,
      mockAccount: {
        tel: '0777117198',
        password: '1234',
      },
    };
  },
  mounted() {
    if (this.authenticated) {
      this.$router.push({ path: '/' });
    }
  },
  methods: {
    setAuthenticated(status) {
      this.authenticated = status;
    },
    /* logout() {
      this.authenticated = false;
    }, */
  },
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

#nav {
  padding: 30px;
}

#nav a {
  font-weight: bold;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: #42b983;
}
</style>
