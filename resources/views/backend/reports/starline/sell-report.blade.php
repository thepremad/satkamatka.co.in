@extends('backend.layouts.app')

@section('styles')
<link href="http://kalyanmumbaimatka.com/adminassets/libs/select2/css/select2.min.css" rel="stylesheet"
    type="text/css" />
    
    <style>
        
        .sr_title{
	text-align: center;
    padding: 10px;
    border: 1px dashed #000;
    margin-bottom: 10px;
}
.sr_title h5{ 
	margin: 0;
    font-size: 16px;
    font-weight: 700;
    color: #c3478f;
}
.sr_td_data .form-group{
	border: 1px solid #000;
    border-left: none;
    padding: 0;

}

.sr_td_data .form-group.st_br_l  {
  border-left: 1px solid #000;
}

.sr_td_data .form-group .st_br_ht, .sr_td_data .form-group .st_br_hb{
	border-bottom: 1px solid black;
    padding: 5px;
	font-size: 15px;
    font-weight: 700;
	    margin: 0;
}
.sr_td_data .form-group .st_br_hb{
	border-bottom: none;
}

.account-pages .avatar-title{
        border: 1px solid #556ee6;
}

.badge-danger {
    color: #fff;
    background-color: #f46a6a;
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
                                                        <h4 class="card-title">Customer Sell Report</h4>
                                                        <form name="gameSrchFrm" method="get" action="{{route('admin.customer_sell_report')}}">
                                                            <div class="row">
                                                                <div class="form-group col-md-2">
                                                                    <label>Result Date</label>
                                                                    <div class="date-picker">
                                                                        <div class="input-group">
                                                                            <input class="form-control digits"
                                                                                type="date" 
                                                                                name="bid_date"
                                                                                value="{{ isset($request->bid_date) ? $request->bid_date : date('Y-m-d') }}" >
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group col-md-3">
                                                                    <label>Game Name </label>
                                                                    <select class="form-control" name="game_id"
                                                                        id="game_id">
                                                                        <option value="">Select Name</option>
                                                                        @foreach ($gameNameList as $key => $value)
                                                                        <option value="{{  $key }}" @if($key == $request->game_id) selected="selected" @endif />{{ $value}} </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="form-group col-md-3">
                                                                    <label>Game Type</label>
                                                                    <select id="bid_type" name="bid_type" class="form-control">
                            											<option value="">-Select Game Type-</option>	
                                                                        <option value="all-type" @if($request->bid_type == "all-type") selected="selected" @endif>All Type</option>
                                                                        <option value="single-digit" @if($request->bid_type == "single-digit") selected="selected" @endif>Single Digit</option>
                                                                        <option value="jodi-digit" @if($request->bid_type == "jodi-digit") selected="selected" @endif>Jodi Digit</option>
                                                                        <option value="single-panna" @if($request->bid_type == "single-panna") selected="selected" @endif>Single Pana</option>
                                                                        <option value="double-panna" @if($request->bid_type == "double-panna") selected="selected" @endif>Double Pana</option>
                                                                        <option value="tripple-panna" @if($request->bid_type == "tripple-panna") selected="selected" @endif>Triple Pana</option>
                                                                        <option value="hald-sangam" @if($request->bid_type == "hald-sangam") selected="selected" @endif>Half Sangam</option>
                                                                        <option value="full-sangam" @if($request->bid_type == "full-sangam") selected="selected" @endif>Full Sangam</option>
                            										</select>
                                                                </div>
                                                                
                                                                <div class="form-group col-md-2">
                                                                    <label>Game Type</label>
                                                                    <select id="market_status" name="market_status" class="form-control">
                            											<option value="">-Select Session-</option>
                            												<option value="Open">Open</option>
                            												<option value="Close">Close</option>
                            										</select>
                                                                </div>

                                                                <div class="form-group col-md-2">
                                                                    <label>&nbsp;</label>
                                                                    <button type="submit"
                                                                        class="btn btn-primary btn-block" name="srchBtn">Go</button>
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
                                <div class="row">
                                    
                                    
                                    <div class="col-sm-12">
				<div class="card">
				  <div class="card-body">
				 
					 <div class="mytable"><div class="row"><div class="col-md-12 sr_title"><h5>Single Digit</h5></div></div><div class="row sr_td_data"><div class="form-group bord st_br_l col-md-2"><h5 class="st_br_ht">Digit</h5><h5 class="st_br_hb">Point</h5></div><div class="form-group bord col-md-1"><h5 class="st_br_ht">6</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">7</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">0</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">8</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">1</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">9</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">2</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">3</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">4</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">5</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div></div><div class="row"><div class="col-md-12 sr_title"><h5>Jodi Digit</h5></div></div><div class="row sr_td_data"></div><div class="row"><div class="col-md-12 sr_title"><h5>Single Pana</h5></div></div><div class="row sr_td_data"><div class="form-group bord st_br_l col-md-2"><h5 class="st_br_ht">Digit</h5><h5 class="st_br_hb">Point</h5></div><div class="form-group bord col-md-1"><h5 class="st_br_ht">127</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">136</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">145</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">190</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">235</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">280</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">370</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">479</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">460</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">569</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord st_br_l col-md-2"><h5 class="st_br_ht">Digit</h5><h5 class="st_br_hb">Point</h5></div><div class="form-group bord col-md-1"><h5 class="st_br_ht">389</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">578</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">128</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">137</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">146</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">236</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">245</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">290</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">380</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">470</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord st_br_l col-md-2"><h5 class="st_br_ht">Digit</h5><h5 class="st_br_hb">Point</h5></div><div class="form-group bord col-md-1"><h5 class="st_br_ht">489</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">560</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">678</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">579</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">129</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">138</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">147</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">156</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">237</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">246</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord st_br_l col-md-2"><h5 class="st_br_ht">Digit</h5><h5 class="st_br_hb">Point</h5></div><div class="form-group bord col-md-1"><h5 class="st_br_ht">345</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">390</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">480</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">570</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">679</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">589</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">120</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">139</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">148</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">157</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord st_br_l col-md-2"><h5 class="st_br_ht">Digit</h5><h5 class="st_br_hb">Point</h5></div><div class="form-group bord col-md-1"><h5 class="st_br_ht">238</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">247</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">256</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">346</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">490</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">580</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">670</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">689</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">130</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">149</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord st_br_l col-md-2"><h5 class="st_br_ht">Digit</h5><h5 class="st_br_hb">Point</h5></div><div class="form-group bord col-md-1"><h5 class="st_br_ht">158</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">167</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">239</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">248</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">257</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">347</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">356</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">590</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">680</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">789</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord st_br_l col-md-2"><h5 class="st_br_ht">Digit</h5><h5 class="st_br_hb">Point</h5></div><div class="form-group bord col-md-1"><h5 class="st_br_ht">140</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">159</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">168</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">230</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">249</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">258</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">267</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">348</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">357</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">456</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord st_br_l col-md-2"><h5 class="st_br_ht">Digit</h5><h5 class="st_br_hb">Point</h5></div><div class="form-group bord col-md-1"><h5 class="st_br_ht">690</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">780</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">123</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">150</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">169</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">178</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">240</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">259</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">268</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">349</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord st_br_l col-md-2"><h5 class="st_br_ht">Digit</h5><h5 class="st_br_hb">Point</h5></div><div class="form-group bord col-md-1"><h5 class="st_br_ht">358</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">457</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">367</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">790</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">124</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">160</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">179</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">250</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">269</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">278</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord st_br_l col-md-2"><h5 class="st_br_ht">Digit</h5><h5 class="st_br_hb">Point</h5></div><div class="form-group bord col-md-1"><h5 class="st_br_ht">340</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">359</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">368</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">458</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">467</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">890</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">125</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">134</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">170</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">189</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord st_br_l col-md-2"><h5 class="st_br_ht">Digit</h5><h5 class="st_br_hb">Point</h5></div><div class="form-group bord col-md-1"><h5 class="st_br_ht">260</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">279</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">350</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">369</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">378</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">459</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">567</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">468</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">126</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">135</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord st_br_l col-md-2"><h5 class="st_br_ht">Digit</h5><h5 class="st_br_hb">Point</h5></div><div class="form-group bord col-md-1"><h5 class="st_br_ht">180</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">234</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">270</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">289</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">360</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">379</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">450</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">469</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">568</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div></div><div class="row"><div class="col-md-12 sr_title"><h5>Double Pana</h5></div></div><div class="row sr_td_data"><div class="form-group bord st_br_l col-md-2"><h5 class="st_br_ht">Digit</h5><h5 class="st_br_hb">Point</h5></div><div class="form-group bord col-md-1"><h5 class="st_br_ht">550</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">668</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">244</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">299</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">226</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">488</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">677</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">118</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">334</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">100</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord st_br_l col-md-2"><h5 class="st_br_ht">Digit</h5><h5 class="st_br_hb">Point</h5></div><div class="form-group bord col-md-1"><h5 class="st_br_ht">119</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">155</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">227</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">335</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">344</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">399</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">588</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">669</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">200</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">110</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord st_br_l col-md-2"><h5 class="st_br_ht">Digit</h5><h5 class="st_br_hb">Point</h5></div><div class="form-group bord col-md-1"><h5 class="st_br_ht">228</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">255</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">336</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">499</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">660</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">688</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">778</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">300</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">166</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">229</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord st_br_l col-md-2"><h5 class="st_br_ht">Digit</h5><h5 class="st_br_hb">Point</h5></div><div class="form-group bord col-md-1"><h5 class="st_br_ht">337</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">355</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">445</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">599</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">779</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">788</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">400</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">112</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">220</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">266</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord st_br_l col-md-2"><h5 class="st_br_ht">Digit</h5><h5 class="st_br_hb">Point</h5></div><div class="form-group bord col-md-1"><h5 class="st_br_ht">338</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">446</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">455</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">699</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">770</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">500</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">113</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">122</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">177</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">339</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord st_br_l col-md-2"><h5 class="st_br_ht">Digit</h5><h5 class="st_br_hb">Point</h5></div><div class="form-group bord col-md-1"><h5 class="st_br_ht">366</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">447</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">799</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">889</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">600</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">114</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">277</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">330</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">448</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">466</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord st_br_l col-md-2"><h5 class="st_br_ht">Digit</h5><h5 class="st_br_hb">Point</h5></div><div class="form-group bord col-md-1"><h5 class="st_br_ht">556</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">880</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">899</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">700</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">115</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">133</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">188</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">223</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">377</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">449</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord st_br_l col-md-2"><h5 class="st_br_ht">Digit</h5><h5 class="st_br_hb">Point</h5></div><div class="form-group bord col-md-1"><h5 class="st_br_ht">557</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">566</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">800</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">116</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">224</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">233</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">288</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">440</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">477</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">558</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord st_br_l col-md-2"><h5 class="st_br_ht">Digit</h5><h5 class="st_br_hb">Point</h5></div><div class="form-group bord col-md-1"><h5 class="st_br_ht">990</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">900</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">117</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">144</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">199</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">225</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">388</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">559</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">577</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">667</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div></div><div class="row"><div class="col-md-12 sr_title"><h5>Triple Pana</h5></div></div><div class="row sr_td_data"><div class="form-group bord st_br_l col-md-2"><h5 class="st_br_ht">Digit</h5><h5 class="st_br_hb">Point</h5></div><div class="form-group bord col-md-1"><h5 class="st_br_ht">000</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">111</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">222</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">333</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">444</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">555</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">666</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">777</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">888</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div><div class="form-group bord col-md-1"><h5 class="st_br_ht">999</h5><h5 class="st_br_hb"><badge class="badge badge-danger">0</badge></h5>
											</div></div><div class="row"><div class="col-md-12 sr_title"><h5>Half Sangam</h5></div></div><div class="row sr_td_data"></div><div class="row"><div class="col-md-12 sr_title"><h5>Full Sangam</h5></div></div><div class="row sr_td_data"></div></div>
					 
					
					</div>
				</div>
			</div>
			
                                </div>
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
                function editBid(bid_id) {
                    var formData = new FormData();                    
                    formData.append('bid_id', bid_id);
                    $.ajax({
                        type: 'POST',
                        // dataType: "json",
                        url: "{{ route('admin.get_bid_details') }}",
                        data: formData,
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