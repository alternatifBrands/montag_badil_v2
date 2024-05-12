<footer class="site-footer background-black-2">
    <img src="{{ asset('assets/images/shapes/footer-bg-1-1.png') }}" alt="" class="site-footer__shape-1">
    <img src="{{ asset('assets/images/shapes/footer-bg-1-2.png') }}" alt="" class="site-footer__shape-2">
    <div class="container">
        <div class="row" style="justify-content: center">
            <div class="col-md-3">
                <div class="footer-widget footer-widget__about-widget">
                    <a href="{{ route('home') }}" class="footer-widget__logo">
                        <img src="{{ asset('logo.png') }}" alt="" width="100" height="100">
                    </a>
                    <p class="thm-text-dark">Atiam rhoncus sit amet adip
                        scing sed ipsum. Lorem ipsum
                        dolor sit amet adipiscing <br>
                        sem neque.</p>
                </div><!-- /.footer-widget -->
            </div><!-- /.col-sm-12 col-md-6 -->
            <div class="col-md-3">
                <div class="footer-widget footer-widget__contact-widget">
                    <h3 class="footer-widget__title">Contact</h3><!-- /.footer-widget__title -->
                    <ul class="list-unstyled footer-widget__contact">
                        <li>
                            <i class="fa fa-phone-square"></i>
                            <a href="tel:01128752357">01128752357</a>
                        </li>
                        <li>
                            <i class="fa fa-envelope"></i>
                            <a href="mailto:sahla@test.com">sahla@test.com</a>
                        </li>
                        <li>
                            <i class="fa fa-map-marker-alt"></i>
                            <a href="#">66 top broklyn street.
                                New York</a>
                        </li>
                    </ul><!-- /.list-unstyled footer-widget__contact -->
                </div><!-- /.footer-widget -->
            </div><!-- /.col-sm-12 col-md-6 col-lg-2 -->
            <div class="col-md-3">
                <div class="footer-widget footer-widget__links-widget">
                    <h3 class="footer-widget__title">Links</h3><!-- /.footer-widget__title -->
                    <ul class="list-unstyled footer-widget__links">
                        <li>
                            <a href="{{ route('about') }}">About</a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}">Contact</a>
                        </li>
                    </ul><!-- /.list-unstyled footer-widget__contact -->
                </div><!-- /.footer-widget -->
            </div><!-- /.col-sm-12 col-md-6 col-lg-2 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
    <div class="bottom-footer">
        <div class="container">
            <hr>
            <div class="inner-container text-center">
                <div class="bottom-footer__social">
                    <a target="_blank" href="https://twitter.com/?lang=ar" class="fab fa-twitter"></a>
                    <a target="_blank" href="https://www.facebook.com/" class="fab fa-facebook-square"></a>
                    <a target="_blank" href="https://www.instagram.com/" class="fab fa-instagram"></a>
                </div><!-- /.bottom-footer__social -->
                <p class="thm-text-dark">© Copyright <span class="dynamic-year"></span> by sahla@test.com</p>
            </div><!-- /.inner-container -->
        </div><!-- /.container -->
    </div><!-- /.bottom-footer -->
</footer><!-- /.site-footer -->