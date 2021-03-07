<template>

  <div>

    <TableTitle v-if="title" :title="title"/>

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

@Component({
  components: {
    TableTitle
  }
})
export default class ListOrders extends Vue {

  private readonly orderClient = new OrderClient();

  @Prop() readonly portfolioId!: number;
  @Prop({type: String}) readonly title!: string;

  public orders: Order[] = [];
  public readonly criteria: { [key: string]: string | number } = {};


  @Watch('portfolioId')
  async onPortfolioIdChanged(newPortfolioId: number) {
    const criteria = {
      filters: `portfolio = ${newPortfolioId} and status = pending`
    };
    this.orders = (await this.orderClient.search(criteria)).data;
  }

  async completeOrder(order: Order) {
    await this.orderClient.complete(order.id);
    this.$emit('orderCompleted', order);

    const index = this.orders.indexOf(order);
    this.orders.splice(index, 1)
  }
}
</script>