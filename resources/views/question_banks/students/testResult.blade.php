@extends('layouts.app')

@section('content')

<div class="main-content-wrap sidenav-open d-flex flex-column">
        <div class="main-content">
            <div class="breadcrumb">
                <h1>Question Banks</h1>

            </div>

            <div class="separator-breadcrumb border-top"></div>



             <!-- /row -->
                    <div class="row">

  <div class="col-md-1"></div>
                        <div class="card mb-5 col-md-10">
                       <div class="card-body">
                                @include('flash::message')

                           <p>درجة الأختبار : {{$studentGrades}} من {{$totalGrades}}</p>

                    </div>
                    </div>








                    </div>
                    <!-- /.row -->



  </div>




@endsection

