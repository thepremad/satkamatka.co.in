@extends('backend.layouts.app')

@section('styles')
<link href="http://kalyanmumbaimatka.com/adminassets/libs/select2/css/select2.min.css" rel="stylesheet"
    type="text/css" />
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
                                                        <h4 class="card-title">Bid History Report</h4>
                                                        <form name="gameSrchFrm" method="get" action="{{route('admin.user-bid-history')}}">
                                                            <div class="row">
                                                                <div class="form-group col-md-3">
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

                                                                <div class="form-group col-md-4">
                                                                    <label>Game Name </label>
                                                                    <select class="form-control" name="game_id"
                                                                        id="game_id">
                                                                        <option value="">Select Name</option>
                                                                        @foreach ($gameNameList as $key => $value)
                                                                        <option value="{{  $key }}" @if($key == $request->game_id) selected="selected" @endif />{{ $value}} </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="form-group col-md-3">
                                                                    <label>Session</label>
                                                                    <select id="bid_type" name="bid_type" class="form-control">
                            											<option value="">-Select Game Type-</option>	
                                                                        <option value="all-type" @if($request->bid_type == "all-type") selected="selected" @endif>All Type</option>
                                                                        <option value="single-digit" @if($request->bid_type == "single-digit") selected="selected" @endif>Single Digit</option>
                                                                        <option value="jodi-digit" @if($request->bid_type == "jodi-digit") selected="selected" @endif>Jodi Digit</option>
                                                                        <option value="single-panna" @if($request->bid_type == "single-panna") selected="selected" @endif>Single Pana</option>
                                                                        <option value="double-panna" @if($request->bid_type == "double-panna") selected="selected" @endif>Double Pana</option>
                                                                        <option value="tripple-panna" @if($request->bid_type == "tripple-panna") selected="selected" @endif>Triple Pana</option>
                                                                        <option value="half-sangam" @if($request->bid_type == "half-sangam") selected="selected" @endif>Half Sangam</option>
                                                                        <option value="full-sangam" @if($request->bid_type == "full-sangam") selected="selected" @endif>Full Sangam</option>
                            										</select>
										
                                                                </div>

                                                                <div class="form-group col-md-2" style="align-self: self-end;">
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
                                                                <th>Bid TX ID</th>
                                                                <th>Game Name</th>
                                                                <th>Game Type</th>
                                                                <th>Session</th>
                                                                <th>Open Paana</th>
                                                                <th>Open Digit</th>
                                                                <th>Close Paana</th>
                                                                <th>Close Digit</th>
                                                                <th>Points</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="getBidHistory">
                                                            @foreach($bidHistory as $bid)
                                                                <tr>
                                                                    <td> {{ $bid->user->name }}</td>
                                                                    <td>{{ rand(1000,9999) }}</td>
                                                                    <td> {{ $bid->gameName->name }}</td>
                                                                    <td> {{ $bid->bid_type }}</td>
                                                                    <td> {{ $bid->session }}</td>
                                                                    <td>
                                                                    
                                                                    
                                                                        {{ $bid->oppen_panna_result }}
                                                                    </td>
                                                                    <td> 
                                                                   
                                                                    
                                                                   
                                                                    
                                                                        {{ $bid->oppen_digit_result }}
                                                                    </td>
                                                                    <td>
                                                                    
                                                                    
                                                                        {{ $bid->close_panna_result }}
                                                                    
                                                                    </td>
                                                                    <td> 
                                                                    
                                                                    
                                                                        {{ $bid->close_digit_result }}
                                                                    </td>
                                                                    <td> {{ $bid->point_quantity }}</td>
                                                                    <td><a href="javascript:;" onclick="editBid({{ $bid->id }})"
                                                            class="btn btn-primary">Edit</a></td>
                                                                </tr>
                                                            @endforeach
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