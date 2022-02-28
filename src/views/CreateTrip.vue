<template>
  <div id="createTrip" class="">
    <div class="logo pt-6">
      <h1>
        <img class="mx-auto" src="@/assets/logos/covoit.svg" alt="">
      </h1>
      <form class="flex flex-col gap-4 ">
        <h2 class="text-2xl font-bold m-6">Créer un intinéraire :</h2>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="date_of_travel">Date de départ : </label>
          <input v-model="date_of_travel" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="date" name="date_of_travel" id="date_of_travel">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="houre_of_travel">Heure de départ : </label>
          <input v-model="houre_of_travel" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="time" name="houre_of_travel" id="houre_of_travel">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="starting_point">Point de départ : </label>
          <input v-model="starting_point" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg form-control" type="text" name="starting_point" id="starting_point">
        <!-- <div class="autocomplete-here-suggestions-container" v-if="suggestionsHere.length">
          <ul>
            <li v-for="suggestion in suggestionsHere" :key="suggestion.id">
              <span v-on:click="onClickSuggestHere(suggestion)">{{ suggestion.lib }}</span>
            </li>
          </ul>
        </div>
        <div class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" v-if="suggestionSelected != ''">
          <h5>
            Vous venez de sélectionner la ville suivante: <br>
            <b><i>{{ suggestionSelected }}</i></b>
          </h5>
        </div> -->
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="end_point">Point d'arriver : </label>
          <input v-model="end_point" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="text" name="end_point" id="end_point">
        </div>
        <div class="grid gap-2">
          <label class="text-left font-bold" for="vehicle">Vehicule : </label>
          <input v-model="vehicle" class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] rounded-full p-2 text-lg" type="text" name="vehicle" id="vehicle">
        </div>
        <button class="drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] bg-neutral-800 p-2 rounded-full text-white font-bold">Créer</button>
      </form>
    </div>
  </div>
  <navbar/>
</template>
<!--<script>
import Navbar from '@/components/Navbar.vue';
/* import axios from 'axios'; */

export default {
  components: { Navbar },
  el: '#app-autocomplete-here',
  data() {
    /* return {
      CreateTrip: '',
    }; */
    return {
      here_id: '', // Important ! Permet de vous identifier avec l'API
      here_code: '', // Important ! Permet de vous identifier avec l'API
      inputCity: '', // Valeur du champ 'Ville'
      suggestionsHere: [], // Tableau qui contiendra les suggestions Here
      suggestionSelected: '', // Ville & Code postal sélectionnés
    };
  },
  methods: {
    /* fetchCreateTrip() {
      axios.get('http://localhost/actions.php', {
        action: 'fetch_create_trip',
      }).then((response) => {
        this.CreateTrip = response.data;
        console.log(response.data);
      });
    }, */
    onKeypressCity() {
      const value = this.inputCity;
      if (value !== undefined && value !== '') {
      // Call API Suggestions de HERE pour réécupérer les informations
        fetch(`https://autocomplete.geocoder.api.here.com/6.2/suggest.json?resultType=city&app_id=${this.jxvUjVVY0Mq4cKAssQnL}&app_code=${this.SGWVLerwga6jzJsKKdZpAA}&maxresults=15&query=${value}&resultType=city&country=FRA`)
          .then((result) => result.json())
          .then((result) => {
            const datas = [];
            if (result.suggestions && result.suggestions.length > 0) {
              result.suggestions.array.forEach((sug) => {
                if (sug.address.postalCode !== undefined && sug.address.city !== undefined) {
                  datas.push({
                    lib: `${sug.address.postalCode}${''}${sug.address.city}`,
                    cp: sug.address.postalCode ? sug.address.postalCode : '',
                    city: sug.address.city ? sug.address.city : '',
                  });
                }
              });
            }
            this.suggestionsHere = datas;
          },
          (error) => {
            console.error(error);
          });
      } else {
        this.suggestionsHere = [];
      }
    },
    onClickSuggestHere(suggestion) {
      // On renseigne la ville sélectionner
      this.suggestionSelected = suggestion.lib;
      // On reset la recherche
      this.inputCity = '';
      this.suggestionsHere = [];
    },
  },
  /* mounted() {
    this.fetchCreateTrip();
  }, */
};
</script>-->

<script>
import Navbar from '@/components/Navbar.vue';
import axios from 'axios';

export default {
  components: { Navbar },
  data() {
    return {
      CreateTrip: '',
    };
  },
  methods: {
    fetchCreateTrip() {
      axios.get('http://localhost/actions.php', {
        action: 'fetch_create_trip',
      }).then((response) => {
        this.CreateTrip = response.data;
        console.log(response.data);
      });
    },
  },
  mounted() {
    this.fetchCreateTrip();
  },
};
</script>
