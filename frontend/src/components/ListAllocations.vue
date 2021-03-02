<template>

  <b-table :fields="['id', 'portfolio', 'allocation', 'shares', 'actions']"
           :items="allocations"
           hover
  >
    <template #cell(actions)="data">
      <b-button variant="outline-danger" @click="sellAllocation(data.item.id)">Sell</b-button>
    </template>
  </b-table>

</template>


<script>

export default {
  name: 'ListAllocations',
  props: {
    allocations: Array
  },
  methods: {
    sellAllocation(allocationId) {
      console.log(allocationId);
    }
  }
}
</script>