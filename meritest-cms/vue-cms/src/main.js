import { createApp } from 'vue'
import App from './App.vue'
import router from './router';
import store from './store';
import './index.css'
import CKEditor from '@ckeditor/ckeditor5-vue';

createApp(App)
.use(router)
.use(store)
.use( CKEditor )
.mount('#app')
