@extends('layouts.app')

@section('content')

    <div class="main-content-wrap sidenav-open d-flex flex-column">
        <div class="main-content">
            <div class="breadcrumb">
                <h1>Reservation Requests</h1>

            </div>

            <div class="separator-breadcrumb border-top"></div>


            <!-- /row -->
            <div class="row">

                <div class="col-md-1"></div>
                <div class="card mb-5 col-md-10">
                    <div class="card-body">
                        @include('flash::message')

                        <div class="col mt-4">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    العمليات
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    {{--<a class="dropdown-item" href="{!! route('reservationRequests.create') !!}">اضافة جديد</a>--}}
                                    <a class="dropdown-item"
                                       onclick="event.preventDefault(); deleteRecord('reservationRequests',datatable)">حذف</a>

                                </div>
                            </div>

                        </div>

                        <br><br>

                        {!! Form::open(['route' => ['reservationRequests.delete'], 'method' => 'delete','id' => 'delete-form']) !!}

                        {{ csrf_field() }}

                        <div class="table-responsive">
                            @include('reservation_requests.table')
                        </div>

                        {!! Form::close() !!}

                    </div>
                </div>


            </div>
            <!-- /.row -->


        </div>
        {{--dffff--}}

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <div class="main-content">
                <div class="breadcrumb">
                    <h1>اضافـــــــه مدرس/مدير جديد</h1>

                </div>

                <div class="separator-breadcrumb border-top"></div>
                <!-- /row -->
                <div class="row">

                    <div class="col-md-1"></div>
                    <div class="card mb-5 col-md-10">
                        <div class="card-body">
                            @include('flash::message')

                            <div class="col mt-4">
                                <div class="col-md-12">
                                    <div class="p-4">
                                        <div class="auth-logo text-center mb-4">
                                            <img src="{{url("public/admin")}}/assets/images/logo.png" alt="">
                                        </div>
                                        <h1 class="mb-3 text-18"> Add user </h1>
                                        <form id="loginform" method="post" action="{{ route('add.new.user') }}">
                                            {!! csrf_field() !!}
                                            <div class="form-group">
                                                <label for="name">name</label>
                                                <input id="name" name="name" class="form-control form-control-rounded"
                                                       type="text">
                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="mobile">mobile</label>
                                                <input id="mobile" name="mobile"
                                                       class="form-control form-control-rounded" type="text">
                                                @if ($errors->has('mobile'))
                                                    <span class="help-block">
                    <strong>{{ $errors->first('mobile') }}</strong>
                </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email address</label>
                                                <input id="email" name="email" class="form-control form-control-rounded"
                                                       type="email">
                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input name="password" id="password"
                                                       class="form-control form-control-rounded" type="password">
                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                                                @endif
                                            </div>

                                            <!-- group Id Field -->
                                            <div class="row">
                                                <div class="col-md-12 form-group mb-3">
                                                    <label for="group_id">التسجيل كــــــــــ</label>
                                                    <select class="form-control" name="role">
                                                        <option value="3"> مدرس</option>
                                                        <option value="4"> مدير</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- group Id Field -->

                                            <!-- group Id Field -->

                                            <input type="submit" class="btn btn-rounded btn-primary btn-block mt-2"
                                                   value="Add user">
                                        </form>


                                    </div>
                                </div>

                            </div>

                        </div>

                        <br><br>


                    </div>
                </div>


            </div>
            <!-- /.row -->


        </div>




@endsection

