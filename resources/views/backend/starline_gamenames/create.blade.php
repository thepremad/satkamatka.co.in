@extends('backend.layouts.app')

@section('content')
 <!-- BEGIN: Content-->
 <div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        
        <div class="content-body">
            <!-- Basic Inputs start -->
            <section id="basic-input">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Game</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form action="{{ route('admin.starline.starline_gamenames.store') }}" method="POST">
                                        @csrf
                                    <div class="col-xl-4 col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="name">Game Name</label>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Name" />
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="name_hindi">Game Name Hindi</label>
                                            <input type="text" class="form-control" name="name_hindi" id="name_hindi" placeholder="Name in hindi" />
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-12">
                                        <div class="mb-1">
                                            <label for="today_open_time">Today Open Time</label>
                                            <input type="time" name="today_open_time" id="today_open_time" class="form-control">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Basic Inputs end -->

        </div>
    </div>
</div>
<!-- END: Content-->

@endsection