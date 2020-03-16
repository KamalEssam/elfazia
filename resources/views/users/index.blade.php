@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">users</h4>
            </div>
            <!-- /.ol-lg-12 -->
        </div>

        <!-- /row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">

                    @include('flash::message')

                    <div class="button-box">
                        <div class="btn-group m-r-10">
                            <button aria-expanded="false" data-toggle="dropdown" class="btn btn-info dropdown-toggle waves-effect waves-light" type="button">العمليات <span class="caret"></span></button>
                            <ul role="menu" class="dropdown-menu">
                                {{--<li>--}}
                                    {{--<a  href="{!! route('users.create') !!}">اضافة جديد</a>--}}
                                {{--</li>--}}
                                {{--
                                <li>
                                    <a href="{!! route('brands.delete') !!}"
                                       onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
                                        حذف
                                    </a>
                                </li>
                                --}}
                                <li>
                                    <a onclick="event.preventDefault(); deleteRecord('users',datatable)">حذف</a>
                                </li>

                            </ul>
                        </div>
                    </div>

                    {{--<div class="button-box">--}}
                        {{--<div class="btn-group m-r-10">--}}
                            {{--<button aria-expanded="false" data-toggle="dropdown" class="btn btn-info dropdown-toggle waves-effect waves-light" type="button">العمليات <span class="caret"></span></button>--}}
                            {{--<ul role="menu" class="dropdown-menu">--}}
                              {{----}}
                                {{--<li>--}}
                                    {{--<a href="{!! route('leagues.destroy',1) !!}"--}}
                                       {{--onclick="event.preventDefault(); document.getElementById('delete-form').submit();">--}}
                                        {{--حذف--}}
                                    {{--</a>--}}



                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                    {{--</div>--}}



                    {!! Form::open(['route' => ['users.destroy', 1], 'method' => 'delete','id' => 'delete-form']) !!}

                    {{ csrf_field() }}


                    <div class="table-responsive">
                        @include('users.table')
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
        <!-- /.row -->



    </div>


@endsection

