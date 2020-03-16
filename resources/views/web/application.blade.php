
<!DOCTYPE html>
<html>

<head>
    <!--
     * @Package: Shipment Tracer - Flash
    -->

    <title>Shipment Tracer - Flash</title>
    <meta charset="utf-8" />
    <!-- Page Loader - Needs to be placed in header for loading at top of all content -->
    <script type="text/javascript" src="{{url("public/web")}}/js/pace.min.js"></script>
    <link href="{{url("public/web")}}/css/pace-loading-bar.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{url("public/web")}}/css/animate.shipping.css">
    <link rel="stylesheet" type="text/css" href="{{url("public/web")}}/css/ShippingIcon.css">
    <link rel="stylesheet" type="text/css" href="{{url("public/web")}}/css/bootstrap.css">
    <!--Owl-->
    <link href="{{url("public/web")}}/css/owl.carousel.css" rel="stylesheet">
    <link href="{{url("public/web")}}/css/owl.theme.css" rel="stylesheet">
    <link href="{{url("public/web")}}/css/owl.transitions.css" rel="stylesheet">
    <!-- Main Style -->
    <link rel="stylesheet" id="main-style" type="text/css" href="{{url("public/web")}}/css/style.css">
</head>



<body class="blue page-loading">

<!-- Section Start - Header -->
<section class='header' id='header'>
    <!-- Header Top Bar - Start -->
    <div class="topbar-wrap">
        <div class="container">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 logo-area">
                <div class="logo">
                    <div>
                        <img src="{{url("public/web")}}/img/flash-logo.png">
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-8 col-sm-7 col-xs-5 menu-area">
                <!-- Menu Top Bar - Start -->
                <div class="topbar">
                    <div class="menu">
                        <div class="primary inviewport animated delay2" data-effect="">
                            <div class='cssmenu'>
                                <!-- Menu - Start -->
                                <ul class='menu-ul'>
                                    <li class='has-sub'>
                                        <a href='{{url("")}}'>الرئيسية </a>

                                    </li>
                                    <li class='has-sub'>
                                        <a href='#'>تتبع <i class='icon icon-chevron-down'></i></a>
                                        <ul>

                                            <li class='has-sub'>
                                                <a href='{{url("track/order")}}'>مسار الشحنه </a>
                                            </li>
                                            <li>
                                                <a href='{{url("estimate/order")}}'>تكلفة الشحنه</a>
                                            </li>

                                            <li>
                                                <a href='{{url("request/order")}}'>طلب شحنه</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class='has-sub'>
                                        <a href='{{url("about")}}'>عن الشركة </a>
                                    </li>
                                    <li class='has-sub'>
                                        <a href='{{url("application")}}'>حمل التطبيق</a>
                                    </li>
                                    <li class='has-sub'>
                                        <a href='{{url("contact")}}'>الاتصال بنا</a>
                                    </li>

                                    <li class='has-sub'>
                                        @if(auth()->check())
                                            <a href='{{url("account")}}'>حسابي</a>

                                        @else
                                            <a href='{{url("login")}}'>تسجيل دخول</a>

                                        @endif

                                    </li>
                                    </li>

                                </ul>
                                </li>
                                </ul>
                                <!-- Menu - End -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Menu Top Bar - End -->
                <!-- Mobile Menu - Start -->
                <div class="menu-mobile col-xs-10 pull-right cssmenu">
                    <i class="icon icon-menu menu-toggle"></i>
                    <ul class="menu" id='parallax-mobile-menu'>
                    </ul>
                </div>
                <!-- Mobile Menu - End -->
            </div>
        </div>
    </div>
    <!-- Header Top Bar - End -->
    <div class="header-bg ">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 slantbar hidden-xs"></div>
        <!-- Header Tracking Box - Start -->
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 white-wrap hidden-xs">
            <div class="white-box">
                <div class="track-order">
                    <div class="track-logo transition">
                        <i class="icon icon-logo"></i>
                    </div>
                    <h3 class="box-heading">تتبع شحنتك</h3>
                    <p class="box-tagline">ادخل رقم الشحنه</p>
                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 col-lg-offset-1 col-md-offset-1 col-sm-offset-0 col-xs-offset-0">
                        <form method='get' action="{{url("track/order")}}" class="track-form">
                            <input type="text" name='ship' placeholder="رقم الشحنه">
                            <i class="icon icon-magnify"></i>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header Tracking Box - End -->
        <!-- Header Content Slide - Start -->
        <div style="position:relative;display:inline-block;width:100%;height:auto;">
            <img src="{{url("public/web")}}/img/banner-1.jpg" alt="Header Image" class="img-responsive">
            <div class="bg-overlay"></div>
            <div class="main-wrap">
                <div class="container">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 main-content">
                        <h1>تابع شحنتك اونلاين</h1>
                        <div class="play-area">
                            <div>
                                <a class="fancybox-media" href="http://www.youtube.com/watch?v=1zclkA9PkFQ"><i class="icon icon-play"></i></a>
                            </div>
                            <span class="small">شاهد الفيديو</span>
                            <span class="title">سرعة وامان لشحنتك</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header Content Slide - End -->
        <!-- Header Social Icons - Start -->
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 social-wrap hidden-xs">
            <div class="social-box">
                <div class="social-icons-wrap">
                    <a href="#"><i class="icon icon-facebook text-on-primary"></i></a>
                    <a href="#"><i class="icon icon-twitter text-on-primary"></i></a>
                    <a href="#"><i class="icon icon-google-plus text-on-primary"></i></a>
                </div>
            </div>
        </div>
        <!-- Header Social Icons - End -->
    </div>
