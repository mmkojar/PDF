<!-- -----------Collection---------- -->

<!-- index -->


  <div class="row">
    <div class="col-md-12">
      <div class="card">        
        <div class="card-header">            
            <a href="{{route('milk_collection.create')}}" class="btn btn-primary">Add Collection</a>
        </div>
        <div class="card-body">
          <?php $count=1 ?>
        @if(count($collections) > 0)
          <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Sr.No</th>
                <th>Collection Date</th>
                <th>Morning</th>
                <th>Evening</th>      
                <th>Total Litres</th>
                <th>Total Sold</th>
                <th>Remaining</th>
                <th>Collection Type</th>
                <th>Party Name</th>                                          
                <th class="disabled-sorting text-right">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($collections as $collection)
                <tr>
                  <td>{{$count}}</td>                  
                  <td>{{date('M j Y',strtotime($collection->collection_date))}}</td>
                  <td>{{$collection->morning}}</td>                  
                  <td>{{$collection->evening}}</td>
                  <td>{{$collection->total_litres}}</td>
                  <td>{{$collection->total_sold ? $collection->total_sold : 0}}</td>
                  <td>{{$collection->remaining_milk ? $collection->remaining_milk : 0}}</td>
                  <td>{{$collection->type}}</td>                  
                  <td>{{ucfirst($collection->party_name ? $collection->party_name : '-')}}</td>
                  <td class="text-right">
                    <!-- {{-- {!! Form::open(['action' => ['App\Http\Controllers\Customer\MilkCollectionController@destroy', $collection->id] , 'method' => 'POST', 'style' => 'display:inline']) !!}
                      {{Form::hidden ('_method','DELETE')}}
                      {{Form::submit('X', ['class' => 'btn btn-sm btn-danger'])}}
                    {!! Form::close() !!} --}} -->
                    <a id="{{$collection->id}}" class="btn btn-sm btn-danger delete_all" url="collection"><i class="fa fa-times"></i></a>                    
                    <a href="{{route('milk_collection.edit', $collection->id)}}" class="btn btn-sm btn-warning edit"><i class="fa fa-edit"></i></a>                    
                  </td>
                </tr>
                <?php $count++ ?>
              @endforeach
            </tbody>
          </table>
          @endif
        </div>
      </div>
    
    </div> 
  </div> 

  <!-- create -->

 <!-- <div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Add Collection</h4>
            </div>
            <form action="{{route('milk_collection.store')}}" accept="" role="form" method="post" id="milk_collection_form">
                @csrf        
                <div class="card-body">       
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Customer Type</label>
                                <select class="form-control" name="type" id="change_type" required>                                                                                          
                                    <option value="" disabled selected>--Select--</option>                        
                                    <option value="Internel">Internel</option>
                                    <option value="External">External</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6" id="show_on_external" style="display: none">
                            <div class="form-group" >
                                <label>Party Name</label>
                                <input type="text" name="party_name" id="remove_party_name" class="form-control">
                            </div>
                        </div>                   
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Morning</label>
                                <input type="number" name="morning" class="form-control" step="0.1" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Evening</label>
                                <input type="number" name="evening" class="form-control" step="0.1" min="0" required>
                            </div>
                        </div>                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Collection Date</label>
                                <input type="text" class="form-control datepicker" name="collection_date" required>
                            </div>
                        </div> 
                    </div>      
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info btn-round">Submit</button>
                    <a href="{{config('app.url')}}" class="btn btn-danger btn-round ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>  -->


