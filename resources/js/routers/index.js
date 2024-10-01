import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";
import Activation from "../views/Activation.vue";
import store from "../store/index.js";

Vue.use(VueRouter);

const routes = [
    {
        path: "/reservations/:date?",
        component: Home,
        beforeEnter: (to, from, next) => {
            const { date } = to.params;
            if (date) {
                store.dispatch("updateSelectedDate", date);
            }
            next();
        },
    },
    {
        path: "/",
        component: Home,
        name: "Home",
    },
    {
        path: "/activation/:token",
        name: "Activation",
        component: Activation,
    },
];

const router = new VueRouter({
    mode: "history",
    routes,
});

export default router;
