<template>

  <b-table :fields="['id', 'portfolio', 'allocation', 'shares', 'actions']"
           :items="orders"
           hover
  >
    <template #cell(actions)="data">
      <b-button variant="outline-info" @click="completeOrder(data.item.id)">Complete</b-button>
    </template>
  </b-table>

</template>


<script lang="ts">

import {Component, Prop, Vue} from "vue-property-decorator";

@Component
export default class ListOrders extends Vue {
  @Prop()
  readonly orders!: Array<any>;

  completeOrder(orderId: number) {
    console.log(orderId);
  }
}
</script>