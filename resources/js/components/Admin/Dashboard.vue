<template>
    <div class="container-fluid">


        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">CPU Traffic</span>
                        <span class="info-box-number">
                  10
                  <small>%</small>
                </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Likes</span>
                        <span class="info-box-number">41,410</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">CPU Traffic</span>
                        <span class="info-box-number">
                  10
                  <small>%</small>
                </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Likes</span>
                        <span class="info-box-number">41,410</span>
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
                        <h3>150</h3>

                        <p>New Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>53<sup style="font-size: 20px">%</sup></h3>

                        <p>Bounce Rate</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>44</h3>

                        <p>User Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>65</h3>

                        <p>Unique Visitors</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
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
                                <span class="users-list-date">{{outPatient.created_at | fromdate}}</span>
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
                                <span class="users-list-date">{{doctor.created_at | fromdate}}</span>
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
                                <span class="users-list-date">{{pharmacy.created_at | fromdate}}</span>
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
                                <span class="users-list-date">{{admin.created_at | fromdate}}</span>
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
        },
        created(){
            this.getPatients();
            this.getDoctors();
            this.getPharmacy();
            this.getAdmin();
        }
    }
</script>
