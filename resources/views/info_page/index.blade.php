@extends('layouts.app')

@section('content')

    <div class="main-content-wrap sidenav-open d-flex flex-column">
        <div class="main-content">
            <div class="breadcrumb">
                <h1>معلومات</h1>

            </div>

            <div class="separator-breadcrumb border-top"></div>
            <!-- /row -->
            <div class="row">
                <div class="col-md-1"></div>
                <div class="card mb-5 col-md-10">
                    <div class="card-body">
                        @include('flash::message')
                        @foreach($user as $user )
                            <div class="col mt-4">
                                <h1> الاسم : {{$user->name}}</h1>
                                <h1> الايميل : {{$user->email}}</h1>
                                @foreach($pointData as $pointData)
                                    <h1> الاعدد النقاط المتاحه : {{$pointData->number_of_points}}</h1>
                                @endforeach
                            </div>
                        @endforeach
                        <br><br>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        {{--dffff--}}
@if(auth()->user()->role !=2)
        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <div class="main-content">
                <div class="breadcrumb">
                    <h1>اضافـــــه طالب جديد</h1>

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
                                        <h1 class="mb-3 text-18"> اضافه طالب مع العلم انه سوف يتم خصم 50 نقطه من نقاطك
                                            عند اضافه طالب جديد </h1>
                                        <form id="loginform" method="post" action="{{ route('add.new.student') }}">
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
                                                        <option value="2"> طاالب</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- group Id Field -->
                                            <div class="row">
                                                <div class="col-md-12 form-group mb-3">
                                                    <label for="group_id">السنتر</label>
                                                    <select class="form-control" name="center_id">
                                                        @foreach(\App\Models\Center::all() as $item)
                                                            <option value="{{$item->id}}"
                                                                    @if(isset($student) && $student->center_id == $item->id) selected @endif>
                                                                {{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- group Id Field -->
                                            <div class="row">
                                                <div class="col-md-12 form-group mb-3">
                                                    <label for="level_id">المستوي</label>
                                                    <select id="level_id" class="form-control" name="level_id">
                                                        @foreach(\App\Models\Level::all() as $item)
                                                            <option value="{{$item->id}}"
                                                                    @if(isset($student) && $student->level_id == $item->id) selected @endif>
                                                                {{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- group Id Field -->
                                            <div class="row">
                                                <div class="col-md-12 form-group mb-3">
                                                    <label for="group_id">المجموعة</label>
                                                    <select id="group" class="form-control" name="group_id">
                                                        @foreach(\App\Models\Group::all() as $item)
                                                            <option value="{{$item->id}}"
                                                                    @if(isset($student) && $student->group_id == $item->id) selected @endif>
                                                                {{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


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
        @endif
        <div class="main-content">
            <div class="breadcrumb">
                <h1> شحن نقاط</h1>

            </div>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="card mb-4 col-md-4">
                    <div class="card-body">
                        <form method="post" action="{{url('admin/charge/point')}}">
                            {{csrf_field()}}
                            <h4> ادخل رقم الكارت</h4>
                            <input type="text" name="charge_card" style="width: 52%;display: inline-block;"class="form-control" >
                            <input type="submit" class="btn btn-success" value="شحن الكارت">
                        </form>

                        <br><br>
                    </div>
                </div>
            </div>
        </div>


        <script>
            var appUrl = "{{url('admin')}}";

            $(document).ready(function () {
                $('#level_id').on('change', function (e) {


                    var level_id = e.target.value;
                    if (level_id > 0) {
                        $.get(appUrl + '/groups/ajax/' + level_id, function (data) {

                            $('#group').empty();

                            if (data.length !== 0) {
                                $.each(data, function (index, subCatObj) {

                                    $('#group').append($('<option>', {
                                        value: subCatObj.id,
                                        text: subCatObj.name
                                    }));

                                });

                            }

                        });
                    } else {
                        $('#group').empty();

                        $('#group').append($('<option>', {
                            value: '',
                            text: "اختر",
                            selected: true
                        }));
                    }

                });
            });


        </script>

@endsection

