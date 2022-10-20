@extends('layouts.app',['page_title' => 'dashboard'])

@section('content')

    <div id="dashboard-cards">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <a href="{{ route('customer.index') }}">
                    <div class="card card-stats">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="numbers">
                                        <p class="card-category"><b>customer</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <a href="{{ route('employee.index') }}">
                    <div class="card card-stats">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="numbers">
                                        <p class="card-category"><b>Employees</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <a href="{{ route('attendance.index') }}">
                    <div class="card card-stats">
                        <div class="card-body">
                            <div class="row">
                               {{--  <div class="col-5 col-md-4">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-shop text-dark"></i>
                                    </div>
                                </div> --}}
                                <div class="col-12 col-md-12">
                                    <div class="numbers">
                                        <p class="card-category"><b>Attendance</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <a href="{{ route('stock.index') }}">
                    <div class="card card-stats">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="numbers">
                                        <p class="card-category"><b>General Stock</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        
        
    </div>

@endsection
