@extends('layouts.app')
@section('content')

        <div class="mt-5" id="banner">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
@php($i = 1)
            <div class="carousel-item active">
                <img src="{{asset('assets/sliders/banner'.$i.'.jpg')}}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block tip-box">
                    <h5>Tip Of The Day</h5>
                    @if(!empty($tip))
                        <p>{{$tip->info}}</p>
                    @endif
                </div>
            </div>
            @for($i = 1; $i <= 6; $i++)
                    <div class="carousel-item">
                        <img src="{{asset('assets/sliders/banner'.$i.'.jpg')}}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block tip-box">
                            <h5>Tip Of The Day</h5>
                            @if(!empty($tip))
                                <p>{{$tip->info}}</p>
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
        <div class="mt-5 row justify-content-center" id="about">
            <div class="col-12"><h3>About Us</h3></div>
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
@endsection

