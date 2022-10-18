@include('inc.header1')
<!-- Extra details for Live View on GitHub Pages -->
<div class="wrapper ">
    @include('inc.navbar')
    <div class="main-panel">
        @include('inc.topnavbar1')
        <div class="content">
            @include('inc.messages')
                {{-- @if(!Request::is('/'))
                <div class="row">
                    <div class="col-md-12 text-right">
                        <a onclick="history.back()" class="text-dark nc-icon x3"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
                    </div>
                </div>
                @endif --}}
            @yield('content')
        </div>

        @include('inc.footer1')
