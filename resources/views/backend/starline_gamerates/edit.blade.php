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
                                    <h4 class="card-title">Add Games Rate</h4>
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
                                        <form action="{{ route('admin.starline.update-game-rates', $gameRate->id) }}"
                                            id="gameRatesFrm" name="gameRatesFrm" method="post">
                                            @csrf
                                            <input type="hidden" name="game_rate_id" value="{{ $gameRate->id }}">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="col-form-label">Single Digit Betting Amount</label>
                                                    <input class="form-control" type="number" name="single_betting_amount"
                                                        id="single_betting_amount"
                                                        value="{{ $gameRate->single_betting_amount }}"
                                                        placeholder="Enter Single Betting Amount">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="col-form-label">Single Digit Winning Amount</label>
                                                    <input class="form-control" type="number" name="single_winning_amount"
                                                        id="single_winning_amount"
                                                        value="{{ $gameRate->single_winning_amount }}"
                                                        placeholder="Enter Single Winning Amount">
                                                </div>
                                                
                                                <div class="form-group col-md-6">
                                                    <label class="col-form-label">Single Pana Betting Amount</label>
                                                    <input class="form-control" type="number"
                                                        name="single_pana_betting_amount" id="single_pana_betting_amount"
                                                        value="{{ $gameRate->single_pana_betting_amount }}"
                                                        placeholder="Enter Single Pana Betting Amount">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="col-form-label">Single Pana Winning Amount</label>
                                                    <input class="form-control" type="number"
                                                        name="single_pana_winning_amount" id="single_pana_winning_amount"
                                                        value="{{ $gameRate->single_pana_winning_amount }}"
                                                        placeholder="Enter Single Pana Winning Amount">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="col-form-label">Double Pana Betting Amount</label>
                                                    <input class="form-control" type="number"
                                                        name="double_pana_betting_amount" id="double_pana_betting_amount"
                                                        value="{{ $gameRate->double_pana_betting_amount }}"
                                                        placeholder="Enter Double Pana Betting Amount">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="col-form-label">Double Pana Winning Amount</label>
                                                    <input class="form-control" type="number"
                                                        name="double_pana_winning_amount" id="double_pana_winning_amount"
                                                        value="{{ $gameRate->double_pana_winning_amount }}"
                                                        placeholder="Enter Double Pana Winning Amount">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="col-form-label">Tripple Pana Betting Amount</label>
                                                    <input class="form-control" type="number"
                                                        name="tripple_pana_betting_amount" id="tripple_pana_betting_amount"
                                                        value="{{ $gameRate->tripple_pana_betting_amount }}"
                                                        placeholder="Enter Tripple Pana Betting Amount">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="col-form-label">Tripple Pana Winning Amount</label>
                                                    <input class="form-control" type="number"
                                                        name="tripple_pana_winning_amount" id="tripple_pana_winning_amount"
                                                        value="{{ $gameRate->tripple_pana_winning_amount }}"
                                                        placeholder="Enter Tripple Pana Winning Amount">
                                                </div>
                                                
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary waves-light m-t-10"
                                                    id="submitBtn" name="buysubmitBtn">Submit</button>
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
                </section>
                <!-- Basic Inputs end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
