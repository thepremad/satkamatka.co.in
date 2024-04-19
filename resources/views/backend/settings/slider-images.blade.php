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

    button.btn.btn-primary.waves-effect.waves-float.waves-light {
        width: 100px;
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
                        <form action="{{route('admin.save-slider-images')}}"  enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="single-wp-ulli">
                                        <span>Slider Images</span>
                                        <a href="{{route('admin.slider-list')}}"><p style="float:right" class="btn btn-primary "> List</p></a>
                                        <ul>
                                            <div class="col-md-6 mt-5 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">slider
                                                        images*</label>
                                                    <input type="file" id="slider" required multiple name="images[]" class="form-control"
                                                        placeholder="Slider images" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="submit" class="btn btn-primary ">submit</button>
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </section>
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection
