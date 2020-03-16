
@extends('layouts.app')

@section('content')

<div class="main-content-wrap sidenav-open d-flex flex-column">
        <div class="main-content">
            <div class="breadcrumb">
                <h1>Question Types</h1>

            </div>

            <div class="separator-breadcrumb border-top"></div>


<div class="row">
    <div class="col-md-1"></div>

            <div class="card mb-5 col-md-10">
                   <div class="card-body">
                  <div class="d-flex flex-column">
                       @include('adminlte-templates::common.errors')

                    {!! Form::model($questionType, ['route' => ['questionTypes.update', $questionType->id],'files' => true, 'method' => 'patch',"class"=>"floating-labels"]) !!}

                   @include('question_types.fields')

                     {!! Form::close() !!}

                       </div>
                  </div>
            </div>
        </div>


        </div>

    <!-- ============ Body content End ============= -->



@endsection

