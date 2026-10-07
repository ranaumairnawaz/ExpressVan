@extends('backend.admin-master')
@section('site-title')
    {{__('Removal Email Templates')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/summernote-bs4.css')}}">
@endsection
@section('content')
    <div class="col-lg-12 col-xl-12 padding-bottom-30">
        <form action="{{ route('admin.removal.settings.email.save') }}" method="POST" >
            @csrf()
            <div class="row">
                <div class="col-lg-12">
                    <div class="margin-top-40"></div>
                    <x-error-msg/>
                    <x-flash-msg/>
                </div>
                <div class="col-lg-12 text-center" >
                    <h3>User Email Templates</h3>
                </div>
                <div class="col-lg-6 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">{{__('Order Creation User Email')}}</h4>
                            <div class="form-group" >
                                <label>Subject</label>
                                <input type="text" name="removal_order_placed_en_US_subject" value="{{ get_static_option('removal_order_placed_en_US_subject') }}" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="removal_order_placed_en_US_message">{{__('Message')}}</label>
                                <input type="hidden" name="removal_order_placed_en_US_message"  class="form-control" value="{{get_static_option('removal_order_placed_en_US_message')}}" >
                                <div class="summernote" data-content='{{get_static_option('removal_order_placed_en_US_message')}}'></div>
    
                                <small class="d-inline-block m-1 form-text text-muted text-danger"><code>@billing_name</code> </small>
                                <small class="d-inline-block m-1 form-text text-muted text-danger"><code>@order_billing_info</code> </small>
                                <small class="d-inline-block m-1 form-text text-muted text-danger"><code>@order_redirect_link</code> </small>
                                <small class="info-text">{{__('all above code will be replace dynamically')}}</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">{{__('Order Status Change Email')}}</h4>
                            <div class="form-group" >
                                <label>Subject</label>
                                <input type="text" name="removal_order_status_en_US_subject" value="{{ get_static_option('removal_order_status_en_US_subject') }}" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="removal_order_status_en_US_message">{{__('Message')}}</label>
                                <input type="hidden" name="removal_order_status_en_US_message"  class="form-control" value="{{get_static_option('removal_order_status_en_US_message')}}" >
                                <div class="summernote" data-content='{{get_static_option('removal_order_status_en_US_message')}}'></div>
    
                                <small class="d-inline-block m-1 form-text text-muted text-danger"><code>@order_status</code> </small>
                                <small class="d-inline-block m-1 form-text text-muted text-danger"><code>@order_id</code> </small>
                                <small class="d-inline-block m-1 form-text text-muted text-danger"><code>@order_redirect_link</code> </small>
                                <small class="info-text">{{__('all above code will be replace dynamically')}}</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">{{__('Order Payment Reminder Email')}}</h4>
                            <div class="form-group" >
                                <label>Subject</label>
                                <input type="text" name="removal_order_payment_reminder_en_US_subject" value="{{ get_static_option('removal_order_payment_reminder_en_US_subject') }}" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="removal_order_payment_reminder_en_US_message">{{__('Message')}}</label>
                                <input type="hidden" name="removal_order_payment_reminder_en_US_message"  class="form-control" value="{{get_static_option('removal_order_payment_reminder_en_US_message')}}" >
                                <div class="summernote" data-content='{{get_static_option('removal_order_payment_reminder_en_US_message')}}'></div>
    
                                <small class="d-inline-block m-1 form-text text-muted text-danger"><code>@order_id</code> </small>
                                <small class="d-inline-block m-1 form-text text-muted text-danger"><code>@billing_name</code> </small>
                                <small class="d-inline-block m-1 form-text text-muted text-danger"><code>@full_payment</code> </small>
                                <small class="d-inline-block m-1 form-text text-muted text-danger"><code>@order_redirect_link</code> </small>
                                <small class="info-text">{{__('all above code will be replace dynamically')}}</small>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                    $statuses = ['full', 'advance', 'remaining'];
                @endphp
                
                @foreach ($statuses as $status)
                    <div class="col-lg-4 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">{{ __("Order " . ucfirst($status) . " Payment") }}</h4>
                                <div class="form-group">
                                    <label>Subject</label>
                                    <input 
                                        type="text" 
                                        name="removal_order_payment_accept_{{ $status }}_en_US_subject" 
                                        value="{{ get_static_option('removal_order_payment_accept_' . $status . '_en_US_subject') }}" 
                                        class="form-control" 
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="removal_order_payment_accept_{{ $status }}_en_US_message">{{ __('Message') }}</label>
                                    <input 
                                        type="hidden" 
                                        name="removal_order_payment_accept_{{ $status }}_en_US_message" 
                                        class="form-control" 
                                        value="{{ get_static_option('removal_order_payment_accept_' . $status . '_en_US_message') }}" 
                                    >
                                    <div 
                                        class="summernote" 
                                        data-content='{{ get_static_option('removal_order_payment_accept_' . $status . '_en_US_message') }}'>
                                    </div>
                                    <small class="d-inline-block m-1 form-text text-muted text-danger"><code>@billing_name</code> </small>
                                    <small class="d-inline-block m-1 form-text text-muted text-danger"><code>@order_billing_info</code> </small>
                                    <small class="d-inline-block m-1 form-text text-muted text-danger"><code>@order_redirect_link</code> </small>
                                    <small class="info-text">{{ __('all above code will be replaced dynamically') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                
                <div class="col-lg-12 mt-5 text-center" >
                    <h3>Admin Email Templates</h3>
                </div>
                
                <div class="col-lg-6 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">{{__('Order Creation Admin Email')}}</h4>
                            <div class="form-group" >
                                <label>Subject</label>
                                <input type="text" name="removal_order_admin_mail_en_US_subject" value="{{ get_static_option('removal_order_admin_mail_en_US_subject') }}" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="removal_order_admin_mail_en_US_nessage">{{__('Message')}}</label>
                                <input type="hidden" name="removal_order_admin_mail_en_US_nessage"  class="form-control" value="{{get_static_option('removal_order_admin_mail_en_US_nessage')}}" >
                                <div class="summernote" data-content='{{get_static_option('removal_order_admin_mail_en_US_nessage')}}'></div>
    
                                <small class="d-inline-block m-1 form-text text-muted text-danger"><code>@order_id</code> </small>
                                <small class="d-inline-block m-1 form-text text-muted text-danger"><code>@billing_name</code> </small>
                                <small class="d-inline-block m-1 form-text text-muted text-danger"><code>@order_billing_info</code> </small>
                                <small class="d-inline-block m-1 form-text text-muted text-danger"><code>@order_date</code> </small>
                                <small class="d-inline-block m-1 form-text text-muted text-danger"><code>@payment_gateway</code> </small>
                                <small class="info-text">{{__('all above code will be replace dynamically')}}</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                @foreach ($statuses as $status)
                    <div class="col-lg-6 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">{{ __(ucfirst($status) . " Payment Admin Email") }}</h4>
                                <div class="form-group">
                                    <label>Subject</label>
                                    <input 
                                        type="text" 
                                        name="removal_order_{{ $status }}_payment_admin_mail_en_US_subject" 
                                        value="{{ get_static_option('removal_order_' . $status . '_payment_admin_mail_en_US_subject') }}" 
                                        class="form-control" 
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="removal_order_{{ $status }}_payment_admin_mail_en_US_message">{{ __('Message') }}</label>
                                    <input 
                                        type="hidden" 
                                        name="removal_order_{{ $status }}_payment_admin_mail_en_US_message" 
                                        class="form-control" 
                                        value="{{ get_static_option('removal_order_' . $status . '_payment_admin_mail_en_US_message') }}" 
                                    >
                                    <div 
                                        class="summernote" 
                                        data-content='{{ get_static_option('removal_order_' . $status . '_payment_admin_mail_en_US_message') }}'>
                                    </div>
                                    <small class="d-inline-block m-1 form-text text-muted text-danger"><code>@billing_name</code> </small>
                                    <small class="d-inline-block m-1 form-text text-muted text-danger"><code>@order_billing_info</code> </small>
                                    <small class="d-inline-block m-1 form-text text-muted text-danger"><code>@order_redirect_link</code> </small>
                                    <small class="info-text">{{ __('all above code will be replaced dynamically') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                
                <div class="col-lg-12 d-flex w-100 justify-content-end px-5 mt-2" >
                    <button type="submit" class="btn btn-primary" >Update</button>
                </div>
                
                
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            var SummerNoteSelector = $('.summernote');
            SummerNoteSelector.summernote({
                height: 200,   //set editable area's height
                codemirror: { // codemirror options
                    theme: 'monokai'
                },
                callbacks: {
                    onChange: function(contents, $editable) {
                        $(this).prev('input').val(contents);
                    },
                    onPaste: function (e) {
                        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                        e.preventDefault();
                        document.execCommand('insertText', false, bufferText);
                    }
                },
                toolbar: [
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']],
                ],

            });
            if(SummerNoteSelector.length > 0){
                SummerNoteSelector.each(function(index,value){
                    $(this).summernote('code', $(this).data('content'));
                });
            }
        });
    </script>
    <script src="{{asset('assets/backend/js/summernote-bs4.js')}}"></script>
@endsection