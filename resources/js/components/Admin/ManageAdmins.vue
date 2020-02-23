<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-center">Administrators</h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm">
                                <button class="btn btn-primary btn-sm mr-2" title="Download template" @click="downloadExcel"><i class="fas fa-download"></i></button>
                                <button class="btn btn-success btn-sm" title="Add new User" @click="showModal"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <bootstrap-table :data="admins" :options="myOptions" :columns="myColumns"/>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <b-modal ref="addAdmin-modal" hide-footer title="Using Component Methods">
            <div class="d-block text-center">
                <h3>Bulk Upload Users</h3>
            </div>
            <div>

                    <div class="form-group">
                        <input v-model="form.file" type="file" name="file"
                               class="form-control" :class="{ 'is-invalid': form.errors.has('file') }">
                        <has-error :form="form" field="file"></has-error>

                    </div>
                    <b-button class="mt-3 btn btn-success" variant="outline-success" block @click="submitUser">Upload File</b-button>
                    <b-button class="mt-3 btn btn-dander" variant="outline-danger" block @click="hideModal">Cancel</b-button>
            </div>

        </b-modal>
    </div>
</template>

<script>
    import BootstrapTable from 'bootstrap-table/dist/bootstrap-table-vue.min.js';
    import { BModal, VBModal } from 'bootstrap-vue';

    export default {
        name: "Admin",
        components: {
            'bootstrap-table': BootstrapTable,
             'b-modal': BModal,
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
                    { field: 'id', title: 'ID', sortable: true,  class: 'd-none'},
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
                            return '<a class="btn btn-sm show"><i class="fas fa-eye text-info"></i></a><a class="btn btn-sm edit"><i class="fas fa-edit text-yellow"></i></a><a class="btn btn-sm destroy"><i class="fas fa-trash text-danger"></i></a>'
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
                ],
                uploadForm: new Form({
                        file: '',
                }),

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

            },
            showModal() {
                this.$refs['addAdmin-modal'].show()
            },
            hideModal() {
                this.$refs['addAdmin-modal'].hide()
            },
            submitUser(){},
            downloadExcel(){},

        },
        created()
        {
            this.index();
        }
    }

</script>

<style scoped>

</style>
