<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Administrators</h3>

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
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr v-for="admin in admins" v-bind:key="admin.id">
                                <td>{{admin.id}}</td>
                                <td v-if="admin.other_name !== null ">{{admin.first_name +' '+ admin.other_name + ' ' + admin.last_name}}</td>
                                <td v-else>{{admin.first_name + ' ' + admin.last_name}}</td>
                                <td>{{admin.email}}</td>
                                <td>{{admin.dob}}</td>
                                <td>{{admin.gender}}</td>
                                <td>{{admin.phone_number}}</td>
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
                    { field: 'name', title: 'Name', sortable: true, filterControl: 'input' },
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
                            return '<button class="btn btn-sm btn-info mr-1 show"><i class="fas fa-eye"></i></button><button class="btn btn-sm btn-warning mr-1 edit"><i class="fas fa-edit"></i></button><button class="btn btn-sm btn-danger mr-1 destroy"><i class="fas fa-trash"></i></button>'
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
