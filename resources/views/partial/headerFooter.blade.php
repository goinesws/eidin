<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Eidin</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="/img/icon.ico" />

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="/frontend/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/frontend/css/LineIcons.3.0.css" />
    <link rel="stylesheet" href="/frontend/css/tiny-slider.css" />
    <link rel="stylesheet" href="/frontend/css/glightbox.min.css" />
    <link rel="stylesheet" href="/frontend/css/main.css" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    @include('sweetalert::alert')
    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- /End Preloader -->

    <!-- Start Header Area -->
    <header class="header navbar-area shadow-sm">
        <!-- Start Header Middle -->
        <div class="header-middle">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-3 col-7">
                        <!-- Start Header Logo -->
                        <a class="navbar-brand" href="/">
                            <img src="/img/logo.png" alt="Logo">
                        </a>
                        <!-- End Header Logo -->
                    </div>
                    <div class="col-lg-5 col-md-7 d-xs-none">
                        <!-- Start Main Menu Search -->
                        <div class="main-menu-search">
                            <!-- navbar search start -->
                            <form action="/search" method="get">
                                <div class="navbar-search search-style-5">
                                    <div class="search-input">
                                        <input type="text" placeholder="@lang('headerFooter.header.discover_game')..." name="search"
                                            class="form-control">
                                    </div>
                                    <div class="search-btn">
                                        <button type="submit" class="btn"><i
                                                class="lni lni-search-alt"></i></button>
                                    </div>
                                </div>
                            </form>
                            <!-- navbar search Ends -->
                        </div>
                        <!-- End Main Menu Search -->
                    </div>
                    <div class="col-lg-4 col-md-2 col-5">
                        <div class="middle-right-area">
                            <div class="main-menu-search">
                                <!-- navbar search start -->
                                <form action="/changeLang" method="get">
                                    <div class="navbar-search search-style-5">
                                        <div class="search-input d-flex align-items-center">
                                            @lang('headerFooter.header.language'):
                                            <select name="lang" id="lang" class="form-select"
                                                style="margin-left:5px">
                                                <?php
                                                $lang = request()
                                                    ->session()
                                                    ->get('locale');
                                                ?>
                                                <option value="/lang/en"
                                                    {{ $lang != null && $lang == 'en' ? 'selected' : '' }}>English
                                                </option>
                                                <option value="/lang/id"
                                                    {{ $lang != null && $lang == 'id' ? 'selected' : '' }}>Indonesia
                                                </option>
                                                <option value="/lang/snd"
                                                    {{ $lang != null && $lang == 'snd' ? 'selected' : '' }}>Basa Sunda
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                                <!-- navbar search Ends -->
                            </div>
                            {{-- @dump(request()->session()->get('locale')) --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header Middle -->
        <!-- Start Header Bottom -->
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="nav-inner">
                        <!-- Start Mega Category Menu -->
                        <div class="mega-category-menu">
                            <span class="cat-button"><i class="lni lni-menu"></i>@lang('headerFooter.header.category')</span>
                            <ul class="sub-category">
                                @foreach ($category_nav as $item)
                                    <li><a href="/category/{{ $item->id }}">{{ $item->genre_name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- End Mega Category Menu -->
                        <!-- Start Navbar -->
                        <nav class="navbar navbar-expand-lg">
                            <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav ms-auto">
                                    <li class="nav-item">
                                        <a href="/" class="{{ $active == 'Home' ? 'active' : '' }}"
                                            aria-label="Toggle navigation">@lang('headerFooter.header.home')</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/all-games" class="{{ $active == 'All Games' ? 'active' : '' }}"
                                            aria-label="Toggle navigation">@lang('headerFooter.header.all_games')</a>
                                    </li>

                                    @if (Auth::check() && Auth::user()->role == 'user')
                                        <li class="nav-item">
                                            <a href="/myLibrary" class="{{ $active == 'Libraries' ? 'active' : '' }}"
                                                aria-label="Toggle navigation">@lang('headerFooter.header.library')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/wishlist" class="{{ $active == 'Wishlist' ? 'active' : '' }}"
                                                aria-label="Toggle navigation">@lang('headerFooter.header.wishlist')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="dd-menu collapsed {{ $active == 'Profile' ? 'active' : '' }}"
                                                href="javascript:void(0)" data-bs-toggle="collapse"
                                                data-bs-target="#submenu-1-2" aria-controls="navbarSupportedContent"
                                                aria-expanded="false"
                                                aria-label="Toggle navigation">@lang('headerFooter.header.profile')</a>
                                            <ul class="sub-menu collapse" id="submenu-1-2">
                                                <li class="nav-item"><a href="/myProfile"
                                                        class="">@lang('headerFooter.header.my_profile')</a></li>
                                                <li class="nav-item"><a href="/changePassword">@lang('headerFooter.header.change_password')</a>
                                                </li>
                                                <li class="nav-item"><a href="/myDonation">@lang('headerFooter.header.donation_history')</a></li>
                                            </ul>
                                        </li>
                                    @endif

                                    @if (Auth::check() && Auth::user()->developer == null && Auth::user()->role == 'user')
                                        <li class="nav-item">
                                            {{-- khusus buat yg belum registrasi dev --}}
                                            <a href="/dev-registration"
                                                class="{{ $active == 'Developer Registration' ? 'active' : '' }}"
                                                aria-label="Toggle navigation">@lang('headerFooter.header.developer_registration')</a>
                                        </li>
                                    @endif

                                    @if (Auth::check() && Auth::user()->developer != null)
                                        <li class="nav-item">
                                            <a class="dd-menu collapsed {{ $active == 'Developer' ? 'active' : '' }}"
                                                href="javascript:void(0)" data-bs-toggle="collapse"
                                                data-bs-target="#submenu-1-2" aria-controls="navbarSupportedContent"
                                                aria-expanded="false"
                                                aria-label="Toggle navigation">@lang('headerFooter.header.developer')</a>
                                            <ul class="sub-menu collapse" id="submenu-1-2">
                                                <li class="nav-item"><a
                                                        href="/dev/upload-game">@lang('headerFooter.header.uploadGame')</a>
                                                </li>
                                                <li class="nav-item"><a
                                                        href="/developer/{{ Auth::user()->developer->id }}"
                                                        class="">@lang('headerFooter.header.company_profile')</a></li>
                                                <li class="nav-item"><a
                                                        href="/dev/purchase-donation">@lang('headerFooter.header.purchases&donations')</a>
                                                </li>
                                            </ul>
                                        </li>
                                    @endif

                                    @if (Auth::check() && Auth::user()->role == 'admin')
                                        <li class="nav-item">
                                            <a class="dd-menu collapsed {{ $active == 'Admin' ? 'active' : '' }}"
                                                href="javascript:void(0)" data-bs-toggle="collapse"
                                                data-bs-target="#submenu-1-2" aria-controls="navbarSupportedContent"
                                                aria-expanded="false"
                                                aria-label="Toggle navigation">@lang('headerFooter.header.admin')</a>
                                            <ul class="sub-menu collapse" id="submenu-1-2">
                                                <li class="nav-item"><a href="/admin/pending"
                                                        class="">@lang('headerFooter.header.pending_games')</a></li>
                                                {{-- <li class="nav-item"><a href="login.html">Reviews</a></li>
                                                <li class="nav-item"><a href="register.html">Donations</a></li> --}}
                                                <li class="nav-item"><a href="/admin/manage-tags"
                                                        class="">@lang('headerFooter.header.manage_tags')</a></li>
                                                <li class="nav-item"><a href="/admin/manage-genres"
                                                        class="">@lang('headerFooter.header.manage_genres')</a></li>
                                            </ul>
                                        </li>
                                    @endif

                                    @if (!Auth::check())
                                        <li class="nav-item">
                                            <a href="/login" class="{{ $active == 'Login' ? 'active' : '' }}"
                                                aria-label="Toggle navigation">@lang('headerFooter.header.login')</a>
                                        </li>
                                    @else
                                        <li class="nav-item">
                                            <a href="/logout" aria-label="Toggle navigation"
                                                class="text-danger">@lang('headerFooter.header.logout')</a>
                                        </li>
                                    @endif
                                </ul>
                            </div> <!-- navbar collapse -->
                        </nav>
                        <!-- End Navbar -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header Bottom -->
    </header>
    <!-- End Header Area -->

    <div>
        @yield('content')
    </div>

    <!-- Start Footer Area -->
    <footer class="footer d-flex flex-column">
        <!-- Start Footer Top -->
        <div class="footer-top">
            <div class="container">
                <div class="inner-content">
                    <div class="row">
                        <div class="col-lg-4 col-12" >
                            <div class="footer-logo">
                                <a href="/">
                                    <img src="/frontend/images/logo/logo.png" alt="/">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12 d-flex justify-content-center">
                            <div class="footer-newsletter">
                                <h4 class="title mt-4">
                                    Copyright &copy; <?php echo date ('Y'); ?> Eidin, inc.
                                    <span>All rights reserved.</span>
                                </h4>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12 d-flex justify-content-center">
                            <div class="footer-newsletter">
                                <h4 class="title mt-3 ">
                                    <a href="#" class="fw-normal fs-6 lh-lg">@lang('headerFooter.footer.footer_top.privacy')</a></br>
                                    <a href="#" class="fw-normal fs-6 lh-lg">@lang('headerFooter.footer.footer_top.terms')</a></br>
                                    <a href="#" class="fw-normal fs-6 lh-lg">@lang('headerFooter.footer.footer_top.legal')</a>
                                </h4>

                            </div>
                        </div>
                        {{-- <!-- Single Widget -->
                        <div class="single-footer f-contact col-lg-4">
                            <h3>@lang('headerFooter.footer.footer_middle.1')</h3>
                            <p class="phone">@lang('headerFooter.footer.footer_middle.2')</p>
                            <ul>
                                <li><span>@lang('headerFooter.footer.footer_middle.3') </span> 9.00 am - 8.00 pm</li>
                                <li><span>@lang('headerFooter.footer.footer_middle.4') </span> 10.00 am - 6.00 pm</li>
                            </ul>
                            <p class="mail">
                                <a href="mailto:support@eidin.com">@lang('headerFooter.footer.footer_middle.5')</a>
                            </p>
                        </div>
                        <!-- End Single Widget --> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Top -->
        {{-- <!-- Start Footer Middle -->
        <div class="footer-middle">
            <div class="container">
                <div class="bottom-inner">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-contact">
                                <h3>@lang('headerFooter.footer.footer_middle.1')</h3>
                                <p class="phone">@lang('headerFooter.footer.footer_middle.2')</p>
                                <ul>
                                    <li><span>@lang('headerFooter.footer.footer_middle.3') </span> 9.00 am - 8.00 pm</li>
                                    <li><span>@lang('headerFooter.footer.footer_middle.4') </span> 10.00 am - 6.00 pm</li>
                                </ul>
                                <p class="mail">
                                    <a href="mailto:support@shopgrids.com">@lang('headerFooter.footer.footer_middle.5')</a>
                                </p>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-link">
                                <h3>@lang('headerFooter.footer.footer_middle.6')</h3>
                                <ul>
                                    @foreach ($category_nav as $item)
                                        <li><a href="/category/{{ $item->id }}">{{ $item->genre_name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-link">
                                <h3>@lang('headerFooter.footer.footer_middle.11')</h3>
                                <ul>
                                    <li><a href="javascript:void(0)">@lang('headerFooter.footer.footer_middle.information.1')</a></li>
                                    <li><a href="javascript:void(0)">@lang('headerFooter.footer.footer_middle.information.2')</a></li>
                                    <li><a href="javascript:void(0)">@lang('headerFooter.footer.footer_middle.information.3')</a></li>
                                    <li><a href="javascript:void(0)">@lang('headerFooter.footer.footer_middle.information.4')</a></li>
                                    <li><a href="javascript:void(0)">@lang('headerFooter.footer.footer_middle.information.5')</a></li>
                                </ul>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Middle --> --}}
        <!-- Start Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="inner-content">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-12">
                            <div class="payment-gateway">
                                <span>@lang('headerFooter.footer.footer_bottom.1')</span>
                                <img src="/frontend/images/footer/credit-cards-footer.png" alt="#">
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="copyright">
                                <p>@lang('headerFooter.footer.footer_bottom.2')<a href="/" rel="nofollow"
                                        target="_blank">@lang('headerFooter.footer.footer_bottom.3')</a></p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <ul class="socila">
                                <li>
                                    <span>@lang('headerFooter.footer.footer_bottom.4')</span>
                                </li>
                                <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-instagram"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Bottom -->
    </footer>
    <!--/ End Footer Area -->

    <!-- ========================= scroll-top ========================= -->
    <a href="#" class="scroll-top">
        <i class="lni lni-chevron-up"></i>
    </a>

    <!-- ========================= JS here ========================= -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    {{-- <script src="/frontend/js/bootstrap.min.js"></script> --}}
    <script src="/frontend/js/tiny-slider.js"></script>
    <script src="/frontend/js/glightbox.min.js"></script>
    <script src="/frontend/js/main.js"></script>
    <script type="text/javascript">
        //========= Hero Slider
        tns({
            container: '.hero-slider',
            slideBy: 'page',
            autoplay: true,
            autoplayButtonOutput: false,
            mouseDrag: true,
            gutter: 0,
            items: 1,
            nav: false,
            controls: true,
            controlsText: ['<i class="lni lni-chevron-left"></i>', '<i class="lni lni-chevron-right"></i>'],
        });

        //======== Brand Slider
        tns({
            container: '.brands-logo-carousel',
            autoplay: true,
            autoplayButtonOutput: false,
            mouseDrag: true,
            gutter: 15,
            nav: false,
            controls: false,
            responsive: {
                0: {
                    items: 1,
                },
                540: {
                    items: 3,
                },
                768: {
                    items: 5,
                },
                992: {
                    items: 6,
                }
            }
        });
    </script>
</body>

</html>
