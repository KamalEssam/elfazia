@extends('layouts.app')

@section('content')
    <!-- ============ Body content start ============= -->
    <div class="main-content-wrap sidenav-open d-flex flex-column">
        <div class="main-content">
            <div class="breadcrumb">
                <h1>Dashboard</h1>

            </div>

            <div class="separator-breadcrumb border-top"></div>
            <form method="post"action="{{url('admin/generate/code')}}" >
                <input type="submit" >
            </form>
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

            {{--<div class="row">--}}
                {{--<!-- ICON BG -->--}}
                {{--<div class="col-lg-3 col-md-6 col-sm-6">--}}
                    {{--<div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">--}}
                        {{--<div class="card-body text-center">--}}
                            {{--<i class="i-Add-User"></i>--}}
                            {{--<div class="content">--}}
                                {{--<p class="text-muted mt-2 mb-0">New Leads</p>--}}
                                {{--<p class="text-primary text-24 line-height-1 mb-2">205</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="col-lg-3 col-md-6 col-sm-6">--}}
                    {{--<div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">--}}
                        {{--<div class="card-body text-center">--}}
                            {{--<i class="i-Financial"></i>--}}
                            {{--<div class="content">--}}
                                {{--<p class="text-muted mt-2 mb-0">Sales</p>--}}
                                {{--<p class="text-primary text-24 line-height-1 mb-2">$4021</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="col-lg-3 col-md-6 col-sm-6">--}}
                    {{--<div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">--}}
                        {{--<div class="card-body text-center">--}}
                            {{--<i class="i-Checkout-Basket"></i>--}}
                            {{--<div class="content">--}}
                                {{--<p class="text-muted mt-2 mb-0">Orders</p>--}}
                                {{--<p class="text-primary text-24 line-height-1 mb-2">80</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="col-lg-3 col-md-6 col-sm-6">--}}
                    {{--<div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">--}}
                        {{--<div class="card-body text-center">--}}
                            {{--<i class="i-Money-2"></i>--}}
                            {{--<div class="content">--}}
                                {{--<p class="text-muted mt-2 mb-0">Expense</p>--}}
                                {{--<p class="text-primary text-24 line-height-1 mb-2">$1200</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

            {{--</div>--}}




        </div>

    <!-- ============ Body content End ============= -->


@endsection