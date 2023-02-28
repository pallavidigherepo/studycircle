import { createApp } from "vue";
import { createPinia } from "pinia";
import App from "./App.vue";
import router from "./router";
import globalComponents from "./global-components";
import utils from "./utils";
import "./libs";
import "./assets/css/app.css";
import i18n from './i18n';

const app = createApp(App)
    .use(router)
    .use(createPinia())
    .use(i18n);

globalComponents(app);
utils(app);

app.mount("#app");
