@extends('backend.layouts.app')
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-body">
               
    
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card" style="min-height: 100%;">
                                <div class="card-header">
                                    <h4 class="card-title">Add Bank Detail</h4>
                                </div>
                                <div class="card-body">
                                   <form class="form" action="{{ route('admin.main-setting-store-bank-detail') }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    
                                        <div class="row">

                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Account Holder Name</label>
                                                    <input type="text" id="first-name-column" name="bank_holder_name" class="form-control" placeholder="Account Holder Name" required value="@if(isset($bank_detail->holder_name)){{ $bank_detail->holder_name}}@endif" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Account Number</label>
                                                    <input type="number" id="first-name-column" name="bank_account_number" class="form-control" placeholder="Account Number" required value="@if(isset($bank_detail->account_number)){{ $bank_detail->account_number}}@endif" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">IFSC Code</label>
                                                    <input type="number" id="first-name-column" name="bank_ifsc_code" class="form-control" placeholder="IFSC Code" required value="@if(isset($bank_detail->ifsc_code)){{ $bank_detail->ifsc_code}}@endif" />
                                                </div>
                                            </div>
                                            
                                            

                                            

                                            

                                            
                                           

                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary me-1">Submit</button>
                                                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card" style="min-height: 100%;">
                                <div class="card-header">
                                    <h4 class="card-title">Add App Link</h4>
                                </div>
                                <div class="card-body">
                                   <form class="form" action="{{ route('admin.main-setting-store-app-link') }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    
                                        <div class="row">

                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">App Link</label>
                                                    <input type="text" id="first-name-column" required name="app_link" class="form-control" placeholder="Account Holder Name" value="@if(isset($app_link->app_link)){{ $app_link->app_link}}@endif" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Share Message</label>
                                                    <textarea class="form-control" required name="app_share_message" id="exampleFormControlTextarea1" rows="3" placeholder="Share Message">@if(isset($app_link->app_share_message)){{ $app_link->app_share_message}}@endif</textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Referral Share Message</label>
                                                    <textarea class="form-control" required name="app_referral_share_message" id="exampleFormControlTextarea1" rows="3" placeholder="Referral Share Message">@if(isset($app_link->referral_share_message)){{ $app_link->referral_share_message}}@endif</textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary me-1">Submit</button>
                                                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                
                <section id="multiple-column-form" style="padding-top: 2%;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card" style="min-height: 100%;">
                                <div class="card-header">
                                    <h4 class="card-title">Add UPI ID</h4>
                                </div>
                                <div class="card-body">
                                   
                                    <form class="form" action="{{ route('admin.main-setting-store-add-upies') }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                        <div class="row">

                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Google UPI Payment Id</label>
                                                    <input type="text" id="first-name-column" required name="google_upi_id" class="form-control" placeholder="Goodle UPI ID" value="@if(isset($upi_ids->google)){{ $upi_ids->google}}@endif" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Phone Pe UPI Payment Id</label>
                                                    <input type="text" id="first-name-column" required name="phone_pe_upi_id" class="form-control" placeholder="Phone Pe UPI ID" value="@if(isset($upi_ids->phone_pe)){{ $upi_ids->phone_pe}}@endif" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Other UPI Payment Id</label>
                                                    <input type="text" id="first-name-column"  required name="other_upi_id" class="form-control" placeholder="Other UPI Id" value="@if(isset($upi_ids->other)){{ $upi_ids->other}}@endif" />
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary me-1">Submit</button>
                                                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card" style="min-height: 100%;">
                                <div class="card-header">
                                    <h4 class="card-title">App Maintainence</h4>
                                </div>
                                <div class="card-body">
                                   
                                    <form class="form" action="{{ route('admin.main-setting-store-add-maintainence') }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                        <div class="row">

                                            
                                            
                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Share Message</label>
                                                    <textarea class="form-control" name="share_message" required id="exampleFormControlTextarea1" rows="3" placeholder="Share Message">@if(isset($app_maintainence->share_message)){{ $app_maintainence->share_message}}@endif</textarea>
                                                </div>
                                            </div>
                                            
                                             <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Show Msg (ON/OFF)</label>
                                                    <div class="form-check form-check-primary form-switch">
                                                        <input class="form-check-input checked_chackbox" id="systemNotification" name="open_or_close" type="checkbox"   value="Open"  onclick="GetAllActiveEmis()"   <?php if(isset($app_maintainence->show_message)){ if($app_maintainence->show_message == 'Yes'){  echo "checked";  } }  ?> >
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary me-1">Submit</button>
                                                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                <section id="multiple-column-form" style="padding-top: 2%;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card" style="min-height: 100%;">
                                <div class="card-header">
                                    <h4 class="card-title">Add Referral Bonus Details</h4>
                                </div>
                                <div class="card-body">
                                   <form class="form" action="{{ route('admin.main-setting-store-referral_master') }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    
                                        <div class="row">

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Referral First Bonus Percentage</label>
                                                    <input type="number" id="first-name-column" name="first_bonus_percentage" class="form-control" max="100" placeholder="First Bonus Percentage" value="@if(isset($ReferralMaster->first_bonus_percentage)){{ $ReferralMaster->first_bonus_percentage}}@endif" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Referral First Bonus Max Amount</label>
                                                    <input type="number" id="first-name-column" name="first_bonus_max_amount" class="form-control" placeholder="First Bonus Max Amount" value="@if(isset($ReferralMaster->first_bonus_max_amount)){{ $ReferralMaster->first_bonus_max_amount}}@endif" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Referral Remaining Bonus Percentage</label>
                                                    <input type="number" id="first-name-column" name="remaining_bonus_percentage" class="form-control" max="100" placeholder="Remaining Bonus Percentage" value="@if(isset($ReferralMaster->remaining_bonus_percentage)){{ $ReferralMaster->remaining_bonus_percentage}}@endif" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Referral Remaining Bonus Max Amount</label>
                                                    <input type="number" id="first-name-column" name="remaining_bonus_max_amount" class="form-control" placeholder="Remaining Bonus Max Amount" value="@if(isset($ReferralMaster->remaining_bonus_max_amount)){{ $ReferralMaster->remaining_bonus_max_amount}}@endif" />
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary me-1">Submit</button>
                                                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                </section>
                
                <section id="multiple-column-form" style="padding-top: 2%;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card" style="min-height: 100%;">
                                <div class="card-header">
                                    <h4 class="card-title">Add Value's</h4>
                                </div>
                                <div class="card-body">
                                   
                                    <form class="form" action="{{ route('admin.main-setting-store-values') }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                        <div class="row">

                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Minimum Deposite</label>
                                                    <input type="text" id="first-name-column" name="min_deposite" class="form-control" placeholder="Minimum Deposite" value="@if(isset($ValueMaster->min_deposite)){{ $ValueMaster->min_deposite}}@endif" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Maximum Deposite</label>
                                                    <input type="number" id="first-name-column" name="max_deposite" class="form-control" placeholder="Maximum Deposite" value="@if(isset($ValueMaster->max_deposite)){{ $ValueMaster->max_deposite}}@endif" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Minimum Withdrawal</label>
                                                    <input type="number" id="first-name-column" name="min_withdrawal" class="form-control" placeholder="Minimum Withdrawal" value="@if(isset($ValueMaster->min_withdrawal)){{ $ValueMaster->min_withdrawal}}@endif" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Maximum Withdrawal</label>
                                                    <input type="number" id="first-name-column" name="max_withdrawal" class="form-control" placeholder="Maximum Withdrawal" value="@if(isset($ValueMaster->max_withdrawal)){{ $ValueMaster->max_withdrawal}}@endif" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Minimum Transfer</label>
                                                    <input type="number" id="first-name-column" name="min_transfer" class="form-control" placeholder="Minimum Transfer" value="@if(isset($ValueMaster->min_transfer)){{ $ValueMaster->min_transfer}}@endif" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Maximum Transfer</label>
                                                    <input type="number" id="first-name-column" name="max_transfer" class="form-control" placeholder="Maximum Transfer" value="@if(isset($ValueMaster->max_transfer)){{ $ValueMaster->max_transfer}}@endif" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Minimum Bid Amount</label>
                                                    <input type="number" id="first-name-column" name="min_bid_amount" class="form-control" placeholder="Minimum Bid Amount" value="@if(isset($ValueMaster->min_bid_amount)){{ $ValueMaster->min_bid_amount}}@endif" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Maximum Bid Amount</label>
                                                    <input type="number" id="first-name-column" name="max_bid_amount" class="form-control" placeholder="Maximum Bid Amount" value="@if(isset($ValueMaster->max_bid_amount)){{ $ValueMaster->max_bid_amount}}@endif" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Welcome Bonus</label>
                                                    <input type="number" id="first-name-column" name="welcome_bonus" class="form-control" placeholder="Welcome Bonus" value="@if(isset($ValueMaster->welcome_bonus)){{ $ValueMaster->welcome_bonus}}@endif" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column"> Withdraw Open Time</label>
                                                    <input type="time" id="first-name-column" name="withdrawal_open_time" class="form-control" placeholder=" Withdraw Open Time" value="@if(isset($ValueMaster->withdrawal_open_time)){{ $ValueMaster->withdrawal_open_time}}@endif" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column"> Withdraw Close Time</label>
                                                    <input type="time" id="first-name-column" name="withdrawal_close_time" class="form-control" placeholder="Withdraw Close Time" value="@if(isset($ValueMaster->withdrawal_close_time)){{ $ValueMaster->withdrawal_close_time}}@endif" />
                                                </div>
                                            </div>
                                            
                                             <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Global Batting</label>
                                                    <div class="form-check form-check-primary form-switch">
                                                        <input class="form-check-input checked_chackbox" id="systemNotification" name="global_batting" type="checkbox" value="1232" <?php if(isset($ValueMaster->global_batting)){ if($ValueMaster->global_batting == '1'){  echo "checked";  } }  ?> onclick="GetAllActiveEmis()">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary me-1">Submit</button>
                                                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                </section>
               
            </div>
            
        </div>
    </div>

            
        @endsection
       
