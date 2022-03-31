import { createApp } from "vue";
import App from "./components/App.vue";

require("./bootstrap");

window.Vue = require("vue").default;

const app = createApp(App).mount("#app");
