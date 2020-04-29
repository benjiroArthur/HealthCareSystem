<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12 c0l-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Search Medical Records</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm">
                                <form class="form-inline ml-3  mr-5" @submit.prevent="getRecords" ref="form">
                                    <div class="input-group input-group-sm">
                                        <input v-model="srnn" class="form-control form-control-navbar" type="text" placeholder="Patient SRN" aria-label="search">

                                        <div class="input-group-append">
                                            <button class="btn btn-navbar bg-health" type="submit">
                                                <i class="fas fa-search text-white"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <button class="btn btn-primary btn-sm mr-2 bg-health" title="Add New Record" data-toggle="modal" data-target="#medicalRecordsModal">New Record <i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body table table-responsive table-striped p-0">
                        <bootstrap-table :data="medicalRecords" :options="myOptions" :columns="myColumns" sticky-header responsive />
                    </div>
                </div>
            </div>
        </div>
        <!-- form modal Add User -->
        <div class="modal" id="medicalRecordsModal" tabindex="-1" role="dialog" aria-labelledby="medicalRecordsModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title">Add Administrators</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="createRecord">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Patient Serial Number</label>
                                <input v-model="form.srn" type="text" name="srn" placeholder="HC-PT-0000"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('srn') }">
                                <has-error :form="form" field="srn"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Diagnosis</label>
                                <textarea name="diagnosis" v-model="form.diagnosis" cols="30" rows="10" class="form-control"
                                          :class="{ 'is-invalid': form.errors.has('diagnosis') }">
                                </textarea>
                                <has-error :form="form" field="diagnosis"></has-error>

                            </div>
                            <div class="form-group">
                                <label>Heart Rate <span class="text-sm"> Optional</span></label>
                                <input v-model="form.heart_rate" type="text" name="heart_rate"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('heart_rate') }">
                                <has-error :form="form" field="heart_rate"></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
        components: {
            'bootstrap-table': BootstrapTable,
            'b-modal': BModal,
            'vb-modal': VBModal,

        },
        data(){
            return{
                medicalRecords: {},
                srnn: '',
                form: new Form({
                    srn:'',
                    diagnosis:'',
                    heart_rate:''
                }),

                myOptions: {
                    pagination: true,
                    clickToSelect: true,
                    idField: 'id',
                    selectItemName: 'id',

                },
                myColumns: [
                    { field: 'index', title: 'ID', formatter: function(row, cell, index){
                            return `<p>${index+1}</p>`;
                        }},
                    { field: 'id', title: 'ID', sortable: true,  class: 'd-none'},
                    { field: 'out_patient.full_name', title: 'Patient', sortable: true},
                    { field: 'doctor.full_name', title: 'Doctor', sortable: true},
                    { field: 'diagnosis', title: 'Diagnosis', sortable: true},
                    { field: 'heart_rate', title: 'Heart Rate', sortable: true},
                    { field: 'created_at', title: 'Date', sortable: true},
                    {
                        field: 'action',
                        title: 'Actions',
                        align: 'center',
                        clickToSelect: false,
                        render: function(e, value, row){},
                        formatter: function (e, value, row){

                            return '<a class="btn btn-sm show" data-toggle="modal" data-target="#"><i class="fas fa-eye text-info"></i></a>'
                        },
                        events: {
                            'click .show': function (e, value, row){
                                return window.location.assign('/admin/show/'+row.id)

                            },
                            'click .edit': function (e, value, row){
                                return window.location.assign('/admin/show/'+row.id)

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
        methods:{
            getRecords(){
                if(this.srnn === ''){
                    return;
                }
                this.$Progress.start();
                axios
                    .get('/records/medical-records/patient/'+ this.srnn)
                    .then(response => {
                        this.loading = false;
                        this.medicalRecords = response.data;

                    }).catch(error => {
                    this.$Progress.finish();
                    this.error = error.response.data.message || error.message;
                });
            },
            createRecord(){

                this.$Progress.start();
                this.form.post('/records/medical-records')
                    .then((response) => {
                        if(response.data === 'error'){
                            Swal.fire(
                                'Failed!',
                                'Patient Does Not Exist In Our Records',
                                'warning'
                            )
                        }
                        else{
                            $('#medicalRecordsModal').modal('hide');
                            this.form.reset();
                            this.medicalRecords = response.data;
                            //console.log(response.data);

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
                                title: 'Medical Record Added Successfully'
                            });
                            Fire.$emit('tableUpdate');
                            this.$Progress.finish();
                        }

                    })
                    .catch(error => {
                        this.loading = false;
                        this.error = error.response.message || error.message;
                    });
            },
        },
        created(){

        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
