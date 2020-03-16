@if(auth()->user()->role == \App\User::$roles["admin"]|| auth()->user()->role == \App\User::$roles["manager"])
    <li class="nav-item " data-item="">
        <a class="nav-item-hold" href="{{url('admin/get/card/generator')}}">
            <i class="nav-icon i-Library"></i>
            <span class="nav-text">استخراج كروت نقاط</span>
        </a>
        <div class="triangle"></div>
    </li><li class="nav-item " data-item="">
        <a class="nav-item-hold" href="{!! route('centers.index') !!}">
            <i class="nav-icon i-Library"></i>
            <span class="nav-text">الفروع</span>
        </a>
        <div class="triangle"></div>
    </li>


    <li class="nav-item " data-item="">
        <a class="nav-item-hold" href="{!! route('levels.index') !!}">
            <i class="nav-icon i-Library"></i>
            <span class="nav-text">الصفوف</span>
        </a>
        <div class="triangle"></div>
    </li>


    <li class="nav-item " data-item="">
        <a class="nav-item-hold" href="{!! route('groups.index') !!}">
            <i class="nav-icon i-Library"></i>
            <span class="nav-text">المجموعات</span>
        </a>
        <div class="triangle"></div>
    </li>
    <li class="nav-item " data-item="">
        <a class="nav-item-hold" href="{!! route('reservationRequests.index') !!}">
            <i class="nav-icon i-Library"></i>
            <span class="nav-text">طلبات التسجيل</span>
        </a>
        <div class="triangle"></div>
    </li>

    <li class="nav-item " data-item="">
        <a class="nav-item-hold" href="{!! route('students.index') !!}">
            <i class="nav-icon i-Library"></i>
            <span class="nav-text">الطلاب المسجلين</span>
        </a>
        <div class="triangle"></div>
    </li>

@endif
@if(auth()->user()->role == \App\User::$roles["teacher"] || auth()->user()->role == \App\User::$roles["admin"])
    <li class="nav-item " data-item="">
        <a class="nav-item-hold" href="{{route('get.info.page',auth()->user()->id)}}">
            <i class="nav-icon i-Library"></i>
            <span class="nav-text"> معلومات و شحن النقاط</span>
        </a>
        <div class="triangle"></div>
    </li>

    <li class="nav-item " data-item="">
        <a class="nav-item-hold" href="{!! route('curricula.index') !!}">
            <i class="nav-icon i-Library"></i>
            <span class="nav-text">المناهج</span>
        </a>
        <div class="triangle"></div>
    </li>



    <li class="nav-item " data-item="">
        <a class="nav-item-hold" href="{!! route('questionPowers.index') !!}">
            <i class="nav-icon i-Library"></i>
            <span class="nav-text">مستويات الأسئلة</span>
        </a>
        <div class="triangle"></div>
    </li>

    <li class="nav-item " data-item="">
        <a class="nav-item-hold" href="{!! route('questionTypes.index') !!}">
            <i class="nav-icon i-Library"></i>
            <span class="nav-text">انواع الأسئلة</span>
        </a>
        <div class="triangle"></div>
    </li>

    <li class="nav-item " data-item="">
        <a class="nav-item-hold" href="{!! route('questionBanks.index') !!}">
            <i class="nav-icon i-Library"></i>
            <span class="nav-text">بنك الاسئلة</span>
        </a>
        <div class="triangle"></div>
    </li>


    <li class="nav-item " data-item="">
        <a class="nav-item-hold" href="{!! route('questionBanks.exams') !!}">
            <i class="nav-icon i-Library"></i>
            <span class="nav-text">الأختبارات</span>
        </a>
        <div class="triangle"></div>
    </li>
@endif




@if(auth()->user()->role == \App\User::$roles["student"] )


    <li class="nav-item " data-item="">
        <a class="nav-item-hold" href="{!! route('questionBanks.student') !!}">
            <i class="nav-icon i-Library"></i>
            <span class="nav-text">بنك الاسئلة</span>
        </a>
        <div class="triangle"></div>
    </li>


    <li class="nav-item " data-item="">
        <a class="nav-item-hold" href="{!! route('questionBanks.student') !!}?isExam=1">
            <i class="nav-icon i-Library"></i>
            <span class="nav-text">الاختبارات</span>
        </a>
        <div class="triangle"></div>
    </li>

    <li class="nav-item " data-item="">
        <a class="nav-item-hold" href="{!! route('curricula.student') !!}">
            <i class="nav-icon i-Library"></i>
            <span class="nav-text">المنهج</span>
        </a>
        <div class="triangle"></div>
    </li>

    <li class="nav-item " data-item="">
        <a class="nav-item-hold" href="{!! route('studentExams.report') !!}">
            <i class="nav-icon i-Library"></i>
            <span class="nav-text">نتائج الأختبارات</span>
        </a>
        <div class="triangle"></div>
    </li>
@endif
