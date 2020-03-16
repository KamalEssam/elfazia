@extends('layouts.app')

@section('content')

    <div class="main-content-wrap sidenav-open d-flex flex-column">
        <div class="main-content">
            <div class="breadcrumb">
                <h1>Reservation Requests</h1>

            </div>

            <div class="separator-breadcrumb border-top"></div>


            <div class="row">
                <div class="col-md-1"></div>

                <div class="card mb-5 col-md-10">
                    <div class="card-body">
                        <div class="d-flex flex-column">
                            @include('reservation_requests.show_fields')
                            <a href="{!! route('reservationRequests.index') !!}"
                               class="btn btn-primary col-md-2">رجوع</a>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <!-- ============ Body content End ============= -->



@endsection




