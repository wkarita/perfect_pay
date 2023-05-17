import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import BootstrapVue3 from "bootstrap-vue-3";
import { createPinia } from "pinia";
import "./scss/_variables.scss";

createApp(App)
  .use(App)
  .use(router)
  .use(BootstrapVue3)
  .use(createPinia())
  .mount("#app");
