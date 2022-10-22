<footer class="footer footer-black  footer-white ">
    <div class="container-fluid">
        <div class="row">
            <div class="credits mx-auto">
                <span class="copyright">
                    Designed And Developed By Mohammed Kojar
                </span>
            </div>
        </div>
    </div>
</footer>

</div>
</div>

<script>
    var base_url = "<?php echo config('app.url'); ?>";
    var pathname = window.location.pathname.split('/').at(-1);
</script>
<script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
{{-- <s?php if ($_SERVER['REQUEST_URI'] !== '/FMS' && $_SERVER['REQUEST_URI'] !== '/FMS/dashboard'): ?> --}}

<script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/dataTables.responsive.min.js') }}"></script>
{{-- <script src="{{ asset('assets/js/plugins/dataTables.rowGroup.min.js') }}"></script> --}}
<script src="{{ asset('assets/js/plugins/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/vfs_fonts.js') }}"></script>
{{-- <s?php endif ?> --}}
{{-- <s?php if ($_SERVER['REQUEST_URI'] !== '/FMS/milk_collection' && $_SERVER['REQUEST_URI'] !== '/FMS/' && $_SERVER['REQUEST_URI'] !== '/FMS/dashboard'): ?> --}}
    <script src="{{ asset('assets/js/plugins/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datepicker.js') }}"></script>    
    <script src="{{ asset('assets/js/plugins/buttons.print.min.js') }}"></script>
{{-- <s?php endif ?> --}}
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('assets/js/paper-dashboard.min1036.js?v=2.1.1') }}" type='text/javascript'></script>
<script src="{{ asset('js/custom.js') }}"></script>
{{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

<script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
@yield('qty_scripts')
@yield('stock_script')
@yield('stockout_script')
@yield('attendance_script')
@yield('customer_script')
@yield('milk_scripts')
</body>

</html>
