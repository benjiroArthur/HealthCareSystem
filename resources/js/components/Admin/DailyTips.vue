<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12 c0l-sm-12">
                <div class="card">
                    <div class="card-header">Daily Tips</div>

                    <div class="card-body">
                        <form @submit.prevent="storeTip" ref="form">
                            <div class="row">
                                <div class="col-10">
                                    <div class="form-group"><textarea v-model="form.info" name="info" class="form-control" cols="8" placeholder="Daily Tip"></textarea></div>

                                </div>
                                <div class="col-2">
                                    <button type="submit" class="btn btn-success bg-health newBtn">Submit <i class="fas fa-upload"></i></button>
                                    <button type="button" class="btn btn-primary d-none editBtn" @click="updateTip">Update <i class="fas fa-upload"></i></button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12 c0l-sm-12">
                <div class="card">
                    <div class="card-header">All Tips</div>

                    <div class="card-body">
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tip</th>

                            </tr>
                            </thead>
                            <tbody>

                            <tr v-for="tip in tips" v-bind:key="tip.id">
                                <td>{{tip.id}}</td>
                                <td>{{tip.info}}</td>

                                <td>
                                    <a href="#" @click="editTips(tip)">
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
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "DailyTips",
        data(){return{
            tips:{},
            tip:'',
            form: new Form({
                id:'',
                info:''
            }),
        }},
        methods:{
            storeTip(){
                this.$Progress.start();
                this.form.post('/records/daily-tips').then((response) => {

                    this.tips.push(response.data);

                        Swal.fire(
                            'Save',
                            'Data Sent Successfully',
                            'success'
                        );

                    this.$Progress.finish();
                    this.form.reset();

                }).catch((response) => {
                    this.$Progress.fail();
                    console.log(response.data)})
            },

            getAllTips(){
                this.error = this.tips = null;
                this.loading = true;
                axios.get('/records/daily-tips')
                    .then((response) => {this.loading = false;
                    this.tips = response.data})
                    .catch((response)=>{ this.loading = false;
                    console.log(response.error)})
            },
            editTips(tip){
                $('.newBtn').addClass('d-none');
                $('.editBtn').removeClass('d-none');
                this.form.fill(tip);
                },
            updateTip(){
                    let id = this.form.id;
                this.$Progress.start();
                axios.put('/records/daily-tips/'+id, this.form).then((response) => {
                    this.tips = {};
                    this.tips = response.data;

                    Swal.fire(
                        'Save',
                        'Data Updated Successfully',
                        'success'
                    );

                    this.$Progress.finish();
                    this.form.reset();

                }).catch((response) => {
                    this.$Progress.fail();
                    console.log(response.data)})
            },
        },
        created(){
            this.getAllTips();

        },
        mounted() {
        }
    }
</script>

<style scoped>

</style>
