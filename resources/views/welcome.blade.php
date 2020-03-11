@extends('layouts.app')
@section('content')
    {{--@dd($tip)--}}
    <div class="mt-5">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">

                    <div class="carousel-item active">
                        <img src="{{asset('assets/sliders/banner1.jpg')}}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Tip Of The Day</h5>
                            @if(!empty($tip))
                                <p>{{$tip->info}}</p>
                                @endif
                        </div>
                    </div>

                    <div class="carousel-item">
                            <img src="{{asset('assets/sliders/banner2.jpg')}}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Tip Of The Day</h5>
                            @if(!empty($tip))
                                <p>{{$tip->info}}</p>
                                @endif
                        </div>
                     </div>

                    <div class="carousel-item">
                        <img src="{{asset('assets/sliders/banner3.jpg')}}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Tip Of The Day</h5>
                            @if(!empty($tip))
                                <p>{{$tip->info}}</p>
                                @endif
                        </div>
                    </div>

                    <div class="carousel-item">
                        <img src="{{asset('assets/sliders/banner4.jpg')}}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Tip Of The Day</h5>
                            @if(!empty($tip))
                                <p>{{$tip->info}}</p>
                                @endif
                        </div>
                    </div>

                    <div class="carousel-item">
                        <img src="{{asset('assets/sliders/banner5.jpg')}}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Tip Of The Day</h5>
                            @if(!empty($tip))
                                <p>{{$tip->info}}</p>
                                @endif
                        </div>
                    </div>

                    <div class="carousel-item">
                        <img src="{{asset('assets/sliders/banner6.jpg')}}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Tip Of The Day</h5>
                            @if(!empty($tip))
                                <p>{{$tip->info}}</p>
                                @endif
                        </div>
                    </div>

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
        <div class="mt-5" id="contact">
            <h3>About Ua</h3>
        </div>
        <div class="mt-5" id="contact">
            <contact-us class="mt-3"></contact-us>
        </div>
@endsection

