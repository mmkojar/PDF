@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Stock out</h4>
            </div>
            <form action="{{route('stock.out.store')}}" accept="" role="form" method="post">
                @csrf
                <div class="card-body">                  
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Item Name</label>
                                <select class="form-control item_id" name="item_id" id="item_id" required> 
                                    <option value="" selected disabled>Select</option>
                                    @foreach($items as $item)
                                        <option value="{{$item->item_id}}">{{$item->item_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Unit</label>
                                <select class="form-control" name="unit" id="unit" required>
                                    <option value="" selected disabled>Select</option>
                                    <option value="GRAM">GRAM</option>
                                    <option value="KG">KG</option>
                                    <option value="LTR">LTR</option>
                                    <option value="BOX">BOX</option>
                                    <option value="PCS">PCS</option>
                                </select>
                            </div> 
                        </div> 
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="number" name="qty" id="qty" class="form-control" min="1" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="purchase_rate">Purchase Rate</label>
                                <input type="number" min="1" id="purchase_rate" name="purchase_rate" class="form-control purchase_rate" readonly/>
                            </div>
                        </div>
                                          
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Rate</label>
                                <input type="number" min="0" id="rate" name="rate" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="text" name="date" id="date" class="datepicker form-control" required>
                            </div>
                        </div>                        
                    </div>                                                
                </div>
                <div class="card-footer">
                    <input type="hidden" id="hidden_qty" name="hidden_qty" class="form-control" />
                    <button type="submit" class="btn btn-info btn-round">Submit</button>
                    <a href="{{config('app.url')}}/stock" class="btn btn-danger btn-round ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('stockout_script')
    <script type="text/javascript">
    $(document).ready(function() { 

        $(document).on('change', '.item_id', function(){

            $("#preloader").show();
            var item_id = $(this).val();            
            
            var today = new Date();
            document.querySelector("#date").value = today.getFullYear() + '-' + ('0' + (today.getMonth() + 1)).slice(-2) + '-' + ('0' + today.getDate()).slice(-2);
			if(item_id !== "") {
				$.ajax({
					url:base_url+"/stock/out/api/"+item_id,
					method:"GET",
					dataType:'json',
					success:function(res)
					{         
                        $("#preloader").hide();
						$('#unit').val(res.unit);
						$('#qty').val(res.qty);
						$('#qty').attr('max',res.qty);
						$('#purchase_rate').val(res.rate);
						$('#hidden_qty').val(res.qty);
					}
				})
			}
			else {
				$('#unit,#qty,#purchase_rate,#hidden_qty,#rate').val('');
				$('#qty').removeAttr('max');
			}
            
        });
    });
    
    </script>
@endsection