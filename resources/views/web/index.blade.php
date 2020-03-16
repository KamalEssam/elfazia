
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
    <!-- Section Start - Major Services -->
    <section class='major-services gray-boxes' id='major-services'>
        <div class="container">
            <div class="row">
                <h1 class="heading">خدمات الشركة</h1>
                <div class="headul"></div>  
                <!-- Service - Start -->
                <div class="col-lg-4 col-md-4 col-md-offset-0 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 service inviewport animated delay1" data-effect="fadeInUp">
                    <div class="service-wrap">
                        <div class="pic">
                            <img alt="service-image" class="img-responsive" src="{{url("public/web")}}/img/service-1.png">
                            <div class="info-layer transition">
                                <a class="btn btn-primary fancybox" title="Air Freight Service" data-fancybox-group="service-gallery" href="img/service-1.png"><i class="icon icon-image-area"></i></a>
                            </div>
                            <div class="more">
                                <a href="#">قراءة المزيد</a>
                            </div>
                        </div>
                        <div class="info">
                            <h4 class="title">المشاريع الصغيرة والمتوسطة</h4>
                            <p>درك أهمية تمكين ومساعدة روّاد الأعمال على خلق فرصهم الخاصة، ولذلك أطلقنا برنامجاً يستهدف كافة المشاريع الصغيرة والمتوسطة ويمهّد الطريق أمام إبرام شراكات مع المزيد من الشركات الصغيرة والمتوسطة بالمناطق التي نزاول أعمالنا فيها، وذلك في إطار حرصنا المتواصل على فهم احتياجات هذه الشريحة من المشاريع ومن ثم توفير الدعم المناسب لها وتزويدها بالخدمات الضرورية.</p>
                        </div>
                    </div>
                </div>
                <!-- Service - End -->
                <!-- Service - Start -->
                <div class="col-lg-4 col-md-4 col-md-offset-0 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 service inviewport animated delay2" data-effect="fadeInUp">
                    <div class="service-wrap">
                        <div class="pic">
                            <img alt="service-image" class="img-responsive" src="{{url("public/web")}}/img/service-2.png">
                            <div class="info-layer transition">
                                <a class="btn btn-primary fancybox" title="Roadway Freight Service" data-fancybox-group="service-gallery" href="img/service-2.png"><i class="icon icon-image-area"></i></a>
                            </div>
                            <div class="more">
                                <a href="#">قراءة المزيد</a>
                            </div>
                        </div>
                        <div class="info">
                            <h4 class="title">المشاريع الصغيرة والمتوسطة</h4>
                            <p>درك أهمية تمكين ومساعدة روّاد الأعمال على خلق فرصهم الخاصة، ولذلك أطلقنا برنامجاً يستهدف كافة المشاريع الصغيرة والمتوسطة ويمهّد الطريق أمام إبرام شراكات مع المزيد من الشركات الصغيرة والمتوسطة بالمناطق التي نزاول أعمالنا فيها، وذلك في إطار حرصنا المتواصل على فهم احتياجات هذه الشريحة من المشاريع ومن ثم توفير الدعم المناسب لها وتزويدها بالخدمات الضرورية.</p>
                        </div>
                    </div>
                </div>
                <!-- Service - End -->
                <!-- Service - Start -->
                <div class="col-lg-4 col-md-4 col-md-offset-0 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 service inviewport animated delay3" data-effect="fadeInUp">
                    <div class="service-wrap">
                        <div class="pic">
                            <img alt="service-image" class="img-responsive" src="{{url("public/web")}}/img/service-3.png">
                            <div class="info-layer transition">
                                <a class="btn btn-primary fancybox" title="Ocean Freight Service" data-fancybox-group="service-gallery" href="img/service-3.png"><i class="icon icon-image-area"></i></a>
                            </div>
                            <div class="more">
                                <a href="#">قراءة المزيد</a>
                            </div>
                        </div>
                        <div class="info">
                            <h4 class="title">المشاريع الصغيرة والمتوسطة
