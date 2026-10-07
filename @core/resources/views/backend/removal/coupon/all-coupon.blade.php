@extends('backend.admin-master')
@section('site-title')
    {{__('Removal Coupon')}}
@endsection
@section('style')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-datepicker.min.css')}}">
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button{
            padding: 0 !important;
        }
        div.dataTables_wrapper div.dataTables_length select {
            width: 60px;
            display: inline-block;
        }
    </style>
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
               <x-error-msg/>
               <x-flash-msg/>
            </div>
            <div class="col-lg-7 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('All Removal Coupons')}}</h4>
                        <div class="bulk-delete-wrapper">
                            <div class="select-box-wrap">
                                <select name="bulk_option" id="bulk_option">
                                    <option value="">{{{__('Bulk Action')}}}</option>
                                    <option value="delete">{{{__('Delete')}}}</option>
                                </select>
                                <button class="btn btn-primary btn-sm" id="bulk_delete_btn">{{__('Apply')}}</button>
                            </div>
                        </div>
                          <div class="table-wrap table-responsive">
                                <table class="table table-default">
                                    <thead>
                                    <th class="no-sort">
                                        <div class="mark-all-checkbox">
                                            <input type="checkbox" class="all-checkbox">
                                        </div>
                                    </th>
                                    <th>{{__('ID')}}</th>
                                    <th>{{__('Code')}}</th>
                                    <th>{{__('Discount')}}</th>
                                    <th>{{__('Expiry')}}</th>
                                    <th>{{__('Limits')}}</th>
                                    <th>{{__('Used')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th>{{__('Action')}}</th>
                                    </thead>
                                    <tbody>
                                    @foreach($all_coupon as $data)
                                        <tr>
                                            <td>
                                                <div class="bulk-checkbox-wrapper">
                                                    <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$data->id}}">
                                                </div>
                                            </td>
                                            <td>{{$data->id}}</td>
                                            <td>{{$data->code}}</td>
                                            <td>
                                                @if($data->discount_type == 'percentage') 
                                                    {{$data->discount_value}}% 
                                                @elseif($data->discount_type == 'fixed')
                                                    {{amount_with_currency_symbol($data->discount_value)}}
                                                @else
                                                    {{__('Free Shipping')}}
                                                @endif
                                            </td>
                                            <td>{{ $data->expire_date ? date('d M Y', strtotime($data->expire_date)) : __('No Expiry') }}</td>
                                            <td>
                                                <ul>
                                                    <li>{{__('Total')}}: {{$data->total_limit ?? __('Unlimited')}}</li>
                                                    <li>{{__('Per Customer')}}: {{$data->limit_per_customer}}</li>
                                                </ul>
                                            </td>
                                            <td>{{ $data->usages->count() }}</td>
                                            <td>
                                                @if('publish' == $data->status)
                                                    <span class="btn btn-success btn-xs">{{ucfirst($data->status)}}</span>
                                                @else
                                                    <span class="btn btn-warning btn-xs">{{ucfirst($data->status)}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <x-delete-popover :url="route('admin.removal.coupon.delete',$data->id)"/>
                                                <a href="#"
                                                   data-toggle="modal"
                                                   data-target="#coupon_edit_modal"
                                                   class="btn btn-primary btn-xs mb-3 mr-1 coupon_edit_btn"
                                                   data-id="{{$data->id}}"
                                                   data-code="{{$data->code}}"
                                                   data-discount_value="{{$data->discount_value}}"
                                                   data-discount_type="{{$data->discount_type}}"
                                                   data-expire_date="{{$data->expire_date ? date('Y-m-d', strtotime($data->expire_date)) : ''}}"
                                                   data-total_limit="{{$data->total_limit}}"
                                                   data-limit_per_customer="{{$data->limit_per_customer}}"
                                                   data-min_amount="{{$data->min_amount}}"
                                                   data-status="{{$data->status}}"
                                                   data-excluded_services="{{ json_encode($data->excluded_services) }}"
                                                   data-stackable="{{ $data->stackable ? 1 : 0 }}"
                                                >
                                                    <i class="ti-pencil"></i>
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
            <div class="col-lg-5 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Add New Coupon')}}</h4>
                        <form action="{{route('admin.removal.coupon.new')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="code">{{__('Coupon Code')}}</label>
                                <input type="text" class="form-control" name="code" placeholder="{{__('e.g. SAVE50')}}">
                            </div>
                            <div class="form-group">
                                <label for="discount_type">{{__('Coupon Type')}}</label>
                                <select name="discount_type" class="form-control">
                                    <option value="percentage">{{__("Percentage (%)")}}</option>
                                    <option value="fixed">{{__("Fixed Amount (£)")}}</option>
                                    <option value="free_shipping">{{__("Free Shipping")}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="discount_value">{{__('Discount Value')}}</label>
                                <input type="number" step="0.01" class="form-control" name="discount_value" placeholder="{{__('Value')}}">
                                <small>{{__('Leave empty for Free Shipping')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="min_amount">{{__('Minimum Order Value')}}</label>
                                <input type="number" step="0.01" class="form-control" name="min_amount" placeholder="{{__('Minimum Spend')}}">
                            </div>
                            <div class="form-group">
                                <label for="expire_date">{{__('Expiry Date')}}</label>
                                <input type="date" class="form-control" name="expire_date">
                            </div>
                            <div class="form-group">
                                <label for="total_limit">{{__('Total Usage Limit')}}</label>
                                <input type="number" class="form-control" name="total_limit" placeholder="{{__('e.g. 100')}}">
                            </div>
                            <div class="form-group">
                                <label for="limit_per_customer">{{__('Usage Per Customer')}}</label>
                                <input type="number" class="form-control" name="limit_per_customer" value="1">
                            </div>
                            <div class="form-group">
                                <label for="status">{{__('Status')}}</label>
                                <select name="status" class="form-control">
                                    <option value="publish">{{__("Publish")}}</option>
                                    <option value="draft">{{__("Draft")}}</option>
                                </select>
                            </div>
                            <hr>
                            <label><strong>{{__('Advanced Options')}}</strong></label>
                            <div class="form-group mt-2">
                                <label>{{__('Excluded Services (Discount will not apply to these)')}}</label>
                                <div class="col-md-12 p-0">
                                    <div class="custom-control custom-checkbox border-bottom py-1">
                                        <input type="checkbox" class="custom-control-input" name="excluded_services[]" value="van" id="ex_van">
                                        <label class="custom-control-label" for="ex_van">{{__('Van / Transport Price')}}</label>
                                    </div>
                                    <div class="custom-control custom-checkbox border-bottom py-1">
                                        <input type="checkbox" class="custom-control-input" name="excluded_services[]" value="helpers" id="ex_helpers">
                                        <label class="custom-control-label" for="ex_helpers">{{__('Helper Charges')}}</label>
                                    </div>
                                    <div class="custom-control custom-checkbox border-bottom py-1">
                                        <input type="checkbox" class="custom-control-input" name="excluded_services[]" value="mileage" id="ex_mileage">
                                        <label class="custom-control-label" for="ex_mileage">{{__('Gas / Mileage Fee')}}</label>
                                    </div>
                                    <div class="custom-control custom-checkbox border-bottom py-1">
                                        <input type="checkbox" class="custom-control-input" name="excluded_services[]" value="floors" id="ex_floors">
                                        <label class="custom-control-label" for="ex_floors">{{__('Floor / Elevator Charges')}}</label>
                                    </div>
                                    <div class="custom-control custom-checkbox border-bottom py-1">
                                        <input type="checkbox" class="custom-control-input" name="excluded_services[]" value="parking" id="ex_parking">
                                        <label class="custom-control-label" for="ex_parking">{{__('Parking Charges')}}</label>
                                    </div>
                                    <div class="custom-control custom-checkbox border-bottom py-1">
                                        <input type="checkbox" class="custom-control-input" name="excluded_services[]" value="special_zones" id="ex_zones">
                                        <label class="custom-control-label" for="ex_zones">{{__('Congestion / ULEZ Charges')}}</label>
                                    </div>
                                    <div class="custom-control custom-checkbox py-1">
                                        <input type="checkbox" class="custom-control-input" name="excluded_services[]" value="insurance" id="ex_insurance">
                                        <label class="custom-control-label" for="ex_insurance">{{__('Insurance Price')}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="stackable" value="1" id="stackable">
                                    <label class="custom-control-label" for="stackable">{{__('Allow Stacking (Can be used with other coupons)')}}</label>
                                </div>
                                <small class="text-muted">{{__('If off, this coupon cannot be combined with others.')}}</small>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Add New Coupon')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="coupon_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Update Coupon')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{route('admin.removal.coupon.update')}}"  method="post">
                    <input type="hidden" name="id" id="coupon_id">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="edit_code">{{__('Coupon Code')}}</label>
                            <input type="text" class="form-control" id="edit_code" name="code">
                        </div>
                        <div class="form-group">
                            <label for="edit_discount_type">{{__('Coupon Type')}}</label>
                            <select name="discount_type" class="form-control" id="edit_discount_type">
                                <option value="percentage">{{__("Percentage (%)")}}</option>
                                <option value="fixed">{{__("Fixed Amount (£)")}}</option>
                                <option value="free_shipping">{{__("Free Shipping")}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_discount_value">{{__('Discount Value')}}</label>
                            <input type="number" step="0.01" class="form-control" id="edit_discount_value" name="discount_value">
                        </div>
                        <div class="form-group">
                            <label for="edit_min_amount">{{__('Minimum Order Value')}}</label>
                            <input type="number" step="0.01" class="form-control" id="edit_min_amount" name="min_amount">
                        </div>
                        <div class="form-group">
                            <label for="edit_expire_date">{{__('Expiry Date')}}</label>
                            <input type="date" class="form-control" id="edit_expire_date" name="expire_date">
                        </div>
                        <div class="form-group">
                            <label for="edit_total_limit">{{__('Total Usage Limit')}}</label>
                            <input type="number" class="form-control" id="edit_total_limit" name="total_limit">
                        </div>
                        <div class="form-group">
                            <label for="edit_limit_per_customer">{{__('Usage Per Customer')}}</label>
                            <input type="number" class="form-control" id="edit_limit_per_customer" name="limit_per_customer">
                        </div>
                            <div class="form-group">
                                <label for="edit_status">{{__('Status')}}</label>
                                <select name="status" class="form-control" id="edit_status">
                                    <option value="draft">{{__("Draft")}}</option>
                                    <option value="publish">{{__("Publish")}}</option>
                                </select>
                            </div>
                            <hr>
                            <label><strong>{{__('Advanced Options')}}</strong></label>
                            <div class="form-group mt-2">
                                <label>{{__('Excluded Services')}}</label>
                                <div class="col-md-12 p-0">
                                    @php
                                        $services = [
                                            'van' => __('Van / Transport Price'),
                                            'helpers' => __('Helper Charges'),
                                            'mileage' => __('Gas / Mileage Fee'),
                                            'floors' => __('Floor / Elevator Charges'),
                                            'parking' => __('Parking Charges'),
                                            'special_zones' => __('Congestion / ULEZ Charges'),
                                            'insurance' => __('Insurance Price')
                                        ];
                                    @endphp
                                    @foreach($services as $key => $label)
                                    <div class="custom-control custom-checkbox border-bottom py-1">
                                        <input type="checkbox" class="custom-control-input edit_excluded_services" name="excluded_services[]" value="{{$key}}" id="edit_ex_{{$key}}">
                                        <label class="custom-control-label" for="edit_ex_{{$key}}">{{$label}}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="stackable" value="1" id="edit_stackable">
                                    <label class="custom-control-label" for="edit_stackable">{{__('Allow Stacking')}}</label>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Save Change')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $(document).ready(function () {

            $(document).on('click','#bulk_delete_btn',function (e) {
                e.preventDefault();

                var bulkOption = $('#bulk_option').val();
                var allCheckbox =  $('.bulk-checkbox:checked');
                var allIds = [];
                allCheckbox.each(function(index,value){
                    allIds.push($(this).val());
                });
                if(allIds != '' && bulkOption == 'delete'){
                    $(this).text('{{__('Deleting...')}}');
                    $.ajax({
                        'type' : "POST",
                        'url' : "{{route('admin.removal.coupon.bulk.action')}}",
                        'data' : {
                            _token: "{{csrf_token()}}",
                            ids: allIds
                        },
                        success:function (data) {
                            location.reload();
                        }
                    });
                }

            });

            $('.all-checkbox').on('change',function (e) {
                e.preventDefault();
                var value = $('.all-checkbox').is(':checked');
                var allChek = $(this).parent().parent().parent().parent().parent().find('.bulk-checkbox');
                if( value == true){
                    allChek.prop('checked',true);
                }else{
                    allChek.prop('checked',false);
                }
            });

            $(document).on('click','.coupon_edit_btn',function(){
                var el = $(this);
                var id = el.data('id');
                var status = el.data('status');
                var modal = $('#coupon_edit_modal');
                modal.find('#coupon_id').val(id);
                modal.find('#edit_status option[value="'+status+'"]').attr('selected',true);
                modal.find('#edit_code').val(el.data('code'));
                modal.find('#edit_discount_value').val(el.data('discount_value'));
                modal.find('#edit_discount_type').val(el.data('discount_type'));
                modal.find('#edit_expire_date').val(el.data('expire_date'));
                modal.find('#edit_total_limit').val(el.data('total_limit'));
                modal.find('#edit_limit_per_customer').val(el.data('limit_per_customer'));
                modal.find('#edit_min_amount').val(el.data('min_amount'));

                // Handle excluded services
                modal.find('.edit_excluded_services').prop('checked', false);
                var excluded = el.data('excluded_services');
                if (excluded) {
                    if (typeof excluded === 'string') excluded = JSON.parse(excluded);
                    excluded.forEach(function(val) {
                        modal.find('#edit_ex_' + val).prop('checked', true);
                    });
                }

                // Handle stackable
                if (el.data('stackable') == 1) {
                    modal.find('#edit_stackable').prop('checked', true);
                } else {
                    modal.find('#edit_stackable').prop('checked', false);
                }
            });
        });
    </script>
    <!-- Start datatable js -->
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.table-wrap > table').DataTable( {
                "order": [[ 1, "desc" ]],
                'columnDefs' : [{
                    'targets' : 'no-sort',
                    'orderable' : false
                }]
            } );
        } );
    </script>
@endsection
