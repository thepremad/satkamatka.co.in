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
                
                
                <section class="app-user-view-billing">
                    <div class="row">
                        <!-- User Sidebar -->
                        <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                            <!-- User Card -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="user-avatar-section">
                                        <div class="d-flex align-items-center flex-column">
                                            <img class="img-fluid rounded mt-3 mb-2" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRv4UK-VacVrppny4aGjzhWStSrcsP_6A1UdFvRLCMg&s" height="110" width="110" alt="User avatar" />
                                            <div class="user-info text-center">
                                                <h2>{{ $user->name }}</h2>
                                                <span class="badge bg-light-secondary">{{ $user->mobile }}</span>
                                                <a href="tel:{{ $user->mobile }} "><img src="{{ asset('public/phone-call.png') }}" style="width: 19px;"></a>
                                                    <a href="https://wa.me/{{ $user->mobile }} "><img src="{{ asset('public/whatsapp.png') }}" style="width: 19px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!--<div class="d-flex justify-content-around my-2 pt-75">-->
                                    <!--    <div class="d-flex align-items-start me-2">-->
                                    <!--        <span class="badge bg-light-primary p-75 rounded">-->
                                    <!--            <i data-feather="check" class="font-medium-2"></i>-->
                                    <!--        </span>-->
                                    <!--        <div class="ms-75">-->
                                    <!--            <h4 class="mb-0">1.23k</h4>-->
                                    <!--            <small>Tasks Done</small>-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--    <div class="d-flex align-items-start">-->
                                    <!--        <span class="badge bg-light-primary p-75 rounded">-->
                                    <!--            <i data-feather="briefcase" class="font-medium-2"></i>-->
                                    <!--        </span>-->
                                    <!--        <div class="ms-75">-->
                                    <!--            <h4 class="mb-0">568</h4>-->
                                    <!--            <small>Projects Done</small>-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <h4 class="fw-bolder border-bottom pb-50 mb-1"></h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="info-container">
                                                <ul class="list-unstyled">
                                                    <li class="mb-75">
                                                        <span class="fw-bolder me-25">Active:</span>
                                                        @if($user->status == '1')
                                                            <span class="badge bg-light-success">Yes</span>
                                                        @else
                                                            <span class="badge bg-light-danger">No</span>
                                                        @endif
                                                    </li>
                                                    
                                                    <li class="mb-75">
                                                        <span class="fw-bolder me-25">Betting:</span>
                                                        @if($user->betting == '1')
                                                            <span class="badge bg-light-success">Yes</span>
                                                        @else
                                                            <span class="badge bg-light-danger">No</span>
                                                        @endif
                                                    </li>
                                                    
                                                    <li class="mb-75">
                                                        <span class="fw-bolder me-25">Transfer:</span>
                                                        @if($user->transfer == '1')
                                                            <span class="badge bg-light-success">Yes</span>
                                                        @else
                                                            <span class="badge bg-light-danger">No</span>
                                                        @endif
                                                    </li>
                                                    
                                                </ul>
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6" style="text-align: center;">
                                            <h5>Available Balance</h5>
                                            <h1>{{ $user->wallet_amount }}</h1>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="d-flex justify-content-center pt-2">
                                                    <a href="javascript:;" class="btn btn-success me-1" data-bs-target="#add_wallet_amount" data-bs-toggle="modal">
                                                        Add Fund
                                                    </a>
                                                    
                                                        <div class="modal fade modal-success text-start" id="add_wallet_amount" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">

                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="myModalLabel120">Add Wallet Amount</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="{{ route('admin.users.add-wallet') }}" method="post">
                                                                                @csrf
                                                                                <div class="md-1">
                                                                                    <input type="number" name="amount" value="" placeholder="Add Amount" class="form-control">
                                                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                                                    <input type="hidden" name="type" value="1">
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="submit" class="btn btn-success" >Add Amount</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                        
                                                                    </div>
                                                            </div>
                                                        </div>
                                                        
                                                    <a href="javascript:;" class="btn btn-danger me-1" data-bs-target="#add_Withdraw_amount" data-bs-toggle="modal" >Withdraw Fund</a>
                                                    
                                                    <div class="modal fade modal-danger text-start" id="add_Withdraw_amount" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">

                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="myModalLabel120">Withdraw Amount</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="{{ route('admin.users.add-wallet') }}" method="post">
                                                                                @csrf
                                                                                <div class="md-1">
                                                                                    <input type="number" name="amount" value="" placeholder="Withdraw Amount" class="form-control">
                                                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                                                    <input type="hidden" name="type" value="0">
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="submit" class="btn btn-danger" >Withdraw Amount</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                        
                                                                    </div>
                                                            </div>
                                                        </div>
                                                </div>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            <!-- /User Card -->
                            <!-- Plan Card -->
                           
                            <!-- /Plan Card -->
                        </div>
                        <!--/ User Sidebar -->

                        <!-- User Content -->
                        <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                            

                            <!-- Billing Address -->
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-50">Personal Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-6 col-12">
                                            <dl class="row mb-0">
                                                <dt class="col-sm-5 fw-bolder mb-1">Full Name:</dt>
                                                <dd class="col-sm-7 mb-1">{{ $user->name }}</dd>

                                                <dt class="col-sm-5 fw-bolder mb-1"> Mobile:</dt>
                                                <dd class="col-sm-7 mb-1">{{ $user->mobile }}  
                                                <a href="tel:{{ $user->mobile }} "><img src="{{ asset('public/phone-call.png') }}" style="width: 19px;"></a>
                                                    <a href="https://wa.me/{{ $user->mobile }} "><img src="{{ asset('public/whatsapp.png') }}" style="width: 19px;"></a>
                                                
                                                </dd>

                                                <dt class="col-sm-5 fw-bolder mb-1">District Name:</dt>
                                                <dd class="col-sm-7 mb-1">N/A</dd>

                                                <dt class="col-sm-5 fw-bolder mb-1">Address Lane 1:</dt>
                                                <dd class="col-sm-7 mb-1">N/A</dd>

                                                <dt class="col-sm-5 fw-bolder mb-1">Area:</dt>
                                                <dd class="col-sm-7 mb-1">N/A</dd>
                                                
                                                <dt class="col-sm-5 fw-bolder mb-1">State Name:</dt>
                                                <dd class="col-sm-7 mb-1">N/A
                                                
                                                <dt class="col-sm-5 fw-bolder mb-1">Creation Date:	</dt>
                                                <dd class="col-sm-7 mb-1">{{ date('d M Y H:i:s',strtotime($user->created_at)) }}</dd>
                                                
                                                
                                            </dl>
                                        </div>
                                        <div class="col-xl-6 col-12">
                                            <dl class="row mb-0">
                                                <dt class="col-sm-5 fw-bolder mb-1">Email :</dt>
                                                <dd class="col-sm-7 mb-1">{{ $user->email }}</dd>

                                                <dt class="col-sm-5 fw-bolder mb-1">Flat/Plot No:</dt>
                                                <dd class="col-sm-7 mb-1">N/A</dd>

                                                <dt class="col-sm-5 fw-bolder mb-1">Password :</dt>
                                                <dd class="col-sm-7 mb-1">{{ $user->password_2 }}</dd>

                                                <dt class="col-sm-5 fw-bolder mb-1">Zipcode:</dt>
                                                <dd class="col-sm-7 mb-1"> N/A </dd>
                                                
                                                <dt class="col-sm-5 fw-bolder mb-1">Address Lane 2:</dt>
                                                <dd class="col-sm-7 mb-1">N/A</dd>
                                                
                                                <dt class="col-sm-5 fw-bolder mb-1">Pin Code:</dt>
                                                <dd class="col-sm-7 mb-1">N/A</dd>
                                                
                                                <dt class="col-sm-5 fw-bolder mb-1">Last Seen:</dt>
                                                <dd class="col-sm-7 mb-1">N/A</dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/ Billing Address -->
                        </div>
                        <!--/ User Content -->
                    </div>
                </section>
                
                <section class="app-user-view-billing">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-7 order-0 order-md-1">
                            

                            <!-- Billing Address -->
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-50">Payment Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-6 col-12">
                                            <dl class="row mb-0">
                                                <dt class="col-sm-4 fw-bolder mb-1">Bank Name :</dt>
                                                <dd class="col-sm-8 mb-1"> {{ isset($bank_detais->bank_name) ? $bank_detais->bank_name :'N/A' }}</dd>

                                                <dt class="col-sm-4 fw-bolder mb-1"> Branch Address:</dt>
                                                <dd class="col-sm-8 mb-1"> {{ isset($bank_detais->branch_address) ? $bank_detais->branch_address :'N/A' }}</dd>

                                                <dt class="col-sm-4 fw-bolder mb-1">A/c Holder Name:</dt>
                                                <dd class="col-sm-8 mb-1"> {{ isset($bank_detais->acccount_holder_name) ? $bank_detais->acccount_holder_name :'N/A' }}</dd>

                                                <dt class="col-sm-4 fw-bolder mb-1">PhonePe No.:</dt>
                                                <dd class="col-sm-8 mb-1">{{ $user->mobile }}</dd>
                                                
                                                <dt class="col-sm-4 fw-bolder mb-1">UPI ID:</dt>
                                                <dd class="col-sm-8 mb-1">{{ isset($bank_detais->upi_id) ? $bank_detais->upi_id :'N/A' }}</dd>
                                                
                                            </dl>
                                        </div>
                                        <div class="col-xl-6 col-12">
                                            <dl class="row mb-0">
                                                <dt class="col-sm-4 fw-bolder mb-1">A/c Number :</dt>
                                                <dd class="col-sm-8 mb-1"> {{ isset($bank_detais->acccount_number) ? $bank_detais->acccount_number :'N/A' }}</dd>

                                                <dt class="col-sm-4 fw-bolder mb-1">IFSC Code :</dt>
                                                <dd class="col-sm-8 mb-1"> {{ isset($bank_detais->ifsc_code) ? $bank_detais->ifsc_code :'N/A' }}</dd>

                                                <dt class="col-sm-4 fw-bolder mb-1">Paytm No.:</dt>
                                                <dd class="col-sm-8 mb-1">{{ $user->mobile}}</dd>

                                                <dt class="col-sm-4 fw-bolder mb-1">Google Pay No.:</dt>
                                                <dd class="col-sm-8 mb-1">{{ $user->mobile }}</dd>
                                                
                                                
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/ Billing Address -->
                        </div>
                    </div>
                </section>
                
                <section class="app-user-view-billing">
                    <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Add Fund Request List</h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table text-nowrap text-center datatable_data">
                                        <thead>
                                            <tr>
                                                <th class="text-start">Request Amount</th>
                                                <th>Request No</th>
                                                <th>Reciept Image</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($money_requests as $key=>$val)
                                            <tr>
                                                <td><strong>{{ $val->amount }}</strong></td>
                                                <td>0000{{ $val->id }}</td>
                                                <td>-</td>
                                                <td>{{ date('d M Y H:i:s',strtotime($val->created_at)) }}</td>
                                                <td>
                                                    @if($val->status == 1)
                                                        <span class="badge bg-light-success">Approved</span>
                                                    @elseif($val->status == 2)
                                                        <span class="badge bg-light-danger">Cancelled</span>
                                                    @elseif($val->status == 0)
                                                        <span class="badge bg-light-warning">Pending</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    
                                                    @if($val->status == 0)
                                                        <a href="{{ route('admin.money-request-approve',$val->id) }}" class=" btn-success" style="padding: 3%;">Approve</a>
                                                        <a href="{{ route('admin.money-request-reject',$val->id) }}" class=" btn-danger" style="padding: 3%;">Reject</a>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                    <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Withdraw Fund Request List</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table text-nowrap text-center datatable_data">
                                    <thead>
                                        <tr>
                                            <th class="text-start">Request Amount</th>
                                            <th>Request No.</th>
                                            <th>Receipt Image</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($withdrawal_requests as $key=>$val)
                                            <tr>
                                                <td><strong>{{ $val->amount }}</strong></td>
                                                <td>0000{{ $val->id }}</td>
                                                <td>-</td>
                                                <td>{{ date('d M Y H:i:s',strtotime($val->created_at)) }}</td>
                                                <td>
                                                    @if($val->status == 1)
                                                        <span class="badge bg-light-success">Approved</span>
                                                    @elseif($val->status == 2)
                                                        <span class="badge bg-light-danger">Cancelled</span>
                                                    @elseif($val->status == 0)
                                                        <span class="badge bg-light-warning">Pending</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($val->status == 0)
                                                        <a href="{{ route('admin.money-request-approve',$val->id) }}" class=" btn-success" style="padding: 3%;">Approve</a>
                                                        <a href="{{ route('admin.money-request-reject',$val->id) }}" class=" btn-danger" style="padding: 3%;">Reject</a>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                            
                    <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Bid History</h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table text-nowrap text-center datatable_data">
                                        <thead>
                                            <tr>
                                                <th class="text-start">Game Name</th>
                                                <th>Game Type</th>
                                                <th>Session</th>
                                                <th>Digits</th>
                                                <th>Close Digits</th>
                                                <th>Points</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($bids as $key => $val)
                                                <tr>
                                                    <td>{{ $val->game_name }}</td>
                                                    <td>{{ $val->bid_type }}</td>
                                                    <td>{{ $val->session }}</td>
                                                    <td>{{ $val->game_number }}</td>
                                                    <td>-</td>
                                                    <td>{{ $val->point_quantity }}</td>
                                                    <td>{{ date('d M Y H:i:s',strtotime($val->created_at)) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                    <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Wallet Transaction History</h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table text-nowrap text-center datatable_data">
                                        <thead>
                                            <tr>
                                                <th class="text-start">Amount</th>
                                                <th>Transaction Note</th>
                                                <th>Type</th>
                                                <th>Date</th>
                                                <th>Tx Req.No</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($wallet_transactions as $key => $val)
                                                <tr>
                                                    <td><strong>{{ $val->amount }}</strong></td>
                                                    <td>{{ $val->desc }}</td>
                                                    <td>@if($val->type == 1)
                                                            <span class="badge bg-light-success">Credit</span>
                                                        @else
                                                            <span class="badge bg-light-danger">Debit</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ date('d M Y H:i:s',strtotime($val->created_at)) }}</td>
                                                    <td>000{{ $val->id }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                    <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Winning History Report </h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table text-nowrap text-center datatable_data">
                                        <thead>
                                            <tr>
                                                <th class="text-start">Amount</th>
                                                <th>Game Name	</th>
                                                <th>Tx Id	</th>
                                                <th>Tx Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($winningGames as $key=>$val)
                                            <tr>
                                                <td>{{ $val->winning_amount }}</td>
                                                <td>{{ $val->game_name }}</td>
                                                <td>000{{ $val->id }}</td>
                                                <td>{{ date('d M Y H:i:s',strtotime($val->created_at)) }}</td>
                                                    
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                    
                        
                </section>
                
                
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@push('scripts')
   
@endpush
