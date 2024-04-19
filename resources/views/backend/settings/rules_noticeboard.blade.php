@extends('backend.layouts.app')
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-body">
               
    
               
                
                <section id="multiple-column-form" style="padding-top: 2%;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card" style="min-height: 100%;">
                                <div class="card-header">
                                    <h4 class="card-title">Marquee Notification</h4>
                                </div>
                                <div class="card-body">
                                   
                                    <form class="form" action="{{ route('admin.rules_notice_board_save') }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                        <div class="row">

                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <textarea class="form-control" name="marquee_notification"><?php print_r($marquee_notification);  ?></textarea>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary me-1">Submit</button>
                                                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                </section>
                
                <section id="multiple-column-form" style="padding-top: 2%;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card" style="min-height: 100%;">
                                <div class="card-header">
                                    <h4 class="card-title">Rules</h4>
                                </div>
                                <div class="card-body">
                                   
                                    <form class="form" action="{{ route('admin.rules_notice_board_save') }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                        <div class="row">

                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <textarea class="ckeditor form-control" name="rules"><?php print_r($rules);  ?></textarea>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary me-1">Submit</button>
                                                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                </section>
                
                 <section id="multiple-column-form" style="padding-top: 2%;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card" style="min-height: 100%;">
                                <div class="card-header">
                                    <h4 class="card-title">Notice Board</h4>
                                </div>
                                <div class="card-body">
                                   
                                    <form class="form" action="{{ route('admin.rules_notice_board_save') }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                        <div class="row">

                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <textarea class="ckeditor form-control" name="notice_board"><?php print_r($notice_board);  ?></textarea>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary me-1">Submit</button>
                                                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                </section>
                
               
               
            </div>
            
        </div>
    </div>
    
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
    </script>
    
    <script type="text/javascript">
        CKEDITOR.replace('rules', {
            filebrowserUploadUrl: "{{route('admin.ckeditor.image-upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>
    <script type="text/javascript">
        CKEDITOR.replace('notice_board', {
            filebrowserUploadUrl: "{{route('admin.ckeditor.image-upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>

            
        @endsection
       
