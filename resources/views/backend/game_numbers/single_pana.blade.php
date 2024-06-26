@extends('backend.layouts.app')

@section('styles')
    <style>
        button.ank_box {
    border: 1px solid #f46a6a;
    border-radius: 4px;
    background-color: rgba(244,106,106,.18);
    width: 40px;
    height: 40px;
    margin: 10px 20px;
    font-weight: 600;
}

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
    </style>
@endsection
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-body">
                <!-- Basic Inputs start -->
                <section id="basic-input">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="single-wp-ulli">
                                        <span>Single Pana Numbers </span>
                                        <ul>
                                            @foreach ($singlePana as $key => $value)
                                            <h5>Single Ank</h5>
                                                <li><button style="border: 1px solid #f46a6a;
                                                    border-radius: 4px;
                                                    background-color: rgba(244,106,106,.18);
                                                    width: 40px;
                                                    height: 40px;
                                                    margin: 10px 20px;
                                                    font-weight: 600;" class="">{{ $key }}</button></li>
                                                <br>
                                                @foreach ($value->digit as $keys => $digit)
                                                    <li><button>{{ $digit }}</button></li>
                                                @endforeach
                                                <br>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Basic Inputs end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
