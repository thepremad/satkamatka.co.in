@extends('backend.layouts.app')
@section('styles')
    <style>
        .status {
            cursor: pointer;
        }

        .betting {
            cursor: pointer;
        }

        .transfer    {
            cursor: pointer;
        }
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
                                <div class="card-header border-bottom">
                                    <h4 class="card-title">Users List</h4>
                                    <a href="{{ route('admin.users.unapproved') }}" class="btn btn-primary">Un-approved
                                        Users List</a>
                                </div>
                                <div class="card-datatable">
                                    <table class="dt-row-grouping table datatable_data" id="">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>User Name</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th>Date</th>
                                                <th>Balance</th>
                                                <th>Betting</th>
                                                <th>Transfer</th>
                                                <th>Active</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $key => $value)
                                                <tr>
                                                    <td></td>
                                                    <td>{{ $value->name }}</td>
                                                    <td>{{ $value->mobile }}</td>
                                                    <td>{{ $value->email }}</td>
                                                    <td>{{ $value->created_at }}</td>
                                                    <td>{{ $value->current_balance }}</td>
                                                    <td class="betting" data-id="{{ $value->id }}">
                                                        @if ($value->betting == 1)
                                                            <span class="betting-text" style="color:green;">Yes</span>
                                                        @else
                                                            <span class="betting-text" style="color:red;">No</span>
                                                        @endif
                                                    </td>
                                                    <td class="transfer" data-id="{{ $value->id }}">
                                                        @if ($value->transfer == 1)
                                                            <span class="transfer-text" style="color:green;">Yes</span>
                                                        @else
                                                            <span class="transfer-text" style="color:red;">No</span>
                                                        @endif
                                                    </td>
                                                    <td class="status" data-id="{{ $value->id }}">
                                                        @if ($value->status == 1)
                                                            <span class="status-text" style="color:green;">Yes</span>
                                                        @else
                                                            <span class="status-text" style="color:red;">No</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.users.show',$value->id) }}" class="btn btn-primary"> View </a>
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
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@push('scripts')
    <script>
        $('.status').on('click', function() {
            var userId = $(this).data('id');
            $.ajax({
                url: "{{ route('admin.users.toggel_status') }}",
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: userId,
                },
                success: function(response) {
                    if (response.status !== undefined) {
                        var statusText = response.status == 1 ? 'Yes' : 'No';
                        var color = response.status == 1 ? 'green' : 'red';
                        $('[data-id="' + userId + '"] .status-text').text(statusText).css('color',
                            color);
                    }
                }
            });
        });

        $('.betting').on('click', function() {
            var userId = $(this).data('id');
            $.ajax({
                url: "{{ route('admin.users.toggle_betting') }}",
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: userId,
                },
                success: function(response) {
                    if (response.betting !== undefined) {
                        var bettingText = response.betting == 1 ? 'Yes' : 'No';
                        var color = response.betting == 1 ? 'green' : 'red';
                        $('[data-id="' + userId + '"] .betting-text').text(bettingText).css('color',
                            color);
                    }
                }
            });
        });

        $('.transfer').on('click', function() {
            var userId = $(this).data('id');
            $.ajax({
                url: "{{ route('admin.users.toggle_transfer') }}",
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: userId,
                },
                success: function(response) {
                    if (response.transfer !== undefined) {
                        var transferText = response.transfer == 1 ? 'Yes' : 'No';
                        var color = response.transfer == 1 ? 'green' : 'red';
                        $('[data-id="' + userId + '"] .transfer-text').text(transferText).css('color',
                            color);
                    }
                }
            });
        });

    </script>
@endpush
