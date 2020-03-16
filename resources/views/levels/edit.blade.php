
@extends('layouts.app')

@section('content')

<div class="main-content-wrap sidenav-open d-flex flex-column">
        <div class="main-content">
            <div class="breadcrumb">
                <h1>Levels</h1>

            </div>

            <div class="separator-breadcrumb border-top"></div>


<div class="row">
    <div class="col-md-1"></div>

            <div class="card mb-5 col-md-10">
                   <div class="card-body">
                  <div class="d-flex flex-column">
                       @include('adminlte-templates::common.errors')

                    {!! Form::model($level, ['route' => ['levels.update', $level->id],'files' => true, 'method' => 'patch',"class"=>"floating-labels"]) !!}

                   @include('levels.fields')

                     {!! Form::close() !!}

                       </div>
                  </div>
            </div>
        </div>


        </div>

    <!-- ============ Body content End ============= -->



@endsection

