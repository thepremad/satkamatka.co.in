@extends('backend.layouts.app')

@section('styles')
<link href="http://kalyanmumbaimatka.com/adminassets/libs/select2/css/select2.min.css" rel="stylesheet"
    type="text/css" />
    
    <style>
    </style>
@endsection
@section('content')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-body">
            <!-- Row grouping -->
            <section id="row-grouping-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-lg-12">
                                        <div class="row">
                                            <div class="col-sm-12 col-12 ">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="card-title">Withdraw Report</h4>
                                                        <form name="gameSrchFrm" method="get" action="{{route('admin.withdraw_report')}}">
                                                            <div class="row">
                                                                <div class="form-group col-md-4">
                                                                    <label>Result Date</label>
                                                                    <div class="date-picker">
                                                                        <div class="input-group">
                                                                            <input class="form-control digits"
                                                                                type="date" 
                                                                                name="bid_date"
                                                                                value="{{ isset($request->bid_date) ? $request->bid_date : date('Y-m-d') }}" >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-2">
                                                                    <label>&nbsp;</label>
                                                                    <button type="submit"
                                                                        class="btn btn-primary btn-block" name="srchBtn">Go</button>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div id="error"></div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Bid History Report</h4>
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered datatable_data">
                                                        <thead>
                                                            <tr>
                        										<th>User Name</th>
                        										<th>Mobile</th>
                        										<th>Amount</th>
                        										<th>Payment Method</th>
                        										<th>Request No.</th>
                        										<th>Date</th>
                        										<th>Status</th>
                        										<th>View</th>
                        										<th>Action</th>
                        									</tr>
                                                        </thead>
                                                        <tbody id="getBidHistory">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ Row grouping -->
        </div>

        <!-- The Modal -->
        <div class="modal" id="marketModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Update Bid</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="modal-dialog modal_right_side" role="document">
                            <div class="modal-content col-12 col-xl-4">                                    
                                <div class="modal-body modal_off_day">
                                    <div id="markOfDayData"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Content-->
            
        @endsection
          @push('scripts')
            <script>
                function editBid(bid_id) {
                    var formData = new FormData();                    
                    formData.append('bid_id', bid_id);
                    $.ajax({
                        type: 'POST',
                        // dataType: "json",
                        url: "{{ route('admin.get_bid_details') }}",
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        beforeSend: function() {},
                        success: function(data) {
                            if ($.isEmptyObject(data.error)) {
                                $('#marketModal').modal('show');
                                console.log(data.data);
                                $('#markOfDayData').html(data.data);
                            } else {
                                alert('something went wrong')
                            }
                        }
                    });


                }
            </script>
        @endpush