<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12 c0l-sm-12">
                <div class="card">
                    <div class="card-header">My Medical Records</div>

                    <div class="card-body">
                        <bootstrap-table :data="records" :options="myOptions" :columns="myColumns"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import BootstrapTable from 'bootstrap-table/dist/bootstrap-table-vue.min.js';
    export default {
        name: 'MedicalRecords',
        components: {
            'bootstrap-table': BootstrapTable,
        },
        data(){
            return{
                records:'',
                record:'',
                //table
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
                    per_page:[10,25,50],

                },
                myColumns: [
                    { field: 'key', title: 'ID', formatter: function(row, cell, index){
                            return `<p>${index+1}</p>`;
                    }},
                    { field: 'id', title: 'ID', sortable: true,  class: 'd-none'},
                    { field: 'diagnosis', title: 'Diagnosis', sortable: true},
                    { field: 'heart_rate', title: 'Heart Rate', sortable: true},
                    { field: 'doctor.full_name', title: 'Doctor\'s Name', sortable: true}

                ],
            }
        },
        methods: {
            //get all medical records
            index() {
                this.error = this.records = null;
                this.loading = true;
                axios
                    .get('/records/medical-records')
                    .then(response => {

                        this.records = response.data;
                    }).catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
            },
        },
        created() {
            this.index();
        }
    }
</script>
