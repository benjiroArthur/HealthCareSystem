<template>
    <div class="container-fluid">


        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user-injured"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Patients</span>
                        <span class="info-box-number">{{this.count.patient}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-md"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Doctors</span>
                        <span class="info-box-number">{{this.count.doctor}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-first-aid"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Pharmacies</span>
                        <span class="info-box-number">{{this.count.pharmacy}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-health elevation-1"><i class="fas fa-user-cog text-white"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Administrators</span>
                        <span class="info-box-number">{{this.count.admin}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{this.count.medRecord}}</h3>

                        <p>Medical Records</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-file-medical text-white"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{this.count.prescription}}</h3>

                        <p>Prescriptions</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-capsules text-white"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6 text-white">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{this.count.users}}</h3>

                        <p>Total Users</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users text-white"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{this.onlineSize}}</h3>

                        <p>Users Online</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-clock text-white"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <div class="row">
            <div class="col-md-6">
                <!-- USERS LIST -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Latest Out Patients</h3>

                        <div class="card-tools">
                            <span class="badge badge-danger">8 New Members</span>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <ul class="users-list clearfix">
                            <li v-for="outPatient in outPatients" v-bind:key="outPatient.id">
                                <img :src="outPatient.image" alt="User Image" width="50">
                                <a class="users-list-name" href="#">{{outPatient.full_name}}</a>
                                <span class="users-list-date">{{outPatient.created_at | fromNow}}</span>
                            </li>

                        </ul>
                        <!-- /.users-list -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-center">
                        <router-link to="/admin/manage/out_patients" class="nav-link">View All Users</router-link>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!--/.card -->
            </div>


            <div class="col-md-6">
                <!-- USERS LIST -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Latest Doctors</h3>

                        <div class="card-tools">
                            <span class="badge badge-danger">8 New Members</span>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <ul class="users-list clearfix">
                            <li v-for="doctor in doctors" v-bind:key="doctor.id">
                                <img :src="doctor.image" alt="User Image" width="50">
                                <a class="users-list-name" href="#">{{doctor.full_name}}</a>
                                <span class="users-list-date">{{doctor.created_at | fromNow}}</span>
                            </li>

                        </ul>
                        <!-- /.users-list -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-center">
                        <router-link to="/admin/manage/doctors" class="nav-link">View All Users</router-link>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!--/.card -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <!-- USERS LIST -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Latest Pharmacies</h3>

                        <div class="card-tools">
                            <span class="badge badge-danger">8 New Members</span>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <ul class="users-list clearfix">
                            <li v-for="pharmacy in pharmacies" v-bind:key="pharmacy.id">
                                <img :src="pharmacy.image" alt="User Image" width="50">
                                <a class="users-list-name" href="#">{{pharmacy.full_name}}</a>
                                <span class="users-list-date">{{pharmacy.from_now}}</span>
                            </li>
                        </ul>
                        <!-- /.users-list -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-center">
                        <router-link to="/admin/manage/pharmacy" class="nav-link">View All Users</router-link>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!--/.card -->
            </div>


            <div class="col-md-6">
                <!-- USERS LIST -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Latest Administrators</h3>

                        <div class="card-tools">
                            <span class="badge badge-danger">8 New Members</span>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <ul class="users-list clearfix">
                            <li v-for="admin in admins" v-bind:key="admin.id">
                                <img :src="admin.image" alt="User Image" width="50">
                                <a class="users-list-name" href="#">{{admin.full_name}}</a>
                                <span class="users-list-date">{{admin.from_now}}</span>
                            </li>
                        </ul>
                        <!-- /.users-list -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-center">
                        <router-link to="/admin/manage/admin" class="nav-link">View All Users</router-link>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!--/.card -->
            </div>
        </div>


    </div>
</template>

<script>
    export default {
        name: 'Dashboard',
        data(){
            return{
                outPatients:{},
                outPatient:'',
                doctors:{},
                doctor:'',
                pharmacies:{},
                pharmacy:'',
                admins:{},
                admin:'',
                count:{},
                onlineSize: '',

            }

        },
        methods:{
            getPatients() {
                this.error = this.outPatients = null;
                this.loading = true;
                axios
                    .get('/dashboard/new/out_patient')
                    .then(response => {
                        this.loading = false;
                        this.outPatients = response.data;
                    }).catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
            },

            getDoctors() {
                this.error = this.doctors = null;
                this.loading = true;
                axios
                    .get('/dashboard/new/doctor')
                    .then(response => {
                        this.loading = false;
                        this.doctors = response.data;
                    }).catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
            },

            getPharmacy() {
                this.error = this.pharmacies = null;
                this.loading = true;
                axios
                    .get('/dashboard/new/pharmacy')
                    .then(response => {
                        this.loading = false;
                        this.pharmacies = response.data;
                    }).catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
            },

            getAdmin() {
                this.error = this.admins = null;
                this.loading = true;
                axios
                    .get('/dashboard/new/admin')
                    .then(response => {
                        this.loading = false;
                        this.admins = response.data;
                    }).catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
            },

            getStat(){
                axios.get('/dashboard/statistics')
                    .then((response) => {
                        this.count = response.data
                    })
                    .catch((error) => {
                        console.log(error.message)
                    })
            },

            handleIncoming(user){
                if(user.role.name === 'admin'){this.getAdmin();}
                else if(user.role.name === 'out_patient'){this.getPatients();}
                else if(user.role.name === 'pharmacy'){this.getPharmacy();}
                else if(user.role.name === 'doctor'){this.getDoctors();}
                this.getStat();
            },
            countOnline(){
                axios.get('/records/online-users')
                    .then((response) => {
                        this.onlineSize = response.data
                    })
                    .catch((error) => {
                        console.log(error.message)
                    })

            },

        },
        created(){
            this.getPatients();
            this.getDoctors();
            this.getPharmacy();
            this.getAdmin();
            this.getStat();
            this.countOnline();
        },

        mounted() {
            Echo.private('adminChannel')
                .listen('NewUser', (e) => {
                    this.handleIncoming(e.user);
                });

            Echo.private('online-users')
                .listen('CheckOnline', (e) => {
                    this.countOnline();
                });

        }
    }
</script>
