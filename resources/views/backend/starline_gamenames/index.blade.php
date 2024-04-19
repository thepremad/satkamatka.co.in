@extends('backend.layouts.app')
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
                                <div class="card-header border-bottom">
                                    <h4 class="card-title">Game Name List</h4>
                                    <a href="{{ route('admin.starline.starline_gamenames.create') }}" class="btn btn-primary">Add </a>
                                </div>
                                <div class="card-datatable">
                                    <table class="dt-row-grouping table datatable_data">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Name</th>
                                                <th>HIndi Name</th>
                                                <th>Start time</th>
                                                <th>Close Time</th>
                                                <th>Status</th>
                                                <th>Market Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $value)
                                                <tr>
                                                    <td></td>
                                                    <td>{{ $value->name }}</td>
                                                    <td>{{ $value->name_hindi }}</td>
                                                    <td>{{ $value->today_open_time }}</td>
                                                    <td>{{ $value->today_close_time }}</td>
                                                    <td>{{ $value->status }}</td>
                                                    <td>{{ $value->market_status }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.starline.starline_gamenames.edit', $value->id) }}"
                                                            class="btn btn-primary">Edit</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Row grouping -->

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#marketModal">
                    Open modal
                </button>
            </div>

            <!-- The Modal -->
            <div class="modal" id="marketModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Modal Heading</h4>
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
                function marketOfTheDay(game_name_id) {
                    var formData2 = new FormData();                    
                    formData2.append('game_name_id', game_name_id);
                    $.ajax({
                        type: 'POST',
                        // dataType: "json",
                        url: "{{ route('admin.get_game_days') }}",
                        data: formData2,
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
