@extends('layouts.main')

@section('content')

    <div class="bread-crumb-section">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-8 d-flex justify-content-lg-start justify-content-center flex-column">
                    <h2 class="bread-crumb-title">News Show</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb gap-3 m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('page-index')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">News Show</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-4">
                    <div class="circle-text-common circel-tex-area1">
                        <img src="{{asset('/assets/images/icons/camera-icon.svg')}}" alt="image">
                        <p id="CircleTypeText1" class="circle-text">SCROLL * DOWN NOW&nbsp; </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
     use Carbon\Carbon;
    ?>

    <div class="blog-grid-section pt-120 pb-120 mb-44 overflow-hidden">
        <div class="container">
            <div class="row justify-content-center gy-5">
                <div class="col-lg-8 pe-lg-4 pe-0">
                    <div class="blog-standard-single">
                        <div class="blog-image">
                          <img src="{{asset('/upload/news/'. $news->news_image.'_bigImage_1920.png')}}" alt="image"> 
                        </div>
                        <div class="blog-content">
                            <ul class="blog-stand-meta">
                                <li>{{Carbon::parse($news->created_at)->format('F d, Y')}}</li>
                            </ul>
                            <h3><a data-cursor="Read Details">{{$news->title}}</a></h3>
                            <p>a{{strip_tags($news->long_text)}}</p>
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
                                            <a href="{{route('newsShowx', ['id' => $post->id])}}"><img src="{{asset('/upload/news/'. $post->news_image.'_thumbnail_450.png')}}" alt="image"></a>   
                                        </div>
                                        <div class="blog-content">
                                            <div class="blog-date">{{Carbon::parse($post->created_at)->format('d.m.Y')}}</div>
                                            <h5><a href="{{route('newsShowx', ['id' => $post->id])}}">{{$post->title}}.</a></h5>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="blog-widget mt-5">
                            <h4 class="blog-widget-title">Social Media</h4>
                            <ul class="social-three">
                                <li>
                                  <a href="https://www.instagram.com/"><i class='bx bxl-linkedin'></i></a>
                                </li>
                                <li>
                                  <a href="https://www.dribbble.com/"><i class='bx bxl-pinterest-alt'></i></a>
                                </li>
                                <li>
                                  <a href="https://www.pinterest.com/"><i class='bx bxl-instagram'></i></a>
                                </li>
                                <li>
                                  <a href="https://www.twitter.com/"><i class='bx bxl-facebook'></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection