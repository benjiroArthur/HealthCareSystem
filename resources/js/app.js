/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


window.Vue = require('vue');


import VueRouter from 'vue-router'
import UserDashboard from './components/User/Dashboard.vue';
import DoctorDashboard from './components/Doctor/Dashboard.vue';
import AdminDashboard from './components/Admin/Dashboard.vue';

Vue.use(VueRouter);

//vue routers
let routes = [
    //Users routes
    {path:'/user/dashboard', component: require('./components/User/Dashboard.vue').default},
    {path:'/user/chat', component: require('./components/User/Chat.vue').default},
    {path:'/user/doctors', component: require('./components/User/Doctors.vue').default},
    {path:'/user/medical-records', component: require('./components/User/MedicalRecords.vue').default},
    {path:'/user/profile', component: require('./components/User/Profile.vue').default},
    {path:'/user/upcoming-appointment', component: require('./components/User/UpAppointment.vue').default},
    {path:'/user/past-appointment', component: require('./components/User/PastAppointment.vue').default},

    //Admins routes
    {path:'/admin/dashboard', component: require('./components/Admin/Dashboard.vue').default},
    {path:'/admin/chat', component: require('./components/Admin/Chat.vue').default},
    {path:'/admin/doctors', component: require('./components/Admin/Doctors.vue').default},
    {path:'/admin/medical-records', component: require('./components/Admin/MedicalRecords.vue').default},
    {path:'/admin/profile', component: require('./components/Admin/Profile.vue').default},
    {path:'/admin/upcoming-appointment', component: require('./components/Admin/UpAppointment.vue').default},
    {path:'/admin/past-appointment', component: require('./components/Admin/PastAppointment.vue').default},

    //Doctors routes
    {path:'/doctor/dashboard', component: require('./components/Doctor/Dashboard.vue').default},
    {path:'/doctor/chat', component: require('./components/Doctor/Chat.vue').default},
    {path:'/doctor/users', component: require('./components/Doctor/Doctors.vue').default},
    {path:'/doctor/medical-records', component: require('./components/Doctor/MedicalRecords.vue').default},
    {path:'/doctor/profile', component: require('./components/Doctor/Profile.vue').default},
    {path:'/doctor/upcoming-appointment', component: require('./components/Doctor/UpAppointment.vue').default},
    {path:'/doctor/past-appointment', component: require('./components/Doctor/PastAppointment.vue').default},

    ];

const router = new VueRouter({
    mode:'history',
    routes:[
        {
            'path' : '/home',
            'name' : 'home',
            'component' : UserDashboard
        },
        {
            'path' : '/doctor-home',
            'name' : 'doctor-home',
            'component' : DoctorDashboard
        },
        {
            'path' : '/admin-home',
            'name' : 'admin-home',
            'component' : AdminDashboard
        }
    ]
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

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
