@extends('web.pages.montag_layout')
@section('title', 'Brand Details')
@section('content')
    <div class="page-wrapper">
        @include('web.pages.header')
        <section class="page-header">
            <div class="page-header__bg" style="background-image: url(assets/images/backgrounds/page-header-bg-1-1.jpg);">
            </div>
            <!-- /.page-header__bg -->
            <div class="container">
                <h2>Brand</h2>
                <ul class="thm-breadcrumb list-unstyled">
                    <li style="color:white"><a href="{{ route('home') }}">Home</a></li>
                    <li>/</li>
                    <li style="color:white">brand</li>
                </ul><!-- /.thm-breadcrumb list-unstyled -->
            </div><!-- /.container -->
        </section><!-- /.page-header -->


        <section class="product_detail">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        <div class="product_detail_image">
                            <img src="{{ Storage::disk('public')->url($brand->image) }}" alt="">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="product_detail_content">
                            <h2>{{ $brand->name }}</h2>
                            <div class="product_detail_text">
                                <p>Description:{{ $brand->description }}</p>
                            </div>
                            <ul class="list-unstyled category_tag_list">
                                <li>Category: {{ $brand->category->name }}</li>
                                <li>URL: <a href="{{ $brand->url }}">{{ $brand->url }}</a></li>
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
                                <li data-tab="#review" class="tab-btn active-btn"><span>Alternatives Of This
                                        Brand</span></li>
                            </ul>
                            <div class="tabs-content">
                                <div class="tab" id="desc">
                                    <div class="product-details-content">
                                        <div class="desc-content-box">
                                            <p>{{ $brand->description }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab" id="addi__info">
                                    <div class="product-details-content">
                                        <div class="desc-content-box">
                                            <p>{{ $brand->notes }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab active-tab" id="review">
                                    <div class="reviews-box">
                                        <div class="row filter-layout">

                                            @foreach ($brand->brandAlternatives as $alternative)
                                                <div class="product-card__two">
                                                    <div class="product-card__two-image">
                                                        <img id="edit_image"
                                                            src="{{ Storage::disk('public')->url($alternative->image) }}"
                                                            alt="{{ $alternative->name }}">
                                                        <div class="product-card__two-image-content">
                                                            <a href="{{ route('brandAlternative.details', $alternative->id) }}"
                                                                target="_blank"><i class="organik-icon-visibility"></i></a>
                                                        </div><!-- /.product-card__two-image-content -->
                                                        </img><!-- /.product-card__two-image -->
                                                        <div class="product-card__two-content">
                                                            <h3><a href="{{ route('brandAlternative.details', $alternative->id) }}"
                                                                    target="_blank">{{ $alternative->name }}</a>
                                                            </h3>
                                                            {{-- <p>{{ $brand->description }}</p> --}}
                                                        </div><!-- /.product-card__two-content -->
                                                    </div><!-- /.product-card__two -->
                                            @endforeach
                                        </div><!-- /.row -->
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
