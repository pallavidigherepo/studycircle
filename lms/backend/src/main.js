import { createApp } from "vue";
import { createPinia } from "pinia";
import App from "./App.vue";
import router from "./router";
import globalComponents from "./global-components";
import utils from "./utils";
import "./libs";
import "./assets/css/app.css";
import i18n from './i18n';
import axiosClient from "@/axios";

window.Laravel = {
    csrfToken: "{{ csrf_token() }}",
    //user_permissions: await getAuth()
}

async function getAuth()
{
    return await axiosClient
                    .get('/check_user_permissions')
                    .then(({data}) => {
                        return data;
                    });
}

const app = createApp(App)
    .use(router)
    .use(createPinia())
    .use(i18n);

app.directive('can', (el, binding, vnode) => {

    let permissions = window.Laravel.user_permissions.permissions;

    if(permissions.includes(binding.value))
    {
        return vnode.el.hidden = false;
    }
    else
    {
        return vnode.el.hidden = true;
    }
});


globalComponents(app);
utils(app);

app.mount("#app");
