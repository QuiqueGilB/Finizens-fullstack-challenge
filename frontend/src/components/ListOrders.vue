<template>

  <div>

    <BuyOrderModal modalId="modal-buy-order" :portfolioId="portfolioId"/>

    <TableTitle v-if="title" :title="title">
      <b-button size="sm"
                squared
                variant="outline-success"
                v-b-modal.modal-buy-order
      >
        Buy
      </b-button>
    </TableTitle>

    <b-table :fields="['id', 'allocationId', 'shares', 'orderType', 'orderStatus', 'actions']"
             :items="orders"
             hover
    >
      <template #cell(actions)="data">
        <b-button size="sm" variant="outline-info" @click="completeOrder(data.item)">Complete</b-button>
      </template>

      <template #cell(orderType)="data">
        {{ data.item.orderType.value }}
      </template>

      <template #cell(orderStatus)="data">
        {{ data.item.orderStatus.value }}
      </template>

    </b-table>
  </div>

</template>


<script lang="ts">

import {Component, Prop, Vue, Watch} from "vue-property-decorator";
import OrderClient from "@/api/Finizens/Order/OrderClient";
import Order from "@/model/Order/Order";
import TableTitle from "@/components/TableTitle.vue";
import EventBus from "@/EventBus";
import BuyOrderModal from "@/components/BuyOrderModal.vue";
import Portfolio from "@/model/Portfolio/Portfolio";

@Component({
  components: {
    TableTitle,
    BuyOrderModal
  }
})
export default class ListOrders extends Vue {

  private readonly orderClient = new OrderClient();

  @Prop() readonly portfolioId!: number;
  @Prop({type: String}) readonly title!: string;

  public orders: Order[] = [];
  public readonly criteria: { [key: string]: string | number } = {};

  created() {
    EventBus.on('orderCreated', this.onOrderCreated)
    EventBus.on('portfolioUpdated', this.onPortfolioUpdated)
  }

  async onOrderCreated(order: Order) {
    this.orders.push(order);
  }

  @Watch('portfolioId')
  async onPortfolioIdChanged(newPortfolioId: number) {
    const criteria = {
      filters: `portfolio = ${newPortfolioId} and status = pending`
    };
    this.orders = (await this.orderClient.search(criteria)).data;
  }

  onPortfolioUpdated(portfolio: Portfolio) {
    this.onPortfolioIdChanged(portfolio.id);
  }

  async completeOrder(order: Order) {
    await this.orderClient.complete(order.id);
    EventBus.emit('orderCompleted', order);

    this.orders.splice(this.orders.indexOf(order), 1)
  }
}
</script>