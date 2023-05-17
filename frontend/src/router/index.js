import { createRouter, createWebHistory } from "vue-router";
import Home from "../views/Home.vue";
import Register from "../views/Register.vue";

const routes = [
  // {
  //   path: "/",
  //   name: "Home",
  //   component: Home,
  // },

  {
    path: "/",
    name: "Register",
    component: Register,
  },
];

const router = createRouter({ history: createWebHistory(), routes });
export default router;
