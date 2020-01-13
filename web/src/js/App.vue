<template>
    <form @submit.prevent="">
        <date-picker v-model="date"></date-picker>
        <div class="row">
            Polévka:
        </div>
        <div class="row">
            <button @click="addItem(soups)">+</button>
        </div>
        <div v-for="(item, index) in soups">
            <Item v-model="soups[index]" @remove="removeItem(soups, index)"/>
        </div>

        sem zkus okopírovat nějak jídla

        <button @click="submit()">Uložit</button>
    </form>
</template>

<script>
  import Item from './Item.vue'
  import DatePicker from 'vue2-datepicker';
  import 'vue2-datepicker/index.css';
  import dateFormat from 'dateformat';
  import axios from 'axios';
  import qs from 'querystring';

  export default {
    name: 'App',
    components: {
      Item, DatePicker
    },
    data: function () {
      return {
        date: null,
        soups: [],
        meals: []
      }
    },
    computed: {
      formattedDate() {
        return dateFormat(this.date, 'yyyy-mm-dd');
      }
    },
    watch: {},
    methods: {
      addItem(items) {
        items.push({
          name: null,
          price: null
        })
      },
      removeItem(items, index) {
        /**
         * vue má svoje nedostatky. Všude na netu by ses dočet, že stačí zavolat
         * "delete items[index];"
         * To by fungovalo, ale Vue by o tom nevědělo a elementy by nebyly reaktivní...
         * tzn. nevšimlo by si, že jsi něco odebral
         *
         * stejně jako je delete, tak existuje this.$set(objekt nebo pole, klíč nebo index, hodnota);
         *
         * prostě to ber jako fakt :D:D
         */
        // delete items[index];
        this.$delete(items, index);
      },
      async submit() {
        const data = {
          date: this.formattedDate,
            soups: this.soups,
            meals: this.meals
        };
        try {
          // tohle se pak nastaví
          await axios.post('http://localhost:8000/save.php', qs.stringify({data: JSON.stringify(data)}), {
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded'
            }
          });
          alert('Uloženo!')
        } catch (e) {
          alert('Něco se nepovedlo.')
        }
      }
    }
  }
</script>

<!--<style lang="scss">-->
<!--    body {-->
<!--    }-->
<!--</style>-->
