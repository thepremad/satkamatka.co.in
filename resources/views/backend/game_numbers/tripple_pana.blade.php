@extends('backend.layouts.app')

@section('styles')
    <style>
        .single-wp-ulli button {
            border: 1px solid #34c38f;
            border-radius: 4px;
            background-color: rgba(52, 195, 143, .18);
            width: 40px;
            height: 40px;
            margin: 10px 20px;
            font-weight: 600;
        }

        .single-wp-ulli ul {
            padding: 0;
            margin: 0;
        }

        .single-wp-ulli li {
            list-style: none;
            display: inline-block;
        }

        .single-wp-ulli {
            padding: 1.25rem;
            box-shadow: 0px 0px 20px #e6e6e6;
            background: #fff;
            border-radius: 8px;
            margin-top: 30px;
        }

        .single-wp-ulli span {
            font-size: 15px;
            margin: 0 0 7px 0;
            font-weight: 600;
            color: #495057;
        }

        footer.footer {
            bottom: 0;
            padding: 20px calc(24px / 2);
            position: absolute;
            right: 0;
            color: #74788d;
            left: 250px;
            height: 60px;
            background-color: #f2f2f5;
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
                <section id="dashboard-ecommerce">
                    <section class="single-wp">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-10">
                                    <div class="single-wp-ulli">
                                        <span>Single Digit Numbers</span>
                                        <ul>
                                            @foreach($tripplePana as $key => $value)                                                                                            
                                            <li><button>{{ $value->digit }}</button></li>                                            
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
