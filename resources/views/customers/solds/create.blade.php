@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <form action="{{route('milk_entries.store')}}" accept="" role="form" method="post" id="milk_sold_form">
                @csrf
                <div class="card-body">
                        <div class="row mb-4">                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Sold Date</label>
                                    <input type="text" class="form-control datepicker" value="{{$next_date}}" name="sold_date" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">                            
                            <div class="col-md-6">
                                <div class="row">
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" value="Morning" class="clabelstyle">
                                            <input type="text" value="Evening" class="clabelstyle">
                                            <input type="text" value="Total" class="clabelstyle">
                                        </div>
                                    @foreach($milkusers as $row)
                                        <div class="col-md-2">
                                            <p class="my-2">{{$row->name}}</p>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="hidden" name="user_id[]" value="{{$row->id}}">
                                            <input type="number" value="{{$row->morning}}" name="u_morning[]" step="1" min="0" class="sold_me_cust_class usr_litre{{$row->id}} user_mlitres form-control" onkeyup="milk_sum(this,{{$row->id}})" onchange="milk_sum(this,{{$row->id}},'.usr_litre','.user_total')" required>
                                            <input type="number" value="{{$row->evening}}" name="u_evening[]" step="1" min="0" class="sold_me_cust_class usr_litre{{$row->id}} user_elitres form-control" onkeyup="milk_sum(this,{{$row->id}})" onchange="milk_sum(this,{{$row->id}},'.usr_litre','.user_total')" required>
                                            <input type="text" value="{{$row->morning + $row->evening}}" readonly class="sold_me_cust_class user_total{{$row->id}} form-control">
                                        </div>
                                    @endforeach
                                    <div class="col-md-2">
                                        <p class="my-2">Fridge</p>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="number" value="{{isset($ext_coll->morning) ? $ext_coll->morning : '0'}}" id="f_morning" name="f_morning[]" step="1" min="0" class="sold_me_cust_class user_mlitres form-control" required>
                                        <input type="number" value="{{isset($ext_coll->evening) ? $ext_coll->evening : '0'}}" id="f_evening" name="f_evening[]" step="1" min="0" class="sold_me_cust_class user_elitres form-control" required>
                                        <input type="text" id="fu_total" value="{{isset($ext_coll->total_lites) ? $ext_coll->total_lites : '0'}}" readonly class="sold_me_cust_class form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <p class="my-2">Bazaar</p>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="hidden" name="ext_type[]" value="bazaar">
                                        <input type="number" name="ext_morning[]" id="b_morning" step="1" min="0" value="0" class="sold_me_cust_class user_mlitres form-control" required>
                                        <input type="number" name="ext_evening[]" id="b_evening" step="1" min="0" value="0" class="sold_me_cust_class user_elitres form-control" required>
                                        <input type="text" id="b_total" value="" readonly class="sold_me_cust_class form-control">
                                    </div>
                                    
                                    <div class="col-md-2 mt-3">
                                        <p class="my-2"><b>Total</b></p>
                                    </div>
                                    <div class="col-md-10 mt-3">
                                        <input type="text" class="sold_me_cust_class form-control" id="final_um_total" readonly>
                                        <input type="text" class="sold_me_cust_class form-control" id="final_ue_total" readonly>
                                        <input type="text" class="sold_me_cust_class form-control" id="final_utotal" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-4 mt-xl-0 mt-md-0">
                                <div class="row">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-10">
                                        <input type="text" value="Morning" class="clabelstyle">
                                        <input type="text" value="Evening" class="clabelstyle">
                                        <input type="text" value="Total" class="clabelstyle">
                                    </div>
                                    @foreach ($customers as $row)
                                        <div class="col-md-2">
                                            <p class="my-2">{{$row->customer_name}}</p>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="hidden" name="customer_id[]" value="{{$row->id}}">
                                            <input type="number" value="{{$row->morning}}" id="c_morning" name="c_morning[]" step="1" min="0" class="sold_me_cust_class cust_mlitres cust_litre{{$row->id}} form-control" onkeyup="milk_sum(this,{{$row->id}})" onchange="milk_sum(this,{{$row->id}},'.cust_litre','.cust_total')" required>
                                            <input type="number" value="{{$row->evening}}" id="c_evening" name="c_evening[]" step="1" min="0" class="sold_me_cust_class cust_elitres cust_litre{{$row->id}} form-control" onkeyup="milk_sum(this,{{$row->id}})" onchange="milk_sum(this,{{$row->id}},'.cust_litre','.cust_total')" required>
                                            <input type="number" value="{{$row->morning + $row->evening}}" readonly class="sold_me_cust_class cust_total{{$row->id}} form-control" required>
                                            <input type="hidden" value="{{$row->milk_rate}}" name="milk_rate[]" step="1" min="0" class="sold_me_cust_class form-control" required>
                                        </div>
                                    @endforeach
                                    <div class="col-md-2 mt-3">
                                        <p class="my-2"><b>Total</b></p>
                                    </div>
                                    <div class="col-md-10 mt-3">
                                        <input type="text" class="sold_me_cust_class form-control" id="final_cm_total" readonly>
                                        <input type="text" class="sold_me_cust_class form-control" id="final_ce_total" readonly>
                                        <input type="text" class="sold_me_cust_class form-control" id="final_ctotal" readonly>
                                    </div>
                                    <div class="col-md-2 mt-3">
                                        <p class="my-2"><b>Fridge</b></p>
                                    </div>
                                    <div class="col-md-10 mt-3">
                                        <input type="hidden" name="ext_type[]" value="fridge">
                                        <input type="text" name="ext_morning[]" class="sold_me_cust_class form-control" id="frm_total" readonly>
                                        <input type="text" name="ext_evening[]" class="sold_me_cust_class form-control" id="fre_total" readonly>
                                        <input type="text" name="frc_total" class="sold_me_cust_class form-control" id="frc_total" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row mt-3">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Total</label>
                                    <input type="text" class="form-control" id="get_allme_values">
                                </div>                            
                            </div>
                        </div>--}}
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info btn-round">Submit</button>
                    <a href="{{config('app.url')}}/milk_entries" class="btn btn-danger btn-round ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('milk_scripts')
    <script type="text/javascript">
       /*  function total_collection() {
            var me_data = [];
            $(".getme_data").each(function() {
                me_data.push(Number($(this).val()));
            })
            var set_allme_values = me_data.reduce((total, values) => total + values, 0);
            $("#get_allme_values").val(set_allme_values);
        }
        total_collection();

        $(document).on('keyup change', '.getme_data', function() {
            total_collection();
        }) */
                       
        function milk_sum(e,id,cls,tid) {
            var userarr = [];
            $(cls+id).each(function() {
                userarr.push(Number($(this).val()));
            })
            var usr_total = userarr.reduce((total, values) => total + values, 0);
            $(tid+id).val(usr_total);
        }
        
        function METotal(clas,tcls) {
            var data = [];
            $(clas).each(function() {
                data.push(Number($(this).val()));
            })
            var final_values = data.reduce((total, values) => total + values, 0);
            $(tcls).val(final_values);
            totlCalc();
            calcFridgeTotal();
            totalValidation();
        }

        // For User Morning Total
        METotal(".user_mlitres","#final_um_total")
        $(document).on('keyup change', '.user_mlitres', function() {
            METotal(".user_mlitres","#final_um_total")            
        })

        // For User Evening Total
        METotal(".user_elitres","#final_ue_total")
        $(document).on('keyup change', '.user_elitres', function() {
            METotal(".user_elitres","#final_ue_total")
        })

        // For Customer Morning Total
        METotal(".cust_mlitres","#final_cm_total")
        $(document).on('keyup change', '.cust_mlitres', function() {
            METotal(".cust_mlitres","#final_cm_total")            
        })

        // For Customer Evening Total
        METotal(".cust_elitres","#final_ce_total")
        $(document).on('keyup change', '.cust_elitres', function() {
            METotal(".cust_elitres","#final_ce_total")
        })
        
        $(document).on('keyup change', '#f_morning,#f_evening', function() {
            $("#fu_total").val(parseInt($("#f_morning").val()) + parseInt($("#f_evening").val()))
        })
        
        $("#b_total").val(parseInt($("#b_morning").val()) + parseInt($("#b_evening").val()))
        $(document).on('keyup change', '#b_morning,#b_evening', function() {
            $("#b_total").val(parseInt($("#b_morning").val()) + parseInt($("#b_evening").val()))
        })

       
        totlCalc();
        function totlCalc() {
            $("#final_utotal").val(parseInt($("#final_um_total").val()) + parseInt($("#final_ue_total").val()))            
            $("#final_ctotal").val(parseInt($("#final_cm_total").val()) + parseInt($("#final_ce_total").val()))
        }

        calcFridgeTotal();
        function calcFridgeTotal() {
            $("#frm_total").val(parseInt($("#final_um_total").val()) - parseInt($("#final_cm_total").val()))
            $("#fre_total").val(parseInt($("#final_ue_total").val()) - parseInt($("#final_ce_total").val()))
            $("#frc_total").val(parseInt($("#final_utotal").val()) - parseInt($("#final_ctotal").val()))
        }

        // check for Total Validation
        function totalValidation() {
            var final_um_total = parseInt($("#final_um_total").val());
            var final_ue_total = parseInt($("#final_ue_total").val());
            var final_utotal = parseInt($("#final_utotal").val());

            var final_cm_total = parseInt($("#final_cm_total").val());
            var final_ce_total = parseInt($("#final_ce_total").val());
            var final_ctotal = parseInt($("#final_ctotal").val());
            
            if((final_cm_total > final_um_total) || (final_ce_total > final_ue_total) || (final_ctotal > final_utotal)) {
                // alert('Sold Total Cannot be Greater than Collection Total');                
                return false;
            }
        }
        
              
    </script>
@endsection