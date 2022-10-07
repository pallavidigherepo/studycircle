import Breadcrumb from './UI/Breadcrumb.vue';
import BaseCard from './UI/BaseCard.vue';
import Loading from './UI/Loading.vue';
import BaseDialog from './UI/BaseDialog.vue';

export default app => {
    app.component('Breadcrumb', Breadcrumb);
    app.component('BaseCard', BaseCard);
    app.component('Loading', Loading);
    app.component('BaseDialog', BaseDialog);
}