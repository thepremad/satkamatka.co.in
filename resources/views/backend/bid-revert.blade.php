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
                                                        <form name="gameSrchFrm" method="get" action="">
                                                            <div class="row">
                                                                <div class="form-group col-md-3">
                                                                    <label>Result Date</label>
                                                                    <div class="date-picker">
                                                                        <div class="input-group">
                                                                            <input class="form-control digits"
                                                                                type="date" 
                                                                                name="bid_date"
                                                                                value="{{ isset($return_Data['bid_date']) ? $return_Data['bid_date'] : date('Y-m-d') }}" >
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group col-md-4">
                                                                    <label>Game Name </label>
                                                                    <select class="form-control" name="game_id"
                                                                        id="game_id">
                                                                        <option value="">Select Name</option>
                                                                        @foreach ($gameNameList as $key => $value)
                                                                        <option value="{{  $value->id }}" {{ (isset($return_Data['game_id']) && $return_Data['game_id'] == $value->id) ? 'selected' : '' }} />{{ $value->name}} </option>
                                                                        @endforeach
                                                                    </select>
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
                                                <h4 class="card-title">Bid History Report <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#danger_ke">Clear & Refund All</button></h4>
                                                
                                                <div class="modal fade modal-danger text-start" id="danger_ke" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="myModalLabel120">Delete Product</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Are you sure you want to rebert all bid !
                                                                    </div>
                                                                    <form action="{{route('admin.bid_clear_for_rebert')}}" method="POST">
                                                                        @csrf
                                                                        <div class="modal-footer">
                                                                            <input type="hidden" name="date" value="{{ $return_Data['bid_date'] }}">
                                                                            <input type="hidden" name="game_id" value="{{ $return_Data['game_id'] }}">
                                                                            <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered datatable_data">
                                                        <thead>
                                                            <tr>
                                                                <th>User Name</th>
                                                                <th>User mobile</th>
                                                                <th>Bid Points</th>
                                                                <th>Bid Type</th>
                                                                <th>Number</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="">
                                                           @foreach($bid_data as $key => $val)
                                                                <tr>
                                                                    <td>{{ $val->user_name }}</td>
                                                                    <td>{{ $val->user_mobile }}</td>
                                                                    <td>{{ $val->point_quantity }}</td>
                                                                    <td>{{ $val->bid_type }}</td>
                                                                    <td>{{ $val->game_number }}</td>
                                                                    
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