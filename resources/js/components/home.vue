<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <!--<h3>Welcome to Healthcare System</h3>-->
            <!--<p>We provide you with the opportunity to chat with the best of Doctors around the globe</p>-->
        </div>

        <div class="mb-2 row justify-content-center" id="banner">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item" v-for="(slider,idx) in sliders" :class="{ active: idx==0 }">
                    <img :src="slider.image" alt="" class="img-fluid">
                    <div class="carousel-caption d-md-block tip-box">
                        <h5>Tip Of The Day</h5>
                        <p v-if="tips">{{tips.info}}</p>
                    </div>
                </div>

            </div>
        </div>
        </div>
        <div class="row justify-content-center" id="about">
            <div class="col-12 mt-2 text-center"><h3>About Us</h3></div>
            <div class="col-12">
                <div class="row justify-content-center">
                    <div class="col-lg-3 col-sm-12 card mr-2 ">
                        <div class="card-header text-center">About</div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore
                            magna aliqua. Leo urna molestie at elementum eu. Orci ac auctor augue mauris.
                            Nunc non blandit massa enim nec dui nunc. Feugiat vivamus at augue eget arcu dictum.</p>
                    </div>
                    <div class="col-lg-3 col-sm-12 card mr-2 ">
                        <div class="card-header text-center">Mission</div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore
                            magna aliqua. Leo urna molestie at elementum eu. Orci ac auctor augue mauris.
                            Nunc non blandit massa enim nec dui nunc. Feugiat vivamus at augue eget arcu dictum.</p>
                    </div>
                    <div class="col-lg-3 col-sm-12 card ml-2">
                        <div class="card-header text-center">Vision</div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore
                            magna aliqua. Leo urna molestie at elementum eu. Orci ac auctor augue mauris.
                            Nunc non blandit massa enim nec dui nunc. Feugiat vivamus at augue eget arcu dictum.</p>
                    </div>
                </div>
            </div>
        </div>
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
        },
        created() {
            this.index();
            this.getSliders();
            console.log('Component mounted.')
        }
    }
</script>
