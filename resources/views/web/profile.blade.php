
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
            <!-- My Order Table -->
            <div class="col-sm-9 col-md-9 col-lg-9">

                <div class="my-account" style="padding-top: 30px;">
                    <div class="bottom-padding">
                        <h3 class="hello">اهلا بك يا احمد </h3>
                    </div>
                    <div class="bottom-padding">
                        <div class="title-box">
                            <h3>اخر الشحنات</h3>
                        </div>
                        <!-- Table  -->
                        <div class="table-responsive">
                            @include('layouts.flash')

                            <table class="table table-striped table-bordered table-responsive text-left my-orders-table">
                                <thead>
                                <tr class="first last">
                                    <th>رقم الشحنه</th>
                                    <th>التاريخ</th>
                                    <th>اسم المندوب</th>
                                    <th><span class="nobr">القيمة</span></th>
                                    <th>الحاله</th>
                                    <th>مرسلة اليك</th>
                                    <th>عرض أو الغاء الطلب</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php /** @var \App\Models\Order $oder **/ @endphp
                                @foreach($orders as $order)
                                    <tr>

                                        <td>{{$order->uniqueID}}</td>
                                        <td>{{$order->estimate_delivery_date}}</td>
                                        <td>@if($order->delivery != null ) {{$order->delivery->name}} @endif</td>
                                        <td><span class="price">جنيه {{$order->price}}</span></td>
                                        @if($order->status == \App\Models\Order::$statuses["canceled"])
                                        <td class="text-danger"><em>{{\Helper\Common\__lang(\App\Models\Order::$statusesText[$order->status])}}</em></td>

                                        @elseif($order->status == \App\Models\Order::$statuses["waiting"])
                                        <td class="text-primary"><em>{{\Helper\Common\__lang(\App\Models\Order::$statusesText[$order->status])}}</em></td>
                                        @else
                                            <td class="text-color"><em>{{\Helper\Common\__lang(\App\Models\Order::$statusesText[$order->status])}}</em></td>
                                        @endif

                                        @if(auth()->id() == $order->from_client_id)
                                            <td class="text-primary">لا</td>
                                        @else
                                            <td class="text-primary">نعم</td>

                                        @endif


                                            <td class="text-center last">
                                            <div class="btn-group">
                                                @if($order->status == \App\Models\Order::$statuses["waiting"])
                                                <a href="{{url("order/cancel/".$order->id)}}" class="btn btn-default">الغاء الطلب</a>
                                                @endif
                                                <button class="btn btn-color"  data-toggle="modal" data-target="#exampleModalLong_{{$order->id}}">عرض الطلب</button>

                                            </div>
                                        </td>
                                    </tr>


                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalLong_{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">{{$order->uniqueID}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                 <div class="container-fluid">
                                                     <!-- Id Field -->
                                                     <div class="form-group">
                                                         {!! Form::label('id', 'رقم الشحنة') !!}
                                                         <p >{!! $order->uniqueID !!}</p>
                                                     </div>

                                                     <!-- From Street Field -->
                                                     <div class="form-group">
                                                         {!! Form::label('from_street', 'اسم الشارع') !!}
                                                         <p>{!! $order->from_street !!}</p>
                                                     </div>

                                                     <!-- From Building Field -->
                                                     <div class="form-group">
                                                         {!! Form::label('from_building', 'رقم  المبني') !!}
                                                         <p>{!! $order->from_building !!}</p>
                                                     </div>

                                                     <!-- From Lat Field -->
                                                     <div class="form-group">
                                                         {!! Form::label('from_lat', 'العنوان بالكامل') !!}
                                                         <p>{!! \Helper\Common\__address($order->from_lat,$order->from_lng) !!}</p>
                                                     </div>

                                                     <!-- From City Field -->
                                                     <div class="form-group">
                                                         {!! Form::label('from_city', 'من منطقة') !!}
                                                         <p>{!! $order->fromCity->name_ar !!}</p>
                                                     </div>



                                                     <!-- To Street Field -->
                                                     <div class="form-group">
                                                         {!! Form::label('to_street', 'الي الشارع') !!}
                                                         <p>{!! $order->to_street !!}</p>
                                                     </div>

                                                     <!-- To Building Field -->
                                                     <div class="form-group">
                                                         {!! Form::label('to_building', 'الي المبني') !!}
                                                         <p>{!! $order->to_building !!}</p>
                                                     </div>

                                                     <!-- To Lat Field -->
                                                     <div class="form-group">
                                                         {!! Form::label('to_lat', 'عنوان المرسل اليه بالكامل') !!}
                                                         <p>{!! \Helper\Common\__address($order->to_lat,$order->to_lng); !!}</p>
                                                     </div>


                                                     <!-- To City Field -->
                                                     <div class="form-group">
                                                         {!! Form::label('to_city', 'الي المنقطة') !!}
                                                         <p>{!! $order->toCity->name_ar !!}</p>
                                                     </div>

                                                     <!-- To Client Id Field -->
                                                     <div class="form-group">
                                                         {!! Form::label('to_client_id', ' المرسل اليه') !!}
                                                         @if($order->toClient != null)
                                                             <p>{!! $order->toClient->name !!}</p>
                                                         @endif
                                                     </div>

                                                     <!-- Shippment Type Field -->
                                                     <div class="form-group">
                                                         {!! Form::label('shippment_type', 'نوع الشحنة') !!}
                                                         <p>{!! \App\Models\Order::$shippmentTypeText[$order->shippment_type] !!}</p>
                                                     </div>

                                                     <!-- Shippment Img Field -->
                                                     <div class="form-group">
                                                         {!! Form::label('shippment_img', 'صورة الشحنة') !!}
                                                         <p><img src="{!! $order->shippment_img !!}" style="width: 100px;height: 100px;" class="img-cricle"></p>
                                                     </div>

                                                     <!-- Status Field -->
                                                     <div class="form-group">
                                                         {!! Form::label('status', 'حالة الطلب') !!}
                                                         <p>{!! \App\Models\Order::$statusesText[$order->status] !!}</p>
                                                     </div>

                                                     <!-- Delivery Id Field -->
                                                     <div class="form-group">
                                                         {!! Form::label('delivery_id', 'المندوب') !!}
                                                         @if($order->delivery != null)
                                                             <p>{!! $order->delivery->name !!}</p>
                                                         @endif
                                                     </div>

                                                     <!-- Number Of Piece Field -->
                                                     <div class="form-group">
                                                         {!! Form::label('number_of_piece', 'عدد القطع') !!}
                                                         <p>{!! $order->number_of_piece !!}</p>
                                                     </div>

                                                     <!-- Number Of Kilo Field -->
                                                     <div class="form-group">
                                                         {!! Form::label('number_of_kilo', 'الوزن') !!}
                                                         <p>{!! $order->number_of_kilo !!}</p>
                                                     </div>

                                                     <!-- Length Field -->
                                                     <div class="form-group">
                                                         {!! Form::label('length', 'الارتفاع') !!}
                                                         <p>{!! $order->length !!}</p>
                                                     </div>

                                                     <!-- Width Field -->
                                                     <div class="form-group">
                                                         {!! Form::label('width', 'العرض') !!}
                                                         <p>{!! $order->width !!}</p>
                                                     </div>

                                                     <!-- Height Field -->
                                                     <div class="form-group">
                                                         {!! Form::label('height', 'الطول') !!}
                                                         <p>{!! $order->height !!}</p>
                                                     </div>

                                                     <!-- Price Field -->
                                                     <div class="form-group">
                                                         {!! Form::label('price', 'السعر') !!}
                                                         <p>{!! $order->price !!}</p>
                                                     </div>

                                                     <!-- Discount Field -->
                                                     <div class="form-group">
                                                         {!! Form::label('discount', 'الخصم') !!}
                                                         <p>{!! $order->discount !!}</p>
                                                     </div>

                                                     <!-- Rate Field -->
                                                     <div class="form-group">
                                                         {!! Form::label('rate', 'التقييم') !!}
                                                         <p>{!! $order->rate !!}</p>
                                                     </div>

                                                     <!-- Comment Field -->
                                                     <div class="form-group">
                                                         {!! Form::label('comment', 'تعليق علي المندوب') !!}
                                                         <p>{!! $order->comment !!}</p>
                                                     </div>

                                                     <!-- Delivery Date Field -->
                                                     <div class="form-group">
                                                         {!! Form::label('delivery_date', 'تاريخ التوصيل') !!}
                                                         <p >{!! $order->delivery_date !!}</p>
                                                     </div>

                                                     <!-- Estimate Delivery Date Field -->
                                                     <div class="form-group">
                                                         {!! Form::label('estimate_delivery_date', 'تاريخ التوصيل المتوقع') !!}
                                                         <p>{!! $order->estimate_delivery_date !!}</p>
                                                     </div>

                                                 @if($order->cancelReason != null)
                                                     <!-- Cancel Reason Id Field -->
                                                         <div class="form-group">
                                                             {!! Form::label('cancel_reason_id', 'Cancel Reason Id:') !!}

                                                             <p>{!! $order->cancelReason->name_ar !!}</p>
                                                         </div>

                                                     @endif

                                                 </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{\Helper\Common\__lang("close")}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /Table  -->
                    </div>

                    <div class="row">

                    </div>
                </div>
            </div>
            <!-- /My Order Table -->
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
        </div>

    </div>
    <!--End Content-->

@include("web.footer")