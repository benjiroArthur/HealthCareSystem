<template>
    <div class="card-body">
        <div class="row">
            <bootstrap-table :data="prescriptions" :options="presOptions" :columns="presColumns" sticky-header responsive table-borderless />
        </div>
        <div class="row">
            <bootstrap-table :data="drugs" :options="drugOptions" :columns="drugColumns" sticky-header responsive table-borderless />
        </div>
    </div>
</template>

<script>
    import BootstrapTable from 'bootstrap-table/dist/bootstrap-table-vue.min.js';
    export default {
        name: "LoadPrescription",
        components: {
            'bootstrap-table': BootstrapTable,
        },
        props:{
            prescriptions: {
                type: Object,
                default: null,
            },
            drugs: {
                type: Object,
                default: null,
            },
        },
        data(){
          return{
              presOptions: {
                  pagination: true,
                  clickToSelect: true,
                  idField: 'id',
                  selectItemName: 'id',

              },
              presColumns: [
                  { field: 'prescription_code', title: 'Prescription Code'},
                  { field: 'doctor.full_name', title: 'Doctor\'s Name'},
                  { field: 'out_patient.full_name', title: 'Patient\'s Name'},
              ],

              drugOptions: {
                  pagination: true,
                  clickToSelect: true,
                  idField: 'id',
                  selectItemName: 'id',

              },
              drugColumns: [
                  { field: 'name', title: 'Drug'},
                  { field: 'dispensed', title: 'Dispensed', render: function(e, value, row){
                      if(value === true){
                          return 'Yes';
                      }
                      else{
                          return 'No';
                      }
                      }},
              ],
          }
        },
    }
</script>

<style lang="scss" scoped>
    .drug-list{
        list-style: none;
        padding: 5px;
    li{
        display: inline-flex;
        width: 100%;
        align-content: space-between;
    span .to-remove{
        position: absolute;
        right: 2px;
        text-align: right;
        float: right;

    }
    }
    }
</style>
