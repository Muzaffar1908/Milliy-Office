@extends('layouts.main')

@section('content')

    <section class=" hero-wrap-layout1">
        <div class="d-flex flex-column wow fadeInUp animated" data-wow-delay="1s">
            <h1 class="mt-5 wow fadeInUp animated" data-wow-delay="1s">{{$mains->title}}</h1>
            <p>{{strip_tags($mains->long_text)}}</p>
            <button>{{__('words.Read more')}}</button>
        </div>
        <div class="wow fadeInLeft animated" data-wow-delay="0.1s" data-wow-duration="1s">
            <div class="process-box-layout1 color-one">
            <a href="{{'https://www.youtube.com/watch?v='.$mains->youtobe_id}}" class="icon-box-link play-btn">
                <div class="icon-box">
                    <img src="https://img.youtube.com/vi/{{$mains->youtobe_id}}/hqdefault.jpg" width="1000px" alt="">
                    <div class="player"></div>
                </div>
            </a>
            </div>
        </div>
    </section>

    <!-- News Section Area Start -->
    <section id="Yangiliklar">
        <div class="container-fluid">
            <h2 class="titlee wow fadeInUp animated" data-wow-delay="0.3s" data-wow-duration="1s">{{__('News')}}</h2>
        <div class="topHeadlines">
            <div class="left">
            <div class="img" id="breakingImg" ></div>
            <div class="text" id="breakingNews">
                <div class="news-title">
                <h2>{{$news->title}}</h2>
                </div>
                <div class="description">
                    {{strip_tags($news->long_text)}}
                </div>
            </div>
            <button>{{__('All news')}}</button>
            </div>
            <div class="right">
            <div class="topNews">
                <div class="news">
                  <div class="img"></div>
                    <div class="text">
                        {{-- @foreach ($news as $new)
                            <div class="news-title">
                                <h2>{{$new->title}}</h2>
                                <span class="date mt-4 d-flex">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    <span class="mx-2">{{$new->created_at}}</span>
                                </span>
                            </div>
                        @endforeach --}}
                    </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </section>
    <!-- News Section Area End -->

    <!-- Platform Section Area Start -->
    <section id="platform">
        <div class="container-fluid">
          <h2 class="titlee wow fadeInUp animated" data-wow-delay="0.3s" data-wow-duration="1s">Platforms</h2>
          <div class="slider">
            <!-- <div class="slide d-flex justify-content-between">
              <div class="slide-content">
                <h1>International Week Of <br> <span>Innovative</span> Ideas 2022 </h1>
                <h3>innoweek.uz</h3>
                <button> Batafsil </button>
              </div>
              <div class="platform-container d-flex justify-content-center align-items-center">
                <div class="mac">
                  <img src="./images/devices/mac.png" width="473px"  alt="">
                  <div class="imgBx"></div>
                </div>
                <div class="macBook">
                  <img src="./images/devices/macbook.png" width="430px" alt="">
                  <div class="imgBx"></div>
                </div>
                <div class="iphone">
                  <img src="./images/devices/iphone.png" width="170px" alt="">
                  <div class="imgBx"></div>
                </div>
              </div>
            </div> -->
    
        <!-- Первый слайд -->
        <div class="item">
        <div class="slide d-flex justify-content-between">
                <div class="slide-content">
                    <h1>International Week Of <br> <span>Innovative</span> Ideas 2021 </h1>
                    <h3>innoweek.uz</h3>
                    <button> Batafsil </button>
                </div>
                <div class="platform-container d-flex justify-content-center align-items-center">
                    <div class="mac">
                    <img src="{{asset('/frontend/images/devices/mac.png')}}" width="473px"  alt="">
                    <div class="imgBx"></div>
                    </div>
                    <div class="macBook">
                    <img src="{{asset('/frontend/images/devices/macbook.png')}}" width="430px" alt="">
                    <div class="imgBx"></div>
                    </div>
                    <div class="iphone">
                    <img src="{{asset('/frontend/images/devices/iphone.png')}}" width="170px" alt="">
                    <div class="imgBx"></div>
                    </div>
                </div>
                </div>
        </div>

        <!-- Второй слайд -->
        <div class="item">
        <div class="slide d-flex justify-content-between">
            <div class="slide-content">
            <h1>International Week Of <br> <span>Innovative</span> Ideas 2022 </h1>
            <h3>innoweek.uz</h3>
            <button> Batafsil </button>
            </div>
            <div class="platform-container d-flex justify-content-center align-items-center">
            <div class="mac">
                <img src="{{asset('/frontend/images/devices/mac.png')}}" width="473px"  alt="">
                <div class="imgBx"></div>
            </div>
            <div class="macBook">
                <img src="{{asset('/frontend/images/devices/macbook.png')}}" width="430px" alt="">
                <div class="imgBx"></div>
            </div>
            <div class="iphone">
                <img src="{{asset('/frontend/images/devices/iphone.png')}}" width="170px" alt="">
                <div class="imgBx"></div>
            </div>
            </div>
        </div>
        </div>

        <!-- Третий слайд -->
        <div class="item">
        <div class="slide d-flex justify-content-between">
            <div class="slide-content">
            <h1>International Week Of <br> <span>Innovative</span> Ideas 2023 </h1>
            <h3>innoweek.uz</h3>
            <button> Batafsil </button>
            </div>
            <div class="platform-container d-flex justify-content-center align-items-center">
            <div class="mac">
                <img src="{{asset('/frontend/images/devices/mac.png')}}" width="473px"  alt="">
                <div class="imgBx"></div>
            </div>
            <div class="macBook">
                <img src="{{asset('/frontend/images/devices/macbook.png')}}" width="430px" alt="">
                <div class="imgBx"></div>
            </div>
            <div class="iphone">
                <img src="{{asset('/frontend/images/devices/iphone.png')}}" width="170px" alt="">
                <div class="imgBx"></div>
            </div>
            </div>
        </div>
        </div>

        <!-- Кнопки-стрелочки -->
        <a class="previous" onclick="previousSlide()">&#10094;</a>
        <a class="next" onclick="nextSlide()">&#10095;</a>

            <!-- <div class="slide d-flex justify-content-between">
              <div class="slide-content">
                <h1>International Week Of <br> <span>Innovative</span> Ideas 2022 </h1>
                <h3>innoweek.uz</h3>
                <button> Batafsil </button>
              </div>
              <div class="platform-container d-flex justify-content-center align-items-center">
                <div class="mac">
                  <img src="./images/devices/mac.png" width="473px"  alt="">
                  <div class="imgBx"></div>
                </div>
                <div class="macBook">
                  <img src="./images/devices/macbook.png" width="430px" alt="">
                  <div class="imgBx"></div>
                </div>
                <div class="iphone">
                  <img src="./images/devices/iphone.png" width="170px" alt="">
                  <div class="imgBx"></div>
                </div>
              </div>
            </div> -->

            <!-- <div class="slide d-flex justify-content-between">
              <div class="slide-content">
                <h1>International Week Of <br> <span>Innovative</span> Ideas 2022 </h1>
                <h3>innoweek.uz</h3>
                <button> Batafsil </button>
              </div>
              <div class="platform-container d-flex justify-content-center align-items-center">
                <div class="mac">
                  <img src="./images/devices/mac.png" width="473px"  alt="">
                  <div class="imgBx"></div>
                </div>
                <div class="macBook">
                  <img src="./images/devices/macbook.png" width="430px" alt="">
                  <div class="imgBx"></div>
                </div>
                <div class="iphone">
                  <img src="./images/devices/iphone.png" width="170px" alt="">
                  <div class="imgBx"></div>
                </div>
              </div>
            </div> -->
          </div>
        </div>
    </section>
  <!-- Platform Section Area End -->
      
    <!-- Services Section Area Start -->
    <section id="services">
    <div class="section-heading style-four">
        <h2 class="titlee wow fadeInUp animated" data-wow-delay="0.2s" data-wow-duration="1s">Xizmatlar</h2>
    </div>
    <div class="row">
        <div class="column">
        <div class="carrd">
            <div class="icon-wrapper">
            <i class="fas fa-hammer"></i>
            </div>
            <h3>Services heading</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit delectus cumque consectetur?</p>
        </div>
        </div>
        <div class="column">
        <div class="carrd">
            <div class="icon-wrapper">
            <i class="fas fa-hammer"></i>
            </div>
            <h3>Services heading</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit delectus cumque consectetur?</p>
        </div>
        </div>
        <div class="column">
        <div class="carrd">
            <div class="icon-wrapper">
            <i class="fas fa-hammer"></i>
            </div>
            <h3>Services heading</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit delectus cumque consectetur?</p>
        </div>
        </div>
        <div class="column">
        <div class="carrd">
            <div class="icon-wrapper">
            <i class="fas fa-hammer"></i>
            </div>
            <h3>Services heading</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit delectus cumque consectetur?</p>
        </div>
        </div>
        <div class="column">
        <div class="carrd">
            <div class="icon-wrapper">
            <i class="fas fa-hammer"></i>
            </div>
            <h3>Services heading</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit delectus cumque consectetur?</p>
        </div>
        </div>
        <div class="column">
        <div class="carrd">
            <div class="icon-wrapper">
            <i class="fas fa-hammer"></i>
            </div>
            <h3>Services heading</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit delectus cumque consectetur?</p>
        </div>
        </div>
    </div>
    </section>
    <!-- Services Section Area End -->

    <!-- Gallery Section Area Start -->
    <div id="gallery" class="gallery-wrap-layout3">
        <div class="section-heading style-four">
           <h2 class="titlee wow fadeInUp animated" data-wow-delay="0.2s" data-wow-duration="1s">Gallery</h2>
        </div>
        <div class="container-fluid ps-3 pe-3">
            <div class="row">
                <div class="col-xl-3 col-md-4 col-sm-6 col-12">
                    <div class="gallery-box-layout3 has-animation">
                        <a href="{{asset('/frontend/images/background.png')}}" class="rt-mfp-gallery-item"><img class="galery-img" src="{{asset('/frontend/images/background.png')}}" alt="Gallery" width="900" height="780"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Gallery Section Area End -->

    <!-- Partners Section Area Start -->
    <section id="partner" class="testimonials-wrap-layout2">
        <div class="section-heading style-four">
            <h2 class="titlee mt-5 wow fadeInUp animated" data-wow-delay="0.2s" data-wow-duration="1s">Hamkorlar</h2>
            </div>
        <div class="sliderPartnerOne swiper-container mb-5">
            <div class="swiper-wrapper align-items-center">
                <div class="swiper-slide">
                    <div class="col">
                        <div class="brand-box-layout4">
                            <a href="#" target="_blank"><img src="{{asset('/frontend/images/partners/minin.png')}}" class="mt-5" alt="Brand" width="270" height="112"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Partners Section Area End -->

    <!-- Location Section Area Start -->
    <section id="contact" class="location-wrap-layout1">
        <div class="section-heading style-four">
          <h2 class="titlee wow fadeInUp animated" data-wow-delay="0.2s" data-wow-duration="1s">Bog'lanish</h2>
        </div>
        <div class="location-box-layout1 has-animation d-flex">
        <div class="address d-flex flex-column">
            <div class="card">
            <img src="{{asset('/frontend/images/icon/location.svg')}}" width="50px" alt="" class="m-3">
            
            <div class="card-body">
                <h1 class="m-2">Manzilimiz</h1>
                <p class="m-2">100174, Toshkent sh., Olmazor t., Universitet ko‘ch., 7 uy.</p>
            </div>
            </div>

            <div class="card">
            <img src="{{asset('/frontend/images/icon/sms.svg')}}" width="50px" alt="" class="m-3">
            
            <div class="card-body">
                <h1 class="m-2">Email</h1>
                <a class="m-2" href="#">milliyofis@mininnovation.uz</a>
            </div>
            </div>
        </div>

        <div class="address d-flex flex-column">
            <div class="card">
            <img src="{{asset('/frontend/images/icon/call.svg')}}" width="50px" alt="" class="m-3">
            
            <div class="card-body">
                <h1 class="m-2">Telefon</h1>
                <p class="m-2">+99871 203-32-00</p>
            </div>
            </div>

            <div class="card">
            <img src="{{asset('/frontend/images/icon//clock.svg')}}" width="50px" alt="" class="m-3">
            
            <div class="card-body">
                <h1 class="m-2">Ish vaqti</h1>
                <p class="m-2">Dushanba - Juma 09:00 - 18:00</p>
            </div>
            </div>
        </div>
        <div class="map">
            <iframe class="map" style="height: 600px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6078.272327453513!2d69.2113345533416!3d41.352176589801374!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38ae8d755132b921%3A0x3d2c94a22bdea876!2sMinistry%20of%20Innovative%20Development%20of%20the%20Republic%20of%20Uzbekistan!5e0!3m2!1sen!2s!4v1662747000746!5m2!1sen!2s" style="border:0;" allowfullscreen="" loading="lazy" width="600" height="450">
            </iframe>
        </div>
        </div>
    </section>
    <!-- Location Section Area End -->

@endsection