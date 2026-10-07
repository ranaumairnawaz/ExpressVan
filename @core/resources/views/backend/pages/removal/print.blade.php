<!doctype html>
<html class="no-js" lang="{{get_default_language()}}" dir="{{get_default_language_direction()}}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>

    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $site_favicon = get_attachment_image_by_id(get_static_option('site_favicon'), "full", false);
    @endphp
    @if (!empty($site_favicon))
        <link rel="icon" href="{{$site_favicon['img_url']}}" type="image/png">
    @endif
    <link rel="stylesheet" href="{{asset('assets/common/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/common/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/common/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/metisMenu.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/slicknav.min.css')}}">
    <!-- others css -->
    <link rel="stylesheet" href="{{asset('assets/backend/css/typography.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/default-css.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/fontawesome-iconpicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/nexicon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/custom-style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
        href="//cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0 !important;
        }

        div.dataTables_wrapper div.dataTables_length select {
            width: 60px;
            display: inline-block;
        }
    </style>
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
    <style>
        .invoice {
            background: #fff;
            padding: 20px
        }

        .invoice-company {
            font-size: 20px
        }

        .invoice-header {
            margin: 0 -20px;
            background: #f0f3f4;
            padding: 20px
        }

        .invoice-date,
        .invoice-from,
        .invoice-to {
            display: table-cell;
            width: 1%
        }

        .invoice-from,
        .invoice-to {
            padding-right: 20px
        }

        .invoice-date .date,
        .invoice-from strong,
        .invoice-to strong {
            font-size: 16px;
            font-weight: 600
        }

        .invoice-date {
            text-align: right;
            padding-left: 20px
        }

        .invoice-price {
            background: #f0f3f4;
            display: table;
            width: 100%
        }

        .invoice-price .invoice-price-left,
        .invoice-price .invoice-price-right {
            display: table-cell;
            padding: 20px;
            font-size: 20px;
            font-weight: 600;
            width: 75%;
            position: relative;
            vertical-align: middle
        }

        .invoice-price .invoice-price-left .sub-price {
            display: table-cell;
            vertical-align: middle;
            padding: 0 20px
        }

        .invoice-price small {
            font-size: 12px;
            font-weight: 400;
            display: block
        }

        .invoice-price .invoice-price-row {
            display: table;
            float: left
        }

        .invoice-price .invoice-price-right {
            width: 25%;
            background: #2d353c;
            color: #fff;
            font-size: 28px;
            text-align: right;
            vertical-align: bottom;
            font-weight: 300
        }

        .invoice-price .invoice-price-right small {
            display: block;
            opacity: .6;
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 12px
        }

        .invoice-footer {
            border-top: 1px solid #ddd;
            padding-top: 10px;
            font-size: 10px
        }

        .invoice-note {
            color: #999;
            margin-top: 80px;
            font-size: 85%
        }

        .invoice>div:not(.invoice-footer) {
            margin-bottom: 20px
        }

        .btn.btn-white,
        .btn.btn-white.disabled,
        .btn.btn-white.disabled:focus,
        .btn.btn-white.disabled:hover,
        .btn.btn-white[disabled],
        .btn.btn-white[disabled]:focus,
        .btn.btn-white[disabled]:hover {
            color: #2d353c;
            background: #fff;
            border-color: #d9dfe3;
        }

        @media print {
            .noprint {
                visibility: hidden;
            }
        }
    </style>
    @if(!empty(get_static_option('site_admin_dark_mode')))
        <link rel="stylesheet" href="{{asset('assets/backend/css/dark-mode.css')}}">
    @endif
    @if(get_default_language_direction() === 'rtl')
        <link rel="stylesheet" href="{{asset('assets/backend/css/rtl.css')}}">
    @endif
    <script>var siteurl = "{{url('/')}}"</script>
    <!-- modernizr css -->
    <script src="{{asset('assets/common/vendor/modernizr-2.8.3.min.js')}}"></script>
</head>

