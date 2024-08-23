import Vue from "vue";
import App from "./App.vue";
import store from "./store";
import vuetify from "./plugins/vuetify";
import "./bootstrap";

new Vue({
    el: "#app", // Mount Vue to the element with the id 'app'
    store,
    vuetify,
    render: (h) => h(App),
});
