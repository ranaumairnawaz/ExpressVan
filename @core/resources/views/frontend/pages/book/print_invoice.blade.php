<!DOCTYPE html>
<html lang="{{$user_select_lang_slug}}"  dir="{{get_user_lang_direction()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {!! render_favicon_by_id(filter_static_option_value('site_favicon',$global_static_field_data)) !!}
    <link rel="canonical" href="{{url()->current()}}">
    <link rel=preload href="{{asset('assets/frontend/css/fontawesome.min.css')}}" as="style">
    <link rel=preload href="{{asset('assets/frontend/css/flaticon.css')}}" as="style">
    <link rel=preload href="{{asset('assets/frontend/css/nexicon.css')}}" as="style">

    <link rel="stylesheet" href="{{asset('assets/frontend/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/nexicon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/fontawesome.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/animate.css')}}">

    <link rel="stylesheet" href="{{asset('assets/frontend/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/style-two.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/helpers.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/jquery.ihavecookies.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/dynamic-style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/toastr.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/slick.css')}}">
    <link href="{{asset('assets/frontend/css/jquery.mb.YTPlayer.min.css')}}" media="all" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    
    <title>{{ $order->trx }} - {{filter_static_option_value('site_'.$user_select_lang_slug.'_title',$global_static_field_data)}}</title>
    <script src="{{asset('assets/frontend/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/frontend/js/jquery-migrate.min.js')}}"></script>
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
        
        .btn.btn-white, .btn.btn-white.disabled, .btn.btn-white.disabled:focus, .btn.btn-white.disabled:hover, .btn.btn-white[disabled], .btn.btn-white[disabled]:focus, .btn.btn-white[disabled]:hover {
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

</head>

<body class="{{request()->path()}} home_variant_{{$home_page_variant}} nexelit_version_{{getenv('XGENIOUS_NEXELIT_VERSION')}} {{filter_static_option_value('item_license_status',$global_static_field_data)}} apps_key_{{filter_static_option_value('site_script_unique_key',$global_static_field_data)}} ">
    <div class="invoice" id="invoice" style="box-shadow: rgba(0, 0, 0, 0.25) 0px 25px 50px -12px;">
     <!-- begin invoice-company -->
     <div class="invoice-company text-inverse d-flex justify-content-between align-items-center">
        @if(!empty(filter_static_option_value('site_logo',$global_static_field_data)))
            {!! render_image_markup_by_attachment_id(filter_static_option_value('site_logo',$global_static_field_data)) !!}
        @else
            <h2 class="site-title">{{filter_static_option_value('site_'.$user_select_lang_slug.'_title',$global_static_field_data)}}</h2>
        @endif
        <h3></h3>
     </div>
     <!-- end invoice-company -->
     <!-- begin invoice-header -->
     <div class="invoice-header row" style="display: flex;">
        <div class="col-md-4 text-left">
           <small>from</small>
           <address class="m-t-5 m-b-5">
              <strong class="text-inverse">{{filter_static_option_value('site_'.$user_select_lang_slug.'_title',$global_static_field_data)}}</strong>
              <p>
                  {{ getContactDetail('Email Address')->description }} </br>
                  {{ getContactDetail('Phone')->description }} </br>
                  {{ getContactDetail('Location')->description }} </br>
                  {{ getContactDetail('Registration')->description }}
              </p>
           </address>
        </div>
        <div class="col-md-4">
           <small>to</small>
           <address class="m-t-5 m-b-5">
              <strong class="text-inverse">{{ $order->name }}</strong>
              <p>
                  {{ $order->email }}</br>
                  {{ $order->phone }}
              </p>
           </address>
        </div>
        <div class="col-md-4 text-right">
           <small>Order #{{ $order->trx }}</small>
           <div class="date text-inverse m-t-5">{{ date_format(date_create($order->created_at), "l jS \of F Y") }}</div>
           <div class="invoice-detail">
              Invoice for @if(getServiceDetails($order->service_id) != NULL) {{ getServiceDetails($order->service_id)->title }} @else Packers and Shifters @endif booking
           </div>
           <small>Message: {{ $order->note }}</small>
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
                    <th>House</th>
                    <th>Locations</th>
                    <th>Floor</th>
                    <th>City</th>
                    <th>Postcode</th>
                    <th>Parking</th>
                 </tr>
              </thead>
              <tbody>
                @php
                $places = getOrderPlaces($order->trx);
                @endphp
                @foreach($places as $key => $place)
                 <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $place->house }}</td>
                    <td>{{ $place->address }}</td>
                    <td>
                        @if(getFloorDetails($place->floor)->elevator_price == 0)
                        {{ getFloorDetails($place->floor)->name }}
                        @else
                        {{ getFloorDetails($place->floor)->name }} @if($place->elevator == 1) with @else without @endif Eelevator
                        @endif
                    </td>
                    <td>{{ $place->city }}</td>
                    <td>{{ $place->postcode }}</td>
                    <td>{{ getParkingDetails($place->parking)->name }}</td>
                 </tr>
                 @endforeach
              </tbody>
           </table>
        </div>
                <div class="table-responsive" >
            <table class="table table-invoice">
              <thead>
                  <tr>
                      <th colspan="100%" class="text-center" >
                          Inventory
                      </th>
                  </tr>
                 <tr>
                    <th>#</th>
                    <th>Item</th>
                    <th>Qty</th>
                 </tr>
              </thead>
              <tbody>
                @php
                $items = getInventoryItems($order->trx);
                @endphp
                @foreach($items as $key => $item)
                 <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $item->item }}</td>
                    <td>{{ $item->qty }}</td>
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
                    <th class="text-center" width="30%">QUANTITY</th>
                    <th class="text-right" width="20%">PRICE</th>
                 </tr>
              </thead>
              <tbody>
                @foreach($order_bills as $ob)
                 <tr>
                    <td>
                       <span class="text-inverse">{{ $ob->name }}</span><br>
                    </td>
                    <td class="text-center">
                        @if($ob->quantity != 0)
                            @if($ob->unit == 'mins')
                                {{ convertMinutesToHoursAndMinutes($ob->quantity) }}
                            @else
                                @if($ob->unit != 0)
                                    {{ $ob->quantity }}  {{ $ob->unit }}
                                @else
                                    {{ $ob->quantity }}
                                @endif
                            @endif
                        @endif
                    </td>
                    <td class="text-right">{{ amount_with_currency_symbol($ob->price) }}</td>
                 </tr>
                 @endforeach
                 @if($order->coupon_code)
                 <tr>
                    <td>
                       <span class="text-inverse">DISCOUNT ({{ $order->coupon_code }})</span><br>
                    </td>
                    <td></td>
                    <td class="text-right text-success">- {{ amount_with_currency_symbol($order->coupon_discount) }}</td>
                 </tr>
                 @endif
                 <tr>
                    <td>
                       <span class="text-inverse">SUBTOTAL</span><br>
                    </td>
                    <td></td>
                    <td class="text-right">{{ $order->price }}</td>
                 </tr>
                 <tr>
                    <td>
                       <span class="text-inverse">TAX</span><br>
                    </td>
                    <td class="text-center">{{ get_static_option('booking_tax') }}%</td>
                    <td class="text-right">{{ amount_with_currency_symbol($order->tax) }}</td>
                 </tr>
                 @if($order->payment_status == 2)
                 <tr>
                     <td>Paid Amount</td>
                     <td></td>
                     <td class="text-right" >
                         {{ amount_with_currency_symbol(($order->total*30)/100) }}
                     </td>
                 </tr>
                 <tr>
                     <td>Remaining Amount</td>
                     <td></td>
                     <td class="text-right" >
                         {{ amount_with_currency_symbol(($order->total*70)/100) }}
                     </td>
                 </tr>
                 @endif
                 @if($order->payment_status == 1)
                 <tr>
                     <td>Paid Amount</td>
                     <td></td>
                     <td class="text-right" >
                         {{ amount_with_currency_symbol($order->total) }}
                     </td>
                 </tr>=
                 @endif
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
                     <a class="badge badge-primary text-white rounded-pill px-3" >Unpaid</a>
                     @elseif($order->payment_status == 2)
                     <a class="badge badge-info text-white rounded-pill px-3" >Partialy Paid</a>
                     @elseif($order->payment_status == 1)
                     <a class="badge badge-success text-white rounded-pill px-3" >Paid</a>
                     @elseif($order->payment_status == 3)
                     <a class="badge badge-danger text-white rounded-pill px-3" >Cancelled</a>
                     @endif
                     
                     @if($order->status == 0)
                     <a class="badge badge-primary text-white rounded-pill px-3" >Pending</a>
                     @elseif($order->status == 1)
                     <a class="badge badge-info text-white rounded-pill px-3" >Ongoing</a>
                     @elseif($order->status == 2)
                     <a class="badge badge-success text-white rounded-pill px-3" >Completed</a>
                     @elseif($order->status == 3)
                     <a class="badge badge-danger text-white rounded-pill px-3" >Cancelled</a>
                     @elseif($order->status == 4)
                     <a class="badge badge-danger text-white rounded-pill px-3" >Cancelled & Returned</a>
                     @endif
                    <!-- <span class="btn btn-sm btn-success p-1" >PAID</span> -->
                 </div>
                 <div class="sub-price">
                 </div>
              </div>
           </div>
           <div class="invoice-price-right">
              <small>TOTAL</small> <span class="f-w-600">{{ amount_with_currency_symbol($order->total) }}</span>
           </div>
        </div>
        <!-- end invoice-price -->
     </div>
     <!-- end invoice-content -->
     <!-- begin invoice-note -->
     <!-- end invoice-note -->
     <!-- begin invoice-footer -->
     <div class="invoice-footer text-center">
        <div class="mt-2 w-100 d-flex align-items-center justify-content-center" >
            <a href="{{ url('/') }}" class="btn-dagency px-3 m-2 noprint">Go Back</a>
            @if($order->payment_status == 0)
            <a href="{{ route('frontend.book.order.checkout',[$order->trx,'full']) }}" class="btn-dagency px-3 m-2 noprint">Pay Now</a>
            <a href="{{ route('frontend.book.order.checkout',[$order->trx,'advance']) }}" class="btn-dagency px-3 m-2 noprint">Pay Advance 30%</a>
            @else
            <a href="#" onclick="openSmallWindow('{{ route('frontend.book.order.print',$order->trx) }}')" class="btn-dagency px-3 m-2 noprint">Print</a>
            @endif
        </div>
        {!! get_footer_copyright_text() !!}
     </div>
     <!-- end invoice-footer -->
  </div>
    <script>
        function printInvoice() {
            var printContents = document.getElementById('invoice').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
        
        window.addEventListener('afterprint', function() {
            window.close();
        });
    
        window.onload = function() {
            printInvoice();
        }
    </script>
</body>