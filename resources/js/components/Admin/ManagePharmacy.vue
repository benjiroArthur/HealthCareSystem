<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pharmacies</h3>

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
                                <th>Phone Number</th>
                                <th>Location</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr v-for="pharmacy in pharmacies" v-bind:key="pharmacy.id">
                                <td>{{pharmacy.id}}</td>
                                <td>{{pharmacy.pharmacy_name }}</td>
                                <td>{{pharmacy.email}}</td>
                                <td>{{pharmacy.phone_number}}</td>
                                <td>{{pharmacy.location}}</td>
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
        name: "Pharmacy",
        data(){
            return{
                pharmacies: {},
                pharmacy: '',

            }
        },
        methods: {

            index() {
                this.error = this.pharmacies = null;
                this.loading = true;
                axios
                    .get('/data/pharmacy')
                    .then(response => {
                        this.loading = false;
                        this.pharmacies = response.data;
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
