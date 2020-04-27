<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">My Prescriptions</h4>

                    </div>
                    <div class="card-body">
                        <div class="row table table-responsive table-borderless">
                            <bootstrap-table :data="allPrescription" :options="presOptions" :columns="presColumns" sticky-header responsive table-borderless />
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import BootstrapTable from 'bootstrap-table/dist/bootstrap-table-vue.min.js';
    import LoadPrescription from '../Doctor/LoadPrescription';
    export default {
        components:{ LoadPrescription, BootstrapTable },
        name: "prescription",
        data(){
            return{
                patient_srn:'',
                allPrescription:{},
                prescription_code: '',
                srn: '',
                drugName: '',
                drugArray: [],
                allData:{},
                prescriptions: {},
                drugs: {},
                presOptions: {
                    clickToSelect: true,
                    idField: 'id',
                    selectItemName: 'id',

                },
                presColumns: [
                    { field: 'prescription_code', title: 'Prescription Code'},
                    { field: 'doctor.full_name', title: 'Doctor\'s Name'},
                    { field: 'out_patient.full_name', title: 'Patient\'s Name'},
                    { field: 'created_at', title: 'Date'},
                ],

                drugOptions: {
                    pagination: true,
                    clickToSelect: true,
                    idField: 'id',
                    selectItemName: 'id',
                    totalRows: 2,

                },
                drugColumns: [
                    { field: 'name', title: 'Drug'},
                    { field: 'dispensed', title: 'Dispensed'},
                ],
            }
        },
        methods:{
            getPrescription(){
              axios
                  .get(`/records/prescription/${this.prescription_code}`)
                  .then((response) => {
                      this.allData = response.data;
                      this.prescriptions = this.allData.prescription;
                      this.drugs = this.allData.drugs;
                  })
            },

            getAllPrescription(){
                if(this.patient_srn === ''){return;}
                this.$Progress.start();
                axios
                    .get(`/records/allPrescription/${this.patient_srn}`)
                    .then((response) => {
                        if(response.data === 'no patient'){
                           swal.fire(
                                'Warning',
                                'Patient SRN Does Not Exist In Our Database',
                                'warning'
                            );
                            return;
                        }

                        if(response.data === 'no prescription'){
                            swal.fire(
                                'Warning',
                                'This Patient Does Not Have Prescriptions Yet',
                                'warning'
                            );
                            return;
                        }

                        this.allPrescription = response.data;
                        this.$Progress.finish();
                    })
                    .catch((error) => {
                        console.log(error.message)
                    })
            },

            addPrescription(){
                if(this.drugArray.length < 1 || this.srn === ''){
                    return;
                }
                this.$Progress.start();

                axios
                    .post('/records/prescription', {
                        srn: this.srn,
                        drugs: this.drugArray
                    })
                    .then((response) => {
                        if(response.data === 'error'){
                            swal.fire(
                                'Error',
                                'Patient SRN Does Not Exist In Our Database',
                                'warning'
                            );
                            return;
                        }
                        this.allData = response.data;
                        this.prescriptions = this.allData.prescription;
                        this.drugs = this.allData.drugs;
                        swal.fire(
                            'Success',
                            'Prescription Added Successfully',
                            'success'
                        );
                    })
                    .catch((error) => {
                        console.log(error.data)
                    })
            },
            addDrug(){
              if(this.drugName === ''){
                  return;
              }
              this.drugArray.push(this.drugName);
                this.drugName = '';
            },
            removeDrug(index){
                this.$delete(this.drugArray, index);
            },
        },
    }
</script>

<style lang="scss" scoped>
    ul.drug-list{
        list-style: none;
        width: 100%;

        li.single-drug{
            display: inline-flex;
            width: 100%;
        }
    }
</style>
