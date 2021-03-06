<template>
  <div>

    <b-row no-gutters>

      <b-col cols="3" no-gutters>
        <ListPortfolios :portfolios="this.portfolios"/>
      </b-col>


      <b-col>
        <h1>Portfolio {{ portfolio.id }}</h1>

        <b-row>

          <b-col cols="3">
            <ListAllocations :allocations="this.portfolio.allocations"/>
          </b-col>

          <b-col>
            <ListOrders :orders="this.orders"/>
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
import FetchHttpClient from "@/api/FetchHttpClient";
import Portfolio from "@/model/Portfolio";
import PortfolioClient from "@/api/Finizens/Portfolio/PortfolioClient";


@Component({
  components: {
    ListAllocations,
    ListOrders,
    ListPortfolios
  }
})
export default class PanelView extends Vue {
  private portfolio: any;
  private readonly portfolioClient = new PortfolioClient()

  data() {
    return {
      portfolios: [{id: 1}, {id: 2}, {id: 3}],
      portfolio: {
        id: ''
      },
      orders: [
        {
          id: 1,
          allocation: 2,
          shares: 3,
          portfolio: 1
        },
        {
          id: 2,
          allocation: 5,
          shares: 34,
          portfolio: 1
        }
      ]
    }
  }

  async created() {
    console.log(process.env);

    this.portfolio = await this.portfolioClient.byId(1);
    console.log(this.portfolio);
  }
}

</script>


<style scoped>

.panel {

}

</style>