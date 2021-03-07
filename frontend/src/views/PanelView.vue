<template>
  <div>

    <b-row no-gutters>

      <b-col lg="2" md="3">
        <b-img :src="finizensLogo" fluid/>

        <b-button squared variant="outline-secondary">
          <b-icon icon="plus-circle"></b-icon>
          New portfolio
        </b-button>

        <ListPortfolios v-on:portfolioSelected="onPortfolioSelected"/>
      </b-col>


      <b-col>
        <h1 class="text-left m-5 my-30 font-weight-bold">Portfolio {{ this.portfolioIdSelected || '' }}</h1>

        <b-row no-gutters>

          <b-col cols="3" class="border mx-2">
            <ListAllocations
                :v-if="0 !== portfolioIdSelected"
                :portfolioId="this.portfolioIdSelected"
            />
          </b-col>

          <b-col class="border mx-2">
            <ListOrders :v-if="0 !== portfolioIdSelected"
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
import finizensLogo from '@/assets/finizens.png';

@Component({
  components: {
    ListAllocations,
    ListOrders,
    ListPortfolios
  }
})
export default class PanelView extends Vue {
  public portfolioIdSelected = 0;
  public finizensLogo = finizensLogo;

  public onPortfolioSelected(portfolioId: number) {
    this.portfolioIdSelected = portfolioId;
  }
}

</script>


<style scoped>

</style>