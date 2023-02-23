@extends('layouts.app',['page_title' => 'dashboard'])

@section('content')

    <div id="dashboard-cards">
        <div class="row">
            <div class="col-12">
                <h5>Masters</h5>
            </div>
            <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                <a href="{{ route('categories.index') }}">
                    <div class="card card-stats" style="background-color:#b8d8d8">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="numbers">
                                        <p class="card-category"><b>Category</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                <a href="{{ route('salves.index') }}">
                    <div class="card card-stats" style="background-color:#b8d8d8">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="numbers">
                                        <p class="card-category"><b>Salves</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                <a href="{{ route('days.index') }}">
                    <div class="card card-stats" style="background-color:#b8d8d8">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="numbers">
                                        <p class="card-category"><b>Days</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                <a href="{{ route('customer.index') }}">
                    <div class="card card-stats" style="background-color:#b8d8d8">
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
            <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                <a href="{{ route('stock.index') }}">
                    <div class="card card-stats" style="background-color:#b8d8d8">
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
            <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                <a href="{{ route('attendance.index') }}">
                    <div class="card card-stats" style="background-color:#b8d8d8">
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
            <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                <a href="{{ route('income_expense.index') }}">
                    <div class="card card-stats" style="background-color:#b8d8d8">
                        <div class="card-body">
                            <div class="row">
                               {{--  <div class="col-5 col-md-4">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-shop text-dark"></i>
                                    </div>
                                </div> --}}
                                <div class="col-12 col-md-12">
                                    <div class="numbers">
                                        <p class="card-category"><b>Income &amp; Expense</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12">
                <h5>Manage Category</h5>
            </div>
            <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                <a href="{{ route('product.stock') }}">
                    <div class="card card-stats" style="background-color:#d5e5a3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="numbers">
                                        <p class="card-category"><b>Product Stock</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        {{-- </div>
        <div class="row"> --}}
            <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                <a href="{{ route('processing.index') }}">
                    <div class="card card-stats" style="background-color:#d5e5a3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="numbers">
                                        <p class="card-category"><b>Processing</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                <a href="{{ route('medical_checkup.index') }}">
                    <div class="card card-stats" style="background-color:#d5e5a3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="numbers">
                                        <p class="card-category"><b>Medical Checkup</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                <a href="{{ route('ghabhan.index') }}">
                    <div class="card card-stats" style="background-color:#d5e5a3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="numbers">
                                        <p class="card-category"><b>Ghabhan</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                <a href="{{ route('report.index') }}">
                    <div class="card card-stats" style="background-color:#d5e5a3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="numbers">
                                        <p class="card-category"><b>Report</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12">
                <h5>Manage Milk Entries</h5>
            </div>
            <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                <a href="{{ route('milk_entries.index') }}">
                    <div class="card card-stats" style="background-color:#6b9aebb3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="numbers">
                                        <p class="card-category"><b>Milk Entries</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                <a href="{{ route('billing.index') }}">
                    <div class="card card-stats" style="background-color:#6b9aebb3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="numbers">
                                        <p class="card-category"><b>Billing</b></p>
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
