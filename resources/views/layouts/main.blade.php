<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>{{__('words.National Office of Innovation')}}
  </title>
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('/frontend/images/logo/logo.png')}}">


  <!-- Dependency Styles -->
  <link rel="stylesheet" href="{{asset('/frontend/assets/wow/animate.css')}}">
  <link rel="stylesheet" href="{{asset('/frontend/assets/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('/frontend/assets/fontawesome/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('/frontend/assets/magnific-popup/css/magnific-popup.css')}}">
  <link rel="stylesheet" href="{{asset('/frontend/assets/swiper/css/swiper.min.css')}}">
  <link rel="stylesheet" href="{{asset('/frontend/css/app.css')}}">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

     @livewire('navbar')

     @yield('content')

     
     @livewire('footer')
      
    


  <!-- Dependency Scripts -->
  <script src="{{asset('/frontend/assets/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('/frontend/assets/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('/frontend/assets/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
  <script src="{{asset('/frontend/assets/magnific-popup/js/magnific-popup.min.js')}}"></script>
  <script src="{{asset('/frontend/assets/wow/wow.min.js')}}"></script>
  <script src="{{asset('/frontend/assets/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('/frontend/assets/swiper/js/swiper.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
  <!-- Custom Script -->

  <script src="{{asset('/frontend/js/app.js')}}"></script>

</body>
</html>