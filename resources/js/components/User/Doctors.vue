<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12 c0l-sm-12">
                <div class="card">
                    <div class="card-header">List Of Doctors</div>

                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Location</th>
                                <th>Specialization</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr v-for="(doctor, index) in doctors" v-bind:key="doctor.id">
                                <td>{{index + 1}}</td>
                                <td>{{doctor.full_name}}</td>
                                <td>{{doctor.specialization}}</td>
                                <td>{{doctor.gender}}</td>
                                <td>{{doctor.location}}</td>
                                <td>
                                    <a href="#">
                                        <i class="fa fa-user-plus blue"></i>
                                    </a>
                                    |
                                    <a href="#">
                                        <i class="fa fa-user-minus red"></i>
                                    </a>
                                </td>
                            </tr>
                            <!--                            @php($id++)-->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name:'Doctors',
        data(){
            return{
                doctors:'',
                doctor:''
            }
        },
        methods: {
            //get all medical records
            index() {

                this.error = this.doctors = null;
                this.loading = true;
                axios
                    .get('/records/doctor')
                    .then(response => {
                        this.loading = false;
                        let data1 = response.data;
                        this.doctors = data1.userable;
                    }).catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
            },
        },
        created() {
            this.index();
        }
    }
</script>
