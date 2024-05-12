@extends('web.pages.montag_layout')
@section('title', 'Contact Us Page')
@section('content')
    <div class="page-wrapper">
        @include('web.Pages.header')
        <section class="page-header">
            <div class="page-header__bg" style="background-image: url(assets/images/backgrounds/page-header-bg-1-1.jpg);">
            </div>
            <!-- /.page-header__bg -->
            <div class="container">
                <h2>Contact</h2>
                <ul class="thm-breadcrumb list-unstyled">
                    <li><a href="{{ route('home') }}" target="_blank">Home</a></li>
                    <li>/</li>
                    <li><span>Contact</span></li>
                </ul><!-- /.thm-breadcrumb list-unstyled -->
            </div><!-- /.container -->
        </section><!-- /.page-header -->
        <section class="contact-one">
            <div class="container">
                <div class="block-title text-center">
                    <div class="block-title__decor"></div><!-- /.block-title__decor -->
                    <p>Get in Touch With Us</p>
                    <h3>Do You’ve Any Question? <br>
                        Write us a Message</h3>
                </div><!-- /.block-title -->
                <form action="{{ route('sendMessage') }}" method="POST" class="contact-one__form">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="name" placeholder="Your Name">
                        </div><!-- /.col-md-6 -->
                        <div class="col-md-6">
                            <input type="text" placeholder="Email Address" name="email">
                        </div><!-- /.col-md-6 -->
                        <div class="col-md-12">
                            <input type="text" placeholder="Phone Number" name="phone">
                        </div><!-- /.col-md-6 -->
                        <div class="col-md-12">
                            <textarea placeholder="Write a Message" name="message"></textarea>
                        </div><!-- /.col-md-12 -->
                        <div class="col-md-12 text-center">
                            <button type="submit" class="thm-btn">Send a Message</button>
                        </div><!-- /.col-md-12 -->
                    </div><!-- /.row -->
                </form>
            </div><!-- /.container -->
        </section><!-- /.contact-one -->
        <section class="contact-infos">
            <div class="container">
                <div class="thm-tiny__slider" id="contact-infos-box"
                    data-tiny-options='{
            "container": "#contact-infos-box",
            "items": 1,
            "slideBy": "page",
            "gutter": 0,
            "mouseDrag": true,
            "autoplay": true,
            "nav": false,
            "controlsPosition": "bottom",
            "controlsText": ["<i class=\"fa fa-angle-left\"></i>", "<i class=\"fa fa-angle-right\"></i>"],
            "autoplayButtonOutput": false,
            "responsive": {
                "640": {
                  "items": 2,
                  "gutter": 30
                },
                "992": {
                  "gutter": 30,
                  "items": 3
                },
                "1200": {
                  "disable": true
                }
              }
        }'>
                    <div>
                        <div class="contact-infos__single">
                            <i class="organik-icon-location"></i>
                            <h3>Visit Anytime</h3>
                            <p>66 Broklyn Golden Street, <br>
                                New York. USA</p>
                        </div><!-- /.contact-infos__single -->
                    </div>
                    <div>
                        <div class="contact-infos__single">
                            <i class="organik-icon-email"></i>
                            <h3>Send Email</h3>
                            <p>
                                <a href="mailto:needhelp@organik.com">needhelp@organik.com</a>
                                <br>
                                <a href="mailto:info@company.com">info@company.com</a>
                            </p>
                        </div><!-- /.contact-infos__single -->
                    </div>
                    <div>
                        <div class="contact-infos__single">
                            <i class="organik-icon-calling"></i>
                            <h3>Call Center</h3>
                            <p><a href="tel:01128752357">01128752357</a> <br>
                                <a href="tel:01128752357">01128752357</a>
                            </p>
                        </div><!-- /.contact-infos__single -->
                    </div>
                </div>
            </div><!-- /.container -->
        </section><!-- /.contact-infos -->
        @include('web.Pages.footer')
    </div><!-- /.page-wrapper -->
    @include('web.Pages.mob_header')
@endsection
