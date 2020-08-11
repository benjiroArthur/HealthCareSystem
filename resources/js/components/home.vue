<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <!--<h3>Welcome to Healthcare System</h3>
            <p>We provide you with the opportunity to chat with the best of Doctors around the globe</p>-->
        </div>

        <div class="mb-2 row justify-content-center" id="banner">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item" v-for="(slider,idx) in sliders" :class="{ active: idx===0 }">
                    <img :src="slider.image" alt="" class="img-fluid">
                    <div class="carousel-caption d-md-block tip-box">
                        <h5>Health Tip Of The Day</h5>
                        <p v-if="tips">{{tips.info}}</p>
                    </div>
                </div>

            </div>
        </div>
        </div>

        <div v-show="this.role === 'out_patient'" class="container">
            <h1 class="text-center text-dark text-bold">What You Can Do</h1>
            <div class="row" style="font-size: 24px">
                <div class="col-md-4">
                        <router-link to="/user/doctors" class="nav-link">
                            <div class="card make-link">
                                <div class="card-body bg-gradient-red text-white text-center">
                                    <span class="fas fa-search"></span>
                                    Find A Doctor
                                </div>
                            </div>
                        </router-link>
                </div>
                <div class="col-md-4">
                    <router-link to="/chat" class="nav-link">
                        <div class="card make-link">
                            <div class="card-body bg-gradient-red text-white text-center">
                                <span class="fab fa-facebook-messenger"></span>
                                Chat A Doctor
                            </div>
                        </div>
                    </router-link>
                </div>
                <div class="col-md-4">
                   <router-link to="/user/pharmacy" class="nav-link">
                       <div class="card make-link">
                           <div class="card-body bg-gradient-red text-white text-center">
                               <span class="fas fa-search"></span>
                               Find A Pharmacy
                           </div>
                       </div>
                   </router-link>
                </div>
            </div>
        </div>
        <div class="container-fluid bg-light shadow p-3">
            <div class="row m-5">
                <div class="col-md-4">
                    <h1>Welcome To</h1>
                    <h1>E-HealthCare Center</h1>
                    <p> Sick at home and cannot get to the hospital immediately? Looking for a pharmacy around you? Worry no more.
                        Register now and get connected to a doctor and locate a pharmacy around you.</p>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-4 text-right">
                            <p class="h1"><span class="fas fa-user-md text-health w-100 font-weight-bold" style="font-size: 80px"></span></p>
                        </div>
                        <div class="col-8">
                            <h4 class="text-bold">Certified Doctors</h4>
                            <p>Quality healthcare starts with quality and certified doctors.
                                Ours are amongst the best.</p>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 text-right">
                            <p class="h1"><span class="fab fa-facebook-messenger text-health w-100 font-weight-bold" style="font-size: 80px"></span></p>
                        </div>
                        <div class="col-8">
                            <h4 class="text-bold">Secured Chat Platform</h4>
                            <p>Our chat platforms are safe and secured. Protected against third-party invasion.</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-4 text-right">
                            <p class="h1"><span class="fas fa-tablets text-health w-100 font-weight-bold" style="font-size: 80px"></span></p>
                        </div>
                        <div class="col-8">
                            <h4 class="text-bold">Trusted Pharmacies</h4>
                            <p>Available pharmacies are licensed and trusthworthy. Safe drug delivery at an affotdable price.</p>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 text-right">
                            <p class="h1"><span class="fas fa-clock text-health w-100 font-weight-bold" style="font-size: 80px"></span></p>
                        </div>
                        <div class="col-8">
                            <h4 class="text-bold">24/7 Services</h4>
                            <p>No Waiting Rooms.
                                No Long Queues.
                                No Traffic. Less Stress. We serve you anytime and anyday.</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row"  id="about">
            <div class="col-12 mt-5 text-center text-bold"><h1 class="text-bold">About Us</h1></div>
        </div>
        <div class="container-fliud bg-none p-3 mb-3">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="row justify-content-center">
                            <div class="col-md-6 col-sm-12 bg-transparent">
                                <img :src="`${this.$parent.resourcePath}/about/about1.jpg`" alt="..." class="img-fluid">
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <p class="font-weight-light h3 text-center" >E-Health Care connects you to Medically
                                    Certified Doctors 24 hours a day 365 days a year using your phone, tablet,
                                    or computer.The system also ensures that pharmacies around you are easily accessible.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--selected Doctors Component-->
        <selected-doctors></selected-doctors>

        <!--Doctor and Pharmacy image starts here-->
        <div v-if="this.$parent.role === 'out_patient'" class="row mt-3 mb-3">
            <div class="col-md-6">
                <div class="card text-white">
                    <img :src="`${this.$parent.resourcePath}/about/about2.jpg`" class="card-img" alt="...">
                    <div class="card-img-overlay text-center" style="margin-top: 50%">
                        <router-link to="/user/doctors">
                            <h2 class="text-white">Reliable Doctors</h2>
                        </router-link>
                </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-white">
                    <img :src="`${this.$parent.resourcePath}/about/about3.jpg`" class="card-img" alt="...">
                    <div class="card-img-overlay text-center" style="margin-top: 50%">
                        <router-link to="/user/pharmacy">
                            <h2 class="text-white">Online Pharmacies</h2>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
        <!--Doctor and Pharmacy image starts here-->


        <div class="mt-5" id="contact">
            <contact-us class="mt-3"></contact-us>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                tips: null,
                date: new Date(),
                sliders:{},
                role: '',
            }
        },
        methods:{
            index(){
                this.error = this.tips = null;
                this.loading = true;
                axios.get('/records/latest-tips')
                    .then((response) => {this.loading = false;
                        this.tips = response.data})
                    .catch((response)=>{ this.loading = false;
                        console.log(response.error)})
            },

            getSliders(){
                this.error = this.tips = null;
                this.loading = true;
                axios.get('/dashboard/sliders')
                    .then((response) => {this.loading = false;
                        this.sliders = response.data})
                    .catch((response)=>{ this.loading = false;
                        console.log(response.error)})
            },
            handleIncoming(tips){
                this.tips = null;
                this.tips = tips;
            }
        },
        created() {
            this.role = this.$parent.role;
            this.index();
            this.getSliders();
        },
        mounted() {
            Echo.private(`daily-tip`)
                .listen('NewDailyTips', (e) => {
                    this.handleIncoming(e.tips);
                });
        }
    }
</script>
