<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-center">Administrators</h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm">
                                <!--<button class="btn btn-danger btn-sm mr-2" title="Download template" @click="downloadExcel"><i class="fas fa-download"></i></button>
                                <button class="btn btn-success btn-sm mr-2" title="Add Bulk Users" data-toggle="modal" data-target="#adminUserModalBulk"><i class="fas fa-file-excel"></i></button>-->
                                <button class="btn btn-primary btn-sm mr-2" title="Add New User" data-toggle="modal" data-target="#adminUserModal"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table table-responsive table-striped p-0">
                        <bootstrap-table :data="admins" :options="myOptions" :columns="myColumns" sticky-header responsive />
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!--Bulk upload modal-->
        <div class="modal" id="adminUserModalBulk" tabindex="-1" role="dialog" aria-labelledby="adminUserModalBulkLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title">Upload Administrators</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="file" name="file" ref="file" v-on:change="handleFileUpload"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" v-on:click="submitUser">Upload <i class="fas fa-user-plus"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- form modal Add User -->
        <div class="modal" id="adminUserModal" tabindex="-1" role="dialog" aria-labelledby="adminUserModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title">Add Administrators</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="createUser">
                    <div class="modal-body">
                        <div class="form-group">
                        <label>Last Name</label>
                        <input v-model="form.last_name" type="text" name="last_name"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('last_name') }">
                        <has-error :form="form" field="last_name"></has-error>
                        </div>
                        <div class="form-group">
                        <label>First Name</label>
                        <input v-model="form.first_name" type="text" name="first_name"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('first_name') }">
                        <has-error :form="form" field="first_name"></has-error>
                        </div>
                        <div class="form-group">
                        <label>Other Name</label>
                        <input v-model="form.other_name" type="text" name="other_name"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('other_name') }">
                        <has-error :form="form" field="other_name"></has-error>
                        </div>
                        <div class="form-group">
                        <label>Email</label>
                        <input v-model="form.email" type="email" name="email"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                        <has-error :form="form" field="email"></has-error>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" @click="resetModalForm">Close</button>
                        <button type="submit" class="btn btn-success">Add <i class="fas fa-upload"></i></button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import BootstrapTable from 'bootstrap-table/dist/bootstrap-table-vue.min.js';
    import { BModal, VBModal } from 'bootstrap-vue';


    export default {
        props: {},
        name: "Admin",
        components: {
            'bootstrap-table': BootstrapTable,
             'b-modal': BModal,
            'vb-modal': VBModal,

        },
        data(){
            return{
                form: new Form({
                    last_name: '',
                    first_name: '',
                    other_name: '',
                    email: '',
                    role: 'admin',
                }),
                statusForm: new FormData(),

                props: {
                    adminShow: {}
                },
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
                    { field: 'index', title: 'ID', formatter: function(row, cell, index){
                            return `<p>${index+1}</p>`;
                        }},
                    { field: 'id', title: 'ID', sortable: true,  class: 'd-none'},
                    { field: 'active', title: 'Active', sortable: true},
                    { field: 'userable.full_name', title: 'Name', sortable: true},
                    { field: 'userable.email', title: 'Email', sortable: true},
                    { field: 'userable.dob', title: 'Date Of Birth', sortable: true},
                    { field: 'userable.gender', title: 'Gender', sortable: true},
                    { field: 'userable.phone_number', title: 'Phone Number', sortable: true},
                    {
                        field: 'action',
                        title: 'Actions',
                        align: 'center',
                        clickToSelect: false,
                        render: function(e, value, row){},
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
                                    axios.delete('/data/admin/' + row.id).then((response) => {
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
                ],


            }
        },
        methods: {
            createUser(){
               this.$Progress.start();
               this.form.post('/data/admin')
               .then((response)=>{
                  if(response.data === 'success'){
                      $('#adminUserModal').modal('hide');
                      Fire.$emit('tableUpdate');
                      Swal.fire({
                          toast: true,
                          position: 'top-end',
                          showConfirmButton: false,
                          timer: 3000,
                          timerProgressBar: true,
                          onOpen: (toast) => {
                              toast.addEventListener('mouseenter', Swal.stopTimer);
                              toast.addEventListener('mouseleave', Swal.resumeTimer);},
                          icon: 'success',
                          title: 'User Added Successfully'
                      });

                      this.$Progress.finish();
                  }
                  else{
                      Swal.fire({
                          toast: true,
                          position: 'top-end',
                          showConfirmButton: false,
                          timer: 3000,
                          timerProgressBar: true,
                          onOpen: (toast) => {
                              toast.addEventListener('mouseenter', Swal.stopTimer);
                              toast.addEventListener('mouseleave', Swal.resumeTimer);
                          },
                          icon: 'error',
                          title: 'Error Saving Records'
                      });
                  }

               })
               .catch(error => {
                   this.loading = false;
                   this.error = error.response.message || error.message;
               });
            },

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
            handleIncoming(user){
                this.admins.push(user);
            },

            update(){

            },
            handleFileUpload(){this.file = this.$refs.file.files[0];},
            submitUser(){
                this.$Progress.start();
                //Initialize the form data
                let formData = new FormData();

                 //Add the form data we need to submit
                formData.append('file', this.file);

                  //Make the request to the POST /single-file URL
                axios.post( '/data/user',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                        }
                    }
                ).then(function(){
                    console.log('SUCCESS!!');
                    this.$Progress.finish();
                    toast({
                        type: 'success',
                        title: 'Records Uploaded Successfully'
                    });
                })
                    .catch(function(){
                        console.log('FAILURE!!');
                        this.$Progress.fail();
                    });
                $('#adminUserModalBulk').modal('hide');


            },
            downloadExcel(){
                let filename = 'adminTemplate.xlsx';
                axios.get('/data/excelDownload/admin', {responseType: 'arraybuffer'})
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

            editUser(row){
              this.form.fill(row);
                $('#adminUserModal').modal('show');
            },
            resetModalForm(){
                this.form.reset();
            },

            updateStatus(id, active){
                this.statusForm.append('active', active);
                axios.put(`/data/user/status-update/${id}`, this.statusForm)
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
            },



        },
        created()
        {
            this.index();

        },
        mounted() {
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

            Echo.private('adminChannel')
                .listen('NewUser', (e) => {
                    this.index();
                });

            Fire.$on('editUser', (row) => {
                this.editUser(row);
            });
        }
    }

</script>

<style scoped>

</style>
