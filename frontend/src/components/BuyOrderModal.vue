<template>

  <b-modal :id="modalId"
           centered
           title="Buy order"
           @ok="onSaveButtonClicked"
           ok-title="Save"
           ok-variant="primary"
           ok-only
  >
    <b-row class="my-1 py-2">
      <b-col sm="3">
        <label>Allocation:</label>
      </b-col>
      <b-col sm="9">
        <b-form-input type="number" number v-model="formBuyOrder.allocation"></b-form-input>
      </b-col>
    </b-row>
    <b-row class="my-1 py-2">
      <b-col sm="3">
        <label>Shares:</label>
      </b-col>
      <b-col sm="9">
        <b-form-input type="number" number v-model="formBuyOrder.shares" min="1"></b-form-input>
      </b-col>
    </b-row>
  </b-modal>


</template>

<script lang="ts">

import {Vue, Component, Prop} from "vue-property-decorator";
import OrderClient from "../api/Finizens/Order/OrderClient";
import Order from "@/model/Order/Order";
import Generator from "@/ValueObject/Generator";
import OrderType from "@/model/Order/OrderType";
import OrderStatus from "@/model/Order/OrderStatus";
import EventBus from "@/EventBus";

@Component
export default class BuyOrderModal extends Vue {
  private readonly orderClient = new OrderClient();

  private readonly formBuyOrder = {
    allocation: Generator.randomInt(),
    shares: Generator.randomIntBetween(1, 300),
  }

  @Prop({required: true, type: String}) readonly modalId!: string;
  @Prop({required: true, type: Number}) readonly portfolioId!: number;

  async onSaveButtonClicked() {
    const order = new Order(
        Generator.randomInt(),
        this.portfolioId,
        this.formBuyOrder.allocation,
        this.formBuyOrder.shares,
        OrderType.buy(),
        OrderStatus.pending()
    );

    await this.orderClient.create(order);
    EventBus.emit('orderCreated', order);

    this.formBuyOrder.allocation = Generator.randomInt();
    this.formBuyOrder.shares = Generator.randomIntBetween(1, 300);
  }

}
</script>

<style scoped>

</style>