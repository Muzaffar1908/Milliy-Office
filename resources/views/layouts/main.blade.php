<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Innovatsiyalar Milliy Ofisi</title>
    <link rel="icon" href="{{asset('/assets/images/logo/logo.png')}}" type="image/gif" sizes="20x20">
    <link rel="stylesheet" href="{{asset('/assets/css/animate.css')}}">

    <link rel="stylesheet" href="{{asset('/assets/css/all.css')}}">

    <link rel="stylesheet" href="{{asset('/assets/css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('/assets/css/boxicons.min.css')}}">

    <link rel="stylesheet" href="{{asset('/assets/css/bootstrap-icons.css')}}">

    <link rel="stylesheet" href="{{asset('/assets/css/jquery-ui.css')}}">

    <link rel="stylesheet" href="{{asset('/assets/css/swiper-bundle.css')}}">

    <link rel="stylesheet" href="{{asset('/assets/css/odometer.css')}}">

    <link rel="stylesheet" href="{{asset('/assets/css/jquery.fancybox.min.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{asset('/assets/css/style.css')}}">
</head>

<body class="tt-magic-cursor">
    <!-- <div class="preloader">
        <div class="counter">0</div>
    </div>
    <div id="magic-cursor">
        <div id="ball"></div>
    </div> -->

    @livewire('navbar')


    @yield('content')


    <!-- <div class="portfolio-section section-common2 pb-120 pl-80 ">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="section-title-two">
                        <h2>Portfolio</h2>
                    </div>
                </div>
            </div>
            <div class="row mb-70">
                <div class="col-12">
                    <ul class="nav nav-tabs portfolio-tab-list mb-70" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#tab-slider-one" aria-selected="false"
                                role="tab" tabindex="-1">All<span>50</span></a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-slider-two" aria-selected="false"
                                role="tab">Fashion<span>50</span>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-slider-three" aria-selected="false"
                                role="tab">Wedding<span>80</span></a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-slider-four" aria-selected="false"
                                role="tab">Nature<span>150</span></a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-slider-five" aria-selected="false"
                                role="tab">Lifestyle<span>350</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade" id="tab-slider-one" role="tabpanel">
                            <div class="swiper portfolio-slider-one position-relative">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="assets/images/portfolio/port-slider1.png" alt="image">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="assets/images/portfolio/port-slider2.png" alt="image">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="assets/images/portfolio/port-slider3.png" alt="image">
                                    </div>
                                </div>
                                <div class="slider-arrows d-flex justify-content-between">
                                    <div class="portfolio-prev1 swiper-prev-arrow" tabindex="0" role="button"
                                        aria-label="Previous slide">

                                    </div>
                                    <div class="portfolio-next1 swiper-next-arrow" tabindex="0" role="button"
                                        aria-label="Next slide">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade active show" id="tab-slider-two" role="tabpanel">
                            <div class="swiper portfolio-slider-one position-relative">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="assets/images/portfolio/port-slider1.png" alt="image">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="assets/images/portfolio/port-slider2.png" alt="image">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="assets/images/portfolio/port-slider3.png" alt="image">
                                    </div>
                                </div>
                                <div class="slider-arrows d-flex justify-content-between">
                                    <div class="portfolio-prev1 swiper-prev-arrow" tabindex="0" role="button"
                                        aria-label="Previous slide">
                                    </div>
                                    <div class="portfolio-next1 swiper-next-arrow" tabindex="0" role="button"
                                        aria-label="Next slide">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-slider-three" role="tabpanel">
                            <div class="swiper portfolio-slider-one position-relative">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="assets/images/portfolio/port-slider1.png" alt="image">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="assets/images/portfolio/port-slider2.png" alt="image">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="assets/images/portfolio/port-slider3.png" alt="image">
                                    </div>
                                </div>
                                <div class="slider-arrows d-flex justify-content-between">
                                    <div class="portfolio-prev1 swiper-prev-arrow" tabindex="0" role="button"
                                        aria-label="Previous slide">
                                    </div>
                                    <div class="portfolio-next1 swiper-next-arrow" tabindex="0" role="button"
                                        aria-label="Next slide">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-slider-four" role="tabpanel">
                            <div class="swiper portfolio-slider-one position-relative">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="assets/images/portfolio/port-slider1.png" alt="image">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="assets/images/portfolio/port-slider2.png" alt="image">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="assets/images/portfolio/port-slider3.png" alt="image">
                                    </div>
                                </div>
                                <div class="slider-arrows d-flex justify-content-between">
                                    <div class="portfolio-prev1 swiper-prev-arrow" tabindex="0" role="button"
                                        aria-label="Previous slide">
                                    </div>
                                    <div class="portfolio-next1 swiper-next-arrow" tabindex="0" role="button"
                                        aria-label="Next slide">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-slider-five" role="tabpanel">
                            <div class="swiper portfolio-slider-one position-relative">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="assets/images/portfolio/port-slider1.png" alt="image">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="assets/images/portfolio/port-slider2.png" alt="image">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="assets/images/portfolio/port-slider3.png" alt="image">
                                    </div>
                                </div>
                                <div class="slider-arrows d-flex justify-content-between">
                                    <div class="portfolio-prev1 swiper-prev-arrow" tabindex="0" role="button"
                                        aria-label="Previous slide">
                                    </div>
                                    <div class="portfolio-next1 swiper-next-arrow" tabindex="0" role="button"
                                        aria-label="Next slide">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <a href="portfolio-masonary.html" class="eg-btn btn--primary btn--lg">View Portfolio</a>
                </div>
            </div>
        </div>
    </div> -->

    <!-- footer -->
       @livewire('footer')


    <!-- <div class="award-section section-common2 pb-120 pl-80">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="section-title-two">
                        <h2>My Awards</h2>
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-3 order-1">
                    <div class="big-title transform-top">
                        <h2>Got Many valuable Awards.</h2>
                    </div>
                </div>
                <div class="col-lg-5 order-lg-2 order-3">
                    <div class="tab-content">
                        <div class="tab-pane fade" id="tab-one" role="tabpanel">
                            <div class="swiper award-slider">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="assets/images/award/award1-1.png" alt="image">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="assets/images/award/award1-2.png" alt="image">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade active show" id="tab-two" role="tabpanel">
                            <div class="swiper award-slider">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="assets/images/award/award2-1.png" alt="image">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="assets/images/award/award2-2.png" alt="image">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-three" role="tabpanel">
                            <div class="swiper award-slider">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="assets/images/award/award3-1.png" alt="image">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="assets/images/award/award1-2.png" alt="image">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-four" role="tabpanel">
                            <div class="swiper award-slider">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="assets/images/award/award1-1.png" alt="image">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="assets/images/award/award1-2.png" alt="image">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-five" role="tabpanel">
                            <div class="swiper award-slider">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="assets/images/award/award1-1.png" alt="image">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="assets/images/award/award1-2.png" alt="image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 order-lg-3 order-2">
                    <ul class="nav nav-tabs award-tab-list" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#tab-one" aria-selected="false"
                                role="tab" tabindex="-1">
                                <span>Carmignac Photojournalism.</span><span>2022</span>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-two" aria-selected="false" role="tab">
                                <span>International Grant..</span><span>2021</span>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-three" aria-selected="false" role="tab">
                                <span>HIPA International..</span><span>2020</span>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-four" aria-selected="false" role="tab">
                                <span>Nikon World Competition.</span><span>2019</span>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-five" aria-selected="false" role="tab">
                                <span>Lucis Photo Awards.</span><span>2018</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="testimonial-section2 section-common2 pb-120 pl-80">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="section-title-two">
                        <h2>Client Feedback</h2>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6 col-sm-12 order-lg-1 order-2">
                    <div class="swiper testi-image-slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="assets/images/testimonial/testi1-1.png" alt="image">
                            </div>
                            <div class="swiper-slide">
                                <img src="assets/images/testimonial/testi1-2.png" alt="image">
                            </div>
                            <div class="swiper-slide">
                                <img src="assets/images/testimonial/testi1-3.png" alt="image">
                            </div>
                            <div class="swiper-slide">
                                <img src="assets/images/testimonial/testi1-4.png" alt="image">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 position-relative order-lg-2 order-1">
                    <div class="section-title-one text-lg-start text-center d-lg-flex d-none">
                        <h2>Lets find what My honored members say.</h2>
                    </div>
                    <div
                        class="slider-arrows arrows-style-1 text-center d-lg-flex d-none flex-row justify-content-lg-end justify-content-center align-items-center w-100 gap-3 mb-50">
                        <div class="testi1-prev swiper-prev-arrow" tabindex="0" role="button"
                            aria-label="Previous slide">
                            <i class="bi bi-chevron-left"></i>
                        </div>
                        <div class="testi1-next swiper-next-arrow" tabindex="0" role="button" aria-label="Next slide">
                            <i class="bi bi-chevron-right"></i>
                        </div>
                    </div>
                    <div class="swiper testi-content-slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="testi-single-one">
                                    <div class="testi-header">
                                        <div class="designation">
                                            <h3>Savannah Nguyen</h3>
                                            <span>Executive CEO</span>
                                        </div>
                                        <div class="review-area">
                                            <ul class="review-list">
                                                <li><i class="bi bi-star-fill"></i></li>
                                                <li><i class="bi bi-star-fill"></i></li>
                                                <li><i class="bi bi-star-fill"></i></li>
                                                <li><i class="bi bi-star-fill"></i></li>
                                                <li><i class="bi bi-star-fill"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="testi-body">
                                        <p>Quisque magna lorem, mattis a auctor eu, commodo vitae ligulaMo
                                            ante id vulputate ultrices, eros est lacinia quam, vel finibus nibh nisls
                                            Nulla ut dolor arcu.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="testi-single-one">
                                    <div class="testi-header">
                                        <div class="designation">
                                            <h3>Anjelina Lira</h3>
                                            <span>Executive Manager</span>
                                        </div>
                                        <div class="review-area">
                                            <ul class="review-list">
                                                <li><i class="bi bi-star-fill"></i></li>
                                                <li><i class="bi bi-star-fill"></i></li>
                                                <li><i class="bi bi-star-fill"></i></li>
                                                <li><i class="bi bi-star-fill"></i></li>
                                                <li><i class="bi bi-star-fill"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="testi-body">
                                        <p>Quisque magna lorem, mattis a auctor eu, commodo vitae ligulaMo
                                            ante id vulputate ultrices, eros est lacinia quam, vel finibus nibh nisls
                                            Nulla ut dolor arcu. commodo vehicula.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="testi-single-one">
                                    <div class="testi-header">
                                        <div class="designation">
                                            <h3>Emma Watson</h3>
                                            <span>Area Manager</span>
                                        </div>
                                        <div class="review-area">
                                            <ul class="review-list">
                                                <li><i class="bi bi-star-fill"></i></li>
                                                <li><i class="bi bi-star-fill"></i></li>
                                                <li><i class="bi bi-star-fill"></i></li>
                                                <li><i class="bi bi-star-fill"></i></li>
                                                <li><i class="bi bi-star-fill"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="testi-body">
                                        <p>Ante id vulputate ultrices, eros est lacinia quam, vel finibus nibh nisls
                                            Nulla ut dolor arcu. Praesent vel justo at quam semper lobortis in rutrum
                                            justo vehicula a ex.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="testi-single-one">
                                    <div class="testi-header">
                                        <div class="designation">
                                            <h3>Savannah Nguyen</h3>
                                            <span>Executive CEO</span>
                                        </div>
                                        <div class="review-area">
                                            <ul class="review-list">
                                                <li><i class="bi bi-star-fill"></i></li>
                                                <li><i class="bi bi-star-fill"></i></li>
                                                <li><i class="bi bi-star-fill"></i></li>
                                                <li><i class="bi bi-star-fill"></i></li>
                                                <li><i class="bi bi-star-fill"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="testi-body">
                                        <p>Eros est lacinia quam, vel finibus nibh auctor eu, commodo vitae ligulaMo
                                            ante id vulputate ultrices, nisls
                                            Nulla ut dolor arcu. Praesent vel justo at in.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="contact-section3 section-common2 pb-120 pl-80 mb-44">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="section-title-two">
                        <h2>Get In Touch</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center align-items-center">
                <div class="col-xl-7 col-lg-6">
                    <h3 class="form-title">Have Any Questions</h3>
                    <form class="contact-me-form">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-inner">
                                    <input type="text" placeholder="Enter your name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-inner">
                                    <input type="text" placeholder="Enter your email">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-inner">
                                    <input type="text" placeholder="Querry">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-inner">
                                    <textarea rows="6" placeholder="Write Your message"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="eg-btn btn--primary btn--lg">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-xl-5 col-lg-6 ps-lg-4 ps-auto">
                    <div class="contact-content">
                        <h2><span>Let’s talk</span>About Your Photography.</h2>
                        <p>I started getting on into photography when my family moved from oni Nevada to Ohio gong
                            toubleta.I started getting on into photographyai when my family moved from Nevada to.</p>
                    </div>
                    <div class="phone-block">
                        <div class="phone-title">Urgent? <span>Call Me</span></div>
                        <h4><a href="tel:+012-3456-789102">+012-3456-789102</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div> -->


    

    <script src="{{asset('/assets/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('/assets/js/jquery-ui.js')}}"></script>
    <script src="{{asset('/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('/assets/js/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('/assets/js/circletype.min.js')}}"></script>
    <script src="{{asset('/assets/js/odometer.min.js')}}"></script>
    <script src="{{asset('/assets/js/viewport.jquery.js')}}"></script>
    <script src="{{asset('/assets/js/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('/assets/js/SmoothScroll.js')}}"></script>
    <script src="{{asset('/assets/js/sidebar.js')}}"></script>
    <script src="{{asset('/assets/js/masonry.pkgd.min.js')}}"></script>
    <script src="{{asset('/assets/js/imagesloaded.pkgd.js')}}"></script>
    <script src="{{asset('/assets/js/gsap.min.js')}}"></script>
    <script src="{{asset('/assets/js/cursor.js')}}"></script>
    <script src="{{asset('/assets/js/jquery.marquee.min.js')}}"></script>
    <script src="{{asset('/assets/js/TweenMax.min.js')}}"></script>
    <script src="{{asset('/assets/js/jquery.fancybox.min.js')}}"></script>
    <script src="{{asset('/assets/js/main.js')}}"></script>

</body>

</html>