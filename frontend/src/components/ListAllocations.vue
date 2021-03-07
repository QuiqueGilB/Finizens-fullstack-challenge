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
        <b-button size="sm" variant="outline-danger" @click="sellAllocation(data.item)">Sell</b-button>
      </template>
    </b-table>

  </div>

</template>


<script lang="ts">

import {Component, Prop, Vue, Watch} from "vue-property-decorator";
import PortfolioClient from "@/api/Finizens/Portfolio/PortfolioClient";
import Portfolio from "@/model/Portfolio/Portfolio";
import TableTitle from "@/components/TableTitle.vue";
import Allocation from "@/model/Portfolio/Allocation";
import OrderClient from "@/api/Finizens/Order/OrderClient";
import Order from "@/model/Order/Order";
import OrderType from "@/model/Order/OrderType";
import OrderStatus from "@/model/Order/OrderStatus";
import Generator from "@/ValueObject/Generator";
import EventBus from "@/EventBus";

@Component({
  components: {
    TableTitle
  }
})
export default class ListAllocations extends Vue {

  @Prop({required: false, type: String}) public title!: string;
  @Prop({required: true, type: Number}) public portfolioId!: number;

  private readonly portfolioClient = new PortfolioClient();
  private readonly orderClient = new OrderClient();

  public portfolio: Portfolio | null = null;

  created() {
    EventBus.on('orderCompleted', this.onOrderCompleted);
  }

  async sellAllocation(allocation: Allocation) {
    const sellOrder = new Order(
        Generator.randomInt(),
        this.portfolioId,
        allocation.id,
        Math.abs(allocation.shares),
        allocation.shares > 0 ? OrderType.sell() : OrderType.buy(),
        OrderStatus.pending()
    );

    await this.orderClient.create(sellOrder);
    EventBus.emit('orderCreated', sellOrder);
  }

  @Watch('portfolioId')
  async onChangePortfolioId(newPortfolioId: number) {
    this.portfolio = await this.portfolioClient.byId(newPortfolioId);
  }

  async onOrderCompleted(order: Order) {
    this.portfolio = await this.portfolioClient.byId(order.portfolioId);
  }
}
</script>