<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>{{config(("app.name"))}}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- Bootstrap Core CSS -->
    <link href="{{url("public/admin")}}/plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url("public/admin")}}/cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />


<!-- jQuery -->
    <script src="{{url("public/admin")}}/plugins/bower_components/jquery/dist/jquery.min.js"></script>

    {{--<!-- Bootstrap Core JavaScript -->--}}
    <script src="{{url("public/admin")}}/bootstrap/dist/js/tether.min.js"></script>
    <script src="{{url("public/admin")}}/bootstrap/dist/js/bootstrap.min.js"></script>

    {{--<!-- jQuery -->--}}
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>


    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">

    <link id="gull-theme" rel="stylesheet" href="{{url("public/admin")}}/assets/styles/css/themes/lite-purple.min.css">
    <link rel="stylesheet" href="{{url("public/admin")}}/assets/styles/vendor/perfect-scrollbar.css">
    <link rel="stylesheet" href="{{url("public/admin")}}/assets/styles/vendor/datatables.min.css">


    <script src="{{url("public/admin")}}/assets/js/common-bundle-script.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


    @yield('css')
    @include("layouts.multiSelect.libsCSS")
    {{--@include("layouts.dateTime.libs")--}}
    @include("layouts.emoji.emojiCSS")
    @include("layouts.map.mapCss")

    <script>
        var appUrl = "{{url('admin')}}";
    </script>


{{--@include("layouts.pusher.pusher")--}}
<!-- ... -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">



</head>



<body class="text-left" id="body">

<!-- Pre Loader Strat  -->
<div class='loadscreen' id="preloader">

    <div class="loader spinner-bubble spinner-bubble-primary">


    </div>
</div>
<!-- Pre Loader end  -->



<!-- ============ Compact Layout start ============= -->
<!-- ============Deafult  Large SIdebar Layout start ============= -->


<div class="app-admin-wrap layout-sidebar-large clearfix">
    <div class="main-header">
        <div class="logo">
            <img src="{{url("public/admin")}}/assets/images/logo.png" alt="">
        </div>

        <div class="menu-toggle">
            <div></div>
            <div></div>
            <div></div>
        </div>



        <div style="margin: auto"></div>

        <div class="header-part-right">
            <!-- Full screen toggle -->

            <!-- User avatar dropdown -->
            <div class="dropdown">
                <div  class="user col align-self-end">
                    <img src="{{url("public/admin")}}/assets/images/faces/1.jpg" id="userDropdown" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <div class="dropdown-header">
                            @if(auth()->user() != null)
                                <i class="i-Lock-User mr-1"></i> {{auth()->user()->email}}
                            @endif
                        </div>

                            <a href="{!! url('admin/logout') !!}" class="dropdown-item"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                تسجيل خروج
                            </a>
                            <form id="logout-form" action="{{ url('admin/logout') }}" method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                            </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- header top menu end -->


    <!-- menu -->
    <div class="side-content-wrap">
        <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
            <ul class="navigation-left">
    @include('layouts.sidebar')
    </ul>
</div>

</div>
    <!-- menu -->
    <!-- menu -->


<!-- Page Content -->
    @yield('content')


<!-- Footer Start -->
    <div class="flex-grow-1"></div>
    <div class="app-footer">

        <div class="footer-bottom border-top pt-3 d-flex flex-column flex-sm-row align-items-center">
            <span class="flex-grow-1"></span>
            <div class="d-flex align-items-center">
                <img class="logo" src="{{url("public/admin")}}/assets/images/logo.png" alt="">
                <div>
                    <p class="m-0">&copy; 2018 Copyrights</p>
                    <p class="m-0">All rights reserved</p>
                </div>
            </div>
        </div>
    </div>
    <!-- fotter end -->
</div>

</div>
<!--=============== End app-admin-wrap ================-->




@include("layouts.includeJsFile")



</body>
</html>

