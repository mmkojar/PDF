@auth

<div class="sidebar"  data-color="warning" data-active-color="danger">
  <!--
    Tip 1: You can change the color of the sidebar using: data-color=" default | primary | info | success | warning | danger |"
  -->
  {{-- <div class="logo">
    <a href="{{config('app.url')}}" class="simple-text logo-mini">
      <div class="logo-image-small">
        <img src="{{config('app.url')}}/assets/img/logo-small.png">
      </div>
      <!-- <p>CT</p> -->
    </a>
    <a href="{{config('app.url')}}" class="simple-text logo-normal">
      {{config('app.name')}}
      <!-- <div class="logo-image-big">
        <img src="../assets/img/logo-big.png">
      </div> -->
    </a>
  </div> --}}
  <div class="sidebar-wrapper">
    <div class="user">
      <div class="photo">
        <img src="{{config('app.url')}}/assets/img/default-avatar.png" />
      </div>
      <div class="info">
        <a href="{{config('app.url')}}">
          <span>
            {{ ucfirst(Auth::user()->name) }}
          </span>
        </a>
        <div class="clearfix"></div>        
      </div>
    </div>
    <ul class="nav">         
      {{-- || 'product/stock' || 'customer' || 'salve' || 'days/processing' || 'days/medical1' || 'days/medical2' || 'days/salves' --}}
      <li id="master">
        <a data-toggle="collapse" href="#pagesExamples">
          <i class="nc-icon nc-paper"></i>
          <p>
            Master <span>(માસ્ટર)</span> <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="pagesExamples">
          <ul class="nav">
            <li>
              <a href="{{route('categories.index')}}">
                <span class="sidebar-normal"> Categories <span>(શ્રેણીઓ)</span> </span>
              </a>
            </li>
            <li>
              <a href="{{route('weight.index')}}">
                <span class="sidebar-normal"> Weight Scale<span>(વજન સ્કેલ)</span> </span>
              </a>
            </li>
            <li>
              <a href="{{route('location.index')}}">
                <span class="sidebar-normal"> Locations <span>(સ્થાનો)</span> </span>
              </a>
            </li>
            <li>
              <a href="{{route('location.khilla')}}">
                <span class="sidebar-normal"> Khilla <span>(ખીલા)</span> </span>
              </a>
            </li>
            <li>
              <a href="{{route('product.stock')}}">
                <span class="sidebar-normal"> Products Stock <span>(સ્ટોક)</span> </span>
              </a>
            </li>
            <li>
              <a href="{{route('customer.index')}}">
                <span class="sidebar-normal"> Customers <span>(બધા ગ્રાહકો)</span> </span>
              </a>
            </li>          
            <li>
              <a href="{{route('salves.index')}}">
                <span class="sidebar-normal"> Salves <span>(સાલ્વેસ)</span>
              </a>
            </li>
            <li>
              <a href="{{route('days.index')}}">
                <span class="sidebar-normal"> Days <span>(દિવસ)</span>
              </a>
            </li>
            <li>
              <a href="{{route('stock.items')}}">
                <span class="sidebar-normal"> Stock Items <span>(સ્ટોક વસ્તુઓ)</span>
              </a>
            </li>
          </ul>
        </div>
      </li>

      <li id="milk_entries">
        <a data-toggle="collapse" href="#transaction">
          <i class="nc-icon nc-money-coins"></i>
          <p>
            Milk Collections <span>(સંગ્રહ)</span> <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="transaction">
          <ul class="nav">            
            <li>
              <a href="{{route('milk_entries.index')}}">
                <span class="sidebar-normal"> Milk Entry <span>(દૂધની એન્ટ્રી)</span> </span>
              </a>
            </li>
            {{-- <li>
              <a href="{{route('milk_collection.internal')}}">
                <span class="sidebar-normal"> Internal Collection <span>(આંતરિક સંગ્રહ)</span> </span>
              </a>
            </li>
            <li>
              <a href="{{route('milk_collection.external')}}">
                <span class="sidebar-normal"> External Collection <span>(બાહ્ય સંગ્રહ)</span> </span>
              </a>
            </li> --}}
          </ul>
        </div>
      </li>

      <li id="billing_detail">
        <a data-toggle="collapse" href="#billing">
          <i class="nc-icon nc-single-copy-04"></i>
          <p>
            Billing  <span>(બિલિંગ)</span> <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="billing">
          <ul class="nav">    
            <li>
              <a href="{{route('billing.index')}}">
                Billing Detail <span>(બિલિંગ વિગત)</span>
              </a>
            </li>
          </ul>
        </div>
      </li>

      <li id="products_flow">
        <a data-toggle="collapse" href="#prod_flow">
          <i class="nc-icon nc-money-coins"></i>
          <p>
            Products Flow <span>(સોદા)</span> <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="prod_flow">
          <ul class="nav">                        
            <li>
              <a href="{{route('processing.index')}}">
                <span class="sidebar-normal"> Processing Detail <span>(પ્રક્રિયા)</span> </span>
              </a>
            </li>
            <li>
              <a href="{{route('medical_checkup.index')}}">
                <span class="sidebar-normal"> Medical Checkup  <span>(તબીબી તપાસ)</span> </span>
              </a>
            </li>
            <li>
              <a href="{{route('ghabhan.index')}}">
                <span class="sidebar-normal"> Gabhan <span>(ગાભણ )</span> </span>
              </a>
            </li>
            <li>
              <a href="{{route('report.index')}}">
                <span class="sidebar-normal"> Reports <span>(અહેવાલો)</span> </span>
              </a>
            </li>
            {{-- <li class="{{ Request::is('salve/transfer') ? 'active' : '' }}">
              <a href="{{route('salve.transfer')}}">
                <span class="sidebar-normal"> Transfer To salve <span>(સોલ્વ)</span> </span>
              </a>
            </li> --}}
            {{-- <li class="{{ Request::is('sold') ? 'active' : '' }}">
              <a href="{{route('sold.index')}}">
                <span class="sidebar-mini-icon">MC2</span>
                <span class="sidebar-normal"> Medical Checkup 2 <span>(દૂધ વેચાય છે)</span> </span>
              </a>
            </li> --}}
          </ul>
        </div>
      </li>

      <li id="others_detail">        
        <a data-toggle="collapse" href="#others">
          <i class="nc-icon nc-tag-content"></i>
          <p>
            Others <span>(અન્ય)</span> <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="others">
          <ul class="nav">
            <li>
              <a href="{{route('stock.index')}}">
                <span class="sidebar-normal"> Manage Stocks  <span>(સ્ટોક્સ મેનેજ કરો)</span></span>
              </a>
            </li>
            {{-- 
              <li>
                <a href="{{route('category_management.index')}}">
                  <span class="sidebar-normal"> Manage Category Stock <br><span>(કેટેગરી સ્ટોક મેનેજ કરો)</span></span>
                </a>
              </li>
              <li>
                <a href="{{route('medical.index')}}">
                  <span class="sidebar-normal"> Medical Stock  <span>(તબીબી સ્ટોક)</span></span>
                </a>
              </li>
              <li>
                <a href="{{route('food.index')}}">
                  <span class="sidebar-normal"> Food Stock  <span>(ફૂડ સ્ટોક)</span></span>
                </a>
              </li> --}}
            <li>
              <a href="{{route('rent.index')}}">
                <span class="sidebar-normal"> Income  <span>(આવક)</span></span>
              </a>
            </li>
            <li>
              <a href="{{route('expense.index')}}">
                <span class="sidebar-normal"> Expense  <span>(ખર્ચ)</span></span>
              </a>
            </li>
          </ul>
        </div>
      </li>      
    </ul>
  </div>
</div>

@endauth