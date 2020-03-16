
@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Configs</h4>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <!-- /row -->
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                @include('flash::message')
                @include('adminlte-templates::common.errors')
                <div class="white-box p-l-20 p-r-20">
                    <div class="row">
                        <div class="col-md-12">


                            {!! Form::model($config, ['route' => ['configs.update', $config->id],'files' => true, 'method' => 'patch',"class"=>"floating-labels"]) !!}

                            @include('configs.fields')

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <!-- /.row -->



    </div>


@endsection

