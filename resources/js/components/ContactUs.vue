<template>

        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-7 col-lg-7">
                <div class="card">
                    <div class="card-header h2 text-bold">CONTACT US</div>
                    <div class="card-body justify-content-center">
                        <form @submit.prevent="contact" ref="form" class="justify-content-center">
                            <div class="row text-center">
                                <div class="col-md-6">
                                    <div class="form-group"><input v-model="form.full_name" type="text" name="name" placeholder="Full Name" required class="form-control"/></div>
                                    <div class="form-group"><input v-model="form.email" type="email" name="email" placeholder="Email" required class="form-control"/></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"><textarea v-model="form.message" name="message" class="form-control" cols="8" rows="3" placeholder="Message"></textarea></div>
                                </div>
                            </div>
                            <div class="form-group justify-content-center align-items-center text-center">
                                <button type="button" class="btn btn-danger" @click="reset">Cancel</button>
                                <button type="submit" class="btn btn-success">Submit <i class="fas fa-upload"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 clo-sm-12 col-md-5">
                <GmapMap
                    :center="{lat:5.573062, lng:-0.208334}"
                    :zoom="7"
                    map-type-id="terrain"
                    style="width: 100%; height: 300px"
                >
                    <GmapMarker
                        :key="index"
                        v-for="(m, index) in markers"
                        :position="m.position"
                        :clickable="true"
                        :draggable="true"
                        @click="center=m.position"
                    />
                </GmapMap>
            </div>
        </div>

</template>

<script>
    export default {
        name: "ContactUs",

        data(){
            return{
                form:  new Form({
                    full_name: '',
                    email: '',
                    message: ''
                }),
                map: '',
                center:{},
                markers:[
                    {
                        position: {lat:5.573062, lng:-0.208334}
                    }
                    ]
            }
        },
        methods:{
                contact(){
                    this.$Progress.start();
                    this.form.post('/records/contact').then((response) => {
                        if(response.data === "success"){
                            this.form.reset();
                            Swal.fire(
                                'Sent',
                                'Message Sent Successfully',
                                'success'
                            );

                        }
                        else{
                            Swal.fire(
                                'Error',
                                response.data,
                                'error'
                            );
                        }
                        this.$Progress.end();
                    }).catch((response) => {
                        this.$Progress.fail();
                        console.log(response.data)})
                },
            reset(){
                this.form.reset();
            }
        },

        created(){
            this.reset();
        }
    }
</script>

<style scoped>

</style>