</section>
    <!-- Section End - Header -->
    <!-- Section Start - Tracking App -->
    <section class='bg-lightgray' id='tracking-app-mobile'>
        <div class="container">
            <div class="row">
                <h1 class="heading">Tracking App</h1>
                <div class="headul"></div>
                <p class="subheading">Lorem ipsum dolor sit amet, consectetuer adipiscing elit enean commodo eget dolor aenean massa eget dolor aenean massa</p>
                <div class="features-wrap">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="row">
                            <!-- Feature - Start -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 right-align feature inviewport animated delay1" data-effect="fadeInUp">
                                <div class="icon-wrap">
                                    <i class="icon icon-air6"></i>
                                </div>
                                <div class="info">
                                    <h5 class="title">Air Freight</h5>
                                    <p>We provide quality logistic and transport services.</p>
                                </div>
                            </div>
                            <!-- Feature - End -->
                            <!-- Feature - Start -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 right-align feature inviewport animated delay2" data-effect="fadeInUp">
                                <div class="icon-wrap">
                                    <i class="icon icon-boat17"></i>
                                </div>
                                <div class="info">
                                    <h5 class="title">Ocean Freight</h5>
                                    <p>We provide quality logistic and transport services.</p>
                                </div>
                            </div>
                            <!-- Feature - End -->
                            <!-- Feature - Start -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 right-align feature inviewport animated delay3" data-effect="fadeInUp">
                                <div class="icon-wrap">
                                    <i class="icon icon-delivery18"></i>
                                </div>
                                <div class="info">
                                    <h5 class="title">Road Freight</h5>
                                    <p>We provide quality logistic and transport services.</p>
                                </div>
                            </div>
                            <!-- Feature - End -->
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="app-phones">
                            <img src="{{url("public/web")}}/img/phone-white-blue.png" class="img-responsive phone-white style-dependent" alt="phone white">
                            <img src="{{url("public/web")}}/img/phone-black-blue.png" class="img-responsive phone-black style-dependent" alt="phone black">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="row">
                            <!-- Feature - Start -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-align feature inviewport animated delay1" data-effect="fadeInUp">
                                <div class="icon-wrap">
                                    <i class="icon icon-packages2"></i>
                                </div>
                                <div class="info">
                                    <h5 class="title">Warehousing</h5>
                                    <p>We provide quality logistic and transport services.</p>
                                </div>
                            </div>
                            <!-- Feature - End -->
                            <!-- Feature - Start -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-align feature inviewport animated delay2" data-effect="fadeInUp">
                                <div class="icon-wrap">
                                    <i class="icon icon-commercial15"></i>
                                </div>
                                <div class="info">
                                    <h5 class="title">Contract Logistics</h5>
                                    <p>We provide quality logistic and transport services.</p>
                                </div>
                            </div>
                            <!-- Feature - End -->
                            <!-- Feature - Start -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-align feature inviewport animated delay3" data-effect="fadeInUp">
                                <div class="icon-wrap">
                                    <i class="icon icon-delivery27"></i>
                                </div>
                                <div class="info">
                                    <h5 class="title">Consulting Services</h5>
                                    <p>We provide quality logistic and transport services.</p>
                                </div>
                            </div>
                            <!-- Feature - End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section End - Tracking App -->
     <!-- Section Start - Footer -->
    @include("web.footer")