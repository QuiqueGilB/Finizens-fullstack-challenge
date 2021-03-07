<template>
  <div class="bg-dark text-light py-2 font-weight-bolder">
    {{ title }}
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