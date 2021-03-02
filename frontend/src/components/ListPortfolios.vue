<template>

  <b-list-group>
    <b-list-group-item :key="portfolio.id"
                       v-for="portfolio in portfolios"
    >
      Portfolio {{portfolio.id}}
    </b-list-group-item>
  </b-list-group>

</template>

<script>
export default {
  name: "ListPortfolios",
  props: {
    portfolios: Array
  }
}
</script>

<style scoped>

</style>