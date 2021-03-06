<template>

  <b-table :fields="['id', 'shares', 'actions']"
           :items="allocations"
           hover
           responsive
  >
    <template #cell(actions)="data">
      <b-button variant="outline-danger" @click="sellAllocation(data.item.id)">Sell</b-button>
    </template>
  </b-table>

</template>


<script lang="ts">

import {Component, Prop, Vue} from "vue-property-decorator";

@Component
export default class ListAllocations extends Vue {
  @Prop()
  public readonly allocations!: Array<any>;

  sellAllocation(allocationId: number) {
    console.log(allocationId);
  }
}
</script>