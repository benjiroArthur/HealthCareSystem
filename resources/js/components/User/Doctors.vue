<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12 c0l-sm-12">
                <div class="card">
                    <div class="card-header">List Of Doctors</div>

                    <div class="card-body">
                        <!--<table class="table table-hover">
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

                            <tr v-for="(doctor, index) in doctors" :key="doctor.id">
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

                            </tbody>
                        </table>-->
                        <bootstrap-table :data="doctors" :options="myOptions" :columns="myColumns"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import BootstrapTable from 'bootstrap-table/dist/bootstrap-table-vue.min.js';

    export default {
        name:'Doctors',
        components: {
            'bootstrap-table': BootstrapTable,
        },
        data(){
            return{
                doctors: null,
                doctor:'',
                //table
                myOptions: {
                    search: true,
                    pagination: true,
                    showColumns: true,
                    filterControl: true,
                    toolbar: '#toolbar',
                    clickToSelect: true,
                    idField: 'id',
                    selectItemName: 'id',
                    per_page:[10,25,50],

                },
                myColumns: [
                    { field: 'key', title: 'ID', formatter: function(row, cell, index){

                            return `<p>${index+1}</p>`;
                        }},
                    { field: 'id', title: 'ID', sortable: true,  class: 'd-none'},
                    { field: 'userable.full_name', title: 'Name', sortable: true},
                    { field: 'userable.srn', title: 'Doctor ID', sortable: true},
                    { field: 'userable.gender', title: 'Gender', sortable: true},
                    { field: 'userable.specialization', title: 'Specialization', sortable: true},
                    {
                        field: 'action',
                        title: 'Actions',
                        align: 'center',
                        clickToSelect: false,
                        formatter: function (e, value, row){
                            return '<a class="btn btn-sm btn-primary add" title="Add to contact"><i class="fas fa-plus text-white"></i></a><a class="btn btn-sm destroy btn-danger" title="remove from contact" @click=""><i  class="fas fa-trash text-white"></i></a>'
                        },
                        events: {
                            'click .add': function (e, value, row){
                                swal.fire({
                                    title: 'Add To Contact',
                                    text: "You are about to add this doctor to your contact list",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Yes, Add To Contact!'
                                }).then((result) => {
                                    if (result.value) {
                                        axios.post('/records/friends', row).then((response) => {
                                            if(response.data === "success")
                                            {
                                                Fire.$emit('tableUpdate');
                                                swal.fire(
                                                    'Process Complete',
                                                    'You Can Now Chat With This Doctor',
                                                    'success'
                                                );

                                            }
                                            else{
                                                swal.fire(
                                                    'Failed!',
                                                    response.data,
                                                    'warning'
                                                )

                                            }
                                        }).catch(() => {
                                            swal.fire(
                                                'Failed!',
                                                'Process Could Not Be Completed.',
                                                'warning'
                                            )
                                        });
                                    }

                                });

                            },
                            'click .edit': function (e, value, row){
                               /* return window.location.assign('/admin/show/'+row.id)*/

                            },
                            'click .destroy': function (e, value, row){
                                swal.fire({
                                    title: 'Are you sure?',
                                    text: "You won't be able to Chat With this Doctor!",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Yes, delete it!'
                                }).then((result) => {
                                    if (result.value) {
                                        axios.delete('/data/admin/' + row.id).then((response) => {
                                            if(response.data === "success")
                                            {
                                                Fire.$emit('tableUpdate');
                                                swal.fire(
                                                    'Deleted!',
                                                    'User Deleted Successfully',
                                                    'success'
                                                );

                                            }
                                            else{
                                                swal.fire(
                                                    'Failed!',
                                                    response.data,
                                                    'warning'
                                                )
                                            }
                                        }).catch(() => {
                                            swal.fire(
                                                'Failed!',
                                                'User Could Not Be Deleted.',
                                                'warning'
                                            )
                                        });
                                    }

                                });
                            },
                        }
                    }
                ],
            }
        },
        methods: {
            //get all medical records
            index() {
                this.loading = true;
                axios
                    .get('/records/doctor')
                    .then((response) => {
                        this.loading = false;
                        this.doctors = response.data;
                        //this.doctors = data1.userable;
                    }).catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
            },

            /*index() {
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
            },*/
        },
        created() {
            this.index();
        }
    }
</script>
