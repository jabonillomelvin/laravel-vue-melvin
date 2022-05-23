import { createWebHistory, createRouter } from "vue-router";
import Home from "../views/Home.vue";
import Form from "../views/Form.vue";

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: "/create",
    name: "create",
    component: Form,
  },
  {
    path: "/edit/:id",
    name: "edit",
    component: Form,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;