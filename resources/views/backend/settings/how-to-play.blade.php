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

                        <div class="row">

                            <div class="col-md-12">
                                <div class="single-wp-ulli">
                                    <span>How to play</span>
                                    <ul>
                                        <div class="col-md-6 mt-2 col-12">
                                            <div class="mb-1">
                                                <!-- <label class="form-label" for="first-name-column">Video URL
                                                        *</label> -->
                                                <iframe width="560" height="315"
                                                    src="https://www.youtube.com/embed/VIDEO_ID_HERE" frameborder="0"
                                                    allowfullscreen></iframe>
                                            </div>
                                            <div class="col-md-3">
                                                <button class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal">Update</button>
                                            </div>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Button trigger modal -->


                        <!-- Modal -->
                        <form action="{{ route('admin.save-instructions') }}" method="post">
                            @csrf
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Video URL</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-md-12 mt-2 col-12">
                                                <div class="mb-1">
                                                <label for="exampleFormControlTextarea1" class="form-label">Add video
                                                        URL</label>
                                                    <input type="text" required id="video-url" name="video"
                                                        class="form-control" placeholder="Video Url" />
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </section>
            </section>
        </div>
    </div>
</div>
</form>
<!-- END: Content-->
@endsection
