<template>

  <div>
    <TableTitle v-if="title" :title="title"/>
    <b-table :fields="['id', 'shares', 'actions']"
             :items="this.portfolio.allocations"
             hover
             responsive
             v-if="this.portfolio"
    >
      <template #cell(actions)="data">
        <b-button size="sm" variant="outline-danger" @click="sellAllocation(data.item.id)">Sell</b-button>
      </template>
    </b-table>

  </div>

</template>


<script lang="ts">

import {Component, Prop, Vue, Watch} from "vue-property-decorator";
import PortfolioClient from "@/api/Finizens/Portfolio/PortfolioClient";
import Portfolio from "@/model/Portfolio/Portfolio";
import TableTitle from "@/components/TableTitle.vue";

@Component({
  components: {
    TableTitle
  }
})
export default class ListAllocations extends Vue {

  @Prop({required: false, type: String}) public title!: string;
  @Prop({required: true, type: Number}) public portfolioId!: number;

  private readonly portfolioClient = new PortfolioClient();
  public portfolio: Portfolio | null = null;

  sellAllocation(allocationId: number) {
    console.log('allocationId: ' + allocationId);
  }

  @Watch('portfolioId')
  async onChangePortfolioId(newPortfolioId: number) {
    this.portfolio = await this.portfolioClient.byId(newPortfolioId);
  }
}
</script>