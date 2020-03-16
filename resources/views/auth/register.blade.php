<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gull - Laravel + Bootstrap 4 admin template</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{url("public/admin")}}/assets/styles/css/themes/lite-purple.min.css">
    <script src="{{url("public/admin")}}/plugins/bower_components/jquery/dist/jquery.min.js"></script>

</head>

<body>
<div class="auth-layout-wrap" style="background-image: url({{url("public/admin")}}/assets/images/photo-wide-4.jpg)">
    <div class="auth-content">
        <div class="card o-hidden">
            <div class="row">
                <div class="col-md-12">
                    <div class="p-4">
                        <div class="auth-logo text-center mb-4">
                            <img src="{{url("public/admin")}}/assets/images/logo.png" alt="">
                        </div>
                        <h1 class="mb-3 text-18">Sign In</h1>
                        <form id="loginform" method="post" action="{{ url('/admin/register') }}">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="name">name</label>
                                <input id="name" name="name" class="form-control form-control-rounded" type="text">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="mobile">mobile</label>
                                <input id="mobile" name="mobile" class="form-control form-control-rounded" type="text">
                                @if ($errors->has('mobile'))
                                    <span class="help-block">
                    <strong>{{ $errors->first('mobile') }}</strong>
                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input id="email" name="email" class="form-control form-control-rounded" type="email">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input name="password" id="password" class="form-control form-control-rounded"
                                       type="password">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                                @endif
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

                            <button onclick="submit()" class="btn btn-rounded btn-primary btn-block mt-2" type="submit">
                                Register
                            </button>
                            <a href="{{url("admin/login")}}"
                               class="btn btn-rounded btn-primary btn-block mt-2">Login</a>

                        </form>


                    </div>
                </div>

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


<script src="{{url("public/admin")}}/assets/js/common-bundle-script.js"></script>

<script src="{{url("public/admin")}}/assets/js/script.js"></script>
</body>

</html>



