import Vue from 'vue';
////////////////////////////
import Axios from 'axios';
////////////////////////////
window.Vue = Vue;
////////////////////////////
window.axios = Axios;
////////////////////////////
Vue.prototype.$http = Axios;
////////////////////////////
// try {
//     window.$ = window.jQuery = window.jquery = require('jquery');
// }
// catch (e) {}
////////////////////////////
window.axios = require('axios');
////////////////////////////
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found');
}
////////////////////////////
// import Multiselect from 'vue-multiselect'
// Vue.component('multiselect', Multiselect)
////////////////////////////
import VueRouterMultiView from 'vue-router-multi-view';
Vue.use(VueRouterMultiView);
////////////////////////////
// import VueCarousel from '@chenfengyuan/vue-carousel';
// Vue.component('fengyCarousel', VueCarousel);
////////////////////////////
// import VueResponsiveText from 'vue-responsive-text'
// Vue.component('VueResponsiveText', VueResponsiveText);
////////////////////////////
// var Paginate = require('vuejs-paginate')
// Vue.component('paginate', Paginate)
////////////////////////////
// import Notifications from 'vue-notification'
// Vue.use(Notifications)
////////////////////////////
// import OwlCarousel from 'v-owl-carousel'
// Vue.component('carousel', OwlCarousel)
////////////////////////////
import VueApexCharts from 'vue-apexcharts'
Vue.component('apexchart', VueApexCharts)
////////////////////////////
import CKEditor from '@ckeditor/ckeditor5-vue';
Vue.use( CKEditor )
////////////////////////////
import 'bootstrap/dist/css/bootstrap.min.css';
// import 'bootstrap';
////////////////////////////
////////////////////////////
import VueScrollmagic from 'vue-scrollmagic'
Vue.use(VueScrollmagic, {
    verical: true,
    refreshInterval: 1
  })
////////////////////////////


