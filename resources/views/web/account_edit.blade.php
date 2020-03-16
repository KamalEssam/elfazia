
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
    <link rel="stylesheet" type="text/css" href="{{url("public/web")}}/css/astyle.css">
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

   <!--Start Content-->
   <div class="content">
  <div class="row">
                            <!-- Left Section -->
                            <div class="col-sm-9 col-md-9 col-lg-9">
                              <div class="my-account" style="margin-top:  30px;    padding-left: 30px;">
                                  @include('layouts.flash')
                                  @include('adminlte-templates::common.errors')

                                  <form action='{{url("account/edit/submit")}}' method='post'>
                                      {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="title-box">
                                                <h3>معلومات شخصيه</h3>
                                            </div>
                                            <ul class="list-unstyled">
                                                <li>
                                                    <div class="form-group">
                                                        <label for="">الاسم <span class="required">*</span></label>
                                                        <input type="text" name="name" value="{{auth()->user()->name}}"  class="form-control" placeholder="الاسم">
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-group">
                                                        <label for="">الهاتف <span class="required">*</span></label>
                                                        <input type="text" name="mobile" value="{{auth()->user()->mobile}}" class="form-control" placeholder="الهاتف">
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-group">
                                                        <label for="emailAddress">البريد الالكتروني <span class="required">*</span></label>
                                                        <input type="email" name="email" value="{{auth()->user()->email}}" id="emailAddress" class="form-control" placeholder="mr-atiar@example.com">
                                                    </div>
							
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="title-box">
                                                <h3>تغيير كلمة المرور</h3>
                                            </div>
                                            <ul class="list-unstyled">
                                                <li>
                                                    <div class="form-group">
                                                        <label for="cpassword">كلمة المرور الحالية <span class="required">*</span></label>
                                                        <input type="password" name="old_password" id="cpassword" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="npassword">كلمة المرور الجديدة <span class="required">*</span></label>
                                                        <input type="password" name="password" id="npassword" class="form-control">
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-group">
                                                        <label for="cnewpassword">تأكيد كلمة المرور الجديدة <span class="required">*</span></label>
                                                        <input type="password" name="confirmation_password" id="cnewpassword" class="form-control">
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="buttons-box clearfix">
                                        <button type="submit" name="submit" class="btn btn-color" value="">حفظ </button>
                                        <span class="required pull-right"><b>*</b> حقول مطلوبة</span>
                                    </div>
                                  </form>

                                </div>
                            </div>
                            <!-- /Left Section -->
                              <!-- Sidebar -->
                            <div id="sidebar" class="sidebar col-sm-3 col-md-3 col-lg-3">
                                <div class="widget">
</br></br></br>
					<img src="{{url("public/web")}}/img/profile-photo.jpg">
                                    <!-- menu-->
                                    <div id="sidebar-nav">
                                        <ul class="sidebar-nav">
                                            <li>
                                                <a href="{{url("account")}}"><i class="fa fa-gears item-icon"></i>حسابي</a>
                                            </li>
                                            <li>
                                                <a href="{{url("account/edit")}}"><i class="fa fa-user item-icon"></i>معلومات شخصيه</a>
                                            </li>
                                            <li class="active">
                                                <a href="{{url("account")}}"><i class="fa fa-gears item-icon"></i>اخر الشحنات</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /menu-->
                                </div>
                            </div>
                            <!-- /Sidebar -->

                        </div></div>
   <!--End Content-->
   
   
     @include("web.footer")