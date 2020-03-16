
@extends('layouts.app')

@section('content')


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
                       @include('flash::message')

                       <div class="d-flex flex-column">
                       @include('adminlte-templates::common.errors')

                             {!! Form::open(['route' => 'questionBanks.testNow','files' => true,"class"=>"floating-labels", "id"=> "testForm"]) !!}
                            <input type="hidden" name="bank_id" value="{{$bank_id}}">
                            <input type="hidden" name="question_id" value="{{$questions->id}}">
                            <input type="hidden" name="ids" value="{{$ids}}">
                       @include('question_banks.students.fields')

                       {!! Form::close() !!}
                       </div>
                  </div>
            </div>
        </div>


        </div>

    <!-- ============ Body content End ============= -->



@endsection
