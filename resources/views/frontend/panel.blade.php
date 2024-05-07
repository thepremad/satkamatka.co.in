


<!DOCTYPE html>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <script async src="{{ asset('public/frontend/cdn.ampproject.js') }}"></script>
    <title>{{ $game->name }} Panel Chart | Online Jodi Bracket</title>
    <link rel="shortcut icon" href="{{ asset('public/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/panel.css') }}">

    <style>
        
        .panel.panel-info {
            border: 1px solid #3f51b5;
            border-radius: 5px;
            width: 70%;
            margin: 0 auto 0;
        }

        tbody td {
            padding: 5px 0;
            font-size: 24px;
        }

        .panel.panel-info .panel-heading h1 {
            font-size: 24px;
            color: #fff;
            text-shadow: 0px 0px;
            line-height: 40px;
            font-weight: 800;
        }

        thead {
            background-color: #ffc107;
            text-shadow: 1px 1px 2px #9a7400ab;
        }

        .button2 {
            background-color: #a0d5ff;
            color: #220c82;
            padding: 10px 30px;
            font-size: 16px;
            margin: 20px auto;
            border-radius: 10px;
            border: 2px solid #0000005c;
            font-weight: 800;
            text-shadow: 1px 1px #00bcd4;
            box-shadow: 0 8px 10px 0 rgba(0,0,0,.2), 0 6px 8px 0 rgba(0,0,0,.19);
            display: inline-block;
            transition: all .3s;
            text-align: center;
            font-family: sans-serif;
        }
        tbody, td, tfoot, th, thead, tr{
            border-color:#000;
        }
        tr td{
            /*min-width:100px;*/
            padding:5px 0 !important;
        }
        td.Dates{
            font-size:15px;
            line-height:20px;
        }
        td.Dates span{
            font-size:16px;
        }
    </style>

</head>
<body>


    
    <div class="logo">
        <a href="{{ url('/') }}">
            <img src="{{ asset('public/logo.png') }}" alt="Image of DPBOSS365.NET" width="220" height="88">
        </a>
    </div>
            
  

    <div id="top"></div>
        <a href="#bottom" class="button2">Go to Bottom </a>
        <div class="container-fluid">
            <div>
                <div class="panel panel-info">
                    <div class="panel-heading text-center" style="background: #3f51b5;">
                        <h1>
                            <span id="ContentPlaceHolder1_lbl_BazarName">{{ $game->name ?? '' }}</span>
                        </h1>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class=" table panel-chart chart-table table-bordered" cellpadding="2">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Mon</th>
                                        <th>Tue</th>
                                        <th>Wed</th>
                                        <th>Thu</th>
                                        <th>Fri</th>
                                        <th>Sat</th>
                                        <th>Sun</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <div id="ContentPlaceHolder1_UP_BazarJodiChart">
                                        @foreach ($week_data as $key => $data)

                                        <tr>
                                            <td class="Dates">
                                                <span id="ContentPlaceHolder1_Repe_BazarPanelList_lbl_WSdate_22">{{ $key }}</span>
                                                <br />
                                                to
                                                <br />
                                                
                                                <span id="ContentPlaceHolder1_Repe_BazarPanelList_lbl_WEdate_22"> {{ \Carbon\Carbon::parse($key)->endOfWeek()->format('Y-m-d') }} </span>
                                            </td>
                                            @foreach ($data as $item)

                                                <td>
                                                    <div class="d-flex flex-nowrap align-items-center justify-content-between">
                                                        <div class="left_content">
                                                            <span id="ContentPlaceHolder1_Repe_BazarPanelList_lbl_MonResultLeft_22" >{{ $item['open_panna'] ?? '' }}</span>
                                                        </div>
                                                        <div class="middle_content">
                                                            <span id="ContentPlaceHolder1_Repe_BazarPanelList_lbl_MonResultCenter_22" >{{ $item['close_panna'] ?? '' }}</span>
                                                        </div>
                                                        <div class="right_content">
                                                            <span id="ContentPlaceHolder1_Repe_BazarPanelList_lbl_MonResultRight_22" >{{ $item['digit'] ?? '' }}</span>
                                                        </div>
                                                    </div>
                                                </td>    
                                            @endforeach
                                        @endforeach
                                        
                                    </div>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <center>
                <div id="bottom"></div>
                <a href="#top" class="button2">Go to Top </a>
            </center>
        </div>
    </div>
    
    
    <style>
            .logo {
        padding: 6px;
    }
    
    .logo a span {
        font-size: 30px;
        font-family: 'Roboto', sans-serif;
        font-weight: 600;
    }
    
    .logo .head {
        font-family: 'Dancing Script', cursive;
        margin-right: 2px;
        font-size: 60px;
        color: #eb008b;
    }
    
    .para2 {
    border-width: 3px;
    border: 2px solid #0014e2;
    margin-bottom: 5px;
    border-style: outset;
    border-radius: 10px;
    border: 2px solid #ff182c;
    box-shadow: 0 0 20px 0 rgb(0 0 0 / 40%);
} 
    </style>
   
</body>
</html>
