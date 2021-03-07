<template>
  <div class="vh-100">

    <b-row no-gutters class="vh-100">

      <b-col lg="2" md="3" class="vh-100 bg-dark">
        <b-img src="/finizens.png" fluid/>

        <b-button squared variant="primary" block size="md" class="py-3">
          <b-icon icon="plus-circle"></b-icon>
          New portfolio
        </b-button>

        <ListPortfolios v-on:portfolioSelected="onPortfolioSelected"/>
      </b-col>


      <b-col class="vh-100">
        <h1 class="text-left m-5 my-30 font-weight-bold">Portfolio {{ this.portfolioIdSelected || '' }}</h1>

        <b-row no-gutters>

          <b-col cols="3" class="border mx-2">
            <ListAllocations
                title="Allocations"
                :v-if="0 !== portfolioIdSelected"
                :portfolioId="this.portfolioIdSelected"
            />
          </b-col>

          <b-col class="border mx-2">
            <ListOrders :v-if="0 !== portfolioIdSelected"
                        title="Orders"
                        :portfolioId="this.portfolioIdSelected"/>
          </b-col>

        </b-row>


      </b-col>
    </b-row>


  </div>
</template>


<script lang="ts">

import ListAllocations from "@/components/ListAllocations.vue";
import ListOrders from "@/components/ListOrders.vue";
import ListPortfolios from "@/components/ListPortfolios.vue";
import {Component, Vue} from "vue-property-decorator";

@Component({
  components: {
    ListAllocations,
    ListOrders,
    ListPortfolios
  }
})
export default class PanelView extends Vue {
  public portfolioIdSelected = 0;

  public onPortfolioSelected(portfolioId: number) {
    this.portfolioIdSelected = portfolioId;
  }
}

</script>


<style scoped>

</style>