</h4>
                            <p>درك أهمية تمكين ومساعدة روّاد الأعمال على خلق فرصهم الخاصة، ولذلك أطلقنا برنامجاً يستهدف كافة المشاريع الصغيرة والمتوسطة ويمهّد الطريق أمام إبرام شراكات مع المزيد من الشركات الصغيرة والمتوسطة بالمناطق التي نزاول أعمالنا فيها، وذلك في إطار حرصنا المتواصل على فهم احتياجات هذه الشريحة من المشاريع ومن ثم توفير الدعم المناسب لها وتزويدها بالخدمات الضرورية...</p>
                        </div>
                    </div>
                </div>
                <!-- Service - End -->
            </div>
        </div>
    </section>
    <!-- Section End - Major Services -->
    <!-- Section Start - Tracking App -->
    <section class='bg-lightgray' id='tracking-app-mobile'>
        <div class="container">
            <div class="row">
                <h1 class="heading">حمل التطبيق الان</h1>
                <div class="headul"></div>
                <p class="subheading">يمكنك طلب وتتبع وحساب تكلفة شحنتك الان بكل سهولة من خلال تطبيق شركة الشخن الخاص بنا</p>
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
   
    <!-- Section Start - Testimonials -->
    <section class='testimonials parallax ' id='testimonials'>
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row">
                <h1 class="heading">اراء عملائنا</h1>
                <div class="headul"></div>
                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                    <div class="row">
                        <!-- Testimonials Carousel - Start -->
                        <ul id="testimonial-carousel" class="owl-carousel">
                            <!-- Testimonial - Start -->
                            <li class="">
                                <h5 class="testi" data-id="testi-1">
		             من افضل شركات الشحن الموجودة فى السوق المصري من حيث السرعه والاسعار ومتابعة خدمة العملاء.. حقا يمكن الاعتماد عليها</h5>
                                <div class="testi_by">
                                    <div class="pic">
                                        <img src="{{url("public/web")}}/img/avatar-1.jpg" alt="User Avatar Image">
                                    </div>
                                    <div class="name">Kate Douglas</div>
                                    <div class="company">Company Co. In.</div>
                                </div>
                                <!-- <div class="tweet_by">Kate Douglas</div>
	              <div class="tweet_time">1 day ago</div> -->
                            </li>
                            <!-- Testimonial - End -->
                            <!-- Testimonial - Start -->
                            <li class="">
                                <h5 class="testi" data-id="testi-2">
		           		             من افضل شركات الشحن الموجودة فى السوق المصري من حيث السرعه والاسعار ومتابعة خدمة العملاء.. حقا يمكن الاعتماد عليها</h5>
                                <div class="testi_by">
                                    <div class="pic">
                                        <img src="{{url("public/web")}}/img/avatar-2.jpg" alt="User Avatar Image">
                                    </div>
                                    <div class="name">احمد معوض</div>
                                    <div class="company">ستوب جروب.</div>
                                </div>
                                <!-- <div class="tweet_by">Jim Arthur</div>
	              <div class="tweet_time">1 day ago</div> -->
                            </li>
                            <!-- Testimonial - End -->
                            <!-- Testimonial - Start -->
                            <li class="">
                                <h5 class="testi" data-id="testi-1">
		             من افضل شركات الشحن الموجودة فى السوق المصري من حيث السرعه والاسعار ومتابعة خدمة العملاء.. حقا يمكن الاعتماد عليها</h5>
 				  <div class="testi_by">
                                    <div class="pic">
                                        <img src="{{url("public/web")}}/img/avatar-1.jpg" alt="User Avatar Image">
                                    </div>
                                    <div class="name">احمد معوض</div>
                                    <div class="company">ستوب جروب.</div>
                                </div>
                                <!-- <div class="tweet_by">احمد معوض</div>
	              <div class="tweet_time">1 day ago</div> -->
                            </li>
                            <!-- Testimonial - End -->
                            <!-- Testimonial - Start -->
                            <li class="">
                                <h5 class="testi" data-id="testi-1">
		             من افضل شركات الشحن الموجودة فى السوق المصري من حيث السرعه والاسعار ومتابعة خدمة العملاء.. حقا يمكن الاعتماد عليها</h5>
 				  <div class="testi_by">
                                    <div class="pic">
                                        <img src="{{url("public/web")}}/img/avatar-1.jpg" alt="User Avatar Image">
                                    </div>
                                    <div class="name">احمد معوض</div>
                                    <div class="company">ستوب جروب.</div>
                                </div>
                                <!-- <div class="tweet_by">احمد معوض</div>
	              <div class="tweet_time">1 day ago</div> -->
                            </li>
                            <!-- Testimonial - End -->
                        </ul>
                        <!-- Testimonials Carousel - End -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section End - Testimonials -->
    <!-- Section Start - Service Estimate -->
    {{--<section class='estimate' id='estimate'>--}}
        {{--<div class="estimate-wrap">--}}
            {{--<div class="row">--}}
                {{--<div class="col-lg-8 col-md-8 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-sm-10  col-xs-offset-1 col-xs-10 ">--}}
                    {{--<h1 class="heading left-align">احسب تكلفة شحنتك الان</h1>--}}
                    {{--<div class="headul left-align"></div>--}}
                    {{--<p class="subheading left-align">الان يمكنك حساب تكلفة شحنتك بكل سهولة ويسر كل ما عليك فعله هو ملأ الخانات التاليه وسيقوم الموقع بالحساب اوتوماتيكياً</p>--}}
                {{--</div>--}}
                {{--<div class="col-lg-4 col-md-4 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-sm-10  col-xs-offset-1 col-xs-10 ">--}}
                    {{--<!-- Estimate Form - Start -->--}}
                    {{--<div class='row'>--}}
                        {{--<form action='#' method='post'>--}}
                            {{--<div class='col-xs-12'>--}}
                                {{--<label>نوع الشحنه</label>--}}
                                {{--<input type='text' placeholder='' class='transition' id='est_load_type'>--}}
                            {{--</div>--}}
                            {{--<div class='col-xs-6'>--}}
                                {{--<label>العدد</label>--}}
                                {{--<input type='text' placeholder='' class='transition' id='est_qty'>--}}
                            {{--</div>--}}
                            {{--<div class='col-xs-6'>--}}
                                {{--<label>وزن</label>--}}
                                {{--<input type='text' placeholder='' class='transition' id='est_weight'>--}}
                            {{--</div>--}}
                            {{--<div class='col-xs-4'>--}}
                                {{--<label>طول</label>--}}
                                {{--<input type='text' placeholder='' class='transition' id='est_length'>--}}
                            {{--</div>--}}
                            {{--<div class='col-xs-4'>--}}
                                {{--<label>عرض</label>--}}
                                {{--<input type='text' placeholder='' class='transition' id='est_height'>--}}
                            {{--</div>--}}
                            {{--<div class='col-xs-4'>--}}
                                {{--<label>ارتفاع</label>--}}
                                {{--<input type='text' placeholder='' class='transition' id='est_width'>--}}
                            {{--</div>--}}
                            {{--<div class='col-xs-12'>--}}
                                {{--<label>التكلفة (يتم الاحتساب تلقائي)</label>--}}
                                {{--<input type='text' placeholder='' class='transition' id='est_total'>--}}
                            {{--</div>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                    {{--<!-- Estimate Form - End -->--}}
                {{--</div>--}}
                {{--<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 pic">--}}
                    {{--<img src="{{url("public/web")}}/img/estimate-fork-blue.jpg" class="img-responsive style-dependent" alt="Estimate Fork Image">--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</section>--}}
    <!-- Section End - Service Estimate -->
    <!-- Section Start - Our Clients -->
    <section class='clients bg-primary white-text' id='clients'>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <h1 class="heading left-align">عملائنا الكرام</h1>
                    <div class="headul left-align"></div>
                    <!-- Client Image - Start -->
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 client inviewport animated delay1" data-effect="fadeInUp">
                        <h4><img alt="client-logo" src="{{url("public/web")}}/img/client-1.png" class="img-responsive"></h4>
                    </div>
                    <!-- Client Image - End -->
                    <!-- Client Image - Start -->
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 client inviewport animated delay2" data-effect="fadeInUp">
                        <h4><img alt="client-logo" src="{{url("public/web")}}/img/client-2.png" class="img-responsive"></h4>
                    </div>
                    <!-- Client Image - End -->
                    <!-- Client Image - Start -->
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 client inviewport animated delay3" data-effect="fadeInUp">
                        <h4><img alt="client-logo" src="{{url("public/web")}}/img/client-3.png" class="img-responsive"></h4>
                    </div>
                    <!-- Client Image - End -->
                    <!-- Client Image - Start -->
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 client inviewport animated delay4" data-effect="fadeInUp">
                        <h4><img alt="client-logo" src="{{url("public/web")}}/img/client-4.png" class="img-responsive"></h4>
                    </div>
                    <!-- Client Image - End -->
                </div>
            </div>
        </div>
    </section>
    <!-- Section End - Our Clients -->
    <!-- Section Start - Get In Touch -->
    <section class='contact contact-small' id='contact'>
        <div class="container">
            <div class="row">
                @include('layouts.flash')
                @include('adminlte-templates::common.errors')

                <h1 class="heading">تواصل معنا</h1>
                <div class="headul"></div>
                <p class="subheading">يسعدنا تواصلكم معنا على مدار اليوم لتلقي طلباتكم واستفساراتكم من خلال ما يلي</p>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                    <!-- Contact Form - Start -->
                    <div class='row'>
                        <form action='{{url("contact/send/save")}}' method='post'>
                            {{csrf_field()}}
                            <div class='col-xs-6'>
                                <input type='text' name="name" placeholder='الاسم' class='transition' i>
                            </div>
                            <div class='col-xs-6'>
                                <input type='text' name="email" placeholder='البريد الالكتروني' class='transition' >
                            </div>
                            <div class='col-xs-12'>
                                <textarea class='transition' name="message" placeholder='الرسالة' ></textarea>
                            </div>
                            <div id='response_email' class='col-xs-12'></div>
                            <div class='col-xs-4'>
                                <button type='submit' name="submit" class='btn btn-primary' id=''>ارسل الرسالة</button>
                            </div>
                        </form>
                    </div>
                    <!-- Contact Form - End -->
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                    <div class="contact-info">
                        <i class="icon icon-envelope"></i>
                        <div class="title">البريد الالكتروني</div>
                        <div class="value">mr.ahmed@stop-group.com</div>
                    </div>
                    <div class="contact-info">
                        <i class="icon icon-phone"></i>
                        <div class="title">الهاتف</div>
                        <div class="value">+02-01013799885</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section End - Get In Touch -->
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="row">
            <div id="contact-map" class="gmap"></div>
        </div>
    </div>



@include("web.footer")