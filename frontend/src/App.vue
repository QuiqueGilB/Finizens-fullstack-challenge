<template>
  <div id="app">

    <b-container fluid class="p-0 vh-100 bg-light">
      <b-row no-gutters class="vh-100">
        <b-col no-gutters class="vh-100">
          <router-view class="vh-100"></router-view>
        </b-col>
      </b-row>
    </b-container>


    <div class="fixed-bottom">

      <div class="d-flex flex-row-reverse">
        <span class="p-4">Finizens Challenge 2021 by <a target="_blank"
                                                        href="https://enriquegil.me">@QuiqueGilB</a></span>
      </div>

    </div>


  </div>
</template>


<script lang="ts">

import {Component, Vue} from "vue-property-decorator";
import EventBus from "@/EventBus";

@Component
export default class App extends Vue {

  created() {
    EventBus.on('error', this.onError);
  }

  async onError(error) {
    this.$bvToast.toast('Unexpected error has occurred, please try again later.', {
      title: "Warning",
      variant: 'danger',
      solid: true
    })
  }
}

</script>

<style>
html, body {
  height: 100%;
}

#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  height: 100%;
}
</style>
