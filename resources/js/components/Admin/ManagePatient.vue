<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Out Patients</h3>

                        <div class="card-tools">

                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive table-striped p-0">
                        <bootstrap-table :data="out_patients" :options="myOptions" :columns="myColumns"/>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

    </div>
</template>

<script>
    import BootstrapTable from 'bootstrap-table/dist/bootstrap-table-vue.min.js'
    export default {
        name: "OutPatient",
        components: {
            'bootstrap-table': BootstrapTable
        },
        data(){
            return{
                form: new Form({
                    last_name: '',
                    first_name: '',
                    other_name: '',
                    email: '',
                    role: 'out_patient',
                }),
                out_patients: {},
                out_patient: '',
                myOptions: {
                    search: true,
                    pagination: true,
                    showColumns: true,
                    showPrint: true,
                    showExport: true,
                    filterControl: true,
                    toolbar: '#toolbar',
                    clickToSelect: true,
                    idField: 'id',
                    selectItemName: 'id',
                    dataShowPaginationSwitch: "true",
                    index:true

                },
                myColumns: [
                    { field: 'id', title: 'ID', sortable: true, class: 'd-none'},
                    { title: 'SRN', formatter: function(row, cell, index){
                            return `<p>${index+1}</p>`;
                        }},
                    { field: 'userable.full_name', title: 'Name', sortable: true},
                    { field: 'email', title: 'Email', sortable: true},
                    { field: 'dob', title: 'Date Of Birth', sortable: true},
                    { field: 'gender', title: 'Gender', sortable: true},
                    { field: 'phone_number', title: 'Phone Number', sortable: true},
                    { field: 'location', title: 'Location', sortable: true},
                    { field: 'active', title: 'Active', sortable: true},
                    {
                        field: 'action',
                        title: 'Actions',
                        align: 'center',
                        clickToSelect: false,
                        formatter: function (e, value, row){
                            return `<a class="btn btn-sm edit" title="Activate"><i class="fas fa-check text-success"></i></a> <a class="btn btn-sm show" title="Deactivate"><i class="fas fa-trash text-danger"></i></a>`;
                        },
                        events: {
                            'click .show': function (e, value, row){
                                /* return window.location.assign('/admin/show/'+row.id)*/
                                Fire.$emit('deactivateUser', row);
                            },
                            'click .edit': function (e, value, row){
                                /* return window.location.assign('/admin/show/'+row.id)*/
                                Fire.$emit('activateUser', row);

                            },
                            'click .destroy': function (e, value, row){
                                Swal.fire({
                                    title: 'Are you sure?',
                                    text: "You won't be able to revert this!",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Yes, delete it!'
                                }).then((result) => {
                                    if (result.value) {
                                        axios.delete('/data/out_patient/' + row.id).then((response) => {
                                            if(response.data === "success")
                                            {
                                                Fire.$emit('tableUpdate');
                                                Swal.fire(
                                                    'Deleted!',
                                                    'User Deleted Successfully',
                                                    'success'
                                                );

                                            }
                                            else{
                                                Swal.fire(
                                                    'Failed!',
                                                    response.data,
                                                    'warning'
                                                )
                                            }
                                        }).catch(() => {
                                            Swal.fire(
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
                ]

            }
        },
        methods: {

            //load all users
            index() {
                this.error = this.out_patients = null;
                this.loading = true;
                axios
                    .get('/data/out_patient')
                    .then(response => {
                        this.loading = false;
                        this.out_patients = response.data;
                    }).catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
            },


            updateStatus(id, active){

                this.statusForm.append('active', active);
                axios.post(`/data/user/status-update/${id}`, this.statusForm)
                    .then((res) => {
                        Swal.fire(
                            'Update',
                            res.data,
                            'success'
                        );
                    })
                    .catch((error) => {
                        console.log(error.message);
                    })
            }
        },
        created()
        {
            //load all data
            this.index();

            //listen to event and fire this function
            Fire.$on('tableUpdate', () => {
                this.index();
            });

            Fire.$on('deactivateUser', (row) => {
                if(row.active === true){
                    this.updateStatus(row.id, 'deactivate')
                }
                this.index();
            });

            Fire.$on('activateUser', (row) => {
                if(row.active === false){
                    this.updateStatus(row.id, 'activate')
                }
                this.index();
            });
        },
        mounted() {
            Echo.private('adminChannel')
                .listen('NewUser', (e) => {
                    this.index();
                });
        }

    }
</script>

<style scoped>

</style>
