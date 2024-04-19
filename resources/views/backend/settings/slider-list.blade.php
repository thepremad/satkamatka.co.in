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
                                    <h4 class="card-title">Slider List</h4>
                                    <a href="{{ route('admin.slider-images') }}" class="btn btn-primary">Add </a>
                                </div>
                                <div class="card-datatable">
                                    <table class="dt-row-grouping table datatable_data" id="">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>images</th>
                                               
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                                <!--<tr>-->
                                                <!--    <td>1.</td>-->
                                                <!--    <td><img style="height:70px" src="{{asset('public/backend/images/avatars/banner1.png')}}" alt=""></td>-->
                                                <!--    <td><button class="btn btn-primary" disabled>delete</button></td>-->
                                                   
                                               
                                                <!--</tr>-->
                                                
                                                @foreach($data as $key => $image)
                                                    <tr>
                                                        <td>1.</td>
                                                        <td><img style="height:70px" src="{{asset('public/uploads/'.$image)}}" alt=""></td>
                                                        <td><a href="{{ route('admin.delete_slider_image',$key) }}"><button class="btn btn-primary" >delete</button></a></td>
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
