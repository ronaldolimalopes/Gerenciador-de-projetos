<template>
  <v-app>
    <e-header />
      <v-content>
        <v-container>
          <router-view />
        </v-container>
      </v-content>
      <v-footer app>
        <span>@copy; <a href="#">Prodeb</a> - {{ year }}</span>
      </v-footer>
  </v-app>
</template>

<script>
import Header from "./partials/Header";

export default {
  name: "App",
  computed: {
    year() {
      return (new Date()).getFullYear();
    }
  },
  components: {
    'e-header': Header
  }
};
</script>

<style>
#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
