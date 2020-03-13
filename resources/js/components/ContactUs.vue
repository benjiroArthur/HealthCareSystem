<template>

        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-5 col-lg-5">
                <div class="card">
                    <div class="card-header">CONTACT US</div>
                    <div class="card-body">
                        <form @submit.prevent="contact" ref="form">
                            <div class="form-group"><input v-model="form.full_name" type="text" name="name" placeholder="Full Name" required class="form-control"/></div>
                            <div class="form-group"><input v-model="form.email" type="email" name="email" placeholder="Email" required class="form-control"/></div>
                            <div class="form-group"><textarea v-model="form.message" name="message" class="form-control" cols="8" placeholder="Message"></textarea></div>
                            <div class="form-group justify-content-center">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
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
                    this.progress.start();
                    this.form.post('').then((response) => {
                        if(response.data === "Yes"){
                            swal.fire(
                                'Sent',
                                'Message Sent Successfully',
                                'success'
                            );
                        }
                        else{
                            swal.fire(
                                'Error',
                                response.data,
                                'error'
                            );
                        }
                        this.progress.end();
                    }).catch((response) => {console.log(response.data)})
                }
        },

        created(){

        }
    }
</script>

<style scoped>

</style>
