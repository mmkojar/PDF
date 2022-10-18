@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Add Food Stock</h4>
            </div>
            <form action="{{route('food.stock.store')}}" accept="" role="form" method="post" id="food_stock_use_form">
                @csrf        
                <div class="card-body">                               
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Item Name</label>
                                <select class="form-control item_name" name="item_name" id="item_name">    
                                    <option value="" disabled selected>--select--</option>   
                                    @foreach ($items as $item)
                                        <option value="{{$item->item_name}}">{{ucwords($item->item_name)}}</option>
                                    @endforeach                             
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="number" name="quantity" id="quantity" class="form-control" min=1 max="" required>
                            </div>
                        </div>
                        <div class="col-md-4">                                
                            <div class="form-group">
                                <label>Date</label>
                                <input type="text" name="date" class="form-control datepicker" required>
                            </div> 
                        </div>
                    </div>       
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info btn-round">Submit</button>
                    <a href="{{config('app.url')}}/food" class="btn btn-danger btn-round ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('qty_scripts')
    <script type="text/javascript">
    $("#item_name").on('change', function() {
            var itm = $(this).val();
            var url = base_url+`/food/stockUse/balqty/${itm}`;
            $.ajax({
                url: url,
                method: "GET",
                contentType: false,
                processData: false,
                dataType:'json',
                success: function(res) {
                    $("#quantity").attr('max',res.quantity);
                }
            })
        });
</script> 
@endsection