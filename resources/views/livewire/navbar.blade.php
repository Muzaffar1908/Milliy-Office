<header id="home" class="header header1 sticky-on trheader">
    <div id="navbar-wrap" class="navbar-wrap">
      <div class="header-menu">
        <div class="header-width">
          <div class="container-fluid">
            <div class="inner-wrap">
              <div class="d-flex align-items-center justify-content-between">
                <div class="site-branding">
                  <div class="d-flex">
                    <a href="index.html" class="pt-4 logo logo-light wow fadeInUp animated" data-wow-delay="0.20s"><img src="{{asset('/frontend/images/logo/MOOFFICIAL.png')}}" alt="Logo" width="100"></a>
                  <a href="index.html" class="logo logo-light wow fadeInUp animated" data-wow-delay="0.40s">
                    <h1 class="pt-4 mt-1 mx-2 text-white">{{__('words.National Office of')}} <br> {{__('words.Innovation and')}} <br> {{__('words.Technology Transfer')}}</h1>
                  </a>
                  </div>
                  <div class="d-flex">
                    <a href="index.html" class="logo logo-dark"><img src="/frontend/images/logo/MOOFFICIAL.png" alt="Logo" width="100"></a>
                  <a href="index.html" class="logo logo-dark">
                    <h1 class="text-white pt-1 mx-2">{{__('words.National Office of')}} <br> {{__('words.Innovation and')}} <br> {{__('words.Technology Transfer')}}</h1>
                  </a>
                  </div>
                </div>
                <nav id="dropdown" class="template-main-menu menu-text-light">
                  <ul class="menu">
                    <li class="menu-item menu-item-has-children wow fadeInUp animated" data-wow-delay="0.8s">
                      <a href="#home" class="inno-cursor">{{__('words.Home')}}</a>
                    </li>

                    <li class="menu-item menu-item-has-children wow fadeInUp animated" data-wow-delay="0.8s">
                      <a class="d-flex align-items-center justify-content-center inno-cursor">{{__('words.Structure')}}
                        <i class="fa fa-angle-down mx-2"></i>
                      </a>
                      <ul class="sub-menu menu-w">
                        <li class="menu-item"><a href="#" target="_blank">Biz haqimizda</a></li>
                        <li class="menu-item"><a href="rahbariyat.html">Rahbariyat</a></li>
                        <li class="menu-item"><a href="#" target="_blank">Tashkilot tuzilmasi</a></li>
                        <li class="menu-item"><a href="#" target="_blank">Bo'limlar</a></li>
                        <li class="menu-item"><a href="#" target="_blank">Hududiy boshqarmalar</a></li>
                        <li class="menu-item"><a href="#" target="_blank">Bo'sh ish o'rinlari</a></li>
                      </ul>
                    </li>

                    <li class="menu-item menu-item-has-children wow fadeInUp animated" data-wow-delay="0.8s">
                      <a class="d-flex align-items-center justify-content-center inno-cursor">{{__('words.Activity')}}
                        <i class="fa fa-angle-down mx-2"></i>
                      </a>
                      <ul class="sub-menu menu-w">
                        <li class="menu-item"><a href="#" target="_blank">Davlat dasturi</a></li>
                        <li class="menu-item"><a href="#" target="_blank">Xalqaro hamkorliklar</a></li>
                        <li class="menu-item"><a href="#" target="_blank">Murojatlar bilan ishlash</a></li>
                        <li class="menu-item"><a href="#" target="_blank">E'lon</a></li>
                        <li class="menu-item"><a href="#" target="_blank">Ilmiy labaratoriya asbob uskunalari</a></li>
                      </ul>
                    </li>

                    <li class="menu-item menu-item-has-children wow fadeInUp animated" data-wow-delay="0.8s">
                      <a class="d-flex align-items-center justify-content-center inno-cursor">{{__('words.Open data')}}
                        <i class="fa fa-angle-down mx-2"></i>
                      </a>
                      <ul class="sub-menu menu-w">
                        <li class="menu-item"><a href="#" target="_blank">PF-6247-son Farmonga asosan ochiq ma'lumotlar</a></li>
                        <li class="menu-item"><a href="#" target="_blank">Budjet jarayonining ochiqligini ta'minlash</a></li>
                        <li class="menu-item"><a href="#" target="_blank">Statistik ma'lumotlar</a></li>
                        <li class="menu-item"><a href="#" target="_blank">??</a></li>
                        <li class="menu-item"><a href="#" target="_blank">??</a></li>
                        <li class="menu-item"><a href="#" target="_blank">Daromadlar va xarajatlar</a></li>
                        <li class="menu-item"><a href="#" target="_blank">Davlat xaridlari</a></li>
                      </ul>
                    </li>

                    <li class="menu-item menu-item-has-children wow fadeInUp animated" data-wow-delay="0.8s">
                      <a class="d-flex align-items-center justify-content-center inno-cursor">{{__('words.The press center')}}
                        <i class="fa fa-angle-down mx-2"></i>
                      </a>
                      <ul class="sub-menu menu-w">
                        <li class="menu-item"><a href="#" target="_blank">Yangiliklar</a></li>
                        <li class="menu-item"><a href="#" target="_blank">OAV biz haqimizda</a></li>
                        <li class="menu-item"><a href="#" target="_blank">Fotogaleriya</a></li>
                        <li class="menu-item"><a href="#" target="_blank">Videogaleriya</a></li>
                        <li class="menu-item"><a href="#" target="_blank">Kontetntlar bo'yicha statistika</a></li>
                        <li class="menu-item"><a href="#" target="_blank">Infografika</a></li>
                      </ul>
                    </li>

                    <li class="menu-item menu-item-has-children wow fadeInUp animated" data-wow-delay="0.8s">
                      <a href="#contact" class="inno-cursor">{{__('words.Connection')}}</a>
                    </li>

                    @php $locale = session()->get('locale'); @endphp

                    <li class="menu-item menu-item-has-children wow fadeInUp animated" data-wow-delay="0.9s">
                      <a href="{{ URL::to('locale/uz') }}" class="d-flex align-items-center justify-content-center inno-cursor">
                        <img class="mx-2" width="30" src="{{asset('/frontend/images/languages/uz.png')}}" alt="">
                        <i class="fa fa-angle-down"></i>
                      </a>
                      <ul class="sub-menu menu-color">
                        <li class="menu-item text-center"><a href="{{ URL::to('locale/en') }}"><img class="mx-2" width="30" src="{{asset('/frontend/images/languages/en.png')}}" alt=""></a>
                        </li>
                        <li class="menu-item text-center"><a href="{{ URL::to('locale/ru') }}"><img class="mx-2" width="30" src="{{asset('/frontend/images/languages/ru.png')}}" alt=""></a>
                        </li>
                      </ul>
                    </li>

                    {{-- <ul>

                      @switch($locale)
                          @case('uz')
                            <li class="menu-item menu-item-has-children wow fadeInUp animated" data-wow-delay="0.9s">
                              <a href="{{ URL::to('locale/uz') }}" class="d-flex align-items-center justify-content-center inno-cursor">
                                <img class="mx-2" width="30" src="{{asset('/frontend/images/languages/uz.png')}}" alt="">
                                <i class="fa fa-angle-down"></i>
                              </a>
                              <ul class="sub-menu menu-color">
                                <li class="menu-item text-center"><a href="{{ URL::to('locale/en') }}"><img class="mx-2" width="30" src="{{asset('/frontend/images/languages/en.png')}}" alt=""></a>
                                </li>
                                <li class="menu-item text-center"><a href="{{ URL::to('locale/ru') }}"><img class="mx-2" width="30" src="{{asset('/frontend/images/languages/ru.png')}}" alt=""></a>
                                </li>
                              </ul>
                            </li>
                              @break

                          @case('en')
                              <li class="menu-item menu-item-has-children wow fadeInUp animated" data-wow-delay="0.9s">
                                <a href="{{ URL::to('locale/en') }}" class="d-flex align-items-center justify-content-center inno-cursor">
                                  <img class="mx-2" width="30" src="{{asset('/frontend/images/languages/en.png')}}" alt="">
                                  <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="sub-menu menu-color">
                                  <li class="menu-item text-center"><a href="{{ URL::to('locale/ru') }}"><img class="mx-2" width="30" src="{{asset('/frontend/images/languages/ru.png')}}" alt=""></a>
                                  </li>
                                  <li class="menu-item text-center"><a href="{{ URL::to('locale/uz') }}"><img class="mx-2" width="30" src="{{asset('/frontend/images/languages/uz.png')}}" alt=""></a>
                                  </li>
                                </ul>
                              </li>
                              @break

                          @case('ru')
                              <li class="menu-item menu-item-has-children wow fadeInUp animated" data-wow-delay="0.9s">
                                <a href="{{ URL::to('locale/ru') }}" class="d-flex align-items-center justify-content-center inno-cursor">
                                  <img class="mx-2" width="30" src="{{asset('/frontend/images/languages/ru.png')}}" alt="">
                                  <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="sub-menu menu-color">
                                  <li class="menu-item text-center"><a href="{{ URL::to('locale/uz') }}"><img class="mx-2" width="30" src="{{asset('/frontend/images/languages/uz.png')}}" alt=""></a>
                                  </li>
                                  <li class="menu-item text-center"><a href="{{ URL::to('locale/en') }}"><img class="mx-2" width="30" src="{{asset('/frontend/images/languages/en.png')}}" alt=""></a>
                                  </li>
                                </ul>
                              </li>
                             @break    

                          @default
                              
                      @endswitch

                    </ul> --}}

                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</header>

<div class="rt-header-menu mean-container" id="meanmenu">
    <div class="mean-bar d-flex">
      <div class="d-flex">
        <a href="#"><img src="{{asset('/frontend/images/logo//logo.png')}}" alt="Logo" width="65"></a>
        <a href="#"><h6 class="mt-1 mx-2 text-dark">{{__('words.National Office of')}} <br> {{__('words.Innovation and')}} <br> {{__('words.Technology Transfer')}}</h6></a>
      </div>
      <span class="sidebarBtn">
        <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
      </span>
    </div>
    <div class="rt-slide-nav Down">
      <div class="offscreen-navigation">
        <nav class="menu-main-primary-container">
          <ul class="menu">
            <li class="list active-link">
              <a class="animation" href="#">{{__('words.Structure')}}</a>
            </li>
            <li class="list">
              <a class="animation" href="#">{{__('words.Activity')}}</a>
            </li>
            <li class="list">
              <a class="animation" href="#">{{__('words.Open data')}}</a>
            </li>
            <li class="list">
              <a class="animation" href="#">{{__('words.The press center')}}</a>
            </li>
            <li class="list">
              <a class="animation" href="#">{{__('words.Connection')}}</a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
</div>
