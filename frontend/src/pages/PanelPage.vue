<template>
  <div>

      <b-row no-gutters >

        <b-col cols="3" no-gutters >
          <ListPortfolios :portfolios="this.portfolios"/>
        </b-col>


        <b-col>
          <h1>Portfolio {{ portfolio.id }}</h1>

            <b-row>

              <b-col cols="3">
                <ListAllocations :allocations="this.portfolio.allocations"/>
              </b-col>

              <b-col>
                <ListOrders :orders="this.orders"/>
              </b-col>

            </b-row>


        </b-col>
      </b-row>



  </div>
</template>


<script>

import ListAllocations from "../components/ListAllocations";
import ListOrders from "../components/ListOrders";
import ListPortfolios from "../components/ListPortfolios";

export default {
  name: 'PanelPage',
  components: {
    ListAllocations,
    ListOrders,
    ListPortfolios
  },
  data() {
    return {
      portfolios:[{id:1},{id:2},{id:3}],
      portfolio: {
        id: ''
      },
      orders: [
        {
          id:1,
          allocation: 2,
          shares:3,
          portfolio:1
        },
        {
          id:2,
          allocation: 5,
          shares:34,
          portfolio:1
        }
      ]
    }
  },
  async created() {
    this.portfolio = await fetch(
        'http://localhost:5500/portfolio/1',
        {
          method: 'GET', // *GET, POST, PUT, DELETE, etc.
          // mode: 'cors', // no-cors, *cors, same-origin
          // cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
          // credentials: 'same-origin', // include, *same-origin, omit
          // headers: {
          //   'Content-Type': 'application/json'
          //   'Content-Type': 'application/x-www-form-urlencoded',
          //
          // }
        }
    ).then(response => response.json());

    console.log(this.portfolio);
  }
}

</script>


<style scoped>

.panel {

}

</style>