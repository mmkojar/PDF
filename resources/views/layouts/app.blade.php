@include('inc.header1')
<!-- Extra details for Live View on GitHub Pages -->
<div class="wrapper ">
    <div id="google_translate_element"></div>

    @include('inc.navbar')
    <div class="main-panel">
        <div class="modal fade" id="medical_alert_modal">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-body"id="getMedicalAlert">
                        
                </div>
              </div>
            </div>
          </div>
  
        @include('inc.topnavbar1')
        <div class="content">
            {{-- @if(!Request::is('/'))
                <div class="row">
                    <div class="col-md-12">
                        <a class="goback text-dark nc-icon x3 mb-3"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                    </div>
                </div>
            @endif --}}
            @include('inc.messages')
            @yield('content')
        </div>

        @include('inc.footer1')
