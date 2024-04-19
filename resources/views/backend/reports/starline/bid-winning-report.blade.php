@extends('backend.layouts.app')
@section('title','Winner Report')
@section('styles')
<link href="http://kalyanmumbaimatka.com/adminassets/libs/select2/css/select2.min.css" rel="stylesheet"
    type="text/css" />
    
    <style>
        .bid_history_box h4, .bid_history_box h5{
    margin-bottom:0;
}
.bid_history_box {
    margin-bottom: 15px;
    padding: 10px;
}
.bid_history_box.bhb_bid_amt{
    border: 1px dashed rgb(85 110 230 / 0.32);
    /*background: #eaeeff;*/
}

.bid_history_box.bhb_win_amt{
        border: 1px dashed rgb(103 58 183 / 32%);
    /*background: rgb(103 58 183 / 18%);*/
} 

.bid_history_box.bhb_bid_amt .text-muted{
    color:#556ee6 !important;
}
.bid_history_box.bhb_win_amt .text-muted{
    color:#673AB7 !important;
}



.bid_history_box.bhb_profit_amt{
    border: 1px solid #34c38f;
    background: #34c38f;
}

.bid_history_box.bhb_lose_amt{
    border: 1px solid #f1673e;
    background: #f1673e;
}

.bid_history_area h5{
    color:#fff !important;
}
.bid_history_area .text-muted{
    color:#fff !important;
}

.smile_box img{
    width: 150px;
    margin: 0 auto;
    display: block;

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
                            <div class="">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-lg-12">
                                        <div class="row">
                                            <div class="col-sm-12 col-12 ">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="card-title">Bid Winning Report</h4>
                                                        <form id="winning_report_form" method="get" action="{{route('admin.get_bid_winning_report_details')}}">
                                                            <div class="row">
                                                                <div class="form-group col-md-3">
                                                                    <label>Result Date</label>
                                                                    <div class="date-picker">
                                                                        <div class="input-group">
                                                                            <input class="form-control digits"
                                                                                type="date" 
                                                                                name="bid_date"
                                                                                id="date"
                                                                                value="{{ date('Y-m-d') }}" >
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group col-md-4">
                                                                    <label>Game Name </label>
                                                                    <select class="form-control" name="game_id"
                                                                        id="game_id">
                                                                        <option value="">Select Name</option>
                                                                        @foreach ($gameNameList as $key => $value)
                                                                        <option value="{{  $key }}" />{{ $value}} </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-2">
                                                                    <label>&nbsp;</label>
                                                                    <button type="submit" id="submit"
                                                                        class="btn btn-primary btn-block" name="srchBtn">Submit</button>
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
                                
                                
                                
                                
                                <div class="container-fluid" style="">
                            		<div class="row">
                            			<div class="col-sm-12">
                            				<div class="card">
                            					<div class="card-body">
                            					    <div id="total_data"></div>
                            					    
                            					</div>
                            				</div>
                            			</div>
                            		</div>
                            	</div>
	
	
	
	    <!--            <div class="card-body">-->
					<!--    <div class="row">-->
					<!--        <div class="col-md-6">-->
    	<!--						<div class="bid_history_box bhb_bid_amt">-->
    	<!--							<div class="row">-->
    	<!--							    <div class="col-md-6">    -->
    	<!--							     <h5 class="text-muted font-weight-medium">Total Bid Amount</h5>-->
    	<!--							    </div>-->
    	<!--							    <div class="col-md-3"> -->
    	<!--							        <h5 id="total_bid_amt"><i class="bx bx-rupee"></i>1060</h5>-->
    	<!--							    </div>-->
    	<!--							    <div class="col-md-3 text-sm-right"> -->
    	<!--							     <button type="button" class="btn btn-primary waves-light btn-xs" onclick="OpenBidHistory();" id="winner_btn">View</button>-->
    	<!--							     </div>-->
    	<!--							</div>-->
    	<!--						</div>-->
    	<!--						<div class="bid_history_box bhb_win_amt">-->
    	<!--						    <div class="row">-->
    	<!--							    <div class="col-md-6">   -->
    	<!--							        <h5 class="text-muted font-weight-medium">Total Win Amount</h5>-->
     <!--   								</div>-->
     <!--   								<div class="col-md-3">-->
     <!--   								    <h5 class="mb-0" id="total_win_amt"><i class="bx bx-rupee"></i>1000</h5>-->
     <!--   								</div>-->
     <!--   								<div class="col-md-3 text-sm-right">-->
     <!--   								    <button type="button" class="btn btn-primary waves-light btn-xs" onclick="OpenWinHistoryDetails();" id="winner_btn">View</button>-->
    	<!--							    </div>-->
    	<!--							</div>-->
    	<!--						</div>-->
    	<!--						<div class="bid_history_area"><div class="bid_history_box bhb_profit_amt"><div class="row"><div class="col-md-6"><h5 class="text-muted font-weight-medium" id="profit_loss">Total Profit Amount</h5></div><div class="col-md-3"><h5 class="mb-0" id="total_profit_amt"><i class="bx bx-rupee"></i>60</h5></div><div class="col-md-3"></div></div></div></div>-->
    							
					<!--		</div>-->
					<!--		<div class="col-md-6">-->
					<!--		    <div class="smile_box"><img src="http://kalyanmumbaimatka.com/adminassets/images/smile.png"></div>-->
					<!--		</div> -->
							
					<!--	</div>-->
					<!--</div>-->
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
                $( document ).ready(function() {
                    $("#submit").click(function(e){
                        e.preventDefault();
                        const game_id = $('#game_id').val();
                        const date = $('#date').val();
                        var formData = new FormData();                    
                        formData.append('game_id', game_id);
                        formData.append('date', date);
                        $.ajax({
                            type: 'POST',
                            // dataType: "json",
                            url: $('#winning_report_form').attr('action'),
                            data: formData,
                            processData: false,
                            contentType: false,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            beforeSend: function() {},
                            success: function(data) {
                                if ($.isEmptyObject(data.error)) {
                                    // $('#marketModal').modal('show');
                                    console.log(data.data);
                                    $('#total_data').html(data.data);
                                } else {
                                    alert('something went wrong')
                                }
                            }
                        });
                     });
                });
            </script>
        @endpush