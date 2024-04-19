@extends('backend.layouts.app')
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-body">
               
    
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card" style="min-height: 100%;">
                                <div class="card-header">
                                    <h4 class="card-title">Contact Settings</h4>
                                </div>
                                <div class="card-body">
                                   <form class="form" action="{{ route('admin.contact-setting-store') }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    
                                        <div class="row">

                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Mobile Number *</label>
                                                    <input type="number" id="first-name-column" name="mobile" class="form-control" placeholder="Mobile Number" required value="@if(isset($data->mobile)){{ $data->mobile}}@endif" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Telegram Mobile *</label>
                                                    <input type="number" id="first-name-column" name="telegram_mobile" class="form-control" placeholder="Telegram Mobile" required value="@if(isset($data->telegram_mobile)){{ $data->telegram_mobile}}@endif" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">WhatsApp Number *</label>
                                                    <input type="number" id="first-name-column" name="whatsapp_number" class="form-control" placeholder="WhatsApp Number" required value="@if(isset($data->whatsapp_number)){{ $data->whatsapp_number}}@endif" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Landline 1</label>
                                                    <input type="text" id="first-name-column" name="landline_1" class="form-control" placeholder="Landline 1"  value="@if(isset($data->landline_1)){{ $data->landline_1}}@endif" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Landline 2</label>
                                                    <input type="text" id="first-name-column" name="landline_2" class="form-control" placeholder="Landline 2"  value="@if(isset($data->landline_2)){{ $data->landline_2}}@endif" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Email 1 *</label>
                                                    <input type="email" id="first-name-column" name="email_1" class="form-control" placeholder="Email 1" required value="@if(isset($data->email_1)){{ $data->email_1}}@endif" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Email 2</label>
                                                    <input type="email" id="first-name-column" name="email_2" class="form-control" placeholder="Email 2"  value="@if(isset($data->email_2)){{ $data->email_2}}@endif" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Facebook</label>
                                                    <input type="text" id="first-name-column" name="facebook" class="form-control" placeholder="Facebook"  value="@if(isset($data->facebook)){{ $data->facebook}}@endif" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Twitter</label>
                                                    <input type="text" id="first-name-column" name="twiter" class="form-control" placeholder="Twitter"  value="@if(isset($data->twiter)){{ $data->twiter}}@endif" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">YouTube</label>
                                                    <input type="text" id="first-name-column" name="youtube" class="form-control" placeholder="YouTube"  value="@if(isset($data->youtube)){{ $data->youtube}}@endif" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Google Plus</label>
                                                    <input type="text" id="first-name-column" name="google_plus" class="form-control" placeholder="Google Plus"  value="@if(isset($data->google_plus)){{ $data->google_plus}}@endif" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Instagram</label>
                                                    <input type="text" id="first-name-column" name="instagram" class="form-control" placeholder="Instagram"  value="@if(isset($data->instagram)){{ $data->instagram}}@endif" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Latitude *</label>
                                                    <input type="text" id="first-name-column" name="latitude" class="form-control" placeholder="Latitude" required value="@if(isset($data->latitude)){{ $data->latitude}}@endif" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Longitude *</label>
                                                    <input type="text" id="first-name-column" name="longitude" class="form-control" placeholder="Longitude" required value="@if(isset($data->longitude)){{ $data->longitude}}@endif" />
                                                </div>
                                            </div>
                                            
                                            
                                            
                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Address *</label>
                                                    <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="3" required placeholder="Enter Your Address">@if(isset($data->address)){{ $data->address}}@endif</textarea>
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

            
        @endsection
       
