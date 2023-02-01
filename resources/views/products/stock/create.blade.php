@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Add Product Stock</h4>
            </div>
            <form action="{{route('product.stock.store')}}" accept="" role="form" method="post">
                @csrf        
                <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Select Product</label>
                                    <select class="form-control" name="product_listing" title="Select Product"  required>
                                        @foreach ($products as $product)
                                            <option value="{{$product->id}}">{{$product->product_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--<div class="col-md-6">
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="number" name="ps_quantity" class="form-control" required>
                                </div>
                            </div>-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Select Gender</label>
                                    <select class="form-control" name="gender" title="Select Gender" required>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Purchase From</label>
                                    <input type="text" name="ps_purchase_from" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Purchase Date</label>
                                    <input type="text" class="form-control datepicker" name="ps_purchase_date" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Party Name</label>
                                    <input type="text" name="ps_party_name" class="form-control" required>
                                </div>        
                            </div>   
							{{-- <div class="col-md-4">
								<label></label>
								<div class="form-group">
									<div class="btn btn-sm btn-primary add_row_icon1"><i class="fa fa-plus"></i></div>							
								</div>
							</div>--}}
                        </div>
						{{-- <div id="show_textboxes1"></div>--}}
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info btn-round insert_product_stock">Submit</button>
                    <a href="{{config('app.url')}}/product_stock" class="btn btn-danger btn-round ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection