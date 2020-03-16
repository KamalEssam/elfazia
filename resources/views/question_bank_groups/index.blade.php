@extends('layouts.app')

@section('content')

<div class="main-content-wrap sidenav-open d-flex flex-column">
        <div class="main-content">
            <div class="breadcrumb">
                <h1>Question Bank Groups</h1>

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
                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    العمليات
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                  <a class="dropdown-item" href="{!! route('questionBankGroups.create') !!}">اضافة جديد</a>
                                                  <a class="dropdown-item" onclick="event.preventDefault(); deleteRecord('questionBankGroups',datatable)">حذف</a>

                                                </div>
                          </div>

                          </div>

<br><br>

                   {!! Form::open(['route' => ['questionBankGroups.delete'], 'method' => 'delete','id' => 'delete-form']) !!}

                   {{ csrf_field() }}

                      <div class="table-responsive">
                       @include('question_bank_groups.table')
                        </div>

                     {!! Form::close() !!}

                    </div>
                    </div>








                    </div>
                    <!-- /.row -->



  </div>




@endsection

