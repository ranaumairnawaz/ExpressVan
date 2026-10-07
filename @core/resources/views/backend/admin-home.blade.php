@extends('backend.admin-master')
@section('site-title')
    {{__('Dashboard')}}
@endsection
@section('content')

    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                 @if(check_page_permission('admin_manage'))
                    <div class="col-md-3 mt-5 mb-3">
                        <div class="card text-dark mb-3 h-100">
                            <div class="dsh-box-style h-100">
                                <a href="{{route('admin.new.user')}}" class="add-new"><i class="ti-plus"></i></a>
                                <div class="icon">
                                    <i class="ti-user"></i>
                                </div>
                                <div class="content">
                                    <span class="total">{{$total_admin}}</span>
                                    <h4 class="title">{{__('Total Admin')}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-md-3 mt-md-5 mb-3">
                    <div class="card text-white bg-primary mb-3 h-100">
                        <div class="dsh-box-style h-100">
                            <a href="{{route('admin.removal')}}?quick_book=true" class="add-new text-white"><i class="ti-plus"></i></a>
                            <div class="icon text-white">
                                <i class="ti-bolt"></i>
                            </div>
                            <div class="content pt-4">
                                <h4 class="title text-white mt-3">{{__('Quick Add Booking')}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mt-md-5 mb-3">
                    <div class="card text-dark  mb-3 h-100">
                        <div class="dsh-box-style h-100">
                            <a href="{{route('admin.removal')}}" class="add-new"><i class="ti-eye"></i></a>
                            <div class="icon">
                                <i class="ti-package"></i>
                            </div>
                            <div class="content">
                                <span class="total">{{ getOrdersCount(1) }}</span>
                                <h4 class="title">{{__('Total Ongoing Removals')}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mt-md-5 mb-3">
                    <div class="card text-dark  mb-3 h-100">
                        <div class="dsh-box-style h-100">
                            <a href="{{route('admin.removal')}}" class="add-new"><i class="ti-eye"></i></a>
                            <div class="icon">
                                <i class="ti-package"></i>
                            </div>
                            <div class="content">
                                <span class="total">{{ getOrdersCount(0) }}</span>
                                <h4 class="title">{{__('Total Pending Removals')}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                @if(check_page_permission_by_string('Blogs Manage'))
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card text-dark  mb-3 h-100">
                            <div class="dsh-box-style h-100">
                                <a href="{{route('admin.blog.new')}}" class="add-new"><i class="ti-plus"></i></a>
                                <div class="icon">
                                    <i class="ti-comments"></i>
                                </div>
                                <div class="content">
                                    <span class="total">{{$blog_count}}</span>
                                    <h4 class="title">{{__('Total Blogs')}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                 @endif
                @if(check_page_permission_by_string('Products Manage') && !empty(get_static_option('product_module_status')))
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card text-dark  mb-3 h-100">
                            <div class="dsh-box-style h-100">
                                <a href="{{route('admin.products.new')}}" class="add-new"><i class="ti-plus"></i></a>
                                <div class="icon">
                                    <i class="ti-package"></i>
                                </div>
                                <div class="content">
                                    <span class="total">{{$total_products}}</span>
                                    <h4 class="title">{{__('Total Products')}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card text-dark  mb-3 h-100">
                            <div class="dsh-box-style h-100">
                                <a href="{{route('admin.products.order.logs')}}" class="add-new"><i class="ti-eye"></i></a>
                                <div class="icon">
                                    <i class="ti-shopping-cart"></i>
                                </div>
                                <div class="content">
                                    <span class="total">{{$total_product_order}}</span>
                                    <h4 class="title">{{__('Total Products Order')}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(check_page_permission_by_string('Services'))
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card text-dark  mb-3 h-100">
                            <div class="dsh-box-style h-100">
                                <a href="{{route('admin.services.new')}}" class="add-new"><i class="ti-plus"></i></a>
                                <div class="icon">
                                    <i class="ti-blackboard"></i>
                                </div>
                                <div class="content">
                                    <span class="total">{{$total_services}}</span>
                                    <h4 class="title">{{__('Total Services')}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                     @if(check_page_permission_by_string('Case Study'))
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card text-dark  mb-3 h-100">
                            <div class="dsh-box-style h-100">
                                <a href="{{route('admin.work.new')}}" class="add-new"><i class="ti-plus"></i></a>
                                <div class="icon">
                                    <i class="ti-write"></i>
                                </div>
                                <div class="content">
                                    <span class="total">{{$total_works}}</span>
                                    <h4 class="title">{{__('Total Case Study')}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                     @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card margin-top-40">
                    <div class="smart-card">
                        <h4 class="title">{{__('Recent Removal Order')}}</h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <th>{{__('Order TRX')}}</th>
                                    <th>{{__('Amount')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th>{{__('Date')}}</th>
                                </thead>
                                <tbody>
                                    @foreach(getRemovalOrders(10) as $data)
                                        <tr>
                                            <td><a href="{{ route('admin.removal.view',$data->trx) }}" >{{$data->trx}}</a></td>
                                            <td>{{amount_with_currency_symbol($data->total)}}</td>
                                            <td>
                                                @if($data->status == 0)
                                                 <a class="badge badge-primary text-white rounded-pill px-3 mb-1" >Pending</a>
                                                 @elseif($data->status == 1)
                                                 <a class="badge badge-info text-white rounded-pill px-3 mb-1" >Ongoing</a>
                                                 @elseif($data->status == 2)
                                                 <a class="badge badge-success text-white rounded-pill px-3 mb-1" >Completed</a>
                                                 @elseif($data->status == 3)
                                                 <a class="badge badge-danger text-white rounded-pill px-3 mb-1" >Cancelled</a>
                                                 @elseif($data->status == 4)
                                                 <a class="badge badge-danger text-white rounded-pill px-3 mb-1" >Cancelled & Returned</a>
                                                 @endif
                                                 
                                                 @if($data->payment_status == 0)
                                                 <a class="badge badge-primary text-white rounded-pill px-3 mb-1" >Unpaid</a>
                                                 @elseif($data->payment_status == 2)
                                                 <a class="badge badge-info text-white rounded-pill px-3 mb-1" >Partialy Paid</a>
                                                 @elseif($data->payment_status == 1)
                                                 <a class="badge badge-success text-white rounded-pill px-3 mb-1" >Paid</a>
                                                 @elseif($data->payment_status == 3)
                                                 <a class="badge badge-danger text-white rounded-pill px-3 mb-1" >Cancelled</a>
                                                 @endif
                                            </td>
                                            <td>{{ $data->booking_time }}<br>{{date_format(date_create($data->date),'d M Y')}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
             @if(check_page_permission_by_string('Products Manage') && !empty(get_static_option('product_module_status')))
            <div class="col-lg-6">
                <div class="card margin-top-40">
                    <div class="smart-card">
                        <h4 class="title">{{__('Recent Product Order')}}</h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <th>{{__('Order ID')}}</th>
                                    <th>{{__('Amount')}}</th>
                                    <th>{{__('Payment Status')}}</th>
                                    <th>{{__('Date')}}</th>
                                </thead>
                                <tbody>
                                    @foreach($product_recent_order as $data)
                                        <tr>
                                            <td>#{{$data->id}}</td>
                                            <td>{{amount_with_currency_symbol($data->total)}}</td>
                                            <td>
                                                @php $pay_status = $data->payment_status; @endphp
                                                @if($pay_status == 'complete')
                                                    <span class="alert alert-success">{{__($pay_status)}}</span>
                                                @elseif($pay_status == 'pending')
                                                    <span class="alert alert-warning">{{__($pay_status)}}</span>
                                                @endif
                                            </td>
                                            <td>{{date_format($data->created_at,'d M Y h:i:s')}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection
