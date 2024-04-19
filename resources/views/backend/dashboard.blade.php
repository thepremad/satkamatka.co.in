@extends('backend.layouts.app')

@section('content')
<style>
    .single-ank-bid .col-md-2 {
        width: 20%;
    }
</style>
<!-- BEGIN: Content-->
  <div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- Dashboard Ecommerce Starts -->
            <section id="dashboard-ecommerce">
                
                <div class="row match-height">
                        <!-- Medal Card -->
                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="card card-congratulation-medal">
                                <div class="card-body">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR0CvarXMVIhpPozpDSDR-P7rsWztOALuEdwTpO288m-XDOVuM2WAOUockiHdqf0NYxJjU&usqp=CAU" width="330" height="100" >
                                    <h2 style="color: #7474ff;">Welcome Back🎉 !</h2>
                                    <h4 style="color: #2e2e81;" >Admin Dashboard</h4>
                                    
                                    <div class="info-container">
                                        <ul class="list-unstyled">
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Username:</span>
                                                <span>kalyanmu</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Unapproved Users:</span>
                                                <span class="badge bg-light-danger">{{ $un_athorised_user }}</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Approved Users:</span>
                                                <span class="badge bg-light-success">{{ $athorised_user }}</span>
                                            </li>
                                            
                                        </ul>
                                        
                                    </div>
                                    
                                </div>
                                
                                
                            </div>
                            <div class="card earnings-card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h4 class="card-title mb-1">Market Bid Detail</h4>
                                                    <div class="col-md-12">
                                                        <div class="mb-1">
                                                            <label class="form-label"  for="last-name-column">Game Name</label>
                                                                <select class="form-control" name="game_id" onChange="GetGameMarketValue(this.value)"
                                                                    id="game_id">
                                                                    <option value="">Select Name</option>
                                                                    @foreach ($gameNameList as $key => $value)
                                                                    <option value="{{  $value->id }}">{{
                                                                        $value->name }} ({{ $value->today_open_time
                                                                        . '-' .
                                                                        $value->today_close_time }})
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                        </div>
                                                    </div>
                                                    <h4 id="GetGameMarketValue">0</h4>
                                                    <h6>Market Amount</h6>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                            
                            
                        </div>
                        
                        
                        <!--/ Medal Card -->

                        <!-- Statistics Card -->
                        <div class="col-xl-8 col-md-6 col-12">
                            <div class="card card-statistics">
                                <div class="card-header">
                                    <h4 class="card-title">Statistics</h4>
                                    <div class="d-flex align-items-center">
                                        <p class="card-text font-small-2 me-25 mb-0">Updated 1 month ago</p>
                                    </div>
                                </div>
                                <div class="card-body statistics-body">
                                <div class="row">
                                    {{-- <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                        <div class="d-flex flex-row">
                                            <div class="avatar bg-light-primary me-2">
                                                <div class="avatar-content">
                                                    <i data-feather="trending-up" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="my-auto">
                                                <h4 class="fw-bolder mb-0">230k</h4>
                                                <p class="card-text font-small-3 mb-0">Sales</p>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-xl-4 col-sm-8 col-12 mb-2 mb-xl-0">
                                        <div class="d-flex flex-row">
                                            <div class="avatar bg-light-info me-2">
                                                <div class="avatar-content">
                                                    <i data-feather="user" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="my-auto">
                                                <h4 class="fw-bolder mb-0">{{ $customers }}</h4>
                                                <p class="card-text font-small-3 mb-0"><a href="{{ url('admin/users') }}">Customers</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-sm-8 col-12 mb-2 mb-sm-0">
                                        <div class="d-flex flex-row">
                                            <div class="avatar bg-light-danger me-2">
                                                <div class="avatar-content">
                                                    <i data-feather="box" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="my-auto">
                                                <h4 class="fw-bolder mb-0">{{ $total_game }}</h4>
                                                <p class="card-text font-small-3 mb-0">Games</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-sm-8 col-12">
                                        <div class="d-flex flex-row">
                                            <div class="avatar bg-light-success me-2">
                                                <div class="avatar-content">
                                                    <i data-feather="dollar-sign" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="my-auto">
                                                <h4 class="fw-bolder mb-0">{{ $today_bid }}</h4>
                                                <p class="card-text font-small-3 mb-0">Bid Amount</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            
                            <div class="card card-statistics">
                                <div class="card card-revenue-budget">
                            <div class="row mx-0">
                                <div class="col-md-12 col-12 revenue-report-wrapper">
                                    <div class="d-sm-flex justify-content-between align-items-center mb-3">
                                        <h4 class="card-title mb-50 mb-sm-0">Total Bids On Single Ank Of Date {{ date('d M Y') }}</h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="mb-1">
                                                <label class="form-label"  for="last-name-column">Game Name</label>
                                                <select class="form-select" name="status" id="game_name_single_digit">
                                                    <option value="">Select Name</option>
                                                    @foreach ($gameNameList as $key => $value)
                                                    <option value="{{  $value->id }}">{{
                                                        $value->name }} ({{ $value->today_open_time
                                                        . '-' .
                                                        $value->today_close_time }})
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <div class="mb-1">
                                                <label class="form-label"  for="last-name-column">Market Time</label>
                                                <select class="form-select" name="status" id="session_type">
                                                    <option value="">-Select Market Time-</option>
                                                    <option value="open">Open Market</option>
                                                    <option value="close">Close Market</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2" id="get_bid_counts_single_bid" style="align-self: center;">
                                            <a href="#" class="btn btn-success">Get</a>
                                            
                                        </div>

                                    </div>

                                </div>
                              
                            </div>
                        </div>
                            </div>
                            
                        </div>
                        <!--/ Statistics Card -->
                    </div>
                
                <div class="row match-height">
                        <!-- Medal Card -->
                        <div class="col-xl-4 col-md-6 col-12">
                            
                        </div>
                        <!--/ Medal Card -->

                        <!-- Statistics Card -->
                        <div class="col-xl-12 col-md-12 col-12">
                            <div class="row single-ank-bid">

                            <div class="col-md-2">
                                <div class="card card-developer-meetup" style="border: 3px solid #556ee6;">
                                    <div class="card-body" style="padding-bottom: 3%;">
                                        <div class="align-items-center" style="    text-align: center;"> 
                                            <div class="my-auto">
                                                <h4 class="card-title mb-25">Total Bid  <span id="market_bid_count_0"></span></h4>
                                                <h2 id="market_bid_total_bid_0">0</h2>
                                                <p class="card-text mb-0">Total Bid Amount</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="text-align: center;background-color: #556ee6;color:white">
                                        <span>Ank 0</span>
                                    </div>
                                </div>
                                
                            </div>
                        
                            <div class="col-md-2">
                                <div class="card card-developer-meetup" style="border: 3px solid #34c38f;">
                                    <div class="card-body" style="padding-bottom: 3%;">
                                        <div class="align-items-center" style="    text-align: center;"> 
                                            <div class="my-auto">
                                                <h4 class="card-title mb-25">Total Bid <span id="market_bid_count_1"></span> </h4>
                                                <h2 id="market_bid_total_bid_1" >0</h2>
                                                <p class="card-text mb-0">Total Bid Amount</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="text-align: center;background-color: #34c38f;color:white">
                                        <span>Ank 1</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="card card-developer-meetup" style="border: 3px solid #50a5f1;">
                                    <div class="card-body" style="padding-bottom: 3%;">
                                        <div class="align-items-center" style="    text-align: center;"> 
                                            <div class="my-auto">
                                                <h4 class="card-title mb-25">Total Bid  <span id="market_bid_count_2"></span></h4>
                                                <h2 id="market_bid_total_bid_2">0</h2>
                                                <p class="card-text mb-0">Total Bid Amount</p>
            
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div style="text-align: center;background-color: #50a5f1;color:white">
                                        <span>Ank 2</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="card card-developer-meetup" style="border: 3px solid #f1b44c;">
                                    <div class="card-body" style="padding-bottom: 3%;">
                                        <div class="align-items-center" style="    text-align: center;"> 
                                            <div class="my-auto">
                                                <h4 class="card-title mb-25">Total Bid <span id="market_bid_count_3"></span></h4>
                                                <h2 id="market_bid_total_bid_3">0</h2>
                                                <p class="card-text mb-0">Total Bid Amount</p>
            
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div style="text-align: center;background-color: #f1b44c;color:white">
                                        <span>Ank 3</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="card card-developer-meetup" style="border: 3px solid #af3ede;">
                                    <div class="card-body" style="padding-bottom: 3%;">
                                        <div class="align-items-center" style="    text-align: center;"> 
                                            <div class="my-auto">
                                                <h4 class="card-title mb-25">Total Bid <span id="market_bid_count_4"></span></h4>
                                                <h2 id="market_bid_total_bid_4" >0</h2>
                                                <p class="card-text mb-0">Total Bid Amount</p>
            
                                            </div>
                                        </div>
                                    </div>
                                    <div style="text-align: center;background-color: #af3ede;color:white">
                                        <span>Ank 4</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="card card-developer-meetup" style="border: 3px solid #f1673e;">
                                    <div class="card-body" style="padding-bottom: 3%;">
                                        <div class="align-items-center" style="    text-align: center;"> 
                                            <div class="my-auto">
                                                <h4 class="card-title mb-25">Total Bid <span id="market_bid_count_5"></span></h4>
                                                <h2 id="market_bid_total_bid_5">0</h2>
                                                <p class="card-text mb-0">Total Bid Amount</p>
            
                                            </div>
                                        </div>
                                    </div>
                                    <div style="text-align: center;background-color: #f1673e;color:white">
                                        <span>Ank 5</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="card card-developer-meetup" style="border: 3px solid #ea31ba;">
                                    <div class="card-body" style="padding-bottom: 3%;">
                                        <div class="align-items-center" style="    text-align: center;"> 
                                            <div class="my-auto">
                                                <h4 class="card-title mb-25">Total Bid <span id="market_bid_count_6"></span></h4>
                                                <h2 id="market_bid_total_bid_6">0</h2>
                                                <p class="card-text mb-0">Total Bid Amount</p>
            
                                            </div>
                                        </div>
                                    </div>
                                    <div style="text-align: center;background-color: #ea31ba;color:white">
                                        <span>Ank 6</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="card card-developer-meetup" style="border: 3px solid #5a3cff;">
                                    <div class="card-body" style="padding-bottom: 3%;">
                                        <div class="align-items-center" style="    text-align: center;"> 
                                            <div class="my-auto">
                                                <h4 class="card-title mb-25">Total Bid <span id="market_bid_count_7"></span></h4>
                                                <h2 id="market_bid_total_bid_7">0</h2>
                                                <p class="card-text mb-0">Total Bid Amount</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="text-align: center;background-color: #5a3cff;color:white">
                                        <span>Ank 7</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="card card-developer-meetup" style="border: 3px solid #ff3c84;">
                                    <div class="card-body" style="padding-bottom: 3%;">
                                        <div class="align-items-center" style="    text-align: center;"> 
                                            <div class="my-auto">
                                                <h4 class="card-title mb-25">Total Bid <span id="market_bid_count_8"></span></h4>
                                                <h2 id="market_bid_total_bid_8">0</h2>
                                                <p class="card-text mb-0">Total Bid Amount</p>
            
                                            </div>
                                        </div>
                                    </div>
                                    <div style="text-align: center;background-color: #ff3c84;color:white">
                                        <span>Ank 8</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="card card-developer-meetup" style="border: 3px solid #0dcebc;">
                                    <div class="card-body" style="padding-bottom: 3%;">
                                        <div class="align-items-center" style="    text-align: center;"> 
                                            <div class="my-auto">
                                                <h4 class="card-title mb-25">Total Bid <span id="market_bid_count_9"></span></h4>
                                                <h2 id="market_bid_total_bid_9">0</h2>
                                                <p class="card-text mb-0">Total Bid Amount</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="text-align: center;background-color: #0dcebc;color:white">
                                        <span>Ank 9</span>
                                    </div>
                                </div>
                            </div>
                           
                    </div>
                            
                            
                            
                        </div>
                        <!--/ Statistics Card -->
                    </div>
               

               
                
                <div class="row">
                    

                <div class="col-lg-8 col-md-8 col-12">

                    
                </div>
                
                <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Fund Request Auto Deposit History</h4>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped " id="datatable_data">
                                        <thead>
                                            <tr>
                                                <th>User Name</th>
                                                <th>Amount</th>
                                                <th>Request No.</th>
                                                <th>Txn Id</th>
                                                <th>Reject Remark</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             @foreach($money_request as $key=>$val)
                                            <tr>
                                                <td>{{ $val->name }}</td>
                                                <td><strong>{{ $val->amount }}</strong></td>
                                                <td>0000{{ $val->id }}</td>
                                                <td>-</td>
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
                        </div>
                </div>
                
                
                
                
            </section>
            <!-- Dashboard Ecommerce ends -->

        </div>
    </div>
</div>
<!-- END: Content-->
@endsection


        @push('scripts')
        <script src="http://kalyanmumbaimatka.com/adminassets/libs/select2/js/select2.min.js"></script>
        <script>
           
           $(document).on('click','#get_bid_counts_single_bid',function(e){
                    var session_type = $("#session_type").val();
                    var game_name_single_digit = $("#game_name_single_digit").val();
                    console.log(session_type)
                    $.ajax({
                        type: "POST",
                        url: '{{ route("admin.get_today_sdingle_digit_bit") }}',
                        data: {
                            game_id: game_name_single_digit,
                            session_type: session_type
                        },
                        dataType: "json",
                         headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            // $('.single-ank-bid').html(data.data)
                            
                            Object.values(data.data).forEach(item => {
                                var spanElement = document.getElementById("market_bid_count_"+item.number);
                                spanElement.innerText = item.count;
                                
                                var spanElement_2 = document.getElementById("market_bid_total_bid_"+item.number);
                                spanElement_2.innerText = item.sum_amount;
                              
                            });
                            
                        }
                    });
                });  
               
             
               

               
               
                

                

        </script>
        
         <script>
                                function GetGameMarketValue(value){
                                    $.ajax({
                                        type: "POST",
                                        url: '{{ route("admin.get_game_market_value") }}',
                                        data: {
                                            game_id: value,
                                        },
                                        dataType: "json",
                                         headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        success: function(data) {
                                            var spanElement = document.getElementById("GetGameMarketValue");

                                            // Update the text content of the <span> element using innerText
                                            spanElement.innerText = data;
                                        }
                                    });
                                }
                            </script>
        @endpush
        
