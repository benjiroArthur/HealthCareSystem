<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Out Patients</h3>
<p>{{idname}}</p>
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
<!--
<!--                            <tr>-->
                            <tr v-for="out_patient in out_patients" v-bind:key="out_patient.id">
                                <td>{{out_patient.id}}</td>
                                <td>{{out_patient.first_name}}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
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
        name: "OutPatient",
        data(){
            return{
                out_patients: {},
                idname : ''
            }
        },
        methods: {
               index(){
                     axios.get('/data/out_patient')
                         .then(({data}) =>
                             (this.out_patients = data.data,
                                     this.idname = data.data['first_name']
                             ));

               },
                update(){

                }
            },
        mounted()
            {
                this.index();
            }

    }
</script>

<style scoped>

</style>
