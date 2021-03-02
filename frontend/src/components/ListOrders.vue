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


<script>

export default {
  name: 'ListOrders',
  props: {
    orders: Array
  },
  methods: {
    completeOrder(orderId) {
      console.log(orderId);
    }
  }
}
</script>