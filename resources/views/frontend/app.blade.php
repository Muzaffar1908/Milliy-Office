@extends('layouts.main')

@section('content')

    <div class="banner-section-three bg-color2 position-relative">
        <div class="container-fluid px-0">
            <div class="swiper banner-three-slider">
                <div class="swiper-wrapper">
                    @foreach ($mains as $main)
                        <div class="swiper-slide">
                            <div class="banner-three-content">
                                <h2>{{$main->title}}</h2>
                                <p>{{strip_tags($main->long_text)}}</p>
                                <a href="#" class="eg-btn btn--primary-two btn--lg">{{__('words.Read more')}}</a>
                            </div>
                            <img src="{{asset('/upload/main/'. $main->background_image.'_big_1920.png')}}" alt="image">
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination swiper-pagination-num"></div>
            </div>
        </div>
    </div>

    <!-- News section -->

    <?php
        use Carbon\Carbon;
    ?>

    <div class="blog-grid-section pt-120 pb-120 ">
        <div class="container">
            <div class="row justify-content-center">
                <h1 class="text-center mt-5 mb-5">{{__('words.News')}}</h1>
                <div class="row justify-content-center">
                    <div class="col-lg-8 pe-lg-4 pe-0">
                        <div class="blog-standard-single">
                            <div class="blog-image">
                              <img src="{{asset('/upload/news/'. $news->news_image.'_bigImage_1920.png')}}" alt="image">
                            </div>
                            <div class="blog-content">
                                <ul class="blog-stand-meta">
                                    <li>{{Carbon::parse($news->created_at)->format('F d, Y')}}</li>
                                    {{-- <li>By, Admin</li>
                                    <li>Photo</li> --}}
                                </ul>
                                <h3><a href="blog-details.html" data-cursor="Read Details">{{$news->title}}</a></h3>
                                <div class="read-more-btn">
                                  <a href="blog-details.html">{{__('words.Read more')}} <img src="assets/images/icons/button-arrow.svg" alt="image"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="blog-sidebar">
                            <div class="blog-widget">
                                <h4 class="blog-widget-title">{{__('words.All news')}}</h4>
                                <ul class="new-post-list">
                                    @foreach($news_post_single as $post)
                                        <li class="new-post-single">
                                            <div class="blog-image">
                                            <img src="{{asset('/upload/news/'. $post->news_image.'_thumbnail_450.png')}}" alt="image">
                                            </div>
                                            <div class="blog-content">
                                                <div class="blog-date">{{Carbon::parse($post->created_at)->format('d.m.Y')}}</div>
                                                <h5><a href="blog-details.html">{{$post->title}}.</a></h5>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div>

    <!-- Platforms -->

    <div class="bread-crumb-section ">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-8 d-flex justify-content-lg-start justify-content-center flex-column">
                    <h2 class="bread-crumb-title text-center">{{__('words.Platforms')}}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="client-section bg-color2 pt-5 ">
        <div class="container">
            <div class="client-single">
                <div class="row justify-content-center align-items-center g-4">
                    <div class="col-xl-4 col-lg-3 col-md-4 col-sm-5">
                        <div class="client-image">
                            <img src="{{asset('/assets/images/screen/Снимок экрана (93).png')}}" alt="image">
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-6">
                        <div class="client-quote">
                            <h4>International Week Of <span>Innovative</span> Ideas 2021</h4>
                            <p>innoweek.uz</p>
                            <a href="https://innoweek.uz/" target="_blank" class="eg-btn btn--primary btn--md">Batafsil</a>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="client-single style-two">
                <div class="row justify-content-center align-items-center g-4">
                    <div class="col-xl-7 col-lg-6">
                        <div class="client-quote">
                            <h4>International Week Of <span>Innovative</span> Ideas 2021</h4>
                            <p>innoweek.uz</p>
                            <a href="https://innoweek.uz/" target="_blank" class="eg-btn btn--primary btn--md">Batafsil</a>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-3 col-md-4 col-sm-5">
                        <div class="client-image">
                            <img src="{{asset('/assets/images/screen/Снимок экрана (93).png')}}" alt="image">
                        </div>
                    </div>
                </div>
            </div>
            <div class="client-single">
                <div class="row justify-content-center align-items-center g-4">
                    <div class="col-xl-4 col-lg-3 col-md-4 col-sm-5">
                        <div class="client-image">
                            <img src="{{asset('/assets/images/screen/Снимок экрана (93).png')}}" alt="image">
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-6">
                        <div class="client-quote">
                            <h4>International Week Of <span>Innovative</span> Ideas 2021</h4>
                            <p>innoweek.uz</p>
                            <a href="https://innoweek.uz/" target="_blank" class="eg-btn btn--primary btn--md">Batafsil</a>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>

    <!-- Gallery -->
    <div class="bread-crumb-section">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-8 d-flex justify-content-lg-start justify-content-center text-center flex-column">
                    <h2 class="bread-crumb-title">{{__('words.Gallery')}}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="our-portfilio-area bg-color2 pt-5 pb-60">
        <div class="container">
            <div class="row grid  g-4 mb-70 justify-content-center">
                @foreach($galleries as $gallery)
                    <div class="col-lg-4 col-md-6 col-sm-10 grid-item Lifestyle Nature Wedding">
                        <div class="portfolio-single-one style-two magnetic-item">
                            <img class="img-fluid" src="{{asset('/upload/gallery/'. $gallery->image.'_thumbnail_450.png')}}" alt="image">
                            <div class="overlay">
                                <div class="content">
                                    <h3><a data-cursor="View<br>Details" href="#">{{__('words.National Office Photography')}}.</a></h3>
                                    <span>{{__('words.Photographer')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-center">
                    <div class="load-more-btn">
                        <a class="eg-btn btn--primary btn--lg" href="#">{{__('words.Read more')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Location -->
    <section id="contact" class="location-wrap-layout1">
        <div class="section-heading style-four">
        <h2 class="text-center pt-5 pb-5">{{__('words.Contact')}}</h2>
        </div>
        <div class="location-box-layout1 has-animation d-flex">
        <div class="address d-flex flex-column">
            <div class="card">
            <img src="{{asset('/assets/images/icons/location.svg')}}" width="50px" alt="" class="m-3">

            <div class="card-body">
                <h1 class="m-2">{{__('words.Address')}}</h1>
                <p class="m-2">100174, Toshkent sh., Olmazor t., Universitet ko‘ch., 7 uy.</p>
            </div>
            </div>

            <div class="card">
            <img src="{{asset('/assets/images/icons/sms.svg')}}" width="50px" alt="" class="m-3">

            <div class="card-body">
                <h1 class="m-2">{{__('words.Email')}}</h1>
                <a class="m-2" href="#">milliyofis@mininnovation.uz</a>
            </div>
            </div>
        </div>

        <div class="address d-flex flex-column">
            <div class="card">
            <img src="{{asset('/assets/images/icons/call.svg')}}" width="50px" alt="" class="m-3">

            <div class="card-body">
                <h1 class="m-2">{{__('words.Phone')}}</h1>
                <p class="m-2">+99871 203-32-00</p>
            </div>
            </div>

            <div class="card">
            <img src="{{asset('/assets/images/icons/clock.svg')}}" width="50px" alt="" class="m-3">

            <div class="card-body">
                <h1 class="m-2">{{__('words.Working time')}}</h1>
                <p class="m-2">{{__('words.Monday - Friday')}} 09:00 - 18:00</p>
            </div>
            </div>
        </div>
        <div class="map">
            <iframe class="map" style="height: 600px;"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6078.272327453513!2d69.2113345533416!3d41.352176589801374!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38ae8d755132b921%3A0x3d2c94a22bdea876!2sMinistry%20of%20Innovative%20Development%20of%20the%20Republic%20of%20Uzbekistan!5e0!3m2!1sen!2s!4v1662747000746!5m2!1sen!2s"
            style="border:0;" allowfullscreen="" loading="lazy" width="600" height="450">
            </iframe>
        </div>
        </div>
    </section>

    <!-- Partners -->
    <div class="container-fluid logo-slider pb-120">
        <h1 class="text-center pt-5 pb-5">{{__('words.Partners')}}</h1>
        <div class="logo-slide-track">
            <div class="slide">
                <img src="{{asset('/assets/images/partners/minin.png')}}" alt="" />
            </div>
            <div class="slide">
                <img src="{{asset('/assets/images/partners/tnet.png')}}" alt="" />
            </div>
            <div class="slide">
                <img src="{{asset('/assets/images/partners/ubtech.png')}}" alt="" />
            </div>
            <div class="slide">
                <img src="{{asset('/assets/images/partners/eec.png')}}" alt="" />
            </div>
            <div class="slide">
                <img src="{{asset('/assets/images/partners/tuya.png')}}" alt="" />
            </div>
            <div class="slide">
                <img src="{{asset('/assets/images/partners/minin.png')}}" alt="" />
            </div>
            <div class="slide">
                <img src="{{asset('/assets/images/partners/tnet.png')}}" alt="" />
            </div>
        </div>
    </div>

@endsection