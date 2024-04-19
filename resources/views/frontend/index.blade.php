<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SatkaMatka</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="{{asset('public/frontEnd/css/style.css')}}">
    <link rel="icon" href="{{ asset('public/favicon.png')}}">
    
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/frontEnd/img/logo.png')}}">

</head>
<body style="background-color: #fc9;">

    <section>

        <div class="containercmn" style="margin: 0 10px;">
            <div class="dphome-onewp cmnbg-1" style="text-align: center; margin: 10px 0 0;" >
                <img style="max-width: 280px;" src="{{asset('public/logo.png')}}" alt="">
            </div>

            <div class="dphome-twowp cmnbg-1" style="margin: 10px 0 0;" >
                <div class="row" style="padding: 5px 8px; align-items: center;">
                    <div class="col-md-6" style="padding: 0;">
                        <img style="height: 68px;" src="{{asset('public/frontEnd/img/dphome-twowp-img.jpeg')}}" alt="">
                    </div>
                    <div class="col-md-6">
                        <div class="" style="float: right;">
                            <i style="color: #000; font-size: 15px; text-shadow: 1px 1px 2px #fff;">!! Welcome to SatkaMatka international !! Satta Matka Fast Result</i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dphome-threewp cmnbg-1" style="text-align: center; margin: 10px 0 0;" >
                <i style="font-size: 16px; color: #000; padding-bottom: 3px;">Satta Matka SatkaMatka Kalyan Matka Result</i><br>
                <i style="    color: #061699!important;
                        
                text-shadow: 1px 1px 2px #fff;font-size: 13px; font-weight: 700;">{!! asset($desc->header) ? $desc->header : '' !!}  </i>
            </div>

            <div class="dphome-fourwp cmnbg-1" style="text-align: center; margin: 10px 0 0; padding: 0;" >
                <div class="pinkbg" style="">
                    <i style="font-size: 22px;">Today Lucky Number</i>
                </div>
                <div class="row">
                    <div class="col-md-5" style="border-right: 1px solid red">
                        <i style="font-size: 24px;
                        color: #001699;
                        text-shadow: 1px 1px 2px #fff;">Golden Ank</i><br>
                        <i style="font-size: 22px; color: #000;">0-5-4-9</i>
                    </div>
                    <div class="col-md-7">
                        <i style="font-size: 24px;
                        color: #001699;
                        text-shadow: 1px 1px 2px #fff;">Final Ank</i><br>
                        <div class="amthltg">
                            <i style="animation: amthltg 10s linear infinite;
                            font-size: 16px;
                            margin-top: 20px; color: #000b65;">MILAN MORNING - 2
                            <br>SRIDEVI - ... <br>KALYAN MORNING - ... <br>MADHURI - 0 <br>SRIDEVI MORNING - 4 <br>MUMBAI MORNING - 8 <br>KARNATAKA DAY - 2 <br>TIME BAZAR - 6 <br>MILAN DAY - 2 <br>SRIDEVI NIGHT - 2 <br>MADHURI NIGHT - 8 <br>MILAN NIGHT - 4 <br>RAJDHANI NIGHT - 4 <br>MAIN BAZAR - 0 <br>KALYAN NIGHT - 6 <br>OLD MAIN MUMBAI - 6 <br>MADHUR DAY - 6 <br>MADHUR NIGHT - 8 <br>KUBER - 4</i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dphome-fivewp cmnbg-1" style="text-align: center; margin: 10px 0 0; padding: 0;" >
                <div class="pinkbg" style="">
                    <i style="font-size: 22px;">☔LIVE RESULT☔</i>
                </div>
                @foreach($game as $key => $val)
                    <!-- <i class="dphome-fivewp-i1">Sabse Tezz Live Result Yahi Milega</i> -->
                    <i class="dphome-fivewp-i2">{{$val->name}}</i>
                    <i class="dphome-fivewp-i3">{{ $val->result }}</i>
                    <button>Refresh</button><br>
                    <i style="color: #000;">{{$val->name_hindi ?? ''}}</i>
                    <hr style="color: #ff0020;">
                @endforeach
               
                
            </div>

            <div class="dphome-sixwp mt-2">
                <i>अब सभी मटका बाजार खेलो ऑनलाइन ऐप पर रोज खेलो रोज कमाओ अभी डाउनलोड करो</i><br>
                <a href="#">
                    👉 Play Matka Online (Sno1)
                </a>
                <i>With 100% Trusted App - 26 Jan Special - Instant Withdraw</i>
            </div>

            <div class="dphome-sevenwp cmnbg-1" style="text-align: center; margin: 10px 0 0; padding: 10px 0;" >
                <i class="dphome-sevenwp-i1">!! TIME CHANGE NOTICE !!</i>
                <i class="dphome-sevenwp-icmn">SUNDAY BAZAR DAY </i>
                <i class="dphome-sevenwp-icmn">Mon to Sun - Open 12:00pm - Close 2:30pm</i>
                <hr style="color: aqua;">
                <i class="dphome-sevenwp-icmn">SUNDAY BAZAR NIGHT </i>
                <i class="dphome-sevenwp-icmn">Mon to Sat - Open 08:00pm - Close 10:00pm</i>
                <i class="dphome-sevenwp-icmn">Sunday - Open : 5:00pm, Close : 7:00pm </i>
            </div>

            <div class="dphome-eightwp cmnbg-1" style="text-align: center; margin: 10px 0 0;" >
                <i>KALYAN MATKA | MATKA RESULT | KALYAN MATKA TIPS | SATTA MATKA | MATKA.COM | MATKA PANA JODI
                    TODAY | BATTA SATKA | MATKA PATTI JODI NUMBER | MATKA RESULTS | MATKA CHART | MATKA JODI | SATTA COM | FULL
                    RATE GAME | MATKA GAME | MATKA WAPKA | ALL MATKA RESULT LIVE ONLINE | MATKA RESULT | KALYAN MATKA RESULT |
                    SatkaMatka MATKA 143 | MAIN MATKA</i>
            </div>

            <div class="pinkbg mt-2 bt-2" style="">
                <i style="font-size: 18px;">WORLD ME SABSE FAST SATTA MATKA RESULT</i>
            </div>

            <div class="dphome-ninewp cmnbg-1" style="text-align: center; margin: 10px 0 0;" >
            @foreach($allgame as $key => $vall)
                <div class="row" style="align-items: center;">
                    <div class="col-md-4" style="text-align: start;">
                        <a href="{{route('jodi',$vall->id)}}">
                            <i>Jodi</i>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <i class="dphome-fivewp-i2">{{$vall->name}}</i>
                        <i class="dphome-fivewp-i3">{{ $vall->result }}</i>
                        <i style="color: #000;">{{$vall->start_time}}    {{$vall->end_time}}</i>
                    </div>
                    <div class="col-md-4" style="text-align: end;">
                        <a href="{{route('panel',$vall->id)}}">
                            <i>Panel</i>
                        </a>
                    </div>
                </div>
                <hr style="color: red;">
                @endforeach
            </div>

            <div class="dphome-tenwp cmnbg-1">
                <i>Email for any inquiries Or Support:</i><a href="#">satkamatka.co.in</a>
            </div>

            <div class="dphome-elevenwp">
                <i>MAIN STARLINE</i>
            </div>

            <div class="main-starlinetable">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Time</th>
                        <th scope="col">Result</th>
                        <th scope="col">Time</th>
                        <th scope="col">Result</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>09:05 AM</td>
                        <td>347-4</td>
                        <td>03:05 PM</td>
                        <td> </td>
                      </tr>
                      <tr>
                        <td>10:05 AM</td>
                        <td>346-3</td>
                        <td>04:05 PM</td>
                        <td> </td>
                      </tr>
                      <tr>
                        <td>11:05 AM</td>
                        <td>135-9</td>
                        <td>05:05 PM</td>
                        <td> </td>
                      </tr>
                      <tr>
                        <td>12:05 PM</td>
                        <td>140-5</td>
                        <td>06:05 PM</td>
                        <td> </td>
                      </tr>
                      <tr>
                        <td>01:05 PM</td>
                        <td>234-9</td>
                        <td>07:05 PM</td>
                        <td> </td>
                      </tr>
                      <tr>
                        <td>02:05 PM</td>
                        <td>258-5</td>
                        <td>08:05 PM</td>
                        <td> </td>
                      </tr>
                    </tbody>
                  </table>
            </div>

            <div class="pinkbg" style="">
                <i style="font-size: 22px;">Mumbai Rajshree Star Line Result</i>
            </div>

            <div class="main-starlinetable">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Time</th>
                        <th scope="col">Result</th>
                        <th scope="col">Time</th>
                        <th scope="col">Result</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>09:30 AM</td>
                        <td>146-1</td>
                        <td>03:30 PM</td>
                        <td> </td>
                      </tr>
                      <tr>
                        <td>10:30 AM</td>
                        <td>589-2</td>
                        <td>04:30 PM</td>
                        <td> </td>
                      </tr>
                      <tr>
                        <td>11:30 AM</td>
                        <td>126-9</td>
                        <td>05:30 PM</td>
                        <td> </td>
                      </tr>
                      <tr>
                        <td>12:30 PM</td>
                        <td>278-7</td>
                        <td>06:30 PM</td>
                        <td> </td>
                      </tr>
                      <tr>
                        <td>01:30 PM</td>
                        <td>369-8</td>
                        <td>07:30 PM</td>
                        <td> </td>
                      </tr>
                      <tr>
                        <td>02:30 PM</td>
                        <td></td>
                        <td>08:30 PM</td>
                        <td> </td>
                      </tr>
                    </tbody>
                  </table>
            </div>

            <div class="pinkbg" style="">
                <i style="font-size: 16px;">EverGreen Trick Zone And Matka Tricks By SatkaMatka</i>
            </div>

            <div class="dphome-twelvewp">
                <h4 class="dphome-twelvehead"><i>SatkaMatka Special Game Zone</i></h4>
                <a href="#">
                    SatkaMatka Guessing Forum (Active) 
                </a>
                <a href="#">
                    All market free fix game 
                </a>
                <a href="#">
                    Ratan Khatri Fix Panel Chart 
                </a>
                <a href="#">
                    Matka Final Number Trick Chart 
                </a>
            </div>

            <div class="dphome-twelvewp mt-2">
                <h4 class="dphome-twelvehead"><i>Matka Jodi List</i></h4>
                <a href="#">
                    Matka Jodi Count Chart
                </a>
                <a href="#">
                    Dhanvarsha Daily Fix Open To Close 
                </a>
                <a href="#">
                    Matka Jodi Family Chart
                </a>
                <a href="#">
                    Penal Count Chart
                </a>
                <a href="#">
                    Penal Total Chart
                </a>
                <a href="#">
                    All 220 Card List
                </a>
            </div>

            <div class="dphome-thirteenwp">
                <h4><i>SatkaMatka Net Weekly Patti Or Penal Chart From 19-02-2024 To 25-02-2024 For Kalyan, Milan, Kalyan Night, Rajdhani, Time, Main Bazar, Mumbai Royal Night</i></h4>
                <i style="color: #000b65; text-shadow: 1px 1px 2px #fff; font-size: 20px; font-weight: 700;">1=>128-146-290-380</i><br>
                <i style="color: #000b65; text-shadow: 1px 1px 2px #fff; font-size: 20px; font-weight: 700;">2=>129-138-237-589</i><br>
                <i style="color: #000b65; text-shadow: 1px 1px 2px #fff; font-size: 20px; font-weight: 700;">3=>157-689-238-300</i><br>
                <i style="color: #000b65; text-shadow: 1px 1px 2px #fff; font-size: 20px; font-weight: 700;">4=>220-770-167-347</i><br>
                <i style="color: #000b65; text-shadow: 1px 1px 2px #fff; font-size: 20px; font-weight: 700;">5=>230-168-113-456</i><br>
                <i style="color: #000b65; text-shadow: 1px 1px 2px #fff; font-size: 20px; font-weight: 700;">6=>178-268-349-556</i><br>
                <i style="color: #000b65; text-shadow: 1px 1px 2px #fff; font-size: 20px; font-weight: 700;">7=>467-340-179-359</i>
                <i style="color: #000b65; text-shadow: 1px 1px 2px #fff; font-size: 20px; font-weight: 700;">8=>350-125-468-260</i>
                <i style="color: #000b65; text-shadow: 1px 1px 2px #fff; font-size: 20px; font-weight: 700;">9=>289-279-117-559</i>
                <i style="color: #000b65; text-shadow: 1px 1px 2px #fff; font-size: 20px; font-weight: 700;">0=>460-127-280-550</i>
            </div>

            <div class="dphome-thirteenwp">
                <h4><i>SatkaMatka Net Weekly Patti Or Penal Chart From 19-02-2024 To 25-02-2024 For Kalyan, Milan, Kalyan Night, Rajdhani, Time, Main Bazar, Mumbai Royal Night</i></h4>
                <i style="color: #000b65; text-shadow: 1px 1px 2px #fff; font-size: 20px; font-weight: 700;">Mon. 1-6-3-8</i><br>
                <i style="color: #000b65; text-shadow: 1px 1px 2px #fff; font-size: 20px; font-weight: 700;">Tue. 2-7-4-9</i><br>
                <i style="color: #000b65; text-shadow: 1px 1px 2px #fff; font-size: 20px; font-weight: 700;">Wed. 4-9-1-6</i><br>
                <i style="color: #000b65; text-shadow: 1px 1px 2px #fff; font-size: 20px; font-weight: 700;">Thu. 2-7-3-8</i><br>
                <i style="color: #000b65; text-shadow: 1px 1px 2px #fff; font-size: 20px; font-weight: 700;">Fri. 1-6-3-8</i><br>
                <i style="color: #000b65; text-shadow: 1px 1px 2px #fff; font-size: 20px; font-weight: 700;">Sat. 2-7-4-9</i><br>
                <i style="color: #000b65; text-shadow: 1px 1px 2px #fff; font-size: 20px; font-weight: 700;">Sun. 1-6-5-0</i>
            </div>

            <div class="dphome-thirteenwp">
                <h4><i>SatkaMatka Net Weekly Jodi Chart From 19-02-2024 To 25-02-2024 For Kalyan Milan Kalyan Night, Rajdhani Time, Main Bazar, Mumbai Royal Night Market</i></h4>
                <i style="color: #000b65; text-shadow: 1px 1px 2px #fff; font-size: 20px; font-weight: 700;">10 15 60 65</i><br>
                <i style="color: #000b65; text-shadow: 1px 1px 2px #fff; font-size: 20px; font-weight: 700;">44 49 94 99</i><br>
                <i style="color: #000b65; text-shadow: 1px 1px 2px #fff; font-size: 20px; font-weight: 700;">23 28 73 78</i><br>
                <i style="color: #000b65; text-shadow: 1px 1px 2px #fff; font-size: 20px; font-weight: 700;">21 26 71 76</i><br>
                <i style="color: #000b65; text-shadow: 1px 1px 2px #fff; font-size: 20px; font-weight: 700;">11 16 61 66</i><br>
                <i style="color: #000b65; text-shadow: 1px 1px 2px #fff; font-size: 20px; font-weight: 700;">03 08 53 58</i>
            </div>

            <div class="pinkbg" style="margin: 10px 0;">
                <i style="font-size: 16px;">FREE GAME ZONE OPEN-CLOSE</i>
            </div>

            <div class="dphome-fourteenwp cmnbg-1">
                <div class="dphome-fourteenwp-top">
                    <span>✔DATE:↬ : 21/02/2024 ↫
                    </span>
                    <p>FREE GUESSING DAILY <br>
                        OPEN TO CLOSE FIX ANK</p>
                </div>
                <div class="row" style="margin: 0px;">
                    <div class="col-md-6" style="border-radius: 10px 0 0 0;">
                        <h5><img style="max-width: 20px;" src="{{asset('public/frontEnd/img/right-next.png')}}" alt=""> MILAN MORNING</h5>
                        <p>1-6-5-0</p>
                        <p>128-123-230-140-190</p>
                        <p>15-10-65-60-51-56-01-06</p>
                    </div>
                    <div class="col-md-6" style="border-radius: 0 10px 0 0;">
                        <h5><img style="max-width: 20px;" src="{{asset('public/frontEnd/img/right-next.png')}}" alt=""> KALYAN MORNING</h5>
                        <p>2-7-3-8</p>
                        <p>23-28-73-78-32-37-82-87</p>
                        <p>23-28-73-78-32-37-82-87</p>
                    </div>
                    <div class="col-md-6" style="">
                        <h5><img style="max-width: 20px;" src="{{asset('public/frontEnd/img/right-next.png')}}" alt=""> TIME BAZAR</h5>
                        <p>1-6-4-9</p>
                        <p>146-466-330-149-199/p>
                        <p>14-19-64-69-41-46-91-96</p>
                    </div>
                    <div class="col-md-6" style="">
                        <h5><img style="max-width: 20px;" src="{{asset('public/frontEnd/img/right-next.png')}}" alt=""> MILAN DAY</h5>
                        <p>1-6-4-9</p>
                        <p>560-150-149-199-379</p>
                        <p>11-16-61-66-44-49-94-99</p>
                    </div>
                    <div class="col-md-6" style="">
                        <h5><img style="max-width: 20px;" src="{{asset('public/frontEnd/img/right-next.png')}}" alt=""> KALYAN</h5>
                        <p>4-9-1-6</p>
                        <p>257-360-117-128-123</p>
                        <p>41-46-91-96-14-19-64-69</p>
                    </div>
                    <div class="col-md-6" style="">
                        <h5><img style="max-width: 20px;" src="{{asset('public/frontEnd/img/right-next.png')}}" alt=""> MILAN NIGHT</h5>
                        <p>*-*-*-*</p>
                        <p>***-***-***-***-***</p>
                        <p>**-**-**-**-**-**-**-**</p>
                    </div>
                    <div class="col-md-6" style="">
                        <h5><img style="max-width: 20px;" src="{{asset('public/frontEnd/img/right-next.png')}}" alt=""> KALYAN NIGHT</h5>
                        <p>*-*-*-*</p>
                        <p>***-***-***-***-***</p>
                        <p>**-**-**-**-**-**-**-**</p>
                    </div>
                    <div class="col-md-6" style="">
                        <h5><img style="max-width: 20px;" src="{{asset('public/frontEnd/img/right-next.png')}}" alt=""> RAJDHANI NIGHT</h5>
                        <p>*-*-*-*</p>
                        <p>***-***-***-***-***</p>
                        <p>**-**-**-**-**-**-**-**</p>
                    </div>
                    <div class="col-md-6" style="">
                        <h5><img style="max-width: 20px;" src="{{asset('public/frontEnd/img/right-next.png')}}" alt=""> MAIN BAZAR</h5>
                        <p>*-*-*-*</p>
                        <p>***-***-***-***-***</p>
                        <p>**-**-**-**-**-**-**-**</p>
                    </div>

                    <div class="col-md-6" style="">
                        <h5><img style="max-width: 20px;" src="{{asset('public/frontEnd/img/right-next.png')}}" alt=""> PUNA BAZAR</h5>
                        <p>1-3-5-6</p>
                        <p>380-146-239-356-258-456-259-358</p>
                        <p>13-15-35-36-51-56-63-65</p>
                    </div>
                    <div class="col-md-6" style="">
                        <h5><img style="max-width: 20px;" src="{{asset('public/frontEnd/img/right-next.png')}}" alt=""> SRIDEVI NIGHT</h5>
                        <p>1-8-9-0</p>
                        <p>399-224-199-244</p>
                        <p>13-18-83-98-94-99-01-06</p>
                    </div>
                    <div class="col-md-6" style="">
                        <h5><img style="max-width: 20px;" src="{{asset('public/frontEnd/img/right-next.png')}}" alt=""> OLD MAIN MUMBAI</h5>
                        <p>7=9=4</p>
                        <p>269=250=149=590=340=234</p>
                        <p>71 =76 =41 =46 =91= 96</p>
                    </div>
                    <div class="col-md-6" style="">
                        <h5><img style="max-width: 20px;" src="{{asset('public/frontEnd/img/right-next.png')}}" alt=""> PADMAVATI</h5>
                        <p>2-3-5-6-9</p>
                        <p>200-570-120-229-159-122-600-466-199-469</p>
                        <p>21-22-35-39-58-52-68-65-98-90</p>
                        <p>1-2-5-9-0</p>
                    </div>
                    <div class="col-md-6" style="">
                        <h5><img style="max-width: 20px;" src="{{asset('public/frontEnd/img/right-next.png')}}" alt=""> KARNATAKA DAY</h5>
                        <p>4-5-8</p>
                        <p>130-235-456-890-350-478</p>
                        <p>49-47-57-59-80-89</p>
                        <p>0-7-9</p>
                    </div>
                    <div class="col-md-6" style="">
                        <h5><img style="max-width: 20px;" src="{{asset('public/frontEnd/img/right-next.png')}}" alt=""> SRIDEVI</h5>
                        <p>1-6-7-8</p>
                        <p>678-178-124-567</p>
                        <p>11-16-62-67-73-78-83-88</p>
                    </div>
                    <div class="col-md-6" style="">
                        <h5><img style="max-width: 20px;" src="{{asset('public/frontEnd/img/right-next.png')}}" alt=""> MUMBAI MORNING</h5>
                        <p>2-7-3-8</p>
                        <p>237-124-378-238</p>
                        <p>27-72-83-38</p>
                    </div>
                    <div class="col-md-6" style="border-radius: 0 0 0 10px;">
                        <h5><img style="max-width: 20px;" src="{{asset('public/frontEnd/img/right-next.png')}}" alt=""> MAIN KALYAN</h5>
                        <p>8-7-6-5</p>
                        <p>378-288-340-368-259-349-249-267</p>
                        <p>84-86-73-77-66-65-58-56</p>
                    </div>
                </div>
            </div>

            <div class="dphome-fivteenwp" style="text-align: center; margin: 10px 0;">
                <table width="100%" cellspacing="0" cellpadding="0" class="l-obj-giv">
                    <tbody>
                    <tr>
                    <td colspan="9" class="v5a25">कल्याण</td>
                    </tr>
                    <tr><td rowspan="2" class="v5a25-v4a5">सोम</td>
                    <td rowspan="2" class="v5a25-v85b">3</td>
                    <td>689</td>
                    <td rowspan="2" class="v5a25-v85b">5</td>
                    <td>366</td>
                    <td rowspan="2" class="v5a25-v85b">7</td>
                    <td>223</td>
                    <td rowspan="2" class="v5a25-v85b">8</td>
                    <td>666</td>
                    </tr><tr>
                    <td>35</td>
                    <td>53</td>
                    <td>78</td>
                    <td>87</td>
                    </tr>
                    <tr><td rowspan="2" class="v5a25-v4a5">मंगल</td>
                    <td rowspan="2" class="v5a25-v85b">2</td>
                    <td>156</td>
                    <td rowspan="2" class="v5a25-v85b">7</td>
                    <td>467</td>
                    <td rowspan="2" class="v5a25-v85b">8</td>
                    <td>477</td>
                    <td rowspan="2" class="v5a25-v85b">9</td>
                    <td>333</td>
                    </tr><tr>
                    <td>27</td>
                    <td>72</td>
                    <td>89</td>
                    <td>98</td>
                    </tr>
                    <tr><td rowspan="2" class="v5a25-v4a5">बुध</td>
                    <td rowspan="2" class="v5a25-v85b">3</td>
                    <td>779</td>
                    <td rowspan="2" class="v5a25-v85b">7</td>
                    <td>359</td>
                    <td rowspan="2" class="v5a25-v85b">8</td>
                    <td>134</td>
                    <td rowspan="2" class="v5a25-v85b">9</td>
                    <td>478</td>
                    </tr><tr>
                    <td>37</td>
                    <td>73</td>
                    <td>89</td>
                    <td>98</td>
                    </tr>
                    <tr><td rowspan="2" class="v5a25-v4a5">गुरु</td>
                    <td rowspan="2" class="v5a25-v85b">3</td>
                    <td>779</td>
                    <td rowspan="2" class="v5a25-v85b">5</td>
                    <td>168</td>
                    <td rowspan="2" class="v5a25-v85b">7</td>
                    <td>133</td>
                    <td rowspan="2" class="v5a25-v85b">9</td>
                    <td>388</td>
                    </tr><tr>
                    <td>35</td>
                    <td>53</td>
                    <td>79</td>
                    <td>97</td>
                    </tr>
                    <tr><td rowspan="2" class="v5a25-v4a5">शुक्र</td>
                    <td rowspan="2" class="v5a25-v85b">5</td>
                    <td>122</td>
                    <td rowspan="2" class="v5a25-v85b">6</td>
                    <td>277</td>
                    <td rowspan="2" class="v5a25-v85b">7</td>
                    <td>269</td>
                    <td rowspan="2" class="v5a25-v85b">8</td>
                    <td>189</td>
                    </tr><tr>
                    <td>56</td>
                    <td>65</td>
                    <td>78</td>
                    <td>87</td>
                    </tr>
                    <tr><td rowspan="2" class="v5a25-v4a5">शनि</td>
                    <td rowspan="2" class="v5a25-v85b">2</td>
                    <td>138</td>
                    <td rowspan="2" class="v5a25-v85b">5</td>
                    <td>122</td>
                    <td rowspan="2" class="v5a25-v85b">7</td>
                    <td>467</td>
                    <td rowspan="2" class="v5a25-v85b">9</td>
                    <td>234</td>
                    </tr><tr>
                    <td>25</td>
                    <td>52</td>
                    <td>79</td>
                    <td>97</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="dphome-fivteenwp" style="text-align: center; margin: 10px 0;">
                <table width="100%" cellspacing="0" cellpadding="0" class="l-obj-giv">
                    <tbody>
                    <tr>
                    <td colspan="9" class="v5a25">KALYAN NIGHT / MAIN BAZAR </td>
                    </tr>
                    <tr><td rowspan="2" class="v5a25-v4a5">सोम</td>
                    <td rowspan="2" class="v5a25-v85b">3</td>
                    <td>445</td>
                    <td rowspan="2" class="v5a25-v85b">6</td>
                    <td>169</td>
                    <td rowspan="2" class="v5a25-v85b">8</td>
                    <td>990</td>
                    <td rowspan="2" class="v5a25-v85b">9</td>
                    <td>360</td>
                    </tr><tr>
                    <td>36</td>
                    <td>63</td>
                    <td>89</td>
                    <td>98</td>
                    </tr>
                    <tr><td rowspan="2" class="v5a25-v4a5">मंगल</td>
                    <td rowspan="2" class="v5a25-v85b">3</td>
                    <td>148</td>
                    <td rowspan="2" class="v5a25-v85b">4</td>
                    <td>158</td>
                    <td rowspan="2" class="v5a25-v85b">5</td>
                    <td>690</td>
                    <td rowspan="2" class="v5a25-v85b">6</td>
                    <td>556</td>
                    </tr><tr>
                    <td>34</td>
                    <td>43</td>
                    <td>56</td>
                    <td>65</td>
                    </tr>
                    <tr><td rowspan="2" class="v5a25-v4a5">बुध</td>
                    <td rowspan="2" class="v5a25-v85b">0</td>
                    <td>127</td>
                    <td rowspan="2" class="v5a25-v85b">5</td>
                    <td>339</td>
                    <td rowspan="2" class="v5a25-v85b">8</td>
                    <td>189</td>
                    <td rowspan="2" class="v5a25-v85b">9</td>
                    <td>568</td>
                    </tr><tr>
                    <td>05</td>
                    <td>50</td>
                    <td>89</td>
                    <td>98</td>
                    </tr>
                    <tr><td rowspan="2" class="v5a25-v4a5">गुरु</td>
                    <td rowspan="2" class="v5a25-v85b">2</td>
                    <td>246</td>
                    <td rowspan="2" class="v5a25-v85b">5</td>
                    <td>168</td>
                    <td rowspan="2" class="v5a25-v85b">6</td>
                    <td>222</td>
                    <td rowspan="2" class="v5a25-v85b">7</td>
                    <td>557</td>
                    </tr><tr>
                    <td>25</td>
                    <td>52</td>
                    <td>67</td>
                    <td>76</td>
                    </tr>
                    <tr><td rowspan="2" class="v5a25-v4a5">शुक्र</td>
                    <td rowspan="2" class="v5a25-v85b">1</td>
                    <td>560</td>
                    <td rowspan="2" class="v5a25-v85b">6</td>
                    <td>259</td>
                    <td rowspan="2" class="v5a25-v85b">8</td>
                    <td>260</td>
                    <td rowspan="2" class="v5a25-v85b">9</td>
                    <td>568</td>
                    </tr><tr>
                    <td>16</td>
                    <td>61</td>
                    <td>89</td>
                    <td>98</td>
                    </tr>
                    </tbody></table>
            </div>


            <div class="dphome-sixteenwp">
                <div class="pinkbg" style="">
                    <i style="font-size: 22px;">SATTA MATKA JODI CHART</i>
                </div>
            @foreach($allgame as $key => $vall)

                <a href="{{route('jodi',$vall->id)}}">{{$vall->name}} Jodi Chart</a><hr>
                @endforeach
            </div>


            <div class="dphome-sixteenwp mt-2">
                <div class="pinkbg" style="">
                    <i style="font-size: 22px;">MATKA PANEL CHART</i>
                </div>
                @foreach($allgame as $key => $vall)

                <a href="{{route('panel',$vall->id)}}">{{$vall->name}} Panel Chart</a><hr>
                @endforeach
                
            </div>

            <div class="dphome-seventeenwp cmnbg-1 mt-2" style="text-align: center;">
                <i style="font-size: 22px; color: #000;">Introduction to SatkaMatka Service</i>
                <p class="mb-3">@foreach($aboutSatta as $ke => $val)
                    @if($val->key == 'intro')
                    {!! asset($val->data) ? $val->data : '' !!}
                    @endif
                    @endforeach
                </p>
                <i>HISTORY OF SATTA MATKA</i>
                @foreach($aboutSatta as $ke => $val)
                    @if($val->key == 'history')
                   <p> {!! asset($val->data) ? $val->data : '' !!}</p>
                    @endif
                    @endforeach
                <hr>
                <i>TYPES OF SATTA MATKA</i>
                @foreach($aboutSatta as $ke => $val)
                    @if($val->key == 'types')
                    <p>{!! asset($val->data) ? $val->data : '' !!}</p>
                    @endif
                    @endforeach
                <hr>
                <i>THE BASICS OF MATKA</i>
                @foreach($aboutSatta as $ke => $val)
                    @if($val->key == 'basic')
                    <p>{!! asset($val->data) ? $val->data : '' !!}</p>
                    @endif
                    @endforeach
                <hr>
                <i>DIFFERENT VARIANTS OF MATKA GAMES</i>
                @foreach($aboutSatta as $ke => $val)
                    @if($val->key == 'diff_veriant')
                    <p>{!! asset($val->data) ? $val->data : '' !!}</p>
                    @endif
                    @endforeach
                <hr>
                <i>WHAT IS KALYAN MATKA AND ITS WINNING STRATEGY</i>
                @foreach($aboutSatta as $ke => $val)
                    @if($val->key == 'kalyan_matka')
                    <p>{!! asset($val->data) ? $val->data : '' !!}</p>
                    @endif
                    @endforeach
            </div>
            
            <div class="dphome-eighteenwp cmnbg-1 mt-2">
                <i>WHAT IS SATTA MATKA?</i>
                <p>@foreach($aboutSatta as $ke => $val)
                    @if($val->key == 'kalyan_matka')
                    <p>{!! asset($val->data) ? $val->data : '' !!}</p>
                    @endif
                    @endforeach</p>
                <hr>
                <i>WHAT IS RAJDHANI MATKA?</i>
                <p>@foreach($aboutSatta as $ke => $val)
                    @if($val->key == 'kalyan_matka')
                    <p>{!! asset($val->data) ? $val->data : '' !!}</p>
                    @endif
                    @endforeach</p>
                <hr>
                <i>WHAT IS SATTA CHART ANALYSIS?</i>
                <p>@foreach($aboutSatta as $ke => $val)
                    @if($val->key == 'kalyan_matka')
                    <p>{!! asset($val->data) ? $val->data : '' !!}</p>
                    @endif
                    @endforeach</p>
                <hr>
                <i>WHAT IS MATKA OPEN AND MATKA CLOSE?</i>
                <p>@foreach($aboutSatta as $ke => $val)
                    @if($val->key == 'kalyan_matka')
                    <p>{!! asset($val->data) ? $val->data : '' !!}</p>
                    @endif
                    @endforeach</p>
                <hr>
                <i>MATKA JODI ON SatkaMatka.SERVICES: COMBINING NUMBERS FOR WINNING BETS</i>
                <p>@foreach($aboutSatta as $ke => $val)
                    @if($val->key == 'kalyan_matka')
                    <p>{!! asset($val->data) ? $val->data : '' !!}</p>
                    @endif
                    @endforeach</p>
                <hr>
                <i>BOMBAY SATTA GUESSING AND TIPS</i>
                <p>@foreach($aboutSatta as $ke => $val)
                    @if($val->key == 'kalyan_matka')
                    <p>{!! asset($val->data) ? $val->data : '' !!}</p>
                    @endif
                    @endforeach</p>
            </div>

            <div class="dphome-nineteenwp cmnbg-1 mt-2">
                <i>WHAT IS SATTA MATKA?</i>
                <p>@foreach($satta as $ke => $val)
                    @if($val->key == 'what_is_matka')
                    <p>{!! asset($val->data) ? $val->data : '' !!}</p>
                    @endif
                    @endforeach</p>
                <hr>
                <i>WHO IS SatkaMatka</i>
                <p>@foreach($satta as $ke => $val)
                    @if($val->key == 'dp_boss')
                    <p>{!! asset($val->data) ? $val->data : '' !!}</p>
                    @endif
                    @endforeach</p>
                <hr>
                <i>HOW DOES MATKA WORK?</i>
                <p>@foreach($satta as $ke => $val)
                    @if($val->key == 'matka_world')
                    <p>{!! asset($val->data) ? $val->data : '' !!}</p>
                    @endif
                    @endforeach</p>
                <hr>
                <i>WHAT IS KALYAN MATKA?</i>
                <p>@foreach($satta as $ke => $val)
                    @if($val->key == 'kalyan_matka')
                    <p>{!! asset($val->data) ? $val->data : '' !!}</p>
                    @endif
                    @endforeach</p>
                <hr>
                <i>HOW CAN I CHECK THE MATKA RESULT?</i>
                <p>@foreach($satta as $ke => $val)
                    @if($val->key == 'matka_result')
                    <p>{!! asset($val->data) ? $val->data : '' !!}</p>
                    @endif
                    @endforeach</p>
                <hr>
                <i>WHAT IS MATKA CHART?</i>
                <p>@foreach($satta as $ke => $val)
                    @if($val->key == 'matka_chart')
                    <p>{!! asset($val->data) ? $val->data : '' !!}</p>
                    @endif
                    @endforeach</p>
                <hr>
                <i>WHAT IS THE DIFFERENCE BETWEEN MATKA AND SATTA?</i>
                <p>@foreach($satta as $ke => $val)
                    @if($val->key == 'diff_bt_matka_satta')
                    <p>{!! asset($val->data) ? $val->data : '' !!}</p>
                    @endif
                    @endforeach</p>
                <hr>
                <i>WHAT ARE MATKA OPEN AND MATKA CLOSE?</i>
                <p>@foreach($satta as $ke => $val)
                    @if($val->key == 'matka_close')
                    <p>{!! asset($val->data) ? $val->data : '' !!}</p>
                    @endif
                    @endforeach.</p>
                <hr>
                <i>WHAT ARE MATKA PANNA AND MATKA JODI?</i>
                <p>@foreach($satta as $ke => $val)
                    @if($val->key == 'matka_pana')
                    <p>{!! asset($val->data) ? $val->data : '' !!}</p>
                    @endif
                    @endforeach</p>
                <hr>
                <i>WHAT IS FIX SATTA?</i>
                <p>@foreach($satta as $ke => $val)
                    @if($val->key == 'fix')
                    <p>{!! asset($val->data) ? $val->data : '' !!}</p>
                    @endif
                    @endforeach</p>
                <hr>
                <i>WHAT IS LUCKY ONLINE MATKA?</i>
                <p>@foreach($satta as $ke => $val)
                    @if($val->key == 'luckey_only')
                    <p>{!! asset($val->data) ? $val->data : '' !!}</p>
                    @endif
                    @endforeach</p>
                <hr>
                <i>LIVE MATKA</i>
                <p>@foreach($satta as $ke => $val)
                    @if($val->key == 'live')
                    <p>{!! asset($val->data) ? $val->data : '' !!}</p>
                    @endif
                    @endforeach</p>
                <hr>
                <i>GALI DESHAWAR MATKA</i>
                <p>@foreach($satta as $ke => $val)
                    @if($val->key == 'gali')
                    <p>{!! asset($val->data) ? $val->data : '' !!}</p>
                    @endif
                    @endforeach</p>
                <hr>
                <i>BOMBAY SATTA</i>
                <p>@foreach($satta as $ke => $val)
                    @if($val->key == 'bombay')
                    <p>{!! asset($val->data) ? $val->data : '' !!}</p>
                    @endif
                    @endforeach</p>
                <hr>
                <i>SATTAMATKA TIPS</i>
                <p>@foreach($satta as $ke => $val)
                    @if($val->key == 'tips')
                    <p>{!! asset($val->data) ? $val->data : '' !!}</p>
                    @endif
                    @endforeach.</p>
                <hr>
                <i>SATTA MATKA WORLD</i>
                <p>@foreach($satta as $ke => $val)
                    @if($val->key == 'world')
                    <p>{!! asset($val->data) ? $val->data : '' !!}</p>
                    @endif
                    @endforeach</p>
            </div>

            <div class="dphome-twentywp cmnbg-1 mt-2">
                <h5>MATKA</h5>
                <a href="#">
                    Madhur Matka | Satta Bazar | Satta Kurla | Satta Com | Satta Batta | Org Mobi Net In | Satta Master | Matka Game | Kapil Indian Matka | Matka Parivar 24 | Prabhat Matka | Tara Matka | Golden Matka | SattaMatka.Com | Madhur Matka satta result chart, satta khabar, matka India net, satakmatak, satta chart 2019, satta bazar result, satta live, satta bazar, satta matka Mumbai chart, satta live result, satta fast result, satta fast, satta today Number 10
                </a>
            </div>

            <div class="dphome-twentyonewp cmnbg-1 mt-2">
                <div class="pinkbg" style="margin: 10px 0;">
                    <i style="font-size: 20px;">-:DISCLAIMER:-</i>
                </div>
                <p>Visiting this site and browsing it is strictly recommended at your own risk. Every information available here is only according to informational purpose and based on astrology and number calculations. We are no associated or affiliated with any illegal Matka business. We make sure we follow all rules and regulations of the regions where you are accessing the website. There are also chances that the website may be banned in your area and after that if you are using it, you are solely dependable and responsible for any damage, loss or legal action taken.</p>
            </div>

            <div class="pinkbg" style="margin: 10px 0; border: 2px solid #ff182c!important;">
                <span style="font-size: 20px;">POWERD BY SatkaMatka.services-</span>
            </div>

            <div class="dphome-twentytwowp cmnbg-1" style="text-align: center; margin-bottom: 10px;">
                <a href="#">
                    <span style="color: #000b65; font-size: 10px;">© 2011 - 2024 SatkaMatka.services</span>
                </a>
                <br>
                <a href="#" style="font-size: 10px;">
                    About us
                </a>
                <span style="color: #a50031; font-size: 10px;">|</span>
                <a href="#" style="font-size: 10px;">
                    Contact us
                </a><br>
                <a href="#" style="font-size: 10px;">
                    Privacy & policy
                </a>
                <span style="color: #a50031; font-size: 10px;">|</span>
                <a href="#" style="font-size: 10px;">
                    Term And Conditions
                </a>
            </div>

        </div>

    </section>

<div style="padding: 5px;">
    <a href="{{ asset('public/app-release.apk') }}" style="
        position: fixed;
        bottom: 9px;
        left: 5px;
        padding: 5px 8px;
        font-size: 15px;
        border: 1px solid #fff;
        text-decoration: none;
        background-color: #039;
        color: #fff;
        border-radius: 5px;
    "> 
        Matka Play
    </a>

</div>





















    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>
</html>