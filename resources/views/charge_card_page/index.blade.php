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
                <div class="card mb-5 col-md-7">
                    <div class="card-body">
                        @include('flash::message')

                        <br><br>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        {{--dffff--}}
        <form method="post" action="{{url('/admin/generate/code')}}">
            <h2> اختر قيمه الكارت</h2>
            <select class="custom-select" style="width: 52%;display: inline-block;" name="card_value"
                    id="inputGroupSelect01">
                <option selected>اختر قيمه الكارت</option>
                <option value="1000">1000</option>
                <option value="500">500</option>
                <option value="250">250</option>
            </select>
            {{--                            @if ($errors->has('card_value'))--}}
            {{--                                <span class="help-block">--}}
            {{--                    <strong>{{ $errors->first('card_value') }}</strong>--}}
            {{--                    </span>--}}
            {{--                            @endif--}}
            <input type="submit" class="btn btn-success" value="استخراج الكارت">
        </form>
        <div class="row">
            <div class="col-md-1">اطبع الكاارت</div>
            <div class="card mb-5 col-md-7">
                <div class="card-body">
                    @if(isset($cardNumber))
                        <center>
                            <br><br>
                            <a href="" class="btnprn btn">Print Preview</a></center>
                        <script type="text/javascript">
                            $(document).ready(function(){
                                $('.btnprn').printPage();
                            });
                        </script>
                        <center>
                            <h1>رقم كارت شحن النقاط </h1>
                            {{$cardNumber}}
                        </center>
                    @endif
                </div>
            </div>

    </div>
@endsection

