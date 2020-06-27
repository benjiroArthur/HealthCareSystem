@extends('layouts.app')
@section('content')

        <div class="mt-5 mb-2" id="banner">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
@php($i = 1)
            <div class="carousel-item active">
                <img src="{{asset('assets/sliders/banner'.$i.'.jpg')}}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-md-block tip-box">
                    <h5>Tip Of The Day</h5>
                    @if(!empty($tip))
                        <p>{{$tip->info}}</p>
                    @endif
                </div>
            </div>
            @for($i = 1; $i <= 6; $i++)
                    <div class="carousel-item">
                        <img src="{{asset('assets/sliders/banner'.$i.'.jpg')}}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-block tip-box">
                            <h5 class="pt-0">Tip Of The Day</h5>
                            @if(!empty($tip))
                                <p class="pb-0">{{$tip->info}}</p>
                                @endif
                        </div>
                    </div>

            @endfor



        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    </div>

        <h1 class="text-center text-dark text-bold">What You Can Do</h1>
        <div class="container">
            <div class="row" style="font-size: 24px">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body bg-health text-white text-center">
                            <span class="fas fa-search"></span>
                            Find A Doctor
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body bg-health text-white text-center">
                            <span class="fab fa-facebook-messenger"></span>
                            Chat With A Doctor
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body bg-health text-white text-center">
                            <span class="fas fa-search"></span>
                            Find A Pharmacy
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row m-5">
                <div class="col-md-4">
                    <h1>Welcome To</h1>
                    <h1>E-HealthCare Center</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aliquam at deleniti distinctio eum facere illum, nulla quidem quisquam voluptates! Animi aspernatur doloremque hic illum minus non officia rem saepe!</p>
                </div>
                 <div class="col-md-4">
                     <div class="row">
                         <div class="col-4 text-right">
                             <p class="h1"><span class="fas fa-user-md text-health w-100 font-weight-bold" style="font-size: 80px"></span></p>
                         </div>
                         <div class="col-8">
                             <h4 class="text-bold">Trusted Doctors</h4>
                             <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. doloremque hic illum minus non officia rem saepe!</p>

                         </div>
                     </div>
                     <div class="row">
                         <div class="col-4 text-right">
                             <p class="h1"><span class="fab fa-facebook-messenger text-health w-100 font-weight-bold" style="font-size: 80px"></span></p>
                         </div>
                         <div class="col-8">
                             <h4 class="text-bold">Secured Chat Platform</h4>
                             <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. doloremque hic illum minus non officia rem saepe!</p>

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
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. doloremque hic illum minus non officia rem saepe!</p>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 text-right">
                            <p class="h1"><span class="fas fa-clock text-health w-100 font-weight-bold" style="font-size: 80px"></span></p>
                        </div>
                        <div class="col-8">
                            <h4 class="text-bold">24/7 Services</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. doloremque hic illum minus non officia rem saepe!</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-center" id="about">
                {{--<div style="min-height: 70px; border-top: 2px solid black; min-width: 100%">

                </div>--}}
                <div class="col-12 mt-5 text-center text-bold"><h1 class="text-bold">About Us</h1></div>

                <div class="col-12">
                    <div class="row justify-content-center">
                        <div class="col-md-6 col-sm-12 card bg-transparent">
                            <img src="{{asset('assets/about/about1.png')}}" alt="..." class="img-fluid">
                        </div>
                        <div class="col-md-6 col-sm-12 card">
                            <div class="card-header text-center">About</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                sed do eiusmod tempor incididunt ut labore et dolore
                                magna aliqua. Leo urna molestie at elementum eu. Orci ac auctor augue mauris.
                                Nunc non blandit massa enim nec dui nunc. Feugiat vivamus at augue eget arcu dictum.</p>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6 col-sm-12 card">
                            <div class="card-header text-center">Mission</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                sed do eiusmod tempor incididunt ut labore et dolore
                                magna aliqua. Leo urna molestie at elementum eu. Orci ac auctor augue mauris.
                                Nunc non blandit massa enim nec dui nunc. Feugiat vivamus at augue eget arcu dictum.</p>
                        </div>
                        <div class="col-md-6 col-sm-12 card bg-transparent">
                            <img src="{{asset('assets/about/about2.png')}}" alt="..." class="img-fluid">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6 col-sm-12 card bg-transparent">
                            <img src="{{asset('assets/about/about3.png')}}" alt="..." class="img-fluid">
                        </div>
                        <div class="col-md-6 col-sm-12 card">
                            <div class="card-header text-center">Vision</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                sed do eiusmod tempor incididunt ut labore et dolore
                                magna aliqua. Leo urna molestie at elementum eu. Orci ac auctor augue mauris.
                                Nunc non blandit massa enim nec dui nunc. Feugiat vivamus at augue eget arcu dictum.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5" id="contact">
            <contact-us class="mt-3"></contact-us>
        </div>

        <a href="#banner" title="Move to top"><span class="fas fa-arrow-alt-circle-up" style="float: right; width: 40px; height: 40px;"></span></a>
@endsection

