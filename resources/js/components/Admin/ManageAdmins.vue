<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-center">Administrators</h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm">
                                <a href="#" @click="downloadExcel()" class="btn btn-success"><i class="fas fa-download"></i></a>
                                <button class="btn btn-primary btn-sm mr-2" title="Download template" @click="downloadExcel()"><i class="fas fa-download"></i></button>
                                <button class="btn btn-success btn-sm" title="Add new User" data-toggle="modal" data-target="#adminUserModal"><i class="fas fa-plus"></i></button>
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
        <div class="modal" id="adminUserModal" tabindex="-1" role="dialog" aria-labelledby="adminUserModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" v-on:click="submitUser()">Upload Users</button>
                    </div>
                </div>
            </div>
        </div>
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
            'vb-modal': VBModal,
        },
        data(){
            return{
                admins: {},
                admin: '',
                file: '',
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
            submitUser(){
                //Initialize the form data
                let formData = new FormData();

                 //Add the form data we need to submit
                formData.append('file', this.file);

                  //Make the request to the POST /single-file URL
                axios.post( '/api/user',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                        }
                    }
                ).then(function(){
                    console.log('SUCCESS!!');
                })
                    .catch(function(){
                        console.log('FAILURE!!');
                    });
            },
            downloadExcel(){
                let filename = 'adminTemplate.xlsx';
                axios.get('api/data/download-excel/admin', {responseType: 'arraybuffer'})
                    .then(response => {
                        this.downloadFile(response, filename);
                        console.log(response);
                    }).catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
            },


             downloadFile(response, filename) {
                    // It is necessary to create a new blob object with mime-type explicitly set
                    // otherwise only Chrome works like it should
                    var newBlob = new Blob([response.data], {type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'});

                    // IE doesn't allow using a blob object directly as link href
                    // instead it is necessary to use msSaveOrOpenBlob
                    if (window.navigator && window.navigator.msSaveOrOpenBlob) {
                        window.navigator.msSaveOrOpenBlob(newBlob);
                        return;
                    }

                    // For other browsers:
                    // Create a link pointing to the ObjectURL containing the blob.
                    const data = window.URL.createObjectURL(newBlob);
                    var link = document.createElement('a');
                    link.href = data;
                    link.download = filename;
                    link.click();
                },

            handleFileUpload(){this.file = this.$refs.file.files[0];},

        },
        created()
        {
            this.index();
        }
    }

</script>

<style scoped>

</style>
