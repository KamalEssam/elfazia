
@extends('layouts.app')

@section('content')
    <link href="{{url("public/vendor/mathEditor")}}/lib/mathquill.css" rel="stylesheet">
    <link href="{{url("public/vendor/mathEditor")}}/lib/matheditor.css" rel="stylesheet">


    <div class="main-content-wrap sidenav-open d-flex flex-column">
        <div class="main-content">
            <div class="breadcrumb">
                <h1>Question Banks</h1>

            </div>

            <div class="separator-breadcrumb border-top"></div>


<div class="row">
    <div class="col-md-1"></div>

            <div class="card mb-5 col-md-10">
                   <div class="card-body">
                  <div class="d-flex flex-column">
                       @include('adminlte-templates::common.errors')

                             {!! Form::open(['route' => 'students.banks.correction.store','files' => true,"class"=>"floating-labels", "id"=> "testForm"]) !!}
                            <input type="hidden" name="student_id" value="{{$student_id}}">
                            <input type="hidden" name="isExam" value="{{$isExam}}">
                       @include('students.reports.fields')

                       {!! Form::close() !!}
                       </div>
                  </div>
            </div>
        </div>


        </div>

    <!-- ============ Body content End ============= -->



@endsection
