<template>

  <b-list-group>
    <b-list-group-item :key="portfolio.id"
                       v-for="portfolio in portfolios"
    >
      Portfolio {{ portfolio.id }}
    </b-list-group-item>
  </b-list-group>

</template>

<script lang="ts">
import {Component, Prop, Vue} from "vue-property-decorator";

@Component
export default class ListPortfolios extends Vue {
  @Prop()
  readonly portfolios!: Array<any>
}
</script>

<style scoped>

</style>