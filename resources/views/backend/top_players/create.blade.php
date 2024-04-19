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
                                <h4 class="card-title">Add Player</h4>
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

                                    <form action="{{ route('admin.top_players.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                    <div class="col-xl-4 col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="name">Winner Name</label>
                                            <input type="text" class="form-control" required name="name" id="name" placeholder="Name" />
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"  for="last-name-column">Image<span class="error"></span></label>
                                            <input type="file" name="image" class="form-control">
                                        </div>
                                    </div>
                                    <!--<a href="https://www.flaticon.com/free-icons/user" title="user icons">User icons created by Freepik - Flaticon</a>-->
                                    <div class="col-xl-4 col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="name_hindi">Amount</label>
                                            <input type="number" class="form-control" required name="amount" id="name_hindi" placeholder="Name in hindi" />
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-12">
                                        <div class="mb-1">
                                            <label for="today_open_time">Digit</label>
                                            <input type="text" name="digit" required id="today_open_time" class="form-control" placeholder="Enter Digit">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-12">
                                        <div class="mb-1">
                                            <label for="today_open_time">Game Name</label>
                                            <select class="form-select" name="game_id" id="basicSelect" required>
                                                <option value="">(Select Game)</option>
                                                @foreach ($game as $item)
                                                    <option value="{{ $item->id }}" {{ (old("category_id") == $item->id ? "selected":"") }}  >{{ $item->name }} ( {{ $item->today_open_time }} : {{ $item->today_close_time }} )</option>
                                                @endforeach
                                            </select>
                                            <!--<input type="text" name="game_id" required id="today_open_time" class="form-control">-->
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-12">
                                        <div class="mb-1">
                                            <label for="today_open_time">Result Date</label>
                                            <input type="datetime-local" name="time" required id="today_open_time" class="form-control">
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