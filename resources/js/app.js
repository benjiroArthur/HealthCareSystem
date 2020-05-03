/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


window.Vue = require('vue');

import Vuetify from 'vuetify';
Vue.use(Vuetify);

import moment from 'moment';
Vue.prototype.$userId = document.querySelector("meta[name='userId']").getAttribute('content');
Vue.prototype.$status = document.querySelector("meta[name='status']").getAttribute('content');

window.Fire = new Vue();

import DataTable from 'laravel-vue-datatable';


Vue.use(DataTable);


require('@fortawesome/fontawesome-free/js/all.js');
require('bootstrap-table/dist/bootstrap-table.min.css');
require('bootstrap-table/dist/bootstrap-table.js');

require('tableexport.jquery.plugin');
require('bootstrap-table/dist/extensions/export/bootstrap-table-export.min.js');
require('bootstrap-table/dist/extensions/print/bootstrap-table-print.min.js');

require('bootstrap-table/dist/extensions/filter-control/bootstrap-table-filter-control.min.css');
require('bootstrap-table/dist/extensions/filter-control/bootstrap-table-filter-control.min.js');

import 'sweetalert2/dist/sweetalert2.min.css';

import {RotateSquare2} from 'vue-loading-spinner';

window.RotateSquare2 = RotateSquare2;



// Import this component
import datePicker from 'vue-bootstrap-datetimepicker';

// Import date picker css
import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';

import VueRouter from 'vue-router';
import axios from "axios";
import { VuejsDatatableFactory } from 'vuejs-datatable';

Vue.use(VueRouter, axios, VuejsDatatableFactory);



import * as VueGoogleMaps from 'vue2-google-maps';

Vue.use(VueGoogleMaps, {
    load: {
        key: 'YOUR_API_TOKEN',
        libraries: 'places', // This is required if you use the Autocomplete plugin
        // OR: libraries: 'places,drawing'
        // OR: libraries: 'places,drawing,visualization'
        // (as you require)

        //// If you want to set the version, you can do so:
        // v: '3.26',
    },});


import {Form, HasError, AlertError} from 'vform';


window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.component('pagination', require('laravel-vue-pagination'));

import VueProgressBar from 'vue-progressbar'

Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '2px'
});





import Swal from 'sweetalert2';
window.Swal = Swal;

/*const toast = Swal.mixin({
    toast: true,
    Position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});*/

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer);
        toast.addEventListener('mouseleave', Swal.resumeTimer);
    }
});
window.toast = Toast;

import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);

//Vue.prototype.$image = document.querySelector("meta['name = user-image']").getAttribute('content');

//vue routers
let routes = [

    //general routes
    {path:'/chat', component: require('./components/ChatExtra/Chat.vue').default},
    {path:'/home', component: require('./components/home.vue').default},
    {path:'/password/update', component: require('./components/Password.vue').default},

//Users routes
    {path:'/user/doctors', component: require('./components/User/Doctors.vue').default},
    {path:'/user/medical-records', component: require('./components/User/MedicalRecords.vue').default},
    {path:'/user/profile', component: require('./components/User/Profile.vue').default},
    {path:'/user/pharmacy', component: require('./components/User/Pharmacy.vue').default},
    {path:'/user/prescription', component: require('./components/User/Prescription.vue').default},

    //Admins routes
    {path:'/admin/dashboard', component: require('./components/Admin/Dashboard.vue').default},
    {path:'/admin/manage/admin', component: require('./components/Admin/ManageAdmins.vue').default},
    {path:'/admin/manage/doctors', component: require('./components/Admin/ManageDoctors.vue').default},
    {path:'/admin/manage/out_patients', component: require('./components/Admin/ManagePatient.vue').default},
    {path:'/admin/manage/pharmacy', component: require('./components/Admin/ManagePharmacy.vue').default},
    {path:'/admin/profile', component: require('./components/Admin/Profile.vue').default},
    {path:'/admin/daily-tips', component: require('./components/Admin/DailyTips').default},

    //Doctors routes
    {path:'/doctor/medical-records', component: require('./components/Doctor/MedicalRecords.vue').default},
    {path:'/doctor/profile', component: require('./components/Doctor/Profile.vue').default},
    {path:'/doctor/prescription', component: require('./components/Doctor/Prescription.vue').default},

    //Pharmacy routes
    {path:'/pharmacy/profile', component: require('./components/Pharmacy/Profile.vue').default},
    {path:'/pharmacy/prescription', component: require('./components/Pharmacy/Prescription.vue').default},

];

const router = new VueRouter({
    mode:'history',
    routes

});

Vue.filter('upText', function(text){
   return text.charAt(0).toUpperCase() + text.slice(1);
});
Vue.filter('myDate', function(text){
   return moment(text).format('MMMM Do YYYY');
});

Vue.filter('fromNow', function(text){
    return moment(text).fromNow();
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('contact-us', require('./components/ContactUs.vue').default);
Vue.component('page-number', require('laravel-vue-pagination'));

//chat component extras
Vue.component('contact-list', require('./components/ChatExtra/ContactList.vue').default);
Vue.component('conversation', require('./components/ChatExtra/Conversation.vue').default);
Vue.component('message-composer', require('./components/ChatExtra/MessageComposer.vue').default);
Vue.component('feed', require('./components/ChatExtra/Feed.vue').default);
Vue.component('online-user', require('./components/ChatExtra/OnlineUser.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 router.beforeResolve((to, from, next)=>{
     if(to.path){

     }
     next();
 });

 router.afterEach(()=>{

 });

import VueLazyload from 'vue-lazyload';

Vue.use(VueLazyload);

import VueCropper from 'vue-cropperjs';
import 'cropperjs/dist/cropper.css';
Vue.component(VueCropper);


const app = new Vue({
    el: '#app',
    router,
    vuetify: new Vuetify(),
    data: () => ({
        pageLoader: true,
        userId: 'ddd',
        search:'',
    }),
    methods:{
        searchIt(){
            Fire.$emit('searching')
        }
    },
    mounted() {
        setTimeout(val => {
            this.pageLoader = false;
        }, 4000);

    }
});
