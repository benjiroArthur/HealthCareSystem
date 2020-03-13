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
                                <td>{{doctor.full_name}}</td>
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
                    .get('/data/admin')
                    .then(response => {
                        this.loading = false;
                        this.doctors = response.data;
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
