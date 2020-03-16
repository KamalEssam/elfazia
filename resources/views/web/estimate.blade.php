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
      <script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
</head>



<body class="blue page-loading">
@php
 $config = App\Models\Config::first();

@endphp
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
    <!-- Section Start - Service Estimate -->
    <section class='estimate' id='estimate'>
        <div class="estimate-wrap">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-sm-10  col-xs-offset-1 col-xs-10 ">
                    <h1 class="heading left-align">احسب تكلفة شحنتك</h1>
                    <div class="headul left-align"></div>
                    <p class="subheading left-align">تعرّف على أسعارنا التنافسية في السوق
</p>
                </div>
                <div class="col-lg-4 col-md-4 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-sm-10  col-xs-offset-1 col-xs-10 ">
                    <!-- Estimate Form - Start -->
                    <div class='row'>
                        @include('layouts.flash')
                        @include('adminlte-templates::common.errors')


                        <form action='{{url("estimate/order")}}' method='get'>
                            <div class='col-xs-12'>
                                <label>نوع الشحنه</label>
                                <select class="form-control" name="shippment_type">
                                    <option value="1">مستند</option>
                                    <option value="2">صندوق</option>

                                </select>
                            </div>
                            <div class='col-xs-6'>
                                <label>من </label>
                                <select class="form-control" name="from_city">
                                   @foreach($cities as $city)
                                        <option value="{{$city->id}}" @if(request("from_city") != null && request("from_city") == $city->id) selected @endif>{{$city->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class='col-xs-6'>
                                <label>الي</label>
                                <select class="form-control" name="to_city">
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}" @if(request("to_city") != null && request("to_city") == $city->id) selected @endif>{{$city->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class='col-xs-6 document'>
                                <label>الكمية</label>
                                <input type='text' name="number_of_piece" value="{{request("number_of_piece")}}" placeholder='' class='transition' id='est_qty'>
                            </div>
                            <div class='col-xs-6 parcel' style="display:none">
                                <label>الوزن</label>
                                <input type='text ' name="weight" value="{{request("weight")}}" placeholder='' class='transition' id='est_weight'>
                            </div>
                            <div class='col-xs-6 parcel' style="display:none">
                                <label>الطول</label>
                                <input type='text' name="height" value="{{request("height")}}" placeholder='' class='transition' id='est_length'>
                            </div>
                            <div class='col-xs-6 parcel' style="display:none">
                                <label>العرض</label>
                                <input type='text' name="width" value="{{request("width")}}" placeholder='' class='transition' id='est_height'>
                            </div>
                            <div class='col-xs-6 parcel' style="display:none">
                                <label>الارتفاع</label>
                                <input type='text' name="length" value="{{request("length")}}" placeholder='' class='transition' id='est_width'>
                            </div>
                            <div class='col-xs-12'>
                                <label>تاريخ الشحن المراد التوصيل فيه</label>
                                <input type='date'  name="delivery_date" value="{{request("delivery_date")}}" placeholder='' class='transition' id='est_width'>
                            </div>
                            <div class='col-xs-12'>
                                <button type="submit" class="btn btn-secondary" name="submit">حساب</button>

                            </div>
                            <div class='col-xs-12'>
                                <label>الاجمالي (يتم الاحتساب تلقائي)</label>
                                <input type='text' placeholder='0' value="@if(isset($total)) {{$total}} @endif" readonly class='transition' id='est_total'>
                            </div>
                        </form>
                    </div>
                    <!-- Estimate Form - End -->
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 pic">
                    <img src="{{url("public/web")}}/img/estimate-fork-blue.jpg" class="img-responsive style-dependent" alt="Estimate Fork Image">
                </div>
            </div>
        </div>
    </section>
    <!-- Section End - Service Estimate -->
    <!-- Section Start - Provided Services -->
    <section class='features bg-lightgray' id='features'>
        <div class="container">
            <div class="row">
                <h1 class="heading">خدمات الشركة</h1>
                <div class="headul"></div>
                <div class="features">
                    <!-- Feature - Start -->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 feature-block inviewport animated delay1" data-effect="fadeInUp">
                        <div class="icon-wrap">
                            <i class="icon icon-airplane68"></i>
                        </div>
                        <div class="info">
                            <h4 class="title">الخدمة الاولى </h4>
                            <p>وصف الخدمة وصف الخدمة وصف الخدمة وصف الخدمة وصف الخدمة وصف الخدمة وصف الخدمة وصف الخدمة وصف الخدمة وصف الخدمة وصف الخدمة وصف الخدمة .</p>
                        </div>
                    </div>
                    <!-- Feature - End -->
                    <!-- Feature - Start -->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 feature-block inviewport animated delay2" data-effect="fadeInUp">
                        <div class="icon-wrap">
                            <i class="icon icon-frontal19"></i>
                        </div>
                        <div class="info">
                            <h4 class="title">الخدمة الثانية</h4>
                            <p>وصف الخدمة وصف الخدمة وصف الخدمة وصف الخدمة وصف الخدمة وصف الخدمة وصف الخدمة وصف الخدمة وصف الخدمة وصف الخدمة وصف الخدمة وصف الخدمة </p>
                        </div>
                    </div>
                    <!-- Feature - End -->
                    <!-- Feature - Start -->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 feature-block inviewport animated delay1" data-effect="fadeInUp">
                        <div class="icon-wrap">
                            <i class="icon icon-train20"></i>
                        </div>
                        <div class="info">
                            <h4 class="title">الخدمة الثالثه</h4>
                            <p>وصف الخدمة وصف الخدمة وصف الخدمة وصف الخدمة وصف الخدمة وصف الخدمة وصف الخدمة وصف الخدمة وصف الخدمة روصف الخدمة وصف الخدمة وصف الخدمة .</p>
                        </div>
                    </div>
                    <!-- Feature - End -->
                    <!-- Feature - Start -->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 feature-block inviewport animated delay2" data-effect="fadeInUp">
                        <div class="icon-wrap">
                            <i class="icon icon-ocean3"></i>
                        </div>
                        <div class="info">
                            <h4 class="title">الخدمة الرابعه</h4>
                            <p>وصف الخدمة وصف الخدمة وصف الخدمة وصف الخدمة وصف الخدمة وصف الخدمة وصف الخدمة وصف الخدمة وصف الخدمة وصف الخدمة وصف الخدمة وصف الخدمة وصف الخدمة وصف الخدمة .</p>
                        </div>
                    </div>
                    <!-- Feature - End -->
                </div>
            </div>
        </div>
    </section>
    <!-- Section End - Provided Services -->


@include("web.footer")

<script>
    function estimate(e) {
        var record_id = $(e).data("id");
        $.get('{{url("admin/users/active")}}'+"/"+record_id, function (data) {
            if (data.length !== 0)
            {
                if(data.success)
                {
                    makeToast(data.message,1);
                    datatable.api().ajax.reload();

                }
                else
                {
                    makeToast(data.message,0);
                }


            }

        });


    }

</script>


<script>
    $('select[name="shippment_type"]').change(function(){
        var val = $(this).val();
        if(val == "1"){
            $(".parcel").css('display','none');
            $(".document").css('display','block');
            
        }else if(val == "2"){
            
            $(".document").css('display','none');
            $(".parcel").css('display','block');
        }
    });
    
    $('input[name="weight"]').keyup(function(){
        if($(this).val() > <?php echo $config->max_weight ?>){
             alert(' الحد الاقصى  للوزن<?php echo $config->max_weight ?> ');
             $(this).val('');
        }
    });
    
      $('input[name="height"]').keyup(function(){
        if($(this).val() > <?php echo $config->max_height ?>){
            alert(' الحد الاقصى للارتفاع <?php echo $config->max_height ?> ');
            $(this).val('');
        }
    });
    
      $('input[name="width"]').keyup(function(){
        if($(this).val() > <?php echo $config->max_width ?>){
           alert(' الحد الاقصى للعرض <?php echo $config->max_width ?> ');
           
           $(this).val('');
        }
    });
    
    
       $('input[name="length"]').keyup(function(){
        if($(this).val() > <?php echo $config->max_length ?>){
            alert(' الحد الاقصى للطول <?php echo $config->max_length ?> ');
            $(this).val('');
        }
    });
    
    
</script>