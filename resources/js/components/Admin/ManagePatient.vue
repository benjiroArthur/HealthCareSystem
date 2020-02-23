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
                    dataShowPaginationSwitch: "true"

                },
                myColumns: [
                    { field: 'id', title: 'ID', sortable: true, visible: "false"},
                    { field: 'srn', title: 'SRN', sortable: true},
                    { field: 'userable.full_name', title: 'Name', sortable: true, filterControl: 'input' },
                    { field: 'email', title: 'Email', sortable: true, filterControl: 'input'},
                    { field: 'dob', title: 'Date Of Birth', sortable: true, filterControl: 'input'},
                    { field: 'gender', title: 'Gender', sortable: true, filterControl: 'input'},
                    { field: 'phone_number', title: 'Phone Number', sortable: true, filterControl: 'select'},
                    { field: 'location', title: 'Location', sortable: true, filterControl: 'select'},
                    {
                        field: 'action',
                        title: 'Actions',
                        align: 'center',
                        width: '140px',
                        clickToSelect: false,
                        formatter: function (e, value, row){
                            return '<a class="btn btn-sm show"><i class="fas fa-eye text-info"></i></a><a class="btn btn-sm edit"><i class="fas fa-edit text-warning"></i></a><a class="btn btn-sm destroy"><i class="fas fa-trash text-danger"></i></a>'
                        },
                        events: {
                            'click .show': function (e, value, row){
                                return window.location.assign('/posts/'+row.id)
                            },
                            'click .edit': function (e, value, row){
                                return window.location.assign('/posts/'+row.id+'/edit')
                            },
                            'click .destroy': function (e, value, row){
                                axios.delete('/posts/'+row.id, {
                                    id: row.id
                                });

                                return window.location.replace('/assign-posts/posts.index')
                            },
                        }
                    }
                ]

            }
        },
        methods: {

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
