<template>

  <b-list-group>
    <b-list-group-item class="bg-transparent text-light text-left btn"
                       :key="portfolio.id"
                       v-for="portfolio in this.portfolios"
                       @click="selectPortfolio(portfolio.id)"
    >
      Portfolio {{ portfolio.id }}
    </b-list-group-item>
  </b-list-group>

</template>

<script lang="ts">
import {Component, Vue} from "vue-property-decorator";
import PortfolioClient from "@/api/Finizens/Portfolio/PortfolioClient";
import Portfolio from "@/model/Portfolio/Portfolio";
import EventBus from "@/EventBus";

@Component
export default class ListPortfolios extends Vue {

  private readonly portfolioClient = new PortfolioClient();

  public portfolios: Portfolio[] = [];

  async created() {
    this.portfolios = (await this.portfolioClient.search()).data;

    if (this.portfolios.length > 0) {
      this.selectPortfolio(this.portfolios[0].id);
    }
  }

  selectPortfolio(portfolioId: number) {
    this.$emit('portfolioSelected', portfolioId);
  }
}
</script>

<style scoped>

</style>