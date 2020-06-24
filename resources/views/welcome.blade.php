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

        <div class="features_area">
            <div class="container-fluid">
                <div class="row no-gutters">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="single_feature text-center">
                            <div class="icon">
                                <i class="flaticon-support"></i>
                            </div>
                            <h3>WE VALUE</h3>
                            <p>We value quality and timely delivery within safe working environment</p>
                            <p>Living by our values helps us to make the best decisions, be successful and
                                stand out for all the right reasons.</p>
                            <p> Customer satisfaction is our top most priority. </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="single_feature text-center">
                            <div class="icon">
                                <i class="flaticon-helmet"></i>
                            </div>
                            <h3>WE PLAN</h3>
                            <p>
                                We PLAN all aspect of our client's projects, conducting feasibility studies and impact analysis
                                covering technical, logistical, legal, environmental and financial considerations. We contributes
                                to a sustainable future for our people, clients and the entire society.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="single_feature text-center">
                            <div class="icon">
                                <i class="flaticon-sketch"></i>
                            </div>
                            <h3>WE DESIGN</h3>
                            <p>
                                We DESIGN building and civil structures, develop cutting edge solutions and combine them with tried
                                and tested technologies to achieve an optimal result. It is living by our values that we have successfully
                                built some of the Ghana's modern architectural marvels.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row justify-content-center" id="about">
            {{--<div style="min-height: 70px; border-top: 2px solid black; min-width: 100%">

            </div>--}}
            <div class="col-12 mt-5 text-center"><h3>About Us</h3></div>
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

        <a href="#banner" title="Move to top"><span class="fas fa-arrow-alt-circle-up" style="float: right; width: 40px; height: 40px;"></span></a>
@endsection

