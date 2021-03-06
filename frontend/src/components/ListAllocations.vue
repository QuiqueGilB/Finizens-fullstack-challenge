<template>

  <b-table :fields="['id', 'shares', 'actions']"
           :items="this.portfolio.allocations"
           hover
           responsive
           v-if="this.portfolio"
  >
    <template #cell(actions)="data">
      <b-button variant="outline-danger" @click="sellAllocation(data.item.id)">Sell</b-button>
    </template>
  </b-table>

</template>


<script lang="ts">

import {Component, Prop, Vue, Watch} from "vue-property-decorator";
import PortfolioClient from "@/api/Finizens/Portfolio/PortfolioClient";
import Portfolio from "@/model/Portfolio/Portfolio";

@Component
export default class ListAllocations extends Vue {

  @Prop({required: true, type: Number}) public portfolioId: number;

  private readonly portfolioClient = new PortfolioClient();
  public portfolio: Portfolio | null = null;

  sellAllocation(allocationId: number) {
    console.log('allocationId: ' + allocationId);
  }

  @Watch('portfolioId')
  async onChangePortfolioId(newPortfolioId: number) {
    this.portfolio = await this.portfolioClient.byId(this.portfolioId);
  }
}
</script>