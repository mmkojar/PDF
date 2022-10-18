@extends('layouts.app',['page_title' => 'dashboard'])

@section('content')

    <div id="dashboard-cards">
        <div class="row">
            <div class="col-md-12">
                <h3>Master</h3>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <a href="{{ route('attendance.index') }}">
                    <div class="card card-stats blue-bgcolor1">
                        <div class="card-body">
                            <div class="row">
                                {{-- <div class="col-5 col-md-4">
                  <div class="icon-big text-center icon-warning">
                    <i class="nc-icon nc-shop text-dark"></i>
                  </div>
                </div> --}}
                                <div class="col-12 col-md-12">
                                    <div class="numbers">
                                        <p class="card-category"><b>Attendance</b></p>
                                        <p class="card-title">0</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <a href="{{ route('categories.index') }}">
                    <div class="card card-stats blue-bgcolor1">
                        <div class="card-body">
                            <div class="row">
                                {{-- <div class="col-5 col-md-4">
                  <div class="icon-big text-center icon-warning">
                    <i class="nc-icon nc-shop text-dark"></i>
                  </div>
                </div> --}}
                                <div class="col-12 col-md-12">
                                    <div class="numbers">
                                        <p class="card-category"><b>Categories</b></p>
                                        <p class="card-title">{{ count($p) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <a href="{{ route('product.stock') }}">
                    <div class="card card-stats green-bgcolor1">
                        <div class="card-body">
                            <div class="row">
                                {{-- <div class="col-5 col-md-4">
                  <div class="icon-big text-center icon-warning">
                    <i class="nc-icon nc-cart-simple text-dark"></i>
                  </div>
                </div> --}}
                                <div class="col-12 col-md-12">
                                    <div class="numbers">
                                        <p class="card-category"><b>Product Stock</b></p>
                                        <p class="card-title">{{ count($ps) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <a href="{{ route('customer.index') }}">
                    <div class="card card-stats red-bgcolor1">
                        <div class="card-body">
                            <div class="row">
                                {{-- <div class="col-5 col-md-4">
                  <div class="icon-big text-center icon-warning">
                    <i class="nc-icon nc-single-02 text-dark"></i>
                  </div>
                </div> --}}
                                <div class="col-12 col-md-12">
                                    <div class="numbers">
                                        <p class="card-category"><b>Customers</b></p>
                                        <p class="card-title">{{ count($c) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <a href="{{ route('salves.index') }}">
                    <div class="card card-stats brown-bgcolor1">
                        <div class="card-body">
                            <div class="row">
                                {{-- <div class="col-5 col-md-4">
                  <div class="icon-big text-center icon-warning">
                    <i class="nc-icon nc-circle-10 text-dark"></i>
                  </div>
                </div> --}}
                                <div class="col-12 col-md-12">
                                    <div class="numbers">
                                        <p class="card-category"><b>Salves</b></p>
                                        <p class="card-title">{{ count($s) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>Milk Entries</h3>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <a href="{{ route('milk_entries.index') }}">
                    <div class="card card-stats blue-bgcolor1">
                        <div class="card-body">
                            <div class="row">
                                {{-- <div class="col-5 col-md-4">
                                        <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-shop text-dark"></i>
                                        </div>
                                    </div> --}}
                                <div class="col-12 col-md-12">
                                    <div class="numbers">
                                        <p class="card-category"><b>Milk Collection</b></p>
                                        <span class="col-me">Morning - </span>
                                        <p class="card-title"> {{ $mcoll_morning }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            {{-- <div class="col-lg-3 col-md-6 col-sm-6">
                <a href="{{route('milk_entries.index')}}">
                <div class="card card-stats blue-bgcolor1">
                    <div class="card-body">
                    <div class="row">
                        <div class="col-5 col-md-4">
                        <div class="icon-big text-center icon-warning">
                            <i class="nc-icon nc-shop text-dark"></i>
                        </div>
                        </div>
                        <div class="col-12 col-md-12">
                        <div class="numbers">
                            <p class="card-category"><b>Milk Collection</b></p>
                            <span class="col-me">Evening - </span><p class="card-title"> {{$mcoll_e}}</p>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </a>
            </div> --}}
            <div class="col-lg-3 col-md-6 col-sm-6">
                <a href="{{ route('milk_entries.index') }}">
                    <div class="card card-stats blue-bgcolor1">
                        <div class="card-body">
                            <div class="row">
                                {{-- <div class="col-5 col-md-4">
                  <div class="icon-big text-center icon-warning">
                    <i class="nc-icon nc-shop text-dark"></i>
                  </div>
                </div> --}}
                                <div class="col-12 col-md-12">
                                    <div class="numbers">
                                        <p class="card-category"><b>Milk Sold</b></p>
                                        <span class="col-me">Morning - </span>
                                        <p class="card-title"> {{ $msold_m }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <a href="{{ route('milk_entries.index') }}">
                    <div class="card card-stats blue-bgcolor1">
                        <div class="card-body">
                            <div class="row">
                                {{-- <div class="col-5 col-md-4">
                  <div class="icon-big text-center icon-warning">
                    <i class="nc-icon nc-shop text-dark"></i>
                  </div>
                </div> --}}
                                <div class="col-12 col-md-12">
                                    <div class="numbers">
                                        <p class="card-category"><b>Milk Sold</b></p>
                                        <span class="col-me">Evening - </span>
                                        <p class="card-title"> {{ $msold_e }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>Products Flow</h3>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <a href="{{ route('processing.index') }}">
                    <div class="card card-stats blue-bgcolor1">
                        <div class="card-body">
                            <div class="row">
                                {{-- <div class="col-5 col-md-4">
                  <div class="icon-big text-center icon-warning">
                    <i class="nc-icon nc-shop text-dark"></i>
                  </div>
                </div> --}}
                                <div class="col-12 col-md-12">
                                    <div class="numbers">
                                        <p class="card-category"><b>Processing</b></p>
                                        <p class="card-title"> {{ count($processing) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <a href="{{ route('medical_checkup.index') }}">
                    <div class="card card-stats blue-bgcolor1">
                        <div class="card-body">
                            <div class="row">
                                {{-- <div class="col-5 col-md-4">
                  <div class="icon-big text-center icon-warning">
                    <i class="nc-icon nc-shop text-dark"></i>
                  </div>
                </div> --}}
                                <div class="col-12 col-md-12">
                                    <div class="numbers">
                                        <p class="card-category"><b>Medical</b></p>
                                        <p class="card-title"> {{ count($medical) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <a href="{{ route('ghabhan.index') }}">
                    <div class="card card-stats blue-bgcolor1">
                        <div class="card-body">
                            <div class="row">
                                {{-- <div class="col-5 col-md-4">
                  <div class="icon-big text-center icon-warning">
                    <i class="nc-icon nc-shop text-dark"></i>
                  </div>
                </div> --}}
                                <div class="col-12 col-md-12">
                                    <div class="numbers">
                                        <p class="card-category"><b>Gabhan</b></p>
                                        <p class="card-title"> {{ count($pregnants) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <a href="{{ route('ghabhan.index') }}">
                    <div class="card card-stats blue-bgcolor1">
                        <div class="card-body">
                            <div class="row">
                                {{-- <div class="col-5 col-md-4">
                  <div class="icon-big text-center icon-warning">
                    <i class="nc-icon nc-shop text-dark"></i>
                  </div>
                </div> --}}
                                <div class="col-12 col-md-12">
                                    <div class="numbers">
                                        <p class="card-category"><b>Transfer Salves</b></p>
                                        <p class="card-title"> {{ count($transfer_salves) }}</p>
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
