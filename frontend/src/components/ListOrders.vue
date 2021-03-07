<template>

  <b-table :fields="['id', 'allocationId', 'shares', 'orderType', 'orderStatus', 'actions']"
           :items="orders"
           hover
  >
    <template #cell(actions)="data">
      <b-button size="sm" variant="outline-info" @click="completeOrder(data.item.id)">Complete</b-button>
    </template>

    <template #cell(orderType)="data">
      {{data.item.orderType.value}}
    </template>

    <template #cell(orderStatus)="data">
      {{data.item.orderStatus.value}}
    </template>

  </b-table>

</template>


<script lang="ts">

import {Component, Prop, Vue, Watch} from "vue-property-decorator";
import OrderClient from "@/api/Finizens/Order/OrderClient";
import Order from "@/model/Order/Order";

@Component
export default class ListOrders extends Vue {

  private readonly orderClient = new OrderClient();

  @Prop()
  readonly portfolioId: number = 0;
  public orders: Order[] = [];
  public readonly criteria: { [key: string]: string | number } = {};


  @Watch('portfolioId')
  async onPortfolioIdChanged(newPortfolioId: number) {
    const criteria = {
      filters: `portfolio = ${this.portfolioId} and status = pending`
    };
    this.orders = (await this.orderClient.search(criteria)).data;
  }

  completeOrder(orderId: number) {
    console.log('orderId: ' + orderId);
  }
}
</script>