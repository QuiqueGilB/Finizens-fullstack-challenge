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
      <template #head(orderStatus)="data">
        {{ data.label }}

        <b-dropdown right size="sm" variant="light">
          <b-dropdown-item @click="changeFilter('completed')" href="#">Completed</b-dropdown-item>
          <b-dropdown-item @click="changeFilter('pending')">Pending</b-dropdown-item>
        </b-dropdown>

      </template>

      <template #cell(actions)="data">
        <b-button v-if="data.item.orderStatus.value === 'pending'"
                  size="sm"
                  variant="outline-info"
                  @click="completeOrder(data.item)"
        >
          Complete
        </b-button>
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

  public filterStatus = 'pending';

  created() {
    EventBus.on('orderCreated', this.onOrderCreated)
    EventBus.on('portfolioUpdated', this.onPortfolioUpdated)
  }

  changeFilter(newStatus: string) {
    console.log(newStatus);
    this.filterStatus = newStatus;
    this.loadOrders(this.portfolioId);
  }

  async onOrderCreated(order: Order) {
    this.orders.push(order);
  }

  private async loadOrders(portfolioId: number) {
    const criteria = {
      filters: `portfolio = ${portfolioId} and status = ${this.filterStatus}`
    };
    this.orders = (await this.orderClient.search(criteria)).data;

  }

  @Watch('portfolioId')
  onPortfolioIdChanged(newPortfolioId: number) {
    this.loadOrders(newPortfolioId)
  }

  onPortfolioUpdated(portfolio: Portfolio) {
    this.loadOrders(portfolio.id);
  }

  async completeOrder(order: Order) {
    await this.orderClient.complete(order.id);
    EventBus.emit('orderCompleted', order);

    this.orders.splice(this.orders.indexOf(order), 1)
  }
}
</script>