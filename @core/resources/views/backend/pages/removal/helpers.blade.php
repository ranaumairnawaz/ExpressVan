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
    </style>
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
@endsection
@section('site-title')
    {{__('Helpers')}}
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
                        <h4 class="header-title">{{__('All Helpers')}}</h4>
                        <a href="#" data-toggle="modal" data-target="#addFloor" class="btn btn-primary " >Add New</a>
                        <div class="table-wrap table-responsive">
                            <table class="table table-default" id="all_blog_table">
                                <thead>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Title')}}</th>
                                <th>{{__('Price')}}</th>
                                <th>{{__('Overtime Price')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                @foreach($helpers as $data)
                                    <tr>
                                        <td>{{$data->id}}</td>
                                        <td>{{$data->name}}</td>
                                        <td><span>{{amount_with_currency_symbol($data->price)}}</span></td>
                                        <td><span>{{amount_with_currency_symbol($data->overtime_price)}}</span></td>
                                        <td>
                                            <x-delete-popover :url="route('admin.removal.helpers.delete',$data->id)"/>
                                            <a href="#"
                                               data-toggle="modal"
                                               data-target="#price_plan_item_edit_modal"
                                               class="btn btn-xs btn-primary btn-xs mb-3 mr-1 price_plan_edit_btn"
                                               data-id="{{$data->id}}"
                                               data-action="{{route('admin.removal.helpers.update')}}"
                                               data-name="{{$data->name}}"
                                               data-price="{{$data->price}}"
                                               data-overtime_price="{{$data->overtime_price}}"
                                               data-invoice_name="{{$data->invoice_name}}"
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
        </div>
    </div>
    <div class="modal fade" id="addFloor" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Add Floor')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{ route('admin.removal.helpers.add') }}"  method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label>{{__('Title')}}</label>
                            <input type="text" class="form-control" name="name" placeholder="{{__('Name')}}">
                        </div>
                        <div class="form-group">
                            <label>{{__('Invoice Title')}}</label>
                            <input type="text" class="form-control" name="invoice_name" placeholder="{{__('Invoice Title')}}">
                        </div>
                        <div class="form-group">
                            <label>{{__('Price')}}</label>
                            <input type="text" class="form-control" name="price" placeholder="{{__('Price')}}">
                        </div>
                        <div class="form-group">
                            <label for="overtime_price">{{__('Overtime Price')}}</label>
                            <input type="text" class="form-control"  name="overtime_price" placeholder="{{__('Overtime Price')}}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Save Changes')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="price_plan_item_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Edit Floor Price')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="#" id="price_plan_edit_modal_form"  method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" id="price_plan_id" value="">
                        <div class="form-group">
                            <label for="edit_title">{{__('Title')}}</label>
                            <input type="text" class="form-control"  id="edit_name"  name="name" placeholder="{{__('Name')}}">
                        </div>
                        <div class="form-group">
                            <label>{{__('Invoice Title')}}</label>
                            <input type="text" class="form-control" id="edit_invoice_name" name="invoice_name" placeholder="{{__('Invoice Title')}}">
                        </div>
                        <div class="form-group">
                            <label for="edit_price">{{__('Price')}}</label>
                            <input type="text" class="form-control"  id="edit_price"  name="price" placeholder="{{__('Price')}}">
                        </div>
                        <div class="form-group">
                            <label for="edit_overtime_price">{{__('Overtime Price')}}</label>
                            <input type="text" class="form-control"  id="edit_overtime_price"  name="overtime_price" placeholder="{{__('Overtime Price')}}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Save Changes')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>
        $(document).ready(function () {
            $(document).on('click','.price_plan_edit_btn',function(){
                var el = $(this);
                var id = el.data('id');
                var name = el.data('name');
                var action = el.data('action');
                var form = $('#price_plan_edit_modal_form');
                form.attr('action',action);
                form.find('#price_plan_id').val(id);
                form.find('#edit_name').val(name);
                form.find('#edit_price').val(el.data('price'));
                form.find('#edit_overtime_price').val(el.data('overtime_price'));
                form.find('#edit_invoice_name').val(el.data('invoice_name'));
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
                "order": [[ 0, "desc" ]],
                "columnDefs": [ {
                    "targets": 'no-sort',
                    "orderable": false,
                } ]
            } );
        } );
    </script>
@endsection