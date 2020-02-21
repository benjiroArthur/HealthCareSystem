<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h3 class="card-title text-center">Administrators</h3>
                        <div id="toolbar">
                            <a href="" class="btn btn-primary"><i class="fas fa-list-alt"></i> View All</a>
                            <button class="btn btn-success" @click="checkPosts('restore')"><i class="fas fa-trash-restore"></i> Restore Selected</button>
                            <button class="btn btn-danger" @click="checkPosts('delete')"><i class="fas fa-times-circle"></i> Delete Permanently</button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <bootstrap-table :data="admins" :options="myOptions" :columns="myColumns" class="table-responsive"/>

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
        name: "Admin",
        components: {
            'bootstrap-table': BootstrapTable
        },
        data(){
            return{
                admins: {},
                admin: '',
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

                },
                myColumns: [
                    { field: 'id', title: 'ID', sortable: true},
                    { field: 'ids', title: 'ID', sortable: true},
                    { field: 'userable.full_name', title: 'Name', sortable: true, filterControl: 'input' },
                    { field: 'email', title: 'Email', sortable: true, filterControl: 'input'},
                    { field: 'dob', title: 'Date Of Birth', sortable: true, filterControl: 'input'},
                    { field: 'gender', title: 'Gender', sortable: true, filterControl: 'input'},
                    { field: 'phone_number', title: 'Phone Number', sortable: true, filterControl: 'select'},
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
                this.error = this.admins = null;
                this.loading = true;
                axios
                    .get('/data/admin')
                    .then(response => {
                        this.loading = false;
                        this.admins = response.data;
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
