<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-6 col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Fill Prescription</h4>
                        <div class="card-tools">
                            <input v-model="srn" class="form-control form-control-navbar" type="text" placeholder="Patient SRN" aria-label="Patient SRN">
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="input-group mb-3">
                                <input v-model="drugName" type="text" class="form-control" placeholder="Drug Name" aria-label="Drug Name" aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary bg-health  text-white" type="button" id="button-addon2" @click="addDrug">Add To List</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <ul class="drug-list">
                                <li class="single-drug" v-for="(drug, index) in drugArray">
                                   <div class="col-sm-10 col-md-10 col-lg-10">
                                       <p>{{drug}}</p>
                                   </div>

                                    <div class="col-sm-2 col-md-2 col-lg-2">
                                        <button class="to-remove btn btn-sn" @click="removeDrug(index)"><i class="fas fa-times text-danger"></i></button>
                                    </div>
                                </li>
                            </ul>

                        </div>
                        <button v-if="this.drugArray.length > 0 && this.srn !== ''" class="bg-health btn text-white" @click="addPrescription">Submit</button>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-6 col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Load Prescription</h4>

                        <div class="card-tools">
                            <div class="input-group input-group-sm">
                                <form class="form-inline ml-3" @submit.prevent="getPrescription" ref="form">
                                    <div class="input-group input-group-sm">
                                        <input v-model="prescription_code" class="form-control form-control-navbar" type="text" placeholder="Prescription Code" aria-label="search">

                                        <div class="input-group-append">
                                            <button class="btn btn-navbar bg-health" type="submit">
                                                <i class="fas fa-search text-white"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row table table-responsive table-borderless">
                            <!--<b-table striped hover :items="items" :fields="fields"></b-table>-->
                            <bootstrap-table :data="prescriptions" :options="presOptions" :columns="presColumns" sticky-header responsive table-borderless />
                        </div>
                        <br>
                        <div class="row table table-responsive">
                            <bootstrap-table :data="drugs" :options="drugOptions" :columns="drugColumns" sticky-header responsive table-borderless />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Prescriptions For A Patient</h4>

                        <div class="card-tools">
                            <div class="input-group input-group-sm">
                                <form class="form-inline ml-3" @submit.prevent="getAllPrescription" ref="form">
                                    <div class="input-group input-group-sm">
                                        <input v-model="patient_srn" class="form-control form-control-navbar" type="text" placeholder="Patient SRN" aria-label="search">

                                        <div class="input-group-append">
                                            <button class="btn btn-navbar bg-health" type="submit">
                                                <i class="fas fa-search text-white"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row table table-responsive table-bordered">

                            <bootstrap-table :data="allPrescription" :options="presOptions" :columns="presColumns" sticky-header responsive table-borderless />
                        </div>
                        <br>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import BootstrapTable from 'bootstrap-table/dist/bootstrap-table-vue.min.js';
    export default {
        components:{ BootstrapTable },
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
                           Swal.fire(
                                'Warning',
                                'Patient SRN Does Not Exist In Our Database',
                                'warning'
                            );
                            return;
                        }

                        if(response.data === 'no prescription'){
                            Swal.fire(
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
                            Swal.fire(
                                'Error',
                                'Patient SRN Does Not Exist In Our Database',
                                'warning'
                            );
                            return;
                        }
                        this.allData = response.data;
                        this.prescriptions = this.allData.prescription;
                        this.drugs = this.allData.drugs;
                        Swal.fire(
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
