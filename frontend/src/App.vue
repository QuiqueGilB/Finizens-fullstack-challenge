<template>
  <div id="app">

    <b-container fluid class="p-0">
      <b-row no-gutters>
        <b-col no-gutters>
          <router-view></router-view>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>


<script lang="ts">

import {Component, Vue} from "vue-property-decorator";

@Component
export default class App extends Vue {

}

</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
</style>
