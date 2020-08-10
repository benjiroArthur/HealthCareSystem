<template>
    <div class="container" v-if="this.doctors.length > 0">
        <div class="row justify-content-center text-center">
            <h1 class="text-center">Meet Some of Our Doctors</h1>
        </div>
    <div v-if="this.doctors.length > 0" class="row">
        <div v-for="(doctor, i) in doctors" :key="i" class="col-md-4 justify-content-center">
            <div class="card" style="width: 18rem;">
                <img :src="doctor.image_source" class="card-img-top" alt="...">
                <div class="card-body text-center">
                    <h5 class="text-center text-bold">Dr. {{ doctor.full_name}}</h5>
                    <h6 class="text-bold" v-if="doctor.specialization !== null">{{doctor.specialization.name}}</h6>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div v-else></div>
</template>

<script>
    export default {
        name: "SelectedDoctors",
        data(){
            return{
                doctors: [],
            }
        },
        methods:{
            getDoctors(){
                axios.get('/data/random-doctors').then((response)=>{
                    this.doctors = response.data;
                }).catch()
            },
        },
        created() {
            this.getDoctors();
        }
    }
</script>

<style scoped>

</style>
