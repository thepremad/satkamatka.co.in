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
        padding:10px
    }
    button.btn.btn-danger.waves-effect.waves-float.waves-light {
        width: 100px;
        padding:10px

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
                        <form action="{{ route('admin.save-notice-management') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="single-wp-ulli">
                                        <span>Notice Management</span>
                                        <ul>
                                            <div class="col-md-6 mt-5 col-12">
                                                <!-- <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Notice *</label>
                                                    <input type="textarea" required id="video-url" name="notice"
                                                        class="form-control" placeholder="Notice" />
                                                </div> -->
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Notice
                                                        Management</label>
                                                    <textarea class="form-control" id="exampleFormControlTextarea1"
                                                        rows="3">welcome to  "matka 365" most trusted matka app,  24*7 fast customer service  provider!</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-3 d-flex">
                                                <button type="submit" class="btn btn-primary ">Update</button>
                                                <button type="submit" disabled  class="btn btn-danger ">Disable</button>
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
