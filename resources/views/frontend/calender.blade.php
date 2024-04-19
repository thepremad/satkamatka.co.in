<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<style>
    
h6.heading-bg {
    text-align: center;
    background: #3f51b5;
    padding: 6px 0;
    color: #fff;
    font-weight: 700;
    margin: 0;
}

th {
    background: #ffc107 !important;
    border: 1px solid #3f51b5;
    padding: 0 !important;
}
tbody {
    border: 1px solid #3f51b5;
}

td {
    /*border: 1px solid #03a9f4a8;*/
}

.vertical-layout.vertical-menu-modern.navbar-floating.footer-static {
    margin: 20px 12%;
    border: 1px solid #3f51b5;
}

.bodyhead-bg {
    margin: 6px 2px;
    line-height: 1.4;
    font-size: 14px;
    padding: 4px 10px;
    color: #00094d;
    text-shadow: 1px 1px 2px #fff;
    box-shadow: 0 0 20px 0 rgb(0 0 0 / 40%);
    border: 1px solid #000;
    text-align: center;
}
td {
    background: #D0E7D2 !important;
    text-align: center;
}
.vertical-text {
        writing-mode: vertical-lr; /* This rotates text vertically */
        transform: rotate(180deg); /* This is for better browser compatibility */
    }
    
    .panna-text{
        letter-spacing: 6px;
    font-weight: 600;
    }
    
    tbody tr td:nth-child(2), tbody tr td:nth-child(5), tbody tr td:nth-child(8), tbody tr td:nth-child(11), tbody tr td:nth-child(14), tbody tr td:nth-child(17), tbody tr td:nth-child(20), tbody tr td:nth-child(25) {
        /*border-right-width: 0;*/
        /*font-size: 13px;*/
        border-right-width: 0 !important;
        /*font-size: 13px;*/
        border: 1px solid #3f51b5;
    }
    
</style>

<body style="background-color: #D0D4CA;">
    
    <div class="bodyhead-bg">
        <h4 style="font-wight: 600;">{{ $game_name->name }}</h4>
        <!--<h4 style="color: #880e4f;font-wight: 600;">356-49-135</h4>-->
        <button style="border: 1px solid #e6e6e6;
            background: #522f92;
            color: #fff;
            padding: 5px 7px;
            font-size: 14px;
            font-wight: 600;
            margin: 2px 0 -1px;
            display: inline-block;
            transition: all .3s;
            cursor: pointer;
            text-shadow: none;
            text-decoration: none;">Refresh Result</button>
    </div>

<div class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="">
    
    
   


    <table class="table" id="datatable_data">
        <h6 class="heading-bg">{{ $game_name->name }} PANEL RECORD 2018 - 2023</h6>
        <thead>
            <tr style="text-align: center;">
                <th>Date</th>
                <th colspan="3">Sun</th>
                <th colspan="3">Mon</th>
                <th colspan="3">Tue</th>
                <th colspan="3">Wed</th>
                <th colspan="3">Thu</th>
                <th colspan="3">Fri</th>
                <th colspan="3">Sat</th>
            </tr>
        </thead>
        <tbody>
             @foreach($calender_data as $key=>$val)
             <tr>
                <th style="text-align: center;">{{ $val['start_date'] }} <br>to <br>{{ $val['end_date'] }}</th>
               @foreach($val['data'] as $k=>$v)
                <td>
                    <!-- @if(!empty($v))
                        {{ substr($v['open_result'], 0, 1) }}
                        <br>
                        {{ substr($v['open_result'], 1, 1) }}
                        <br>
                        {{ substr($v['open_result'], 2, 1) }}
                    @endif -->
                </td>
                <td style="vertical-align: middle;
    font-weight: 500;
    font-size: 19px;">
                    @if(!empty($v['digit']))
                        {{ $v['digit'] }}
                    @endif
                </td>
                <td>
                    <!-- @if(!empty($v['close_result']))
                        {{ substr($v['close_result'], 0, 1) }}
                        <br>
                        {{ substr($v['close_result'], 1, 1) }}
                        <br>
                        {{ substr($v['close_result'], 2, 1) }}
                    @endif -->
                </td>
               @endforeach
            </tr>
             @endforeach
           
        </tbody>
    </table>

</div>
</body>


</html>



      