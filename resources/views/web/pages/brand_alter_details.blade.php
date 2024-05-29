@extends('web.pages.montag_layout')
@section('title', 'Brand Alternative Details')
@section('content')
    <div class="page-wrapper">
        @include('web.pages.header')
        <section class="page-header">
            <div class="page-header__bg" style="background-image: url(assets/images/backgrounds/page-header-bg-1-1.jpg);">
            </div>
            <!-- /.page-header__bg -->
            <div class="container">
                <h2>Brand Alternative</h2>
                <ul class="thm-breadcrumb list-unstyled">
                    <li style="color:white"><a href="{{ route('home') }}">Home</a></li>
                    <li>/</li>
                    <li style="color:white">brand_alternative</li>
                </ul><!-- /.thm-breadcrumb list-unstyled -->
            </div><!-- /.container -->
        </section><!-- /.page-header -->


        <section class="product_detail">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        <div class="product_detail_image">
                            <img src="{{ Storage::disk('public')->url($brand_alt->image) }}" alt="">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="product_detail_content">
                            <h2>{{ $brand_alt->name }}</h2>
                            <div class="product_detail_text">
                                <p>Description:{{ $brand_alt->description }}</p>
                            </div>
                            <ul class="list-unstyled category_tag_list">
                                <li>Category: {{ $brand_alt->category->name }}</li>
                                <li>URL: <a href="{{ $brand_alt->url }}">{{ $brand_alt->url }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="product-tab-box tabs-box">
                            <ul class="tab-btns tab-buttons clearfix list-unstyled">
                                <li data-tab="#desc" class="tab-btn"><span>description</span></li>
                                <li data-tab="#addi__info" class="tab-btn"><span>Additional Notes</span></li>
                            </ul>
                            <div class="tabs-content">
                                <div class="tab" id="desc">
                                    <div class="product-details-content">
                                        <div class="desc-content-box">
                                            <p>{{ $brand_alt->description }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab" id="addi__info">
                                    <div class="product-details-content">
                                        <div class="desc-content-box">
                                            <p>{{ $brand_alt->notes }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('web.pages.footer')
    </div><!-- /.page-wrapper -->
    @include('web.pages.mob_header')
@endsection
