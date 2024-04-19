<!-- BEGIN: Vendor JS-->
<script src="{{asset('public/backend/vendors/js/vendors.min.js')}}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('public/backend/vendors/js/charts/apexcharts.min.js')}}"></script>
<script src="{{asset('public/backend/vendors/js/extensions/toastr.min.js')}}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{asset('public/backend/js/core/app-menu.js')}}"></script>
<script src="{{asset('public/backend/js/core/app.js')}}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{asset('public/backend/js/scripts/pages/dashboard-ecommerce.js')}}"></script>

<script src="{{asset('public/backend/js/scripts/forms/forms/select2-full-min.js')}}"></script>
<script src="{{asset('public/backend/js/scripts/forms/form-select2.js')}}"></script>
<!-- END: Page JS-->
<script src="{{ asset('public/backend/js/scripts/components/components-popovers.js')}}"></script>



<!--<script src="{{asset('public/backend/vendors/js/tables/datatable/responsive.bootstrap5.min.js')}}"></script>-->
<!--<script src="{{asset('public/backend/vendors/js/tables/datatable/datatables.checkboxes.min.js')}}"></script>-->
<!--<script src="{{asset('public/backend/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>-->
<!--<script src="{{asset('public/backend/vendors/js/tables/datatable/jszip.min.js')}}"></script>-->
<!--<script src="{{asset('public/backend/vendors/js/tables/datatable/pdfmake.min.js')}}"></script>-->
<!--<script src="{{asset('public/backend/vendors/js/tables/datatable/vfs_fonts.js')}}"></script>-->
<!--<script src="{{asset('public/backend/vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>-->
<!--<script src="{{asset('public/backend/vendors/js/tables/datatable/buttons.print.min.js')}}"></script>-->
<!--<script src="{{asset('public/backend/vendors/js/tables/datatable/dataTables.rowGroup.min.js')}}"></script>-->

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>


<script>
    $(document).ready(function() {
        $('.datatable_data').DataTable( {
             "aaSorting": [],
            "ordering": false,
            "aaSorting": [],
        });
        
        // $('.datatable_data_2').DataTable( {
        //     "pageLength": 50,
        //     "aaSorting": []
        //     // "ordering": false
        //     // "aaSorting": []
        // });

});

</script>

<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>

<script>
    $(document).ready(function() {
        
        toastr.options.timeOut = 10000;
        @if (Session::has('error'))
            toastr.error('{{ Session::get('error') }}');
            
        @elseif(Session::has('success'))
            toastr.success('{{ Session::get('success') }}');
        @endif

    });
</script>