<!-- colleciton controller -->
<!--  
    public function store(Request $request)
    {
        $data = DB::table('milkcollections')     
        ->select('milkcollections.*')
        ->where(['type'=>$request->type , 'collection_date' => $request->collection_date])
        ->get();

        $newdate = date('Y-m-d',strtotime($request->collection_date . "-1 days"));    

        $get_remaining_milk = DB::table('milkcollections')     
        ->select('milkcollections.*')
        ->where(['collection_date' => $newdate])
        ->first();               
        
        if(count($data) > 0) {
            return redirect('/milk_collection/create')->with('error','Collectin of this date is Already Created');
        }
        else {    
            $collection = new Milkcollection();
            $collection->type = $request->input('type');
            $collection->party_name = $request->input('party_name');
            $collection->morning = $request->input('morning');
            $collection->evening = $request->input('evening');
            $collection->total_litres = $request->input('morning')+$request->input('evening')+$get_remaining_milk->remaining_milk;
            $collection->collection_date = $request->input('collection_date');
            $collection->created_at = date('Y-m-d');
            $collection->save();

            return redirect('/milk_collection')->with('success','Record Created');
        }
    }

    public function edit($id)
    {
        $collection = Milkcollection::find($id);
        return view('customers.collections.edit')->with('collection', $collection);
    }


    public function update(Request $request, $id)
    {
        $collection = Milkcollection::find($id);
        $collection->type = $request->input('type');
        $collection->party_name = $request->input('party_name');        
        $collection->morning = $request->input('morning');
        $collection->evening = $request->input('evening');
        $collection->total_litres = $request->input('morning')+$request->input('evening');
        $collection->collection_date = $request->input('collection_date');
        $collection->save();

        return redirect('/milk_collection')->with('success','Record Updated');
    }

    public function delete($id)
    {
        $collection =  Milkcollection::find($id);        
        $collection->delete();
        return ['status' => 1 ];
    }  -->

    <!-- code for fetching sold items array && index function -->
      <!-- $today_date = date('Y-m-d');
        $checkForExternal =  Milkcollection::where(['created_at'=>$today_date,'type'=>'External'])->select('created_at')->get();
        $checkForInternal =  Milkcollection::where(['created_at'=>$today_date,'type'=>'Internel'])->select('created_at')->get();        
        return view('customers.collections.index')->with(['collections'=>$collections,'checkForExternal'=>$checkForExternal,'checkForInternal'=>$checkForInternal]); -->

   <!--   $c =[];
        foreach ($solds as $i => $b)
        {
            $date = $b->sold_date;
            $morning = $b->morning;
            $evening = $b->evening;
            $total_litres = $b->total_litres;
            
            $key = $i;
            
            $key = array_search($date, array_column($c, 'sold_date'));
            if ($key !== false)
            {                
                $morning = $c[$key]['morning'] + $morning;
                $evening = $c[$key]['evening'] + $evening;
                $total_litres = $morning + $evening;                
            }
            else
            {
                $key = count($c);                
            }
            $c[$key]['sold_date'] = $date;
            $c[$key]['morning'] = $morning;
            $c[$key]['evening'] = $evening;
            $c[$key]['total_litres'] = $total_litres;
        } -->

        <!-- billing code -->
         <!-- ${res.data[i].timing == 'Morning' ? `<td>${res.data[i].litres}</td>` : '<td>0</td>'} -->
         <!-- ${res.data[i].timing == 'Evening' ? `<td>${res.data[i].litres}</td>` : '<td>0</td>'} -->

       <!--   /*else if(bill_type == "ten_days") {
                                                html_table += `
                                                <div class="container bootstrap snippets bootdeys">
                                                <div class="row">
                                                <div class="col-md-12">
                                                <div class="panel panel-default invoice" id="invoice">
                                                <div class="panel-body">
                                                <div class="row">
                                                <div class="col-sm-12 text-center">
                                                <p class="lead1">Subject To Mumbai jurisdiction</p>
                                                <p class="lead1 dairy_name">MOONLIGHT DAIRY FARM</p>
                                                <p class="lead1">WHOLESALE & RETAIL MILK MERCHANT</p>
                                                </div>
                                                </div>                                                            
                                                <div class="row">
                                                <div class="col-sm-3 invoice_image">
                                                <img src="${base_url}/assets/img/p_image.jpg" height="100" widht="100">
                                                </div>      
                                                <div class="col-sm-6 text-center">                                                                                            
                                                <p>Aarey Milk Colony, </p>
                                                <p>Unit No:8,</p>
                                                <p>Goregaon (E), Mumbai-65</p>
                                                </div>
                                                <div class="col-sm-3 text-right invoice_date">
                                                <h3 class="marginright invoice_no mb-0">INVOICE-${bill_no}</h3>
                                                <span class="marginright">${moment().format('DD-MMM-YYYY')}</span>
                                                </div>
                                                </div>
                                                <hr>
                                                <div class="row">                                                                                        
                                                <div class="col-sm-6">
                                                <p class="lead marginbottom">${bill_customer_name.toUpperCase()}</p>
                                                </div>
                                                <div class="col-sm-6 text-right payment-details">
                                                <p class="lead marginbottom payment-info">Payment details</p>
                                                <p>Date : ${moment().format('DD-MMM-YYYY')}</p>
                                                <p>Bill Period :<br> ${moment(xdate).format("DD-MMM-YYYY")} to ${moment(ydate).format("DD-MMM-YYYY")}</p>
                                                </div>
                                                </div>

                                                <div class="row table-row">
                                                <div class="col-sm-12">
                                                <table class="table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                <th>Dates</th>
                                                <th>Morning</th>
                                                <th>Evening</th>
                                                <th>Dates</th>
                                                <th>Morning</th>
                                                <th>Evening</th>
                                                </tr>
                                                </thead>
                                                <tbody>`;
                                                let first5res = [];                                                   
                                                if(res.data.length == '10') {
                                                    for(var i=0; i<res.data.length; i+=5){
                                                        var sliced = res.data.slice(i, i+5);
                                                        first5res.push(sliced);
                                                    }   
                                                }
                                                else {
                                                    for(var i=0; i<res.data.length; i+=6){
                                                        var sliced = res.data.slice(i, i+6);
                                                        first5res.push(sliced);
                                                    }   
                                                }
                                                console.log(first5res);                                                    
                                                first5res[1].push(Object.create({sold_date:'',morning:'',evening:''}));
                                                for (var i = 0; i < first5res[0].length; i++) {
                                                    html_table +=`<tr>
                                                            <td>${moment(first5res[0][i].sold_date).format("DD-MMM-YYYY")}</td>
                                                            <td>${first5res[0][i].morning}</td>
                                                            <td>${first5res[0][i].evening}</td>
                                                            <td>${first5res[1][i].sold_date ? (moment(first5res[1][i].sold_date).format("DD-MMM-YYYY")) : ''}</td>
                                                            <td>${first5res[1][i].morning}</td>
                                                            <td>${first5res[1][i].evening}</td>
                                                    </tr>`;
                                                }

                                                // for (var i = 0; i < res.data.length; i++) {                                                 
                                                //     html_table +=`<tr>
                                                //     <td>${moment(res.data[i].sold_date).format("DD-MMM-YYYY")}</td>                                                                                
                                                //     <td class="text-right">${res.data[i].morning}</td>
                                                //     <td class="text-right">${res.data[i].evening}</td>
                                                //     <td class="text-right">${res.data[i].total_litres}</td>
                                                //     </tr>`;                                                   
                                                // }   
                                                html_table += `
                                                <tr>
                                                    <td class="text-right"></td>
                                                    <td class="text-right">Morning: ${get_morning_litres}</td>
                                                    <td class="text-right">Evening: ${get_evening_litres}</td>
                                                    <td class="text-right">Total: ${ysum}</td>
                                                    <td class="text-right"></td>
                                                    <td class="text-right"></td>
                                                </tr>
                                                </tbody>
                                                </table>
                                                </div>
                                                </div>                                                                                    
                                                <div class="row table-row">
                                                <div class="col-sm-6 margintop">
                                                <p class="marginbottom">THANK YOU! <span style=" font-size: 12px;">(Rs.${res4.adjusted}/-&nbsp;&nbsp;Bhool/Bhav Pher)</span></p>
                                                <p></p>                                                                                            
                                                <p id="number_in_words">Amount (in words):<br> ${RsPaise(Math.round((get_grand_total_amount)*100)/100)}</p>
                                                </div>
                                                <div class="col-sm-2 text-center">
                                                <p>Rate : ${get_rate}</p>
                                                </div>
                                                <div class="col-sm-4 text-right invoice-total">                                                                                               
                                                <p>Total : ${get_total_amount}</p>
                                                <p>Previous Bal : ${get_pending_amount} </p>
                                                <p>Grand Total : ${get_grand_total_amount} </p>
                                                </div>                                                                                    
                                                </div>                                                                                
                                                </div>
                                                </div>
                                                </div>
                                                </div>
                                                </div>`;
                                            }*/ -->