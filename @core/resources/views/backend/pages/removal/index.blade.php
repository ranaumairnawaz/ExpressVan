@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0 !important;
        }

        div.dataTables_wrapper div.dataTables_length select {
            width: 60px;
            display: inline-block;
        }

        .pac-container {
            z-index: 10000 !important;
        }

        /* Styling for the new standard Place Autocomplete elements */
        gmp-place-autocomplete {
            width: 100%;
        }

        gmp-place-autocomplete input {
            display: block;
            width: 100%;
            height: calc(1.5em + 0.75rem + 2px);
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 4px;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        gmp-place-autocomplete input:focus {
            color: #495057;
            background-color: #fff;
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
        }

        /* Floating Price Badge Styling */
        #quick_booking_modal .modal-content {
            position: relative;
        }

        .floating-price-badge {
            position: fixed;
            bottom: 30px;
            left: 40px;
            z-index: 1060;
            background: linear-gradient(135deg, #1d2d50 0%, #133b5c 100%);
            color: #fff;
            padding: 15px 25px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border: 2px solid rgba(255, 255, 255, 0.15);
            transition: all 0.3s ease;
            text-align: center;
        }

        .floating-price-badge:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
        }

        .floating-price-badge span.label {
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: 1px;
            color: #cbd5e1;
            font-weight: bold;
            margin-bottom: 2px;
        }

        .floating-price-badge span.price-value {
            font-size: 1.6rem;
            font-weight: 800;
            color: #00f2fe;
            margin-bottom: 8px;
        }

        .floating-price-badge .btn-refresh-price {
            background-color: #00f2fe;
            color: #121f3d;
            border: none;
            font-weight: bold;
            font-size: 12px;
            padding: 5px 15px;
            border-radius: 30px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .floating-price-badge .btn-refresh-price:hover {
            background-color: #ffffff;
            color: #133b5c;
            transform: scale(1.05);
        }

        .floating-price-badge .btn-refresh-price:focus {
            outline: none;
        }
    </style>
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
@endsection
@section('site-title')
    {{__('Removal Orders')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-error-msg />
                <x-flash-msg />
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <h4 class="header-title">{{ $type }} {{__('Removal Orders')}}</h4>
                            <div class="btn-wrapper">
                                <a href="#" data-toggle="modal" data-target="#quick_booking_modal"
                                    class="btn btn-primary mb-3">{{__('Quick Booking')}}</a>
                            </div>
                        </div>
                        <div class="table-wrap table-responsive">
                            <table class="table table-default" id="all_blog_table">
                                <thead>
                                    <th>{{__('ID')}}</th>
                                    <th>{{__('Order #')}}</th>
                                    <th>{{__('Date')}}</th>
                                    <th>{{__('User')}}</th>
                                    <th>{{__('Distance')}}</th>
                                    <th>{{__('Total Price')}}</th>
                                    <th>{{__('Statuses')}}</th>
                                    <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                    @foreach($orders as $data)
                                        <tr>
                                            <td>{{$data->id}}</td>
                                            <td>{{$data->trx}}</td>
                                            <td>{{$data->date}}</td>
                                            <td>
                                                {{ $data->name }}</br>
                                                {{ $data->email }}</br>
                                                {{ $data->phone }}
                                                @if($data->lead_source)
                                                    </br><span class="badge badge-secondary p-1">{{$data->lead_source}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $data->distance }} Miles
                                            </td>
                                            <td>
                                                <span>{{amount_with_currency_symbol($data->total)}}</span>
                                            </td>
                                            <td>
                                                @if($data->status == 0)
                                                    @if($data->payment_status == 0)
                                                        <span class="alert alert-warning">Unpaid & Pending</span>
                                                    @elseif($data->payment_status == 1)
                                                        <span class="alert alert-warning">Fully Paid & Pending</span>
                                                    @elseif($data->payment_status == 2)
                                                        <span class="alert alert-warning">Partialy Paid & Pending</span>
                                                    @endif
                                                @elseif($data->status == 1)
                                                    @if($data->payment_status == 0)
                                                        <span class="alert alert-info">Unpaid & Ongoing</span>
                                                    @elseif($data->payment_status == 1)
                                                        <span class="alert alert-info">Fully Paid & Ongoing</span>
                                                    @elseif($data->payment_status == 2)
                                                        <span class="alert alert-info">Partialy Paid & Ongoing</span>
                                                    @endif
                                                @elseif($data->status == 2)
                                                    @if($data->payment_status == 1)
                                                        <span class="alert alert-success">Fully Paid & Completed</span>
                                                    @elseif($data->payment_status == 2)
                                                        <span class="alert alert-danger">Partialy Paid & Completed</span>
                                                    @endif
                                                @elseif($data->status == 3)
                                                    @if($data->payment_status == 0)
                                                        <span class="alert alert-danger">Unpaid & Cancelled</span>
                                                    @elseif($data->payment_status == 1)
                                                        <span class="alert alert-danger">Fully Paid & Cancelled</span>
                                                    @elseif($data->payment_status == 2)
                                                        <span class="alert alert-danger">Partialy Paid & Cancelled</span>
                                                    @endif
                                                @elseif($data->status == 4)
                                                    <span class="alert alert-danger">Cancelled & Refunded</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($data->is_deleted == 0)
                                                    <x-delete-popover :url="route('admin.removal.delete', $data->id)" />
                                                @else
                                                    <a href="{{ route('admin.removal.recover', $data->trx) }}"
                                                        class="btn btn-success btn-xs mb-3 mr-1">
                                                        <i class="fas fa-recycle"></i>
                                                    </a>
                                                    <x-delete-popover :url="route('admin.removal.delete.permanent', $data->id)"
                                                        :title="__('Permanent Delete')" />
                                                @endif
                                                <a href="{{ route('admin.removal.view', $data->trx) }}"
                                                    class="btn btn-info btn-xs mb-3 mr-1">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="quick_booking_modal" aria-hidden="true">
        <div class="floating-price-badge d-none" id="quick_book_floating_tally">
            <span class="label">{{__('Estimated Total')}}</span>
            <span class="price-value" id="quick_book_total_price">{{site_currency_symbol()}}0.00</span>

            <div id="floating_price_breakdown"
                style="font-size: 11px; color: #cbd5e1; margin-bottom: 8px; text-align: left; display: none; width: 100%;">
                <div class="d-flex justify-content-between mb-1"
                    style="gap: 15px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 3px;">
                    <span>{{__('Mileage:')}}</span>
                    <span id="floating_mileage_charge">£0.00</span>
                </div>
                <div class="d-flex justify-content-between mb-1"
                    style="gap: 15px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 3px;">
                    <span>{{__('Zones:')}}</span>
                    <span id="floating_zone_charge">£0.00</span>
                </div>
                <div class="d-flex justify-content-between mb-1"
                    style="gap: 15px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 3px;">
                    <span>{{__('Floor Charges:')}}</span>
                    <span id="floating_floor_charge">£0.00</span>
                </div>
                <div class="d-flex justify-content-between mb-1"
                    style="gap: 15px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 3px;">
                    <span>{{__('Parking Fee:')}}</span>
                    <span id="floating_parking_charge">£0.00</span>
                </div>
                <div class="d-flex justify-content-between" style="gap: 15px;">
                    <span>{{__('Tax:')}}</span>
                    <span id="floating_tax_charge">£0.00</span>
                </div>
            </div>

            <button type="button" class="btn-refresh-price" id="btn_manual_refresh_price">
                <i class="fas fa-sync-alt"></i> {{__('Refresh Price')}}
            </button>
        </div>

        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Quick Booking / Lead Entry')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{route('admin.removal.quick.book')}}" method="post">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{__('Customer Name')}}</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">{{__('Customer Email')}}</label>
                                    <input type="email" class="form-control" id="customer_email" name="email" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">{{__('Customer Phone')}}</label>
                                    <input type="text" class="form-control" name="phone" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lead_source">{{__('Lead Source')}}</label>
                                    <select name="lead_source" class="form-control">
                                        @foreach($lead_sources as $source)
                                            <option value="{{$source->name}}">{{$source->name}}</option>
                                        @endforeach
                                        <option value="Others">{{__('Others')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="date">{{__('Booking Date')}}</label>
                                    <input type="date" class="form-control" name="date" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="time">{{__('Booking Time')}}</label>
                                    <input type="time" class="form-control" name="time" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="coupon">{{__('Coupon Code')}}</label>
                                    <input type="text" class="form-control" id="coupon_code" name="coupon"
                                        placeholder="{{__('Optional')}}">
                                    <div id="coupon-feedback-msg"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="service_id">{{__('Service')}}</label>
                                    <select name="service_id" class="form-control" required>
                                        @foreach($all_services as $service)
                                            <option value="{{$service->id}}">{{$service->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="van_id">{{__('Van Type')}}</label>
                                    <select name="van_id" class="form-control" required>
                                        @foreach($van_types as $van)
                                            <option value="{{$van->id}}">{{$van->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="helpers">{{__('Helpers')}}</label>
                                    <select name="helpers" class="form-control">
                                        <option value="0">{{__('No Helper')}}</option>
                                        @foreach($helpers as $helper)
                                            <option value="{{$helper->id}}">{{$helper->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="duration">{{__('Duration (Hrs)')}}</label>
                                    <input type="number" class="form-control" name="duration" id="duration" value="1"
                                        min="0.5" step="0.5" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="insurance">{{__('Insurance')}}</label>
                                    <select name="insurance" id="quick_book_insurance" class="form-control">
                                        <option value="0">{{__('No Insurance')}}</option>
                                        @foreach($insurances as $ins)
                                            <option value="{{$ins->id}}">{{__('Cover')}}
                                                {{amount_with_currency_symbol($ins->cover)}}
                                                (+{{amount_with_currency_symbol($ins->price)}})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 mt-2 mb-3" id="van-helper-selection-details" style="display:none;">
                                <div class="p-3 bg-light rounded border">
                                    <h6 class="text-primary mb-2 font-weight-bold"><i class="fas fa-truck"></i>
                                        {{ __('Selected Van & Helper Configuration') }}</h6>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span><strong id="selected_van_name">-</strong></span>
                                                <span class="badge badge-info" id="selected_van_price_badge">-</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span><strong id="selected_helper_name">-</strong></span>
                                                <span class="badge badge-info" id="selected_helper_price_badge">-</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top pt-2 mt-1 d-flex justify-content-between font-weight-bold">
                                        <span>{{ __('Duration:') }} <span id="selected_duration_text">-</span></span>
                                        <span>{{ __('Subtotal (Van + Helpers):') }} <span
                                                id="van_helper_subtotal">-</span></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mt-2">
                                <h6 class="border-bottom pb-2 mb-3 text-info"><i class="fas fa-map-marker-alt"></i>
                                    {{__('Pickup Details')}}</h6>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="pickup_address">{{__('Pickup Search')}}</label>
                                    <input type="text" class="form-control" name="pickup_address" id="pickup_address"
                                        placeholder="{{__('Search Pickup Address')}}" required>
                                    <input type="hidden" name="pickup_city" id="pickup_city">
                                </div>
                            </div>
                            <div class="col-md-4 house-lookups" id="pickup-lookup-container" data-postcode="">
                                <div class="form-group">
                                    <label for="pickup_house">{{__('House/Flat')}} (*)</label>
                                    <select class="form-control house-select d-none mb-2"
                                        onchange="toggleHouseInputVariant(this)">
                                        <option value="" disabled selected>Loading addresses...</option>
                                    </select>
                                    <input type="text" class="form-control text-box-input" name="pickup_house"
                                        id="pickup_house">
                                    <small class="text-info d-none loading-msg pt-1"><i class="fa fa-spinner fa-spin"></i>
                                        Fetching registered addresses...</small>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="pickup_postcode">{{__('Postcode')}}</label>
                                    <input type="text" class="form-control" name="pickup_postcode" id="pickup_postcode"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="pickup_floor">{{__('Floor')}}</label>
                                    <select name="pickup_floor" required class="form-control">
                                        <option value="">{{__('Select Floor')}}</option>
                                        @foreach($floors as $floor)
                                            <option value="{{$floor->id}}">{{$floor->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="pickup_elevator">{{__('Elevator')}}</label>
                                    <select name="pickup_elevator" required class="form-control">
                                        <option value="0" selected="">{{__('No')}}</option>
                                        <option value="1">{{__('Yes')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="pickup_parking">{{__('Parking')}}</label>
                                    <select name="pickup_parking" required class="form-control">
                                        <option value="">{{__('Select Parking')}}</option>
                                        @foreach($parkings as $parking)
                                            <option value="{{$parking->id}}">{{$parking->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">
                                <h6 class="border-bottom pb-2 mb-3 text-info"><i class="fas fa-map-pin"></i>
                                    {{__('Destination Details')}}</h6>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="destination_address">{{__('Destination Search')}}</label>
                                    <input type="text" class="form-control" name="destination_address"
                                        id="destination_address" placeholder="{{__('Search Destination Address')}}"
                                        required>
                                    <input type="hidden" name="destination_city" id="destination_city">
                                </div>
                            </div>
                            <div class="col-md-4 house-lookups" id="destination-lookup-container" data-postcode="">
                                <div class="form-group">
                                    <label for="destination_house">{{__('House/Flat')}} (*)</label>
                                    <select class="form-control house-select d-none mb-2"
                                        onchange="toggleHouseInputVariant(this)">
                                        <option value="" disabled selected>Loading addresses...</option>
                                    </select>
                                    <input type="text" class="form-control text-box-input" name="destination_house"
                                        id="destination_house">
                                    <small class="text-info d-none loading-msg pt-1"><i class="fa fa-spinner fa-spin"></i>
                                        Fetching registered addresses...</small>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="destination_postcode">{{__('Postcode')}}</label>
                                    <input type="text" class="form-control" name="destination_postcode"
                                        id="destination_postcode" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="destination_floor">{{__('Floor')}}</label>
                                    <select name="destination_floor" required class="form-control">
                                        <option value="">{{__('Select Floor')}}</option>
                                        @foreach($floors as $floor)
                                            <option value="{{$floor->id}}">{{$floor->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="destination_elevator">{{__('Elevator')}}</label>
                                    <select name="destination_elevator" required class="form-control">
                                        <option value="0" selected="">{{__('No')}}</option>
                                        <option value="1">{{__('Yes')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="destination_parking">{{__('Parking')}}</label>
                                    <select name="destination_parking" class="form-control" required>
                                        <option value="">{{__('Select Parking')}}</option>
                                        @foreach($parkings as $parking)
                                            <option value="{{$parking->id}}">{{$parking->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 mt-3" id="live-route-fees-panel" style="display:none;">
                                <div class="alert alert-warning d-flex justify-content-between align-items-center mb-0">
                                    <span><strong>{{ __('Route Adjustments Applied:') }}</strong></span>
                                    <span>{{ __('Mileage/Gas Charge:') }} <span id="lbl_mileage_charge">£0.00</span></span>
                                    <span>{{ __('Special Zones Surcharge:') }} <span id="lbl_zone_fee">£0.00</span></span>
                                </div>
                            </div>

                            <div class="col-md-12 mt-3" id="booking-tax-panel" style="display:none;">
                                <div class="alert alert-secondary d-flex justify-content-between align-items-center mb-0">
                                    <span><strong>{{ __('Booking Tax:') }}</strong></span>
                                    <span>{{ __('Tax Rate:') }}
                                        <span>{{ get_static_option('booking_tax') ?? 0 }}%</span></span>
                                    <span>{{ __('Calculated Tax:') }} <span id="lbl_tax_charge"
                                            class="font-weight-bold">£0.00</span></span>
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">
                                <h6 class="border-bottom pb-2 mb-3 text-info"><i class="fas fa-clipboard-list"></i>
                                    {{__('Additional Details')}}</h6>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="contents_to_move">{{__('Contents to Move (Checklist/Key Items)')}}</label>
                                    <textarea class="form-control" name="contents_to_move" rows="3"
                                        placeholder="{{__('e.g., 2 Bedroom Flat, Piano, Heavy Wardrobe...')}}"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="admin_notes">{{__('Admin Notes (Internal)')}}</label>
                                    <textarea class="form-control" name="admin_notes" rows="3"
                                        placeholder="{{__('e.g., Customer is very concerned about the piano.')}}"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="send_email" id="send_email">
                                    <label class="form-check-label"
                                        for="send_email">{{__('Send Booking Email to Customer')}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Create Booking')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @php
        $zipcodes = getSpecialZipCodes();
    @endphp

    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.table-wrap > table').DataTable({
                "order": [[0, "desc"]],
                "columnDefs": [{
                    "targets": 'no-sort',
                    "orderable": false,
                }]
            });
        });
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{ get_static_option('google_api_key') }}&callback=initAutocomplete&libraries=places&v=weekly"></script>

    <script>
        (function ($) {
            "use strict";

            // Expose calculateQuickBookPrice globally so it can be called anywhere safely
            window.calculateQuickBookPrice = function () {
                let total = 0;
                const currency_symbol = "{{ site_currency_symbol() }}";
                const tax_percentage = parseFloat("{{ get_static_option('booking_tax') ?? 0 }}");

                const van_types = @json($van_types ?? []);
                const helpers_data = @json($helpers ?? []);
                const floors_data = @json($floors ?? []);
                const parkings_data = @json($parkings ?? []);
                const insurances_data = @json($insurances ?? []);

                // 1. Van Pricing Calculations
                const van_id = $('select[name="van_id"]').val();
                const duration = parseFloat($('input[name="duration"]').val()) || 0;
                const van = van_types.find(v => v.id == van_id);
                if (van) {
                    total += parseFloat(van.price) * duration;
                }

                // 2. Helpers Configuration additions
                const helper_id = $('select[name="helpers"]').val();
                const helper = helpers_data.find(h => h.id == helper_id);
                let persons = 0;
                if (helper) {
                    total += parseFloat(helper.price) * duration;
                    persons = parseInt(helper.persons) || 0;
                }

                // 3. Multi-floor and Elevator matrix parsing 
                const pickup_floor_id = $('select[name="pickup_floor"]').val();
                const dest_floor_id = $('select[name="destination_floor"]').val();
                const pickup_elevator = $('select[name="pickup_elevator"]').val();
                const dest_elevator = $('select[name="destination_elevator"]').val();

                if (pickup_floor_id) {
                    const floor = floors_data.find(f => f.id == pickup_floor_id);
                    if (floor) {
                        total += (pickup_elevator == 1) ? (parseFloat(floor.elevator_price) * (persons > 0 ? persons : 1)) : (parseFloat(floor.simple_price) * (persons > 0 ? persons : 1));
                    }
                }
                if (dest_floor_id) {
                    const floor = floors_data.find(f => f.id == dest_floor_id);
                    if (floor) {
                        total += (dest_elevator == 1) ? (parseFloat(floor.elevator_price) * (persons > 0 ? persons : 1)) : (parseFloat(floor.simple_price) * (persons > 0 ? persons : 1));
                    }
                }

                // 4. Parking Permits Logic Block
                const pickup_parking_id = $('select[name="pickup_parking"]').val();
                const dest_parking_id = $('select[name="destination_parking"]').val();
                if (pickup_parking_id) {
                    const parking = parkings_data.find(p => p.id == pickup_parking_id);
                    if (parking) total += parseFloat(parking.price);
                }
                if (dest_parking_id) {
                    const parking = parkings_data.find(p => p.id == dest_parking_id);
                    if (parking) total += parseFloat(parking.price);
                }

                // 5. Insurance Cover Packages
                const insurance_id = $('select[name="insurance"]').val();
                const insurance = insurances_data.find(i => i.id == insurance_id);
                if (insurance) {
                    total += parseFloat(insurance.price);
                }

                // 6. Dynamic Route Charges Addition
                if (typeof window.gasMileageCharge === 'number') total += window.gasMileageCharge;
                if (typeof window.specialZonesCharge === 'number') total += window.specialZonesCharge;

                // 7. Coupon Calculations Logic
                if (typeof window.activeCouponDiscount === 'number' && window.activeCouponDiscount > 0) {
                    if (window.activeCouponType === 'percentage') {
                        total -= (total * window.activeCouponDiscount) / 100;
                    } else {
                        total -= window.activeCouponDiscount;
                    }
                }

                // Calculate and update Van & Helper Selection Details UI
                let van_cost = 0;
                let helper_cost = 0;

                if (van) {
                    van_cost = parseFloat(van.price) * duration;
                    $('#selected_van_name').text(van.name);
                    $('#selected_van_price_badge').text(currency_symbol + parseFloat(van.price).toFixed(2) + '/hr × ' + duration + ' hr = ' + currency_symbol + van_cost.toFixed(2));
                } else {
                    $('#selected_van_name').text('-');
                    $('#selected_van_price_badge').text('-');
                }

                if (helper) {
                    helper_cost = parseFloat(helper.price) * duration;
                    $('#selected_helper_name').text(helper.name);
                    $('#selected_helper_price_badge').text(currency_symbol + parseFloat(helper.price).toFixed(2) + '/hr × ' + duration + ' hr = ' + currency_symbol + helper_cost.toFixed(2));
                } else {
                    $('#selected_helper_name').text("{{ __('No Helper') }}");
                    $('#selected_helper_price_badge').text(currency_symbol + '0.00/hr × ' + duration + ' hr = ' + currency_symbol + '0.00');
                }

                $('#selected_duration_text').text(duration + (duration === 1 ? ' Hr' : ' Hrs'));
                $('#van_helper_subtotal').text(currency_symbol + (van_cost + helper_cost).toFixed(2));

                if (van || helper || duration > 0) {
                    $('#van-helper-selection-details').slideDown();
                } else {
                    $('#van-helper-selection-details').slideUp();
                }

                // 8. Apply tax variables
                const tax = (total * tax_percentage) / 100;
                total += tax;

                // Force rendering directly to UI element
                $('#quick_book_total_price').text(currency_symbol + total.toFixed(2));
                $('#floating_tax_charge').text(currency_symbol + tax.toFixed(2));
                $('#lbl_tax_charge').text(currency_symbol + tax.toFixed(2));

                if (tax_percentage > 0) {
                    $('#booking-tax-panel').show();
                } else {
                    $('#booking-tax-panel').hide();
                }
            };

            $(document).ready(function () {

                // Assign scope elements directly onto global window wrapper
                window.activeCouponDiscount = 0;
                window.activeCouponType = 'fixed';
                window.gasMileageCharge = 0;
                window.specialZonesCharge = 0;

                const goAddressApiKey = "{{ get_static_option('go_address_api_key') }}";
                const goAddressStatus = "{{ get_static_option('go_address_status') }}";

                const perMilePrice = parseFloat("{{ get_static_option('per_km_price') ?? 0 }}");
                const congestionChargeRate = parseFloat("{{ get_static_option('congestion_charge') ?? 15.00 }}");
                const ulezChargeRate = parseFloat("{{ get_static_option('ultra_low_emission_charge') ?? 12.50 }}");

                const zipcodes = @json($zipcodes ?? []);
                console.log(zipcodes);
                const currency_symbol = "{{ site_currency_symbol() }}";

                function extractZipCode(address) {
                    const zipRegex = /\b([A-Z]{1,2}\d[A-Z\d]? ?\d[A-Z]{2}|GIR ?0AA)\b/i;  // Strict UK Postcode regex
                    const match = address.match(zipRegex);
                    return match ? match[0].toUpperCase() : null;
                }

                // ========================================================
                // FIXED: Accurate UK Full and Partial Outcode matching logic
                // ========================================================
                function matchPostcodeZone(postcode, dbCode) {
                    if (!postcode || !dbCode) return false;

                    const cleanPostcode = postcode.toUpperCase().replace(/\s+/g, '');
                    const cleanDbCode = dbCode.toUpperCase().replace(/\s+/g, '');

                    // 1. Direct Exact Match (e.g., "SE14" === "SE14")
                    if (cleanPostcode === cleanDbCode) {
                        return true;
                    }

                    // 2. Extract Outward Part from Input Postcode (Slice last 3 chars if it's a full postcode)
                    let outwardInput = cleanPostcode;
                    if (cleanPostcode.length > 4) {
                        outwardInput = cleanPostcode.slice(0, -3);
                    }

                    // 3. Extract Outward Part from DB Code
                    let outwardDb = cleanDbCode;
                    if (cleanDbCode.length > 4) {
                        outwardDb = cleanDbCode.slice(0, -3);
                    }

                    // 4. Check if Outward match is exact (e.g. "SE14" === "SE14")
                    if (outwardInput === outwardDb) {
                        return true;
                    }

                    // 5. Broad Prefix Matching (e.g., DB has "SE", Input has "SE14")
                    if (outwardInput.startsWith(outwardDb)) {
                        const remaining = outwardInput.slice(outwardDb.length);
                        // Prevent false matches like "W10" matching DB "W1"
                        if (remaining.length > 0 && /^\d/.test(remaining) && !/^\d/.test(outwardDb.charAt(outwardDb.length - 1))) {
                            return false;
                        }
                        return true;
                    }

                    return false;
                }

                // Component Autocomplete Initializer
                window.initAutocomplete = function () {
                    const pickupInput = document.getElementById('pickup_address');
                    const destInput = document.getElementById('destination_address');

                    if (!pickupInput || !destInput) return;

                    const options = {
                        componentRestrictions: { country: 'gb' }
                    };

                    const pickupAutocomplete = new google.maps.places.Autocomplete(pickupInput, options);
                    const destAutocomplete = new google.maps.places.Autocomplete(destInput, options);

                    pickupAutocomplete.addListener('place_changed', function () {
                        const place = pickupAutocomplete.getPlace();
                        handleAutocompleteSelection(place, 'pickup');
                    });

                    destAutocomplete.addListener('place_changed', function () {
                        const place = destAutocomplete.getPlace();
                        handleAutocompleteSelection(place, 'destination');
                    });
                };

                function handleAutocompleteSelection(place, type) {
                    if (!place || !place.address_components) {
                        console.warn("handleAutocompleteSelection: no place prediction");
                        window.calculateQuickBookPrice();
                        return;
                    }

                    let postcode = "";
                    let city = "";
                    const components = place.address_components || [];
                    for (const component of components) {
                        const types = component.types || [];
                        if (types.includes("postal_code")) postcode = component.long_name || "";
                        if (types.includes("postal_town") || types.includes("locality")) city = component.long_name || "";
                    }

                    const formattedAddress = place.formatted_address || '';

                    if (type === 'pickup') {
                        document.getElementById('pickup_address').value = formattedAddress;
                        document.getElementById('pickup_postcode').value = postcode;
                        document.getElementById('pickup_city').value = city;
                        $('#pickup-lookup-container').attr('data-postcode', postcode);
                        fetchGoAddresses('pickup-lookup-container', postcode);
                    } else {
                        document.getElementById('destination_address').value = formattedAddress;
                        document.getElementById('destination_postcode').value = postcode;
                        document.getElementById('destination_city').value = city;
                        $('#destination-lookup-container').attr('data-postcode', postcode);
                        fetchGoAddresses('destination-lookup-container', postcode);
                    }

                    // Auto-update dynamic route fees
                    fetchDynamicRouteFees();
                }

                // Call initialization safely inside document ready layout loop
                if (typeof google === 'object' && google.maps && google.maps.places) {
                    window.initAutocomplete();
                }

                // Address Lookup Module
                function fetchGoAddresses(containerId, postcode) {
                    const container = document.getElementById(containerId);
                    if (!container) return;

                    const select = container.querySelector('.house-select');
                    const manualInput = container.querySelector('.text-box-input');
                    const loadingMsg = container.querySelector('.loading-msg');

                    if (goAddressStatus !== "1" || !goAddressApiKey || !postcode) {
                        if (select) select.classList.add('d-none');
                        if (manualInput) manualInput.classList.remove('d-none');
                        if (loadingMsg) loadingMsg.classList.add('d-none');
                        return;
                    }

                    if (loadingMsg) loadingMsg.classList.remove('d-none');

                    fetch(`https://portal.goaddress.io/api/address/${encodeURIComponent(postcode)}`, {
                        headers: {
                            'Authorization': `Bearer ${goAddressApiKey}`,
                            'Accept': 'application/json'
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            if (loadingMsg) loadingMsg.classList.add('d-none');

                            let addresses = [];
                            if (Array.isArray(data)) addresses = data;
                            else if (data && Array.isArray(data.result)) addresses = data.result;
                            else if (data && Array.isArray(data.addresses)) addresses = data.addresses;
                            else if (data && Array.isArray(data.data)) addresses = data.data;

                            if (addresses.length > 0 && select && manualInput) {
                                select.classList.remove('d-none');
                                if (!manualInput.value) {
                                    manualInput.classList.add('d-none');
                                } else {
                                    select.value = 'manual_entry';
                                }

                                select.innerHTML = '<option value="" disabled selected>Select address...</option><option value="manual_entry">-- Enter Manually / Not Listed --</option>';

                                const uniqueAddresses = new Set();
                                addresses.forEach(address => {
                                    let fullLine = '';
                                    if (typeof address === 'string') {
                                        fullLine = address;
                                    } else if (address && typeof address === 'object') {
                                        if (address.formatted_address) fullLine = address.formatted_address;
                                        else if (address.address) fullLine = address.address;
                                        else {
                                            const parts = [address.line_1 || address.address_line_1, address.line_2, address.town || address.city].filter(Boolean);
                                            fullLine = parts.join(', ');
                                        }
                                    }

                                    if (fullLine && !uniqueAddresses.has(fullLine)) {
                                        uniqueAddresses.add(fullLine);
                                        const opt = document.createElement('option');
                                        opt.value = fullLine;
                                        opt.innerText = fullLine;
                                        select.appendChild(opt);
                                    }
                                });
                            } else {
                                if (select) select.classList.add('d-none');
                                if (manualInput) manualInput.classList.remove('d-none');
                            }
                        })
                        .catch(err => {
                            console.warn("Go Address Failure", err);
                            if (loadingMsg) loadingMsg.classList.add('d-none');
                            if (select) select.classList.add('d-none');
                            if (manualInput) manualInput.classList.remove('d-none');
                        });
                }

                window.toggleHouseInputVariant = function (selectElement) {
                    const container = selectElement.closest('.house-lookups');
                    const manualInput = container.querySelector('.text-box-input');
                    if (selectElement.value === 'manual_entry') {
                        manualInput.classList.remove('d-none');
                        $(manualInput).val('');
                        manualInput.focus();
                    } else if (selectElement.value) {
                        manualInput.classList.add('d-none');
                        manualInput.value = selectElement.value;
                    }
                    window.calculateQuickBookPrice();
                };

                // Coupon Hook
                $(document).on('input', '#coupon_code', function () {
                    const code = $(this).val().trim();
                    const email = $('#customer_email').val().trim();
                    const feedback = $('#coupon-feedback-msg');

                    feedback.html('');
                    if (!code) {
                        window.activeCouponDiscount = 0;
                        window.calculateQuickBookPrice();
                        return;
                    }

                    if (!email) {
                        feedback.html('<small class="text-danger font-weight-bold">Please enter customer email address first.</small>');
                        window.activeCouponDiscount = 0;
                        window.calculateQuickBookPrice();
                        return;
                    }

                    $.ajax({
                        url: "{{ route('admin.removal.coupon.validate.ajax') }}",
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            coupon: code,
                            email: email
                        },
                        success: function (res) {
                            if (res.status === 'valid') {
                                window.activeCouponDiscount = parseFloat(res.discount);
                                window.activeCouponType = res.type;
                                feedback.html(`<small class="text-success font-weight-bold">Coupon Applied: -${res.value_display}</small>`);
                            } else {
                                window.activeCouponDiscount = 0;
                                feedback.html(`<small class="text-danger">${res.message || 'Invalid Coupon'}</small>`);
                            }
                            window.calculateQuickBookPrice();
                        },
                        error: function () {
                            window.activeCouponDiscount = 0;
                            window.calculateQuickBookPrice();
                        }
                    });
                });

                // Route Matrix computation loop using DistanceMatrixService
                function fetchDynamicRouteFees() {
                    window.calculateQuickBookPrice();

                    const pickupAddr = $('#pickup_address').val();
                    const destAddr = $('#destination_address').val();

                    if (!pickupAddr || !destAddr) {
                        return;
                    }

                    let type1Found = false;
                    let type2Found = false;
                    window.specialZonesCharge = 0;

                    // Use a Set to handle duplicate postcodes cleanly if you updated this rule
                    const pickupPostcode = ($('#pickup_postcode').val() || extractZipCode(pickupAddr) || '').toUpperCase().replace(/\s+/g, '');
                    const destinationPostcode = ($('#destination_postcode').val() || extractZipCode(destAddr) || '').toUpperCase().replace(/\s+/g, '');

                    [pickupPostcode, destinationPostcode].forEach(extractedPostcode => {
                        if (extractedPostcode) {
                            const matchedZip = zipcodes.find(item => {
                                return matchPostcodeZone(extractedPostcode, item.code);
                            });

                            if (matchedZip) {
                                if (matchedZip.type == 1) type1Found = true;
                                else if (matchedZip.type == 2) type2Found = true;
                                else if (matchedZip.type == 3) { type1Found = true; type2Found = true; }
                            }
                        }
                    });

                    if (type1Found) window.specialZonesCharge += congestionChargeRate;
                    if (type2Found) window.specialZonesCharge += ulezChargeRate;

                    // Google Distance Matrix Processing Block
                    if (typeof google === 'object' && google.maps && google.maps.DistanceMatrixService) {
                        const service = new google.maps.DistanceMatrixService();
                        service.getDistanceMatrix({
                            origins: [pickupAddr],
                            destinations: [destAddr],
                            travelMode: 'DRIVING',
                            unitSystem: google.maps.UnitSystem.METRIC,
                        }, (response, status) => {
                            if (status !== 'OK') {
                                console.error("DistanceMatrix failed:", status);
                                window.gasMileageCharge = 0;
                                updateFeesUI();
                            } else {
                                try {
                                    const element = response.rows[0].elements[0];
                                    if (element.status === 'OK') {
                                        const distanceInMeters = element.distance.value;
                                        const distanceInMiles = distanceInMeters * 0.000621371;
                                        window.gasMileageCharge = distanceInMiles * perMilePrice;
                                    } else {
                                        window.gasMileageCharge = 0;
                                    }
                                } catch (e) {
                                    console.error("Error parsing DistanceMatrix response:", e);
                                    window.gasMileageCharge = 0;
                                }
                                updateFeesUI();
                            }
                        });
                    } else {
                        window.gasMileageCharge = 0;
                        updateFeesUI();
                    }

                    // ========================================================
                    // FIXED: UI Renderer Function tracking Floors + Fees
                    // ========================================================
                    function updateFeesUI() {
                        // 1. Calculate Floor charges dynamically for the summary bubble
                        let totalFloorCost = 0;
                        const helpers_data = @json($helpers ?? []);
                        const floors_data = @json($floors ?? []);
                        const parkings_data = @json($parkings ?? []);

                        const helper_id = $('select[name="helpers"]').val();
                        const helper = helpers_data.find(h => h.id == helper_id);
                        const persons = helper ? (parseInt(helper.persons) || 1) : 1;

                        const pickup_floor_id = $('select[name="pickup_floor"]').val();
                        const dest_floor_id = $('select[name="destination_floor"]').val();
                        const pickup_elevator = $('select[name="pickup_elevator"]').val();
                        const dest_elevator = $('select[name="destination_elevator"]').val();

                        if (pickup_floor_id) {
                            const floor = floors_data.find(f => f.id == pickup_floor_id);
                            if (floor) {
                                totalFloorCost += (pickup_elevator == 1) ? (parseFloat(floor.elevator_price) * persons) : (parseFloat(floor.simple_price) * persons);
                            }
                        }
                        if (dest_floor_id) {
                            const floor = floors_data.find(f => f.id == dest_floor_id);
                            if (floor) {
                                totalFloorCost += (dest_elevator == 1) ? (parseFloat(floor.elevator_price) * persons) : (parseFloat(floor.simple_price) * persons);
                            }
                        }

                        // 2. Calculate Parking Permit Charges
                        let totalParkingCost = 0;
                        const pickup_parking_id = $('select[name="pickup_parking"]').val();
                        const dest_parking_id = $('select[name="destination_parking"]').val();
                        if (pickup_parking_id) {
                            const parking = parkings_data.find(p => p.id == pickup_parking_id);
                            if (parking) totalParkingCost += parseFloat(parking.price);
                        }
                        if (dest_parking_id) {
                            const parking = parkings_data.find(p => p.id == dest_parking_id);
                            if (parking) totalParkingCost += parseFloat(parking.price);
                        }

                        // 3. Control visibility of elements based on charges
                        if (window.gasMileageCharge > 0 || window.specialZonesCharge > 0) {
                            $('#live-route-fees-panel').slideDown();
                            $('#lbl_mileage_charge').text(currency_symbol + window.gasMileageCharge.toFixed(2));
                            $('#lbl_zone_fee').text(currency_symbol + window.specialZonesCharge.toFixed(2));
                        } else {
                            $('#live-route-fees-panel').slideUp();
                        }

                        const tax_percentage = parseFloat("{{ get_static_option('booking_tax') ?? 0 }}");
                        if (window.gasMileageCharge > 0 || window.specialZonesCharge > 0 || totalFloorCost > 0 || totalParkingCost > 0 || tax_percentage > 0) {
                            // Floating breakdown display updates
                            $('#floating_price_breakdown').show();
                            $('#floating_mileage_charge').text(currency_symbol + window.gasMileageCharge.toFixed(2));
                            $('#floating_zone_charge').text(currency_symbol + window.specialZonesCharge.toFixed(2));

                            // Render the calculated floor cost to the target floating element span
                            if ($('#floating_floor_charge').length) {
                                $('#floating_floor_charge').text(currency_symbol + totalFloorCost.toFixed(2));
                            }

                            // Render the calculated parking cost to the target floating element span
                            if ($('#floating_parking_charge').length) {
                                $('#floating_parking_charge').text(currency_symbol + totalParkingCost.toFixed(2));
                            }
                        } else {
                            $('#floating_price_breakdown').hide();
                        }
                        window.calculateQuickBookPrice();
                    }
                    window.updateFeesUI = updateFeesUI;

                    updateFeesUI();
                }

                // Universal Change Event Pipeline
                $(document).on('change input', '#quick_booking_modal select, #quick_booking_modal input:not(#coupon_code)', function () {
                    window.calculateQuickBookPrice();
                    if (typeof window.updateFeesUI === 'function') {
                        window.updateFeesUI();
                    }
                });

                // Auto-refresh dynamic route fees on address/postcode changes
                $(document).on('change', '#pickup_address, #destination_address, #pickup_postcode, #destination_postcode', function () {
                    fetchDynamicRouteFees();
                });

                // Modal Lifecycle Triggers
                if ($('#quick_booking_modal').hasClass('show')) {
                    $('#quick_book_floating_tally').removeClass('d-none');
                    window.calculateQuickBookPrice();
                    if (typeof window.updateFeesUI === 'function') {
                        window.updateFeesUI();
                    }
                }
                $('#quick_booking_modal').on('shown.bs.modal', function () {
                    $('#quick_book_floating_tally').removeClass('d-none');
                    window.calculateQuickBookPrice();
                    if (typeof window.updateFeesUI === 'function') {
                        window.updateFeesUI();
                    }
                });
                $('#quick_booking_modal').on('hidden.bs.modal', function () {
                    $('#quick_book_floating_tally').addClass('d-none');
                });

                // Manual Refresh Click Handler
                $(document).on('click', '#btn_manual_refresh_price', function (e) {
                    e.preventDefault();
                    const icon = $(this).find('i');
                    icon.addClass('fa-spin');

                    fetchDynamicRouteFees();
                    window.calculateQuickBookPrice();

                    setTimeout(() => {
                        icon.removeClass('fa-spin');
                    }, 600);
                });
            });
        })(jQuery);
    </script>
@endsection