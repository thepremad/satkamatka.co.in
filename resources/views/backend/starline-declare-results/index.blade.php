@extends('backend.layouts.app')

@section('styles')
<!--<link href="http://kalyanmumbaimatka.com/adminassets/libs/select2/css/select2.min.css" rel="stylesheet"-->
<!--    type="text/css" />-->
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
                                <!--<div class="container-fluid">-->

                                <div class="row">

                                    <div class="col-12 col-sm-12 col-lg-12">

                                        <div class="row">

                                            <div class="col-sm-12 col-12 ">

                                                <div class="card">

                                                    <div class="card-body">
                                                        <h4 class="card-title">Select Game</h4>
                                                        <form name="gameSrchFrm" id="gameSrchFrm" method="post">

                                                            <input type="hidden" name="id" id="id">

                                                            <div class="row">
                                                                <div class="form-group col-md-3">
                                                                    <label>Result Date</label>
                                                                    <div class="date-picker">
                                                                        <div class="input-group">
                                                                            <input class="form-control digits"
                                                                                type="date" 
                                                                                name="result_dec_date"
                                                                                id="result_dec_date" value="{{ date('Y-m-d') }}" >
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group col-md-4">
                                                                    <label>Game Name </label>
                                                                    <select class="select2 form-select" name="game_id"
                                                                        id="game_id">
                                                                        <option value="">Select Name</option>
                                                                        @foreach ($gameNameList as $key => $value)
                                                                        <option value="{{  $value->id }}">{{
                                                                            $value->name }} ({{ $value->today_open_time
                                                                            . '-' .
                                                                            $value->today_close_time }})
                                                                        </option>';
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="form-group col-md-2" style="align-self: end;">
                                                                    <label>&nbsp;</label>
                                                                    <button type="submit"
                                                                        class="btn btn-primary btn-block" id="srchBtn"
                                                                        name="srchBtn">Go</button>
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



                                <div class="row display_none" id="result_div">

                                    <div class="col-12 col-sm-12 col-lg-12">

                                        <div class="row">

                                            <div class="col-sm-12 col-12 ">

                                                <div class="card">

                                                    <div class="card-body" id="desclare_result" style="display: none;">
                                                        <form action="">
                                                            <input type="hidden" name="desclare_result_date"
                                                                id="desclare_result_date">
                                                            <input type="hidden" name="desclare_result_game_name"
                                                                id="desclare_result_game_name">
                                                            <input type="hidden" name="desclare_result_session"
                                                                id="desclare_result_session">
                                                            <h4 class="card-title">Declare Result</h4>
                                                            <div class="mt-3" id="withdraw_data_details"
                                                                style="display: none;">
                                                                <div class="bs_box bs_box_light_withdraw">
                                                                    <span>Open Result :-</span>
                                                                    <b><span id="open_result_data">0</span></b>
                                                                </div>
                                                            </div>
                                                            @php
                                                            $panna = config('constants.panna');
                                                            @endphp
                                                            <div class="row open_panna_area">
                                                                <div class="col-12 col-md-12">
                                                                    <div class="row">
                                                                        <div class="form-group col-md-4">
                                                                            <label>Panna</label>
                                                                            <select
                                                                                class="select2 form-select getDigitOpenResult"
                                                                                name="open_number" id="open_number"
                                                                                data-placeholder="Select panna"
                                                                                data-select2-id="open_number"
                                                                                tabindex="-1" aria-hidden="true">
                                                                                <option data-select2-id="2"></option>
                                                                                @foreach($panna as $key => $value)
                                                                                <option value="{{ $key }}">{{ $value }}
                                                                                </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label>Digit</label>
                                                                            <input class="form-control" type="number"
                                                                                name="open_result" id="open_result"
                                                                                readonly="">
                                                                        </div>

                                                                        <div class="form-group col-md-4" style="align-self: end;"
                                                                            id="open_div_msg">
                                                                            <label>&nbsp;</label>
                                                                            <button type="button" 
                                                                                class="btn btn-primary waves-light mr-1"
                                                                                id="openSaveBtn" name="openSaveBtn"
                                                                                >Declare Button</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div id="error2"></div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Winning Users</h4>
                                                
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered datatable_data" id="myTable" style="display: none;">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>User Mobile</th>
                                                                <th>User Name</th>
                                                                <th>Game Name</th>
                                                                <th style="text-transform: capitalize;">Game Type</th>
                                                                <th>Open Panna</th>
                                                                <th>Open Digit</th>
                                                                <th>Winning Amount</th>
                                                                <th>Points</th>
                                                                <th>Edit Bid</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="getGameResultHistory">
                                                            
                                                        </tbody>
                                                    </table>
                                                    
                                                    <h2 id="winning_result_not_found" style="display: none;color:red" >Result Not Found</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Game Result History</h4>
                                                <div class="form-group row">
                                                    <form action="" method="get">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <!--<label>Select Result Date</label>-->
                                                                <div class="date-picker">
                                                                    <div class="input-group">
                                                                            <input class="form-control digits" type="date"
                                                                            name="result_date" id="result_pik_date"
                                                                            value="{{ isset($date) ? $date :'' }}" max="{{ date('Y-m-d') }}">
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                            <div class="col-md-2">
                                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                                </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered datatable_data">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Game Name</th>
                                                                <th>Result Date</th>
                                                                <th>Open Declare Date</th>
                                                                <th>Open Pana</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="getGameResultHistory">
                                                            <?php $i=1;  ?>
                                                            @foreach($game_3 as $key=>$val)
                                                            <tr>
                                                                <td>{{ $i }}</td>
                                                                <td>{{ $val->name }}</td>
                                                                <td>{{ isset($date) ? $date :'' }}</td>
                                                                <td>{{ $val->today_open_time }}</td>
                                                                <td>{{ $val->open_result }}
                                                                     @if(!empty($val->open_id))
                                                                    <br>
                                                                        <button class="btn-danger" onClick="redirect({{ $val->open_id }})">Delete</button>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <?php $i++ ?>
                                                            @endforeach
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
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
        
        <script>
             function redirect(id) {
                const confirmed = window.confirm('Are you sure you want to delete this result?');
                                
                if (confirmed) {
                    window.location.href = "{{ route('admin.starline.delete-declare-result', '') }}" + '/' + id;
                } else {
                  alert('Action canceled.');
                }
              }
        </script>

        @endsection
        @push('scripts')
        <!--<script src="http://kalyanmumbaimatka.com/adminassets/libs/select2/js/select2.min.js"></script>-->
        <script>
            $(document).ready(function() {
               $("#myTable").hide();
               $("#winning_result_not_found").hide();
            });
            
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

                function sumValue(value) {
                    let digits = value.toString().split('').map(Number);
                    let sum = digits.reduce((acc, curr) => acc + curr, 0);
                    let stringValue = sum.toString();
                    return stringValue.slice(-1);
                }

                $(document).on('change','.getDigitCloseResult',function(e){
                    var close_number=$(this).val();
                    var close_result = sumValue(close_number);
                    $("#close_result").val(close_result);                       
                });

                $(document).on('change','.getDigitOpenResult',function(e){
                    var open_number=$(this).val();
                    var open_result = sumValue(open_number);
                    $("#open_result").val(open_result);                       
                });
                
                $(document).on('change','#open_number',function(e){
                    var open_number=$(this).val();
                    var desclare_result_date = $('#desclare_result_date').val();
                    var desclare_result_game_name = $('#desclare_result_game_name').val();
                    var desclare_result_session = $('#desclare_result_session').val();
                    $.ajax({
                        url: "{{ route('admin.starline.get-game-winning-bid-detail') }}", 
                        type: 'POST',
                        data: {
                            '_token': '{{ csrf_token() }}',option_number:open_number,desclare_result_date:desclare_result_date,game_id:desclare_result_game_name,session:desclare_result_session
                        },
                        dataType: 'json',
                        success: function(response) {
                            
                            var table = document.getElementById("myTable").getElementsByTagName("tbody")[0];
                            table.innerHTML = '';
                            
                            let i = 1; 
                            if (response.length > 0) {
                                response.forEach(function(item) {
                                    var row = table.insertRow();
                                    row.insertCell().innerHTML = i;
                                    row.insertCell().innerHTML = item.user_mobile;
                                    row.insertCell().innerHTML = item.user_name;
                                    row.insertCell().innerHTML = item.game_name;
                                    row.insertCell().innerHTML = item.bid_type;
                                    row.insertCell().innerHTML = item.open_panna;
                                    row.insertCell().innerHTML = item.open_digit;
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
                                                                         <form action="{{ route('admin.starline.edit-bid') }}" method="POST">
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
                                $("#myTable").show();
                                $("#winning_result_not_found").hide();
                            } else {
                                $("#myTable").hide();
                                $("#winning_result_not_found").show();
                            }
                            
                        },
                        error: function(xhr, status, error) {
                            // Handle any errors that occurred during the Ajax request
                            console.log(error);
                        }
                    });
                });

                $(document).on('change','#result_dec_date',function(e){
                    const result_dec_date = $(this).val();                    
                    var formData = new FormData();
                    formData.append('result_dec_date', result_dec_date);
                    $.ajax({
                        type: 'GET',
                        // dataType: "json",
                        url: "{{ route('admin.starline.result.get_game_name') }}",
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        beforeSend: function() {},
                        success: function(data) {
                            if ($.isEmptyObject(data.error)) {
                                $('#game_id').html('<option value="">Select Name</option>');
                                $.each(data.data, function (key, value) {
                                      $("#game_id").append('<option value="' + value.id + '">' + value.name + '(' + value.today_open_time + '-' + value/* */ + ')</option>');
                                });
                            } else {
                                alert('something went wrong')
                            }
                        }
                    });
                });

                $(document).on('click','#srchBtn',function(e){

                    e.preventDefault()
                    const result_dec_date = $('#result_dec_date').val();
                    const game_id = $('#game_id').val();
                    const market_status = $('#market_status').val();
                    if(game_id == ''){
                        alert('Please select game');
                        return false;
                    }

                    if(result_dec_date == ''){
                        alert('Please select Date');
                        return false;
                    }

                    if(market_status == ''){
                        alert('Please select Session');
                        return false;
                    }

                    $('#desclare_result_date').val(result_dec_date);
                    $('#desclare_result_game_name').val(game_id);
                    $('#desclare_result_session').val(market_status);
                    $('#desclare_result').show()

                });
                
                $(document).on('click','#openSaveBtn',function(e){

                   const desclare_result_date = $('#desclare_result_date').val();
                    const desclare_result_game_name = $('#desclare_result_game_name').val();
                    const desclare_result_session = $('#desclare_result_session').val();
                    const open_number = $('#open_number').val();
                    

                    var formData2 = new FormData();
                    formData2.append('result_date', desclare_result_date);
                    formData2.append('game_id', desclare_result_game_name);
                    formData2.append('session', desclare_result_session);
                    formData2.append('result_number', open_number);                    
                    $.ajax({
                        type: 'POST',
                        // dataType: "json",
                        url: "{{ route('admin.starline.result-declare') }}",
                        data: formData2,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        beforeSend: function() {},
                        success: function(data) {
                            if ($.isEmptyObject(data.error)) {
                                if(data.status == true){
                                    toastr.options.timeOut = 10000;
                                    toastr.success('Declare Result Success');
                                }else{
                                    toastr.error(data.message);
                                }
                            } else {
                                alert('something went wrong')
                            }
                        }
                    });

                });
                
    
            
                

        </script>
        @endpush