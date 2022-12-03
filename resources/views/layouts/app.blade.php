@include('inc.header1')
<!-- Extra details for Live View on GitHub Pages -->
<div class="wrapper ">
    @include('inc.navbar')
    <div class="main-panel">
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
