<template>
  <div id="nav">
    <router-link to="/">Login</router-link> |
    <router-link to="/registration">Registration</router-link> |
    <router-link to="/SearchTrip">SearchTrip</router-link> |
    <router-link to="/Trip">Trip</router-link> |
    <router-link to="/ProfilSetting">ProfilSetting</router-link> |
    <router-link to="/Vehicles">Vehicles</router-link> |
  </div>
  <div class="max-w-sm mx-auto relative h-screen">
    <router-view/>
  </div>
</template>

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
