<!-- Navbar -->
@auth
<nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
  <div class="container-fluid">
    <div class="navbar-wrapper">
      <div class="navbar-minimize">
        <button id="minimizeSidebar" class="btn btn-icon btn-round">
          <i class="nc-icon nc-minimal-right text-center visible-on-sidebar-mini"></i>
          <i class="nc-icon nc-minimal-left text-center visible-on-sidebar-regular"></i>
        </button>
      </div>
      <div class="navbar-toggle">
        <button type="button" class="navbar-toggler">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </button>
      </div>
      <a class="navbar-brand font-weight-bold" href="{{config('app.url')}}">{{Request::segment(1) == '' ? 'dashboard' : str_replace('_',' ',Request::segment(1))}}</a>      
    </div>
    <a href="{{config('app.url')}}"><h4 class="my-0 text-success font-weight-bold">{{str_replace('_',' ',config('app.name','PATEL DAIRY FARM'))}}</h4></a>
    <div class="collapses navbar-collapses justify-content-end" id="navigation">
      <ul class="navbar-nav">
       {{--  @if (Route::currentRouteName() == 'dashboard')
        <li class="nav-item btn-rotate dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <i class="nc-icon nc-bell-55"></i>            
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink1">            
              <s?php// $count = 1 ?>
              <a class="dropdown-item" href="#">Delivery Report</a>     
              @if(count($delivery_report) > 0)
                  @foreach ($delivery_report as $item)
                  <s?php               
                    //$date1 = str_replace('-', '/', $item->delivery_date);
                    //$newdate = date('Y-m-d',strtotime($date1 . -$salves_days[0]->days_in_salves."days")); 
                  ?>
                  @if(strtotime(date('Y-m-d')) == strtotime($newdate))
                    <a class="dropdown-item" href="{{route('ghabhan.index')}}">{{$count}} - {{$item->product_name}} {{$item->product_no}}</a>      
                    <s?php //$count++ ?>
                    @else
                    <a class="dropdown-item" href="#">No Notifications</a>      
                  @endif               
                  @endforeach
              @else
              @endif
          </div>
        </li>
        @endif --}}
        <li class="nav-item btn-rotate dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="nc-icon nc-settings-gear-65"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <span class="sidebar-normal">{{ __('Logout') }}</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </div>
        </li>        
      </ul>
    </div>
  </div>
</nav>
  <!-- End Navbar -->
  @endauth