<body>

    <!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
    @if(!empty(get_static_option('disable_backend_preloader')))
        <div id="preloader">
            <div class="loader"></div>
        </div>
    @endif
    <div class="page-container">
        <div class="main-content">
            <div class="col-lg-12 col-ml-12 padding-bottom-30">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="margin-top-40"></div>
                        <x-error-msg />
                        <x-flash-msg />
                    </div>
                    <div class="col-lg-12 px-4">
                        <div class="invoice" style="box-shadow: rgba(0, 0, 0, 0.25) 0px 25px 50px -12px;">
                            <!-- begin invoice-company -->
                            <div class="invoice-company text-inverse d-flex justify-content-between align-items-center">
                                {!! render_image_markup_by_attachment_id(get_static_option('site_logo')) !!}
                            </div>
                            <!-- end invoice-company -->
                            <!-- begin invoice-header -->
                            <div class="invoice-header">
                                <div class="invoice-from">
                                    <small>from</small>
                                    <address class="m-t-5 m-b-5">
                                        <strong
                                            class="text-inverse">{{ get_static_option('site_en_US_title') }}</strong>
                                        <p>
                                            {{ getContactDetail('Email Address')->description }} </br>
                                            {{ getContactDetail('Phone')->description }} </br>
                                            {{ getContactDetail('Location')->description }} </br>
                                            {{ getContactDetail('Registration')->description }}
                                        </p>
                                    </address>
                                </div>
                                <div class="invoice-to">
                                    <small>to</small>
                                    <address class="m-t-5 m-b-5">
                                        <strong class="text-inverse">{{ $order->name }}</strong>
                                        <p>
                                            {{ $order->email }}</br>
                                            {{ $order->phone }}
                                        </p>
                                    </address>
                                </div>
                                <div class="invoice-date">
                                    <small>Order #{{ $order->trx }}</small>
                                    <div class="date text-inverse m-t-5">
                                        {{ date_format(date_create($order->created_at), "l jS \of F Y") }}</div>
                                    <div class="invoice-detail">
                                        Invoice for Packers and Shifters Booking @if($order->payment_status == 0)
                                        (UNPAID) @endif
                                    </div>
                                </div>
                            </div>
                            <!-- end invoice-header -->
                            <!-- begin invoice-content -->
                            <div class="invoice-content">
                                <!-- begin table-responsive -->
                                <div class="table-responsive">
                                    <table class="table table-invoice">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Locations</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $places = getOrderPlaces($order->trx);
                                            @endphp
                                            @foreach($places as $key => $place)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>
                                                        {{ $place->address }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-invoice">
                                        <thead>
                                            <tr>
                                                <th>ITEM</th>
                                                <th class="text-center" width="10%">QUANTITY</th>
                                                <th class="text-center" width="10%">UNIT</th>
                                                <th class="text-right" width="20%">PRICE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $order_bills = getOrderBills($order->trx);
                                            @endphp
                                            @foreach($order_bills as $ob)
                                                <tr>
                                                    <td>
                                                        <span class="text-inverse">{{ $ob->name }}</span><br>
                                                    </td>
                                                    <td class="text-center">
                                                        @if($ob->quantity != 0)
                                                            {{ $ob->quantity }}
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if($ob->unit != 0)
                                                            {{ $ob->unit }}
                                                        @endif
                                                    </td>
                                                    <td class="text-right">{{ $ob->price }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td>
                                                    <span class="text-inverse">SUBTOTAL</span><br>
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td class="text-right">{{ $order->price }}</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="text-inverse">TAX</span><br>
                                                </td>
                                                <td></td>
                                                <td class="text-center">{{ get_static_option('booking_tax') }}%</td>
                                                <td class="text-right">{{ $order->tax }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- end table-responsive -->
                                <!-- begin invoice-price -->
                                <div class="invoice-price">
                                    <div class="invoice-price-left">
                                        <div class="invoice-price-row">
                                            <div class="sub-price">
                                                @if($order->payment_status == 0)
                                                    <a class="badge badge-primary text-white rounded-pill px-3">UNPAID</a>
                                                @elseif($order->payment_status == 2)
                                                    <a class="badge badge-info text-white rounded-pill px-3">PARTIALY
                                                        PAID</a>
                                                @elseif($order->payment_status == 1)
                                                    <a class="badge badge-success text-white rounded-pill px-3">PAID</a>
                                                @elseif($order->payment_status == 3)
                                                    <a class="badge badge-danger text-white rounded-pill px-3">CANCELLED</a>
                                                @endif
                                                <!-- <span class="btn btn-sm btn-success p-1" >PAID</span> -->
                                            </div>
                                            <div class="sub-price">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="invoice-price-right">
                                        <small>TOTAL</small> <span class="f-w-600">{{ $order->total }}</span>
                                    </div>
                                </div>
                                <!-- end invoice-price -->
                            </div>
                            <!-- end invoice-content -->
                            <!-- begin invoice-note -->
                            <!-- end invoice-note -->
                            <!-- begin invoice-footer -->
                            <div class="invoice-footer text-center">
                                {!! get_footer_copyright_text() !!}
                            </div>
                            <!-- end invoice-footer -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="{{asset('assets/common/vendor/jquery-2.2.4.min.js')}}"></script>
    <script src="{{asset('assets/common/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/common/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/metisMenu.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/jquery.slicknav.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/fontawesome-iconpicker.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/sweetalert2.js')}}"></script>
    <script>
        function iFrameFilterInSummernote(contents) {

            let rawContents = contents;
            let matches = rawContents.match(/<iframe(.+)<\/iframe>/);
            let ifamemarkup = Array.isArray(matches) ? matches[0] : '';
            let srcMatches = ifamemarkup.match(/src="(.*?)"/);
            let ifameSrc = Array.isArray(srcMatches) ? srcMatches[0] : '';

            return rawContents.replace(/<iframe(.+)<\/iframe>/, '{iframe} {vsrc}="' + ifameSrc.replace('src="', '') + '{/iframe}');

        }
    </script>
    <script>
        function printInvoice() {
            var printContents = document.getElementById('invoice').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }

        window.addEventListener('afterprint', function () {
            window.close();
        });

        window.onload = function () {
            printInvoice();
        }
    </script>
    <script src="{{asset('assets/backend/js/plugins.js')}}"></script>
    <script src="{{asset('assets/backend/js/scripts.js')}}"></script>
    @if(!empty(get_static_option('site_admin_panel_nav_sticky')))
        <script>
                (function ($) {
                    "use strict";

                    $(document).ready(function ($) {

                        var parent = $("#menu");
                        var activeMenu = $('.metismenu > li.main_dropdown.active');
                        var markup = activeMenu.clone();
                        activeMenu.remove();
                        parent.prepend(markup);

                    });

                })(jQuery);
        </script>
    @endif
    <script>
        (function ($) {
            "use strict";

            $(document).ready(function ($) {

                $('input[type="date"]').datepicker({
                    format: 'yyyy-mm-dd'
                });

                $(document).on('click', '.swal_delete_button', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '{{__("Are you sure?")}}',
                        text: '{{__("You would not be able to revert this item!")}}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "{{__('Yes, delete it!')}}",
                        cancelButtonText: "{{__('cancel')}}",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.swal_form_submit_btn').trigger('click');
                        }
                    });
                });

                $(document).on('click', '.swal_change_language_button', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '{{__("Are you sure to make this language as a default language?")}}',
                        text: '{{__("Languages will be turn changed as default")}}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "{{__('Yes, Change it!')}}",
                        cancelButtonText: "{{__('cancel')}}",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.swal_form_submit_btn').trigger('click');
                        }
                    });
                });

                $(document).on('click', '.swal_change_approve_payment_button', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '{{__("Are you sure to approve this payment?")}}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "{{__('Yes, Accept it!')}}",
                        cancelButtonText: "{{__('cancel')}}",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.swal_form_submit_btn').trigger('click');
                        }
                    });
                });

            });

        })(jQuery);
    </script>
</body>

</html>