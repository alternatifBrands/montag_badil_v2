<header class="main-header">
    <div class="topbar">
        <div class="container">
            <div class="main-logo">
                <a href="{{ route('home') }}" class="logo" target="_blank">
                    <img src="{{ asset('logo.png') }}" width="100" height="100" alt="Montag_Logo">
                </a>
                <div class="mobile-nav__buttons">
                    <a href="#" class="search-toggler"><i class="organik-icon-magnifying-glass"></i></a>
                    {{-- <a href="#" class="mini-cart__toggler"><i class="organik-icon-shopping-cart"></i></a> --}}
                </div><!-- /.mobile__buttons -->

                <span class="fa fa-bars mobile-nav__toggler"></span>
            </div><!-- /.main-logo -->

            <div class="topbar__left">
                <div class="topbar__social">
                    <a target="_blank" href="https://twitter.com/?lang=ar" class="fab fa-twitter"></a>
                    <a target="_blank" href="https://www.facebook.com/" class="fab fa-facebook-square"></a>
                    <a target="_blank" href="https://www.instagram.com/" class="fab fa-instagram"></a>
                </div><!-- /.topbar__social -->
                <div class="topbar__info">
                    <i class="organik-icon-email"></i>
                    <p>Email <a href="mailto:alternatifurunler@b1rincitech.com">alternatifurunler@b1rincitech.com</a></p>
                </div><!-- /.topbar__info -->
            </div><!-- /.topbar__left -->
            <div class="topbar__right">
                <div class="topbar__info">
                    <i class="organik-icon-calling"></i>
                    <p>Phone <a href="tel:01128752357">01128752357</a></p>
                </div><!-- /.topbar__info -->
                <div class="topbar__buttons">
                    <a href="#" class="search-toggler"><i class="organik-icon-magnifying-glass"></i></a>
                </div><!-- /.topbar__buttons -->
            </div><!-- /.topbar__left -->

        </div><!-- /.container -->
    </div><!-- /.topbar -->
    <nav class="main-menu">
        <div class="container">
            @auth
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="userDropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Hello, {{ auth()->user()->name }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            @else
                <div class="main-menu__login">
                    <a href="{{ route('login') }}"><i class="organik-icon-user"></i>Login / Register</a>
                </div><!-- /.main-menu__login -->
            @endauth

            <ul class="main-menu__list">
                <li>
                    <a href="{{ route('home') }}" target="_blank">Home</a>
                </li>
                <li>
                    <a href="{{ route('about') }}" target="_blank">About</a>
                </li>

                <li>
                    <a href="{{ route('terms') }}" target="_blank">terms & conditions</a>
                </li>

                <li><a href="{{ route('contact') }}" target="_blank">Contact</a></li>
            </ul>
        </div><!-- /.container -->
    </nav>
    <!-- /.main-menu -->
</header><!-- /.main-header -->

<div class="stricky-header stricked-menu main-menu">
    <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
</div><!-- /.stricky-header -->
