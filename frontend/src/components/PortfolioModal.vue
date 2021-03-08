<template>

  <b-modal :id="modalId"
           centered
           :title="`${action ==='create' ? 'Create portfolio' : 'Update portfolio'} ${this.portfolio.id}`"
           @ok="onSaveButtonClicked"
           ok-title="Save"
           ok-variant="primary"
           ok-only
  >
    <span class="">Allocations:</span>

    <b-row class="my-1 py-2"
           v-for="allocation in this.portfolio.allocations"
           :key="allocation.id"
    >

      <b-col cols="5">

        <b-form-group label-cols="4" label="Id:">
          <b-form-input v-model="allocation.id" number></b-form-input>
        </b-form-group>

      </b-col>

      <b-col cols="5">

        <b-form-group label-cols="4" label="Shares:">
          <b-form-input v-model="allocation.shares" number></b-form-input>
        </b-form-group>

      </b-col>

      <b-col cols="1">
        <b-button size="sm"
                  variant="outline-danger"
                  @click="onDeleteButtonClicked(allocation)"
        > X
        </b-button>
      </b-col>

    </b-row>

    <b-row>
      <b-col class="text-right">
        <b-button size="sm" variant='outline-dark' @click="this.addAllocation">Add</b-button>
      </b-col>
    </b-row>
  </b-modal>


</template>

<script lang="ts">

import {Component, Prop, Vue, Watch} from "vue-property-decorator";
import PortfolioClient from "@/api/Finizens/Portfolio/PortfolioClient";
import Portfolio from "@/model/Portfolio/Portfolio";
import Generator from "@/ValueObject/Generator";
import Allocation from "@/model/Portfolio/Allocation";
import EventBus from "@/EventBus";

@Component
export default class PortfolioModal extends Vue {

  private readonly portfolioClient = new PortfolioClient()

  @Prop({required: true, type: String}) readonly modalId!: string;
  @Prop({required: false, type: String, default: 'create'}) readonly action!: string;
  @Prop({required: false, type: Number, default: Generator.randomInt()}) portfolioId!: number;

  public portfolio: Portfolio = new Portfolio(Generator.randomInt(), []);


  @Watch('portfolioId')
  async onPortfolioIdChanged() {
    if (this.action === 'update') {
      this.portfolio = await this.portfolioClient.byId(this.portfolioId);
      return;
    }
    this.portfolio = new Portfolio(this.portfolioId, [])
  }

  async onSaveButtonClicked() {
    await this.portfolioClient.save(this.portfolio);
    EventBus.emit(
        this.action === 'create'
            ? 'portfolioCreated'
            : 'portfolioUpdated',
        this.portfolio
    );
  }

  addAllocation() {
    this.portfolio?.allocations.push(new Allocation(Generator.randomInt(), Generator.randomIntBetween(1, 100)));
  }

  onDeleteButtonClicked(allocation: Allocation) {
    this.portfolio.allocations.splice(this.portfolio.allocations.indexOf(allocation), 1);
  }

}
</script>

<style scoped>

</style>