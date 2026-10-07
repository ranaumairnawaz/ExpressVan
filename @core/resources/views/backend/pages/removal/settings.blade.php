@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button{
            padding: 0 !important;
        }
        div.dataTables_wrapper div.dataTables_length select {
            width: 60px;
            display: inline-block;
        }
        .image-wrap img{
            width: 5rem;
        }
    </style>
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-tagsinput.css')}}">
@endsection
@section('site-title')
    {{__('Transports')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-error-msg/>
                <x-flash-msg/>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Copmany Settings')}}</h4>
                        <div class="row" >
                            <div class="col-md-4" >
                                <a class="btn btn-primary" href="{{ route('admin.general.basic.settings') }}" >Company Details</a>
                            </div>
                            <div class="col-md-4" >
                                <a class="btn btn-primary" href="{{ route('admin.contact.info') }}" >Contact Details</a>
                            </div>
                        </div>
                        <h4 class="header-title mt-3">{{__('Removal Settings')}}</h4>
                        <form action="{{ route('admin.removal.settings.save') }}" method="POST" enctype="multipart/form-data" >
                            @csrf()
                            <div class="row" >
                                <div class="col-md-3" >
                                    <div class="form-group" >
                                        <label>Gas Charge per mile</label>
                                        <input type="text" name="per_km_price" value="{{ get_static_option('per_km_price') }}" class="form-control" placeholder="Gas Charge per mile" >
                                    </div>
                                </div>
                                <div class="col-md-3" >
                                    <div class="form-group" >
                                        <label class="text-capitalize" >maximum booking hours</label>
                                        <input type="number" name="maximum_booking_hours" value="{{ get_static_option('maximum_booking_hours') }}" class="form-control" placeholder="maximum booking hours" >
                                    </div>
                                </div>
                                <div class="col-md-3" >
                                    <div class="form-group" >
                                        <label class="text-capitalize" >minimum booking hours</label>
                                        <input type="number" name="minimum_booking_hours" value="{{ get_static_option('minimum_booking_hours') }}" class="form-control" placeholder="minimum booking hours" >
                                    </div>
                                </div>
                                <div class="col-md-3" >
                                    <div class="form-group" >
                                        <label>Congestion charge</label>
                                        <input type="text" name="congestion_charge" value="{{ get_static_option('congestion_charge') }}" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-3" >
                                    <div class="form-group" >
                                        <label>Ultra low emission charge</label>
                                        <input type="text" name="ultra_low_emission_charge" value="{{ get_static_option('ultra_low_emission_charge') }}" class="form-control" placeholder="Ultra low emission charge" >
                                    </div>
                                </div>
                                <div class="col-md-3" >
                                    <div class="form-group" >
                                        <label>Booking Tax</label>
                                        <input type="text" name="booking_tax" value="{{ get_static_option('booking_tax') }}" class="form-control" placeholder="Booking Tax" >
                                    </div>
                                </div>
                                <div class="col-md-3" >
                                    <div class="form-group" >
                                        <label>Google MAPS API key</label>
                                        <input type="text" name="google_api_key" value="{{ get_static_option('google_api_key') }}" class="form-control" placeholder="Google MAPS API key" >
                                    </div>
                                </div>
                                <div class="col-md-3" >
                                    <div class="form-group" >
                                        <label>Go Address API Key</label>
                                        <input type="text" name="go_address_api_key" value="{{ get_static_option('go_address_api_key') }}" class="form-control" placeholder="Go Address API Key" >
                                    </div>
                                </div>
                                <div class="col-md-3" >
                                    <div class="form-group" >
                                        <label for="go_address_status"><strong>Enable/Disable Go Address</strong></label>
                                        <select class="form-control" name="go_address_status" id="go_address_status" >
                                            <option value="1" @if(get_static_option('go_address_status') == 1) selected @endif>Enable</option>
                                            <option value="0" @if(get_static_option('go_address_status') == 0 || get_static_option('go_address_status') === null) selected @endif>Disable</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3" >
                                    <div class="form-group" >
                                        <label>Whatsapp Number</label>
                                        <input type="text" name="whatsapp_number" value="{{ get_static_option('whatsapp_number') }}" class="form-control" placeholder="Whatsapp Number" >
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4" >
                                    <h4 class="header-title">{{__('Automated Calendar Sync OAuth')}}</h4>
                                </div>
                                <div class="col-md-6" >
                                    <div class="form-group" >
                                        <label>Google Calendar Client ID</label>
                                        <input type="text" name="google_calendar_client_id" value="{{ get_static_option('google_calendar_client_id') }}" class="form-control" placeholder="Google Client ID" >
                                    </div>
                                </div>
                                <div class="col-md-6" >
                                    <div class="form-group" >
                                        <label>Google Calendar Client Secret</label>
                                        <input type="secret" name="google_calendar_client_secret" value="{{ get_static_option('google_calendar_client_secret') }}" class="form-control" placeholder="Google Client Secret" >
                                    </div>
                                </div>
                                <div class="col-md-6" >
                                    <div class="form-group" >
                                        <label>Microsoft Calendar Client ID</label>
                                        <input type="text" name="microsoft_calendar_client_id" value="{{ get_static_option('microsoft_calendar_client_id') }}" class="form-control" placeholder="Microsoft Client ID" >
                                    </div>
                                </div>
                                <div class="col-md-6" >
                                    <div class="form-group" >
                                        <label>Microsoft Calendar Client Secret</label>
                                        <input type="secret" name="microsoft_calendar_client_secret" value="{{ get_static_option('microsoft_calendar_client_secret') }}" class="form-control" placeholder="Microsoft Client Secret" >
                                    </div>
                                </div>
                                <div class="col-md-12" >
                                    <h4 class="header-title mt-3">{{__('Stripe Settings')}}</h4>
                                    <div id="stripe_settings_content">
                                        <div class="row" >
                                            <div class="col-md-4" >
                                                <div class="form-group">
                                                    <label for="stripe_test_mode"><strong>{{__('Enable/Disable Stripe Test Mode')}}</strong></label>
                                                    <select class="form-control" name="stripe_test_mode" id="stripe_test_mode" >
                                                        <option value="1" 
                                                        @if(get_static_option('stripe_test_mode') == 1)
                                                        selected
                                                        @endif
                                                        >Enable</option>
                                                        <option value="0"
                                                        @if(get_static_option('stripe_test_mode') == 0)
                                                        selected
                                                        @endif
                                                        >Disable</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label for="stripe_logo"><strong>{{__('Stripe Logo')}}</strong></label>
                                            <div class="media-upload-btn-wrapper">
                                                <div class="img-wrap">
                                                    @php
                                                        $stripe_img = get_attachment_image_by_id(get_static_option('stripe_preview_logo'),null,true);
                                                        $stripe_image_btn_label = __('Upload Image');
                                                    @endphp
                                                    @if (!empty($stripe_img))
                                                        <div class="attachment-preview">
                                                            <div class="thumbnail">
                                                                <div class="centered">
                                                                    <img class="avatar user-thumb" src="{{$stripe_img['img_url']}}" alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @php  $stripe_image_btn_label = __('Change Image'); @endphp
                                                    @endif
                                                </div>
                                                <input type="hidden" id="stripe_preview_logo" name="stripe_preview_logo" value="{{get_static_option('stripe_preview_logo')}}">
                                                <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                                    {{__($stripe_image_btn_label)}}
                                                </button>
                                            </div>
                                            <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')}}</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="stripe_public_key">{{__('Stripe Public Key')}}</label>
                                            <input type="text" name="stripe_public_key" id="stripe_public_key" value="{{get_static_option('stripe_public_key')}}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="stripe_secret_key">{{__('Stripe Secret')}}</label>
                                            <input type="text" name="stripe_secret_key" id="stripe_secret_key"  value="{{get_static_option('stripe_secret_key')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 justify-content-end" >
                                    <button type="submit" class="btn btn-primary" >Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('backend.partials.media-upload.media-upload-markup')
@endsection

@section('script')

    <!-- Start datatable js -->
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {

            $('.table-wrap > table').DataTable( {
                "order": [[ 0, "desc" ]],
                "columnDefs": [ {
                    "targets": 'no-sort',
                    "orderable": false,
                } ]
            } );
        } );
    </script>
    
    <script src="{{asset('assets/backend/js/summernote-bs4.js')}}"></script>
    <script src="{{asset('assets/backend/js/jquery.nice-select.min.js')}}"></script>
    <x-backend.auto-slug-js :url="route('admin.work.slug.check')" :type="'new'"/>
    <script>
        $(document).ready(function () {

            $('.summernote').summernote({
                height: 250,   //set editable area's height
                codemirror: { // codemirror options
                    theme: 'monokai'
                },
                callbacks: {
                    onChange: function(contents, $editable) {
                        let finalContenat =  iFrameFilterInSummernote(contents);
                        
                        $(this).prev('input').val(finalContenat);
                        console.log($(this).prev('input').val())
                    }
                }
            });
            
            if($('.summernote').length > 1){
                $('.summernote').each(function(index, value){
                    $(this).summernote('code', $(this).data('content'));
                });
            }

            if($('.nice-select').length > 0){
                $('.nice-select').niceSelect();
            }


            $(document).on('change','#language',function (e) {
                e.preventDefault();
                var selectedLang = $(this).val();
                $.ajax({
                    url : "{{route('admin.work.category.by.slug')}}",
                    type: "POST",
                    data: {
                        _token : "{{csrf_token()}}",
                        lang: selectedLang
                    },
                    success:function (data) {
                        $('#category').html('');
                        $.each(data,function (index,value) {
                            $('#category').append('<option value="'+value.id+'">'+value.name+'</option>');
                            $('.nice-select').niceSelect('update');
                        });
                    }
                });
            });
        });
    </script>
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    <script src="{{asset('assets/backend/js/bootstrap-tagsinput.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
@endsection