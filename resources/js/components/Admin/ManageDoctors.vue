<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Doctors</h3>

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
                                <th>Specialization</th>
                                <th>Qualification</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr v-for="doctor in doctors" v-bind:key="doctor.id">
                                <td>{{doctor.id}}</td>
                                <td v-if="doctor.other_name !== null ">{{doctor.first_name +' '+ doctor.other_name + ' ' + doctor.last_name}}</td>
                                <td v-else>{{doctor.first_name + ' ' + doctor.last_name}}</td>
                                <td>{{doctor.email}}</td>
                                <td>{{doctor.dob}}</td>
                                <td>{{doctor.gender}}</td>
                                <td>{{doctor.phone_number}}</td>
                                <td>{{doctor.location}}</td>
                                <td>{{doctor.specialization}}</td>
                                <td>{{doctor.qualification}}</td>
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
                            <!--                            @php($id++)-->
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
        name: "Doctor",
        data(){
            return{
                doctors: {},
                doctor: '',

            }
        },
        methods: {

            index() {
                this.error = this.doctors = null;
                this.loading = true;
                axios
                    .get('/data/doctor')
                    .then(response => {
                        this.loading = false;
                        this.doctors = response.data;
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
        }
    }
</script>

<style scoped>

</style>
