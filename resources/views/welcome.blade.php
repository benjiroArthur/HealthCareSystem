@extends('layouts.app')
@section('content')

        <div class="mt-5 mb-2" id="banner">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
@php($i = 1)
            <div class="carousel-item active">
                <img src="{{asset('assets/sliders/banner'.$i.'.jpg')}}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-md-block tip-box">
                    <h5>Health Tip Of The Day</h5>
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

        <h1 class="text-center text-bold">What You Can Do</h1>
        <div class="container">
            <div class="row" style="font-size: 24px">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body bg-gradient-red text-white text-center">
                            <span class="fas fa-search"></span>
                            Find A Doctor
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body bg-gradient-red text-white text-center">
                            <span class="fab fa-facebook-messenger"></span>
                            Chat With A Doctor
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body bg-gradient-red text-white text-center">
                            <span class="fas fa-search"></span>
                            Find A Pharmacy
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid bg-light shadow p-3">
            <div class="row m-5">
                <div class="col-md-4">
                    <h1>Welcome To</h1>
                    <h1>E-HealthCare Center</h1>
                    <p>Sick at home and cannot get the hospital immediately? Looking for a pharmacy around you? Worry no more.
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
                                 Ours are amongst the best!</p>

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
                            <p>Available pharmacies are licensed and trusthworthy.Safe drug delivery at an affotdable price</p>

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
        <div class="container-fluid bg-none p-3 mb-3">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="row justify-content-center">
                            <div class="col-md-6 col-sm-12 bg-transparent">
                                <img src="{{asset('assets/about/about1.jpg')}}" alt="..." class="img-fluid">
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="text-center">
                                <p class="font-weight-light h2">E-Health Care connects you to Medically
                                    Certified Doctors 24 hours a day 365 days a year using your phone, tablet,
                                    or computer. The system also ensures that pharmacies around you are easily accessible.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <selected-doctors></selected-doctors>
        <div class="row">
            <div class="col-md-6">
                <div class="card-body bg-gradient-red text-white text-center">
                <div class="row"><div class="col-12 mt-5 text-center text-bold"><h1 class="text-bold">Our Mission</h1></div></div>
                <div class="container-fliud bg-none p-3 mb-3">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="row justify-content-center">
                                    <div class="col-md-12 col-sm-12">
                                        <p class="font-weight-light h2">To inspire hope and contribute to health and well-being by
                                                                providing the best health care to
                                                                every patient remotely</p>
                                    </div>
                                    </div>
                                   {{-- <div class="col-md-6 col-sm-12" >
                                        <img src="{{asset('assets/about/about1.jpg')}}" alt="..." class="img-fluid">
                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-body bg-gradient-green text-white text-center">
                <div class="row">
                    <div class="col-12 mt-5 text-center text-bold"><h1 class="text-bold">Our vision</h1></div>
                </div>
                <div class="container-fliud bg-none p-3 mb-3">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="row justify-content-center">
                                    {{--<div class="col-md-6 col-sm-12">
                                        <img src="{{asset('assets/about/about3.jpg')}}" alt="..." class="img-fluid">
                                    </div>--}}
                                    <div class="col-md-12 col-sm-12">

                                        <p class="font-weight-light h2">E-HealthCare will provide an unparalleled
                                    experience as the most trusted partner for health care services remotely.</p>
                                    </div>
                                </div>
                                </div>
                            </div>
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
@section('style')
    <style>
        .about-bg{

        }
    </style>
@endSection()

