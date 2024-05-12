@extends('web.pages.montag_layout')
@section('title', 'Home Page')
@section('content')
    <div class="page-wrapper">
        @include('web.pages.header')
        <section class="main-slider">
            <div class="swiper-container thm-swiper__slider"
                data-swiper-options='{
    "slidesPerView": 1,
    "loop": true,
    "effect": "fade",
    "autoplay": {
        "delay": 5000
    },
    "navigation": {
        "nextEl": "#main-slider__swiper-button-next",
        "prevEl": "#main-slider__swiper-button-prev"
    }
    }'>
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="image-layer"
                            style="background-image: url({{ asset('assets/images/main-slider/main-slider-1-1.jpg);') }}">
                        </div>
                        <!-- /.image-layer -->
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 text-center">
                                    <h2><span>Montag Badil</span> <br>
                                        Brand</h2>
                                    {{-- <a href="products.html" class=" thm-btn">Order Now</a> --}}
                                    <!-- /.thm-btn dynamic-radius -->
                                </div><!-- /.col-lg-7 text-right -->
                            </div><!-- /.row -->
                        </div><!-- /.container -->
                    </div><!-- /.swiper-slide -->
                    <div class="swiper-slide">
                        <div class="image-layer"
                            style="background-image: url({{ asset('assets/images/main-slider/main-slider-1-2.jpg);') }}">
                        </div>
                        <!-- /.image-layer -->
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 text-center">
                                    <h2><span>Montag Badil</span> <br>
                                        Alternative Brand</h2>
                                    {{-- <a href="products.html" class=" thm-btn">Order Now</a> --}}
                                    <!-- /.thm-btn dynamic-radius -->
                                </div><!-- /.col-lg-7 text-right -->
                            </div><!-- /.row -->
                        </div><!-- /.container -->
                    </div><!-- /.swiper-slide -->
                </div><!-- /.swiper-wrapper -->

                <!-- If we need navigation buttons -->
                <div class="main-slider__nav">
                    <div class="swiper-button-prev" id="main-slider__swiper-button-next"><i
                            class="organik-icon-left-arrow"></i>
                    </div>
                    <div class="swiper-button-next" id="main-slider__swiper-button-prev"><i
                            class="organik-icon-right-arrow"></i></div>
                </div><!-- /.main-slider__nav -->

            </div><!-- /.swiper-container thm-swiper__slider -->
        </section><!-- /.main-slider -->

        <section class="new-products" style="margin-top: 30px">
            <img src="{{ asset('assets/images/shapes/new-product-shape-1.png') }}" alt=""
                class="new-products__shape-1">
            <div class="container">
                <div class="new-products__top">
                    <div class="block-title ">
                        <div class="block-title__decor"></div><!-- /.block-title__decor -->
                        <p>Recently Added</p>
                        <h3>New Brands</h3>
                    </div><!-- /.block-title -->
                    
                    <ul class="post-filter filters list-unstyled">
                        <li class="active filter" data-filter=".filter-item">All</li>
                        @foreach ($categories as $category)
                            <li class="filter" data-filter=".{{ $category->name }}">{{ $category->name }}</li>
                        @endforeach
                    </ul>
                </div><!-- /.new-products__top -->
                @auth
                    <div style="margin-bottom:35px">
                        <a class="button-3" role="button" href="{{route('brand.insert')}}" target="_blank">Insert Brand</a>
                        <a class="button-3" role="button" href="{{route('Alternaivebrand.insert')}}" target="_blank">Insert Alternative Brand</a>
                        <a class="button-3" role="button" href="{{route('map.insert')}}" target="_blank">Map Brand With Alternatives</a>
                    </div>
                @endauth
                <div class="row filter-layout">
                    @foreach ($categories as $category)
                        @foreach ($category->brands as $brand)
                                <div class="col-lg-4 col-md-6 filter-item {{ $category->name }}">
                                    <div class="product-card__two">
                                        <div class="product-card__two-image">
                                            <img id="edit_image" src="{{ Storage::disk('public')->url($brand->image) }}"
                                                alt="{{ $brand->name }}">
                                            <div class="product-card__two-image-content">
                                                <a href="{{ route('brand.details', $brand->id) }}" target="_blank"><i
                                                        class="organik-icon-visibility"></i></a>
                                            </div><!-- /.product-card__two-image-content -->
                                        </div><!-- /.product-card__two-image -->
                                        <div class="product-card__two-content">
                                            <h3><a href="{{ route('brand.details', $brand->id) }}"
                                                    target="_blank">{{ $brand->name }}</a>
                                            </h3>
                                            {{-- <p>{{ $brand->description }}</p> --}}
                                        </div><!-- /.product-card__two-content -->
                                    </div><!-- /.product-card__two -->
                                </div><!-- /.col-lg-4 -->
                            
                        @endforeach
                    @endforeach
                </div><!-- /.row -->

            </div><!-- /.container -->
        </section><!-- /.new-products -->

        <section class="offer-banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="0ms">
                        <div class="offer-banner__box"
                            style="background-image: url({{ asset('assets/images/resources/offer-banner-1-1.jpg);') }}">
                            <div class="offer-banner__content">
                                <h3><span>{{$brands}}</span> <br>Brand</h3>
                                {{-- <a href="products.html" class="thm-btn">Order Now</a><!-- /.thm-btn --> --}}
                            </div><!-- /.offer-banner__content -->
                        </div><!-- /.offer-banner__box -->
                    </div><!-- /.col-md-6 -->
                    <div class="col-md-6 wow fadeInRight" data-wow-duration="1500ms" data-wow-delay="100ms">
                        <div class="offer-banner__box"
                            style="background-image: url({{ asset('assets/images/resources/offer-banner-1-2.jpg);') }}">
                            <div class="offer-banner__content">
                                <h3><span>{{$brand_alternatives}}</span> <br>Alternative Brand</h3>
                                {{-- <a href="products.html" class="thm-btn">Order Now</a><!-- /.thm-btn --> --}}
                            </div><!-- /.offer-banner__content -->
                        </div><!-- /.offer-banner__box -->
                    </div><!-- /.col-md-6 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.offer-banner -->

        <section class="funfact-one jarallax" data-jarallax data-speed="0.3" data-imgPosition="50% 50%" style="margin-bottom: 50px">
            <img src="{{ asset('assets/images/backgrounds/funfact-bg-1-1.jpg') }}" class="jarallax-img" alt="">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-md-6 col-lg-3  wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="0ms">
                        <div class="funfact-one__single">
                            <h3 class="odometer" data-count="{{$categories_count}}">00</h3>
                            <p>Category Available</p>
                        </div><!-- /.funfact-one__single -->
                    </div><!-- /.col-md-6 col-lg-3 -->
                    <div class="col-md-6 col-lg-3  wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="100ms">
                        <div class="funfact-one__single">
                            <h3 class="odometer" data-count="{{$brands}}">00</h3>
                            <p>Brand Available</p>
                        </div><!-- /.funfact-one__single -->
                    </div><!-- /.col-md-6 col-lg-3 -->
                    <div class="col-md-6 col-lg-3  wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="200ms">
                        <div class="funfact-one__single">
                            <h3 class="odometer" data-count="{{$brand_alternatives}}">00</h3>
                            <p>Alternative Brand Available</p>
                        </div><!-- /.funfact-one__single -->
                    </div><!-- /.col-md-6 col-lg-3 -->
                    <div class="col-md-6 col-lg-3  wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="300ms">
                        <div class="funfact-one__single">
                            <h3 class="odometer" data-count="{{$users}}">00</h3>
                            <p>Our Users</p>
                        </div><!-- /.funfact-one__single -->
                    </div><!-- /.col-md-6 col-lg-3 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.funfact-one -->
        @include('web.pages.footer')
    </div><!-- /.page-wrapper -->
    @include('web.pages.mob_header')
@endsection
