@extends('backend.layouts.app')

@section('styles')
    <link href="http://kalyanmumbaimatka.com/adminassets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
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
                                <div class="card-body">
                                    <h4 class="card-title">Winning prediction</h4>
                                    <!--<form class="theme-form mega-form" id="geWinningpredictFrm" name="geWinningpredictFrm"-->
                                        <!--method="get" autocomplete="off">-->
                                        <div class="row">
                                            <div class="form-group col-md-2">
                                                <label>Date</label>
                                                <div class="date-picker">
                                                    <div class="input-group">
                                                        <input class="form-control" type="date" value="{{ date('Y-m-d'); }}"
                                                            name="result_date" max="{{ date('Y-m-d'); }}" id="desclare_result_date" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Game Name</label>
                                                <select id="desclare_result_game_name" name="win_game_name" class="form-control select2"
                                                    onchange="checkGameDeclare(this.value);">
                                                    <option value="">-Select Game Name-</option>
                                                    @foreach ($gameNameList as $key => $value)
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label>Session Time</label>
                                                <select id="win_market_status" name="win_market_status"
                                                    onchange="showclose(this.value);" class="form-control">
                                                    <option value="1">Open Market</option>
                                                    <option value="2">Close Market</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label>Open Pana</label>
                                                <select class="form-control select2 " name="winning_ank" id="open_number"
                                                    data-placeholder="Select open number" data-select2-id="winning_ank"
                                                    tabindex="-1" aria-hidden="true">
                                                    <option data-select2-id="2"></option>
                                                    <option value="000">000</option>
                                                    <option value="100">100</option>
                                                    <option value="110">110</option>
                                                    <option value="111">111</option>
                                                    <option value="112">112</option>
                                                    <option value="113">113</option>
                                                    <option value="114">114</option>
                                                    <option value="115">115</option>
                                                    <option value="116">116</option>
                                                    <option value="117">117</option>
                                                    <option value="118">118</option>
                                                    <option value="119">119</option>
                                                    <option value="120">120</option>
                                                    <option value="122">122</option>
                                                    <option value="123">123</option>
                                                    <option value="124">124</option>
                                                    <option value="125">125</option>
                                                    <option value="126">126</option>
                                                    <option value="127">127</option>
                                                    <option value="128">128</option>
                                                    <option value="129">129</option>
                                                    <option value="130">130</option>
                                                    <option value="133">133</option>
                                                    <option value="134">134</option>
                                                    <option value="135">135</option>
                                                    <option value="136">136</option>
                                                    <option value="137">137</option>
                                                    <option value="138">138</option>
                                                    <option value="139">139</option>
                                                    <option value="140">140</option>
                                                    <option value="144">144</option>
                                                    <option value="145">145</option>
                                                    <option value="146">146</option>
                                                    <option value="147">147</option>
                                                    <option value="148">148</option>
                                                    <option value="149">149</option>
                                                    <option value="150">150</option>
                                                    <option value="155">155</option>
                                                    <option value="156">156</option>
                                                    <option value="157">157</option>
                                                    <option value="158">158</option>
                                                    <option value="159">159</option>
                                                    <option value="160">160</option>
                                                    <option value="166">166</option>
                                                    <option value="167">167</option>
                                                    <option value="168">168</option>
                                                    <option value="169">169</option>
                                                    <option value="170">170</option>
                                                    <option value="177">177</option>
                                                    <option value="178">178</option>
                                                    <option value="179">179</option>
                                                    <option value="180">180</option>
                                                    <option value="188">188</option>
                                                    <option value="189">189</option>
                                                    <option value="190">190</option>
                                                    <option value="199">199</option>
                                                    <option value="200">200</option>
                                                    <option value="220">220</option>
                                                    <option value="222">222</option>
                                                    <option value="223">223</option>
                                                    <option value="224">224</option>
                                                    <option value="225">225</option>
                                                    <option value="226">226</option>
                                                    <option value="227">227</option>
                                                    <option value="228">228</option>
                                                    <option value="229">229</option>
                                                    <option value="230">230</option>
                                                    <option value="233">233</option>
                                                    <option value="234">234</option>
                                                    <option value="235">235</option>
                                                    <option value="236">236</option>
                                                    <option value="237">237</option>
                                                    <option value="238">238</option>
                                                    <option value="239">239</option>
                                                    <option value="240">240</option>
                                                    <option value="244">244</option>
                                                    <option value="245">245</option>
                                                    <option value="246">246</option>
                                                    <option value="247">247</option>
                                                    <option value="248">248</option>
                                                    <option value="249">249</option>
                                                    <option value="250">250</option>
                                                    <option value="255">255</option>
                                                    <option value="256">256</option>
                                                    <option value="257">257</option>
                                                    <option value="258">258</option>
                                                    <option value="259">259</option>
                                                    <option value="260">260</option>
                                                    <option value="266">266</option>
                                                    <option value="267">267</option>
                                                    <option value="268">268</option>
                                                    <option value="269">269</option>
                                                    <option value="270">270</option>
                                                    <option value="277">277</option>
                                                    <option value="278">278</option>
                                                    <option value="279">279</option>
                                                    <option value="280">280</option>
                                                    <option value="288">288</option>
                                                    <option value="289">289</option>
                                                    <option value="290">290</option>
                                                    <option value="299">299</option>
                                                    <option value="300">300</option>
                                                    <option value="330">330</option>
                                                    <option value="333">333</option>
                                                    <option value="334">334</option>
                                                    <option value="335">335</option>
                                                    <option value="336">336</option>
                                                    <option value="337">337</option>
                                                    <option value="338">338</option>
                                                    <option value="339">339</option>
                                                    <option value="340">340</option>
                                                    <option value="344">344</option>
                                                    <option value="345">345</option>
                                                    <option value="346">346</option>
                                                    <option value="347">347</option>
                                                    <option value="348">348</option>
                                                    <option value="349">349</option>
                                                    <option value="350">350</option>
                                                    <option value="355">355</option>
                                                    <option value="356">356</option>
                                                    <option value="357">357</option>
                                                    <option value="358">358</option>
                                                    <option value="359">359</option>
                                                    <option value="360">360</option>
                                                    <option value="366">366</option>
                                                    <option value="367">367</option>
                                                    <option value="368">368</option>
                                                    <option value="369">369</option>
                                                    <option value="370">370</option>
                                                    <option value="377">377</option>
                                                    <option value="378">378</option>
                                                    <option value="379">379</option>
                                                    <option value="380">380</option>
                                                    <option value="388">388</option>
                                                    <option value="389">389</option>
                                                    <option value="390">390</option>
                                                    <option value="399">399</option>
                                                    <option value="400">400</option>
                                                    <option value="440">440</option>
                                                    <option value="444">444</option>
                                                    <option value="445">445</option>
                                                    <option value="446">446</option>
                                                    <option value="447">447</option>
                                                    <option value="448">448</option>
                                                    <option value="449">449</option>
                                                    <option value="450">450</option>
                                                    <option value="455">455</option>
                                                    <option value="456">456</option>
                                                    <option value="457">457</option>
                                                    <option value="458">458</option>
                                                    <option value="459">459</option>
                                                    <option value="460">460</option>
                                                    <option value="466">466</option>
                                                    <option value="467">467</option>
                                                    <option value="468">468</option>
                                                    <option value="469">469</option>
                                                    <option value="470">470</option>
                                                    <option value="477">477</option>
                                                    <option value="478">478</option>
                                                    <option value="479">479</option>
                                                    <option value="480">480</option>
                                                    <option value="488">488</option>
                                                    <option value="489">489</option>
                                                    <option value="490">490</option>
                                                    <option value="499">499</option>
                                                    <option value="500">500</option>
                                                    <option value="550">550</option>
                                                    <option value="555">555</option>
                                                    <option value="556">556</option>
                                                    <option value="557">557</option>
                                                    <option value="558">558</option>
                                                    <option value="559">559</option>
                                                    <option value="560">560</option>
                                                    <option value="566">566</option>
                                                    <option value="567">567</option>
                                                    <option value="568">568</option>
                                                    <option value="569">569</option>
                                                    <option value="570">570</option>
                                                    <option value="577">577</option>
                                                    <option value="578">578</option>
                                                    <option value="579">579</option>
                                                    <option value="580">580</option>
                                                    <option value="588">588</option>
                                                    <option value="589">589</option>
                                                    <option value="590">590</option>
                                                    <option value="599">599</option>
                                                    <option value="600">600</option>
                                                    <option value="660">660</option>
                                                    <option value="666">666</option>
                                                    <option value="667">667</option>
                                                    <option value="668">668</option>
                                                    <option value="669">669</option>
                                                    <option value="670">670</option>
                                                    <option value="677">677</option>
                                                    <option value="678">678</option>
                                                    <option value="679">679</option>
                                                    <option value="680">680</option>
                                                    <option value="688">688</option>
                                                    <option value="689">689</option>
                                                    <option value="690">690</option>
                                                    <option value="699">699</option>
                                                    <option value="700">700</option>
                                                    <option value="770">770</option>
                                                    <option value="777">777</option>
                                                    <option value="778">778</option>
                                                    <option value="779">779</option>
                                                    <option value="780">780</option>
                                                    <option value="788">788</option>
                                                    <option value="789">789</option>
                                                    <option value="790">790</option>
                                                    <option value="799">799</option>
                                                    <option value="800">800</option>
                                                    <option value="880">880</option>
                                                    <option value="888">888</option>
                                                    <option value="889">889</option>
                                                    <option value="890">890</option>
                                                    <option value="899">899</option>
                                                    <option value="900">900</option>
                                                    <option value="990">990</option>
                                                    <option value="999">999</option>
                                                </select>

                                            </div>
                                            <div class="form-group col-md-2" id="showclosediv" style="display:none;">
                                                <label>Close Pana</label>
                                                <!--<input class="form-control" type="text"  value="" name="close_number" id="close_number" placeholder="Enter close number" >-->
                                                <select class="form-control select2 " name="close_number"
                                                    id="close_number" data-placeholder="Select close number"
                                                    data-select2-id="close_number" tabindex="-1" aria-hidden="true">
                                                    <option data-select2-id="4"></option>
                                                    <option value="000">000</option>
                                                    <option value="100">100</option>
                                                    <option value="110">110</option>
                                                    <option value="111">111</option>
                                                    <option value="112">112</option>
                                                    <option value="113">113</option>
                                                    <option value="114">114</option>
                                                    <option value="115">115</option>
                                                    <option value="116">116</option>
                                                    <option value="117">117</option>
                                                    <option value="118">118</option>
                                                    <option value="119">119</option>
                                                    <option value="120">120</option>
                                                    <option value="122">122</option>
                                                    <option value="123">123</option>
                                                    <option value="124">124</option>
                                                    <option value="125">125</option>
                                                    <option value="126">126</option>
                                                    <option value="127">127</option>
                                                    <option value="128">128</option>
                                                    <option value="129">129</option>
                                                    <option value="130">130</option>
                                                    <option value="133">133</option>
                                                    <option value="134">134</option>
                                                    <option value="135">135</option>
                                                    <option value="136">136</option>
                                                    <option value="137">137</option>
                                                    <option value="138">138</option>
                                                    <option value="139">139</option>
                                                    <option value="140">140</option>
                                                    <option value="144">144</option>
                                                    <option value="145">145</option>
                                                    <option value="146">146</option>
                                                    <option value="147">147</option>
                                                    <option value="148">148</option>
                                                    <option value="149">149</option>
                                                    <option value="150">150</option>
                                                    <option value="155">155</option>
                                                    <option value="156">156</option>
                                                    <option value="157">157</option>
                                                    <option value="158">158</option>
                                                    <option value="159">159</option>
                                                    <option value="160">160</option>
                                                    <option value="166">166</option>
                                                    <option value="167">167</option>
                                                    <option value="168">168</option>
                                                    <option value="169">169</option>
                                                    <option value="170">170</option>
                                                    <option value="177">177</option>
                                                    <option value="178">178</option>
                                                    <option value="179">179</option>
                                                    <option value="180">180</option>
                                                    <option value="188">188</option>
                                                    <option value="189">189</option>
                                                    <option value="190">190</option>
                                                    <option value="199">199</option>
                                                    <option value="200">200</option>
                                                    <option value="220">220</option>
                                                    <option value="222">222</option>
                                                    <option value="223">223</option>
                                                    <option value="224">224</option>
                                                    <option value="225">225</option>
                                                    <option value="226">226</option>
                                                    <option value="227">227</option>
                                                    <option value="228">228</option>
                                                    <option value="229">229</option>
                                                    <option value="230">230</option>
                                                    <option value="233">233</option>
                                                    <option value="234">234</option>
                                                    <option value="235">235</option>
                                                    <option value="236">236</option>
                                                    <option value="237">237</option>
                                                    <option value="238">238</option>
                                                    <option value="239">239</option>
                                                    <option value="240">240</option>
                                                    <option value="244">244</option>
                                                    <option value="245">245</option>
                                                    <option value="246">246</option>
                                                    <option value="247">247</option>
                                                    <option value="248">248</option>
                                                    <option value="249">249</option>
                                                    <option value="250">250</option>
                                                    <option value="255">255</option>
                                                    <option value="256">256</option>
                                                    <option value="257">257</option>
                                                    <option value="258">258</option>
                                                    <option value="259">259</option>
                                                    <option value="260">260</option>
                                                    <option value="266">266</option>
                                                    <option value="267">267</option>
                                                    <option value="268">268</option>
                                                    <option value="269">269</option>
                                                    <option value="270">270</option>
                                                    <option value="277">277</option>
                                                    <option value="278">278</option>
                                                    <option value="279">279</option>
                                                    <option value="280">280</option>
                                                    <option value="288">288</option>
                                                    <option value="289">289</option>
                                                    <option value="290">290</option>
                                                    <option value="299">299</option>
                                                    <option value="300">300</option>
                                                    <option value="330">330</option>
                                                    <option value="333">333</option>
                                                    <option value="334">334</option>
                                                    <option value="335">335</option>
                                                    <option value="336">336</option>
                                                    <option value="337">337</option>
                                                    <option value="338">338</option>
                                                    <option value="339">339</option>
                                                    <option value="340">340</option>
                                                    <option value="344">344</option>
                                                    <option value="345">345</option>
                                                    <option value="346">346</option>
                                                    <option value="347">347</option>
                                                    <option value="348">348</option>
                                                    <option value="349">349</option>
                                                    <option value="350">350</option>
                                                    <option value="355">355</option>
                                                    <option value="356">356</option>
                                                    <option value="357">357</option>
                                                    <option value="358">358</option>
                                                    <option value="359">359</option>
                                                    <option value="360">360</option>
                                                    <option value="366">366</option>
                                                    <option value="367">367</option>
                                                    <option value="368">368</option>
                                                    <option value="369">369</option>
                                                    <option value="370">370</option>
                                                    <option value="377">377</option>
                                                    <option value="378">378</option>
                                                    <option value="379">379</option>
                                                    <option value="380">380</option>
                                                    <option value="388">388</option>
                                                    <option value="389">389</option>
                                                    <option value="390">390</option>
                                                    <option value="399">399</option>
                                                    <option value="400">400</option>
                                                    <option value="440">440</option>
                                                    <option value="444">444</option>
                                                    <option value="445">445</option>
                                                    <option value="446">446</option>
                                                    <option value="447">447</option>
                                                    <option value="448">448</option>
                                                    <option value="449">449</option>
                                                    <option value="450">450</option>
                                                    <option value="455">455</option>
                                                    <option value="456">456</option>
                                                    <option value="457">457</option>
                                                    <option value="458">458</option>
                                                    <option value="459">459</option>
                                                    <option value="460">460</option>
                                                    <option value="466">466</option>
                                                    <option value="467">467</option>
                                                    <option value="468">468</option>
                                                    <option value="469">469</option>
                                                    <option value="470">470</option>
                                                    <option value="477">477</option>
                                                    <option value="478">478</option>
                                                    <option value="479">479</option>
                                                    <option value="480">480</option>
                                                    <option value="488">488</option>
                                                    <option value="489">489</option>
                                                    <option value="490">490</option>
                                                    <option value="499">499</option>
                                                    <option value="500">500</option>
                                                    <option value="550">550</option>
                                                    <option value="555">555</option>
                                                    <option value="556">556</option>
                                                    <option value="557">557</option>
                                                    <option value="558">558</option>
                                                    <option value="559">559</option>
                                                    <option value="560">560</option>
                                                    <option value="566">566</option>
                                                    <option value="567">567</option>
                                                    <option value="568">568</option>
                                                    <option value="569">569</option>
                                                    <option value="570">570</option>
                                                    <option value="577">577</option>
                                                    <option value="578">578</option>
                                                    <option value="579">579</option>
                                                    <option value="580">580</option>
                                                    <option value="588">588</option>
                                                    <option value="589">589</option>
                                                    <option value="590">590</option>
                                                    <option value="599">599</option>
                                                    <option value="600">600</option>
                                                    <option value="660">660</option>
                                                    <option value="666">666</option>
                                                    <option value="667">667</option>
                                                    <option value="668">668</option>
                                                    <option value="669">669</option>
                                                    <option value="670">670</option>
                                                    <option value="677">677</option>
                                                    <option value="678">678</option>
                                                    <option value="679">679</option>
                                                    <option value="680">680</option>
                                                    <option value="688">688</option>
                                                    <option value="689">689</option>
                                                    <option value="690">690</option>
                                                    <option value="699">699</option>
                                                    <option value="700">700</option>
                                                    <option value="770">770</option>
                                                    <option value="777">777</option>
                                                    <option value="778">778</option>
                                                    <option value="779">779</option>
                                                    <option value="780">780</option>
                                                    <option value="788">788</option>
                                                    <option value="789">789</option>
                                                    <option value="790">790</option>
                                                    <option value="799">799</option>
                                                    <option value="800">800</option>
                                                    <option value="880">880</option>
                                                    <option value="888">888</option>
                                                    <option value="889">889</option>
                                                    <option value="890">890</option>
                                                    <option value="899">899</option>
                                                    <option value="900">900</option>
                                                    <option value="990">990</option>
                                                    <option value="999">999</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-2" style="    align-self: self-end;">
                                                <label>&nbsp;</label>
                                                <button type="submit" class="btn btn-primary btn-block" id="search_button"
                                                    name="submitBtn">Submit</button>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div id="error" style="display: none;">
                                                <p class="alert alert-danger"><strong>Error : </strong> Please select game
                                                    name</p>
                                            </div>
                                        </div>
                                    <!--</form>-->
                                </div>


                                <div class="card-datatable">
                                    <!--<table class="dt-row-grouping table" id="myTable">-->
                                    <!--    <thead>-->
                                    <!--        <tr>-->
                                    <!--            <th></th>-->
                                    <!--            <th>Name</th>-->
                                    <!--            <th>HIndi Name</th>-->
                                    <!--            <th>Start time</th>-->
                                    <!--            <th>Close Time</th>-->
                                    <!--            <th>Status</th>-->
                                    <!--            <th>Market Status</th>-->
                                    <!--            <th>Action</th>-->
                                    <!--        </tr>-->
                                    <!--    </thead>-->
                                        <!--<tbody>-->

                                    <!--        <tbody id="myTable">-->
                                                            
                                    <!--                    </tbody>-->
                                        <!--</tbody>-->
                                    <!--</table>-->
                                    
                                    <table class="table table-striped table-bordered datatable_data" id="myTable" >
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>User Mobile</th>
                                                                <th>User Name</th>
                                                                <th>Game Name</th>
                                                                <th style="text-transform: capitalize;">Game Type</th>
                                                                <th>Open Panna</th>
                                                                <th>Open Digit</th>
                                                                <th>Close Panna</th>
                                                                <th>Close Digit</th>
                                                                <th>Winning Amount</th>
                                                                <th>Points</th>
                                                                <th>Edit Bid</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="getGameResultHistory">
                                                            
                                                        </tbody>
                                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Row grouping -->                
            </div>

        @endsection
        @push('scripts')
            <script src="http://kalyanmumbaimatka.com/adminassets/libs/select2/js/select2.min.js"></script>
            <script>
                function showclose(close) {
                    if (close == 2) {
                        $("#showclosediv").show();
                    } else {
                        $("#showclosediv").hide();
                    }
                }

                function checkGameDeclare(id) {
                    return false;
                    var result_date = $("#result_date").val();
                    $.ajax({
                        type: "POST",
                        url: base_url + "check-open-market-result-declaration",
                        data: {
                            game_id: id,
                            result_date: result_date
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data.open_decleare_status != 0) {
                                var objSelect_1 = document.getElementById("win_market_status");
                                var objSelect_2 = document.getElementById("winning_ank");
                                var open_number = data.open_number;
                                setSelectedValue(objSelect_1, "2");
                                $("#showclosediv").show();
                                setSelectedValueNumber(objSelect_2, open_number);
                            }
                        }
                    });
                }



                function setSelectedValueNumber(selectObj, valueToSet) {
                    $("#winning_ank").select2('destroy');
                    for (var i = 0; i < selectObj.options.length; i++) {
                        if (selectObj.options[i].value == valueToSet) {
                            selectObj.options[i].selected = true;
                            return;
                        }
                    }
                }
                
                
                
                $(document).on('click','#search_button',function(e){
                    
                    var open_number = $('#open_number').val();
                    
                    
                    // alert(open_number);
                    var desclare_result_date = $('#desclare_result_date').val();
                    if(desclare_result_date == ""){
                        alert('select date');
                    }
                    
                    
                    var desclare_result_game_name = $('#desclare_result_game_name').val();
                    var desclare_result_session = $('#win_market_status').val();
                    
                    if(desclare_result_game_name == ""){
                        alert('select game');
                    }
                    $.ajax({
                        url: "{{ route('admin.get-game-winning-bid-detail') }}",
                        type: 'POST',
                        data: {
                            '_token': '{{ csrf_token() }}',option_number:open_number,desclare_result_date:desclare_result_date,game_id:desclare_result_game_name,session:desclare_result_session
                        },
                        dataType: 'json',
                        success: function(response) {
                            
                            if(response.status == true){
                                var table = document.getElementById("myTable").getElementsByTagName("tbody")[0];
                                table.innerHTML = '';
                                
                                let i = 1; 
                                if (response.data.length > 0) {
                                    response.data.forEach(function(item) {
                                        var row = table.insertRow();
                                        row.insertCell().innerHTML = i;
                                        row.insertCell().innerHTML = item.user_mobile;
                                        row.insertCell().innerHTML = item.user_name;
                                        row.insertCell().innerHTML = item.game_name;
                                        row.insertCell().innerHTML = item.bid_type;
                                        row.insertCell().innerHTML = item.open_panna;
                                        row.insertCell().innerHTML = item.open_digit;
                                        row.insertCell().innerHTML = item.close_panna;
                                        row.insertCell().innerHTML = item.close_digit;
                                        row.insertCell().innerHTML = item.winning_amount;
                                        row.insertCell().innerHTML = item.point_quantity;
                                        row.insertCell().innerHTML = `<a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#danger_ke_${item.id}"><button class="btn btn-warning">Edit Bid</button></a>
    
                                                            <!-- Modal -->
                                                            <div class="modal fade modal-warning text-start" id="danger_ke_${item.id}" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
    
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="myModalLabel120">Edit Bid</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                             <form action="{{ route('admin.edit-bid') }}" method="POST">
                                                                                @csrf
                                                                            
                                                                            <div class="modal-body">
                                                                           
                                                                                
                                                                                <div class="row">
                                                                                    <div class="col-md-6 col-12">
                                                                                        <div class="mb-1">
                                                                                            <label class="form-label" for="first-name-column">User Name</label>
                                                                                            <input type="email" id="first-name-column" name="email" class="form-control" placeholder="" readonly value="${item.user_name}" />
                                                                                        </div>
                                                                                    </div>
                                        
                                                                                    <div class="col-md-6 col-12">
                                                                                        <div class="mb-1">
                                                                                            <label class="form-label" for="first-name-column">User Mobile</label>
                                                                                            <input type="number" id="first-name-column" name="mobile" class="form-control" placeholder="" readonly value="${item.user_mobile}" />
                                                                                        </div>
                                                                                    </div>
                                        
                                                                                    <div class="col-md-12 col-12">
                                                                                        <div class="mb-1">
                                                                                            <label class="form-label" for="first-name-column">Change Panna<span class="error">*</span></label>
                                                                                            <input type="hidden" name="id" value="${item.id}">
                                                                                            <input type="number" id="first-name-column" name="game_number" class="form-control" placeholder="" value="${item.game_number}" />
                                                                                        </div>
                                                                                    </div>
                                                                                </div> 
                                                                            </div>
                                                                            
                                                                                <div class="modal-footer">
                                                                                    <button type="submit" class="btn btn-warning" >Edit Bid</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                </div>
                                                            </div>`;
                                        i++;
                                    });
                                    // $("#myTable").show();
                                    // $("#winning_result_not_found").hide();
                                } else {
                                    alert('no data found');
                                }
                            }else{
                                alert(response.message);
                            }
                            
                            
                            
                        },
                        error: function(xhr, status, error) {
                            // Handle any errors that occurred during the Ajax request
                            console.log(error);
                        }
                    });
                });
                
                
                
            </script>
        @endpush
