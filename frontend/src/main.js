import Vue from 'vue'
import PanelPage from "./pages/PanelPage";
import VueRouter from "vue-router";
import App from "./App";
import BootstrapVue, {IconsPlugin} from "bootstrap-vue";

Vue.config.productionTip = false

const routes = [
  { path: '/', component: PanelPage, name: "PanelPage" },
]


const router = new VueRouter({
  routes // short for `routes: routes`
})
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

Vue.use(VueRouter);

new Vue({
  render: h => h(App),
  router
}).$mount('#app')
