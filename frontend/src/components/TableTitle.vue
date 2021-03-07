<template>
  <div class="bg-dark text-light py-2 font-weight-bolder px-4">
    <b-row>
      <b-col cols="6" class="text-left h-100 align-middle pt-1">{{ title }}</b-col>

      <b-col class="text-right">
        <slot></slot>
      </b-col>

    </b-row>
  </div>

</template>

<script lang="ts">

import {Vue, Component, Prop} from "vue-property-decorator";

@Component
export default class TableTitle extends Vue {

  @Prop({required: true, type: String}) title!: string;
}
</script>

<style scoped>

</style>