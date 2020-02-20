<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Out Patients</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                       <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Date Of Birth</th>
                                <th>Gender</th>
                                <th>Phone Number</th>
                                <th>Location</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr v-for="out_patient in out_patients" v-bind:key="out_patient.id">
                                <td>{{out_patient.id}}</td>
                                <td v-if="out_patient.other_name !== null ">{{out_patient.first_name +' '+ out_patient.other_name + ' ' + out_patient.last_name}}</td>
                                <td v-else>{{out_patient.first_name + ' ' + out_patient.last_name}}</td>
                                <td>{{out_patient.email}}</td>
                                <td>{{out_patient.dob}}</td>
                                <td>{{out_patient.gender}}</td>
                                <td>{{out_patient.phone_number}}</td>
                                <td>{{out_patient.location}}</td>
                                <td>
                                    <a href="#">
                                        <i class="fa fa-edit blue"></i>
                                    </a>
                                    |
                                    <a href="#">
                                        <i class="fa fa-trash red"></i>
                                    </a>
                                </td>
                            </tr>
                            <page-number :data="out_patient" @pagination-change-page="index"></page-number>
                            </tbody>
                        </table>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "OutPatient",
        data(){
            return{
                out_patients: {},
                out_patient: '',

            }
        },
        methods: {

            index(page) {
                this.error = this.out_patients = null;
                this.loading = true;
                axios
                    .get('/data/out_patient?page=' + page)
                    .then(response => {
                        this.loading = false;
                        this.out_patients = response.data;
                    }).catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
            },

                update(){

                }
            },
        created()
            {
                this.index();
                // console.log(self.out_patients)
            }

    }
</script>

<style scoped>

</style>
