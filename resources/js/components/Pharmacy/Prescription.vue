<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
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
                            <table class="table table-striped table-dark">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Prescription Code</th>
                                    <th scope="col">Patient's Name</th>
                                    <th scope="col">Doctor's Name</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Drugs</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(pres, index) in myPrescription.data" :key="pres.id">
                                    <th scope="row">{{index + 1}}</th>
                                    <td>{{pres.prescription_code}}</td>
                                    <td>{{pres.out_patient.full_name}}</td>
                                    <td>{{pres.doctor.full_name}}</td>
                                    <td>{{pres.created_at | myDate}}</td>
                                    <td>
                                        <table class="table table-striped table-dark">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Drug Name</th>
                                                <th scope="col">Dispensed</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(drug, index) in pres.drugs" :key="drug.id">
                                                <th scope="row">{{index + 1}}</th>
                                                <td>{{drug.name}}</td>
                                                <td>{{drug.dispensed}}</td>
                                                <td>
                                                    <a v-if="drug.dispensed === 'No'" href="#" class="btn btn-warning btn-sm" title="Mark As Dispensed" @click.prevent="dispense(drug)"><i class="fas fa-edit text white"></i></a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <pagination :data="myPrescription" @pagination-change-page="getResults">

                        </pagination>
                    </div>
                </div>
            </div>
        </div>


    </div>
</template>

<script>
    export default {
        name: "prescription",
        data(){
            return{
                myPrescription:{},
                pres:'',
                drug:'',
                prescription_code: '',
            }
        },
        methods:{
            getPrescription(){
                axios
                    .get(`/records/prescription`)
                    .then((response) => {
                        this.myPrescription = response.data;
                    })
            },



            dispense(drug){
                Swal.fire({
                    title: 'Dispense Drug',
                    text: "You are about to set " + drug.name + " as dispensed",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Dispense Drug!'
                }).then((result) => {
                    if (result.value) {
                        axios.put(`/records/drug/dispense/${drug.id}`).then((response) => {
                            if(response.data === "success")
                            {
                                Fire.$emit('tableUpdate');
                                Swal.fire(
                                    'Process Complete',
                                    'Drug Status Now Set As Dispensed',
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
                                'Process Could Not Be Completed.',
                                'warning'
                            )
                        });
                    }

                });
            },

        },
        created() {


        }
    }
</script>

<style scoped>

</style>
