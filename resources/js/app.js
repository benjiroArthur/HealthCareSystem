/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


window.Vue = require('vue');

import moment from 'moment';


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


import VueRouter from 'vue-router';
import axios from "axios";
import { VuejsDatatableFactory } from 'vuejs-datatable';




import {Form, HasError, AlertError} from 'vform';


window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

import VueProgressBar from 'vue-progressbar'

Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '2px'
});


Vue.use(VueRouter, axios, VuejsDatatableFactory);


import Swal from 'sweetalert2';
window.swal = Swal;

/*const toast = swal.mixin({
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
    //Users routes
    {path:'/home', component: require('./components/home.vue').default},
    {path:'/user/chat', component: require('./components/User/Chat.vue').default},
    {path:'/user/doctors', component: require('./components/User/Doctors.vue').default},
    {path:'/user/medical-records', component: require('./components/User/MedicalRecords.vue').default},
    {path:'/user/profile', component: require('./components/User/Profile.vue').default},
    {path:'/user/upcoming-appointment', component: require('./components/User/UpAppointment.vue').default},
    {path:'/user/past-appointment', component: require('./components/User/PastAppointment.vue').default},

    //Admins routes
    {path:'/admin/dashboard', component: require('./components/Admin/Dashboard.vue').default},
    {path:'/admin/manage/admin', component: require('./components/Admin/ManageAdmins.vue').default},
    {path:'/admin/manage/doctors', component: require('./components/Admin/ManageDoctors.vue').default},
    {path:'/admin/manage/out_patients', component: require('./components/Admin/ManagePatient.vue').default},
    {path:'/admin/manage/pharmacy', component: require('./components/Admin/ManagePharmacy.vue').default},
    {path:'/admin/medical-records', component: require('./components/Admin/MedicalRecords.vue').default},
    {path:'/admin/profile', component: require('./components/Admin/Profile.vue').default},
    {path:'/admin/upcoming-appointment', component: require('./components/Admin/UpAppointment.vue').default},
    {path:'/admin/past-appointment', component: require('./components/Admin/PastAppointment.vue').default},
    {path:'/admin/show/:id', component: require('./components/Admin/ShowAdmin').default, name:'admin-show'},

    //Doctors routes
    {path:'/doctor/dashboard', component: require('./components/Doctor/Dashboard.vue').default},
    {path:'/doctor/chat', component: require('./components/Doctor/Chat.vue').default},
    {path:'/doctor/users', component: require('./components/Doctor/Doctors.vue').default},
    {path:'/doctor/medical-records', component: require('./components/Doctor/MedicalRecords.vue').default},
    {path:'/doctor/profile', component: require('./components/Doctor/Profile.vue').default},
    {path:'/doctor/upcoming-appointment', component: require('./components/Doctor/UpAppointment.vue').default},
    {path:'/doctor/past-appointment', component: require('./components/Doctor/PastAppointment.vue').default},

    //Pharmacy routes
    {path:'/pharmacy/dashboard', component: require('./components/Pharmacy/Dashboard.vue').default},
    {path:'/pharmacy/orders', component: require('./components/Pharmacy/Chat.vue').default},
    {path:'/pharmacy/users', component: require('./components/Pharmacy/Doctors.vue').default},
    {path:'/pharmacy/medical-records', component: require('./components/Pharmacy/MedicalRecords.vue').default},
    {path:'/pharmacy/profile', component: require('./components/Pharmacy/Profile.vue').default},
    {path:'/pharmacy/upcoming-appointment', component: require('./components/Pharmacy/UpAppointment.vue').default},
    {path:'/pharmacy/past-appointment', component: require('./components/Pharmacy/PastAppointment.vue').default},

];

const router = new VueRouter({
    mode:'history',
    routes

});

Vue.filter('uptext', function(text){
   return text.toUpperCase();
});
Vue.filter('myDate', function(text){
   return created.moment().format('Do MMMM YYYY, h:mm:ss a');
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
Vue.component('page-number', require('laravel-vue-pagination'));

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

const app = new Vue({
    el: '#app',
    router
});
