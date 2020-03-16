@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">الحضور</h4>
            </div>
            <!-- /.ol-lg-12 -->
        </div>

        <!-- /row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">

                    <form method="get" action="{{route("attendances.index")}}">
                        {{csrf_field()}}
                        @if(request("user_id") != null)
                            <input type="hidden" name="user_id" value="{{request("user_id")}}">
                        @endif
                        <div class="form-group col-md-2">
                            <button type="submit" class="btn btn-success col-md-12"> <i class="fa fa-check"></i> بحث</button>

                        </div>
                        <div class="form-group col-md-4 ">
                            {!! Form::date('attendanceDate', null, ['class' => 'form-control','id'=>"date","required"]) !!}
                            <span class="highlight"></span> <span class="bar"></span>
                            {!! Form::label('date', 'البحث باليوم') !!}
                        </div>




                    </form>


                    @include('flash::message')

                    <div class="button-box">
                        <div class="btn-group m-r-10">
                            <button aria-expanded="false" data-toggle="dropdown" class="btn btn-info dropdown-toggle waves-effect waves-light" type="button">العمليات <span class="caret"></span></button>
                            <ul role="menu" class="dropdown-menu">
                                {{--<li>--}}
                                    {{--<a  href="{!! route('attendances.create') !!}">اضافة جديد</a>--}}
                                {{--</li>--}}
                                {{--
                                <li>
                                    <a href="{!! route('attendances.delete') !!}"
                                       onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
                                        حذف
                                    </a>
                                </li>
                                --}}
                                <li>
                                     <a onclick="event.preventDefault(); deleteRecord('attendances',datatable)">حذف</a>
                                </li>

                            </ul>
                        </div>
                    </div>



                    {!! Form::open(['route' => ['attendances.delete'], 'method' => 'delete','id' => 'delete-form']) !!}

                    {{ csrf_field() }}


                    <div class="table-responsive">
                        @include('attendances.table')
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
        <!-- /.row -->



    </div>


@endsection

