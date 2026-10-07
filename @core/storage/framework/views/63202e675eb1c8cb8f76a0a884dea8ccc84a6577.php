<?php $__env->startSection('site-title'); ?>
    Book - Removal Service
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    Book for removal service
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('frontend.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('frontend.partials.navbar-variant.navbar-'.get_static_option('navbar_variant'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <style>
    .form-control{
        height: 3rem !important;
        border-radius: 3rem !important;
        background-color: white !important;
        width: 100% !important;
        font-size: 1rem !important;
    }
    
    .form-control option{
        font-size: 1rem;
        padding-top: 10px;
        padding-bottom: 10px;
    }
    
    .inputCont{
        height: 3rem;
        border-radius: 3rem;
        padding: 0rem;
        background-color: white;
    }
    .newInput{
        height: 3rem;
        border-radius: 3rem;
        font-size: 1rem;
        padding: 0rem 2rem;
        background-color: transparent;
        border: 0px solid transparent;
    }
    .pac-logo:after{
        content: none;
    }
    .hdpi .pac-icon{
        display: none;
    }
    .pac-item{
        font-size: 1rem;
        padding-top: 10px;
        padding-bottom: 10px;
    }
    .pac-item-query{
        font-size: 1rem;
    }
    .step {
        display: none;
    }
    .step.active {
        display: block;
    }
    .nav-arrow .nav-item{
        position: relative;
        font-size: 1rem;
        margin: 0.75rem;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        white-space: nowrap;
        border: 2px solid #ced4da;
    }
    .nav-arrow .nav-link.active {
        border-bottom: 3px solid var(--dagency-color);
        color: var(--dagency-color);
        font-weight: bold;
    }
    .demo-link {
        display: block;
        padding: 0.5rem 1rem;
    }
    .newCard {
        cursor: pointer;
        transition: border-color 0.3s ease;
    }
    
    .newCard:hover {
        border-color: #007bff; /* Optional hover effect */
    }
    
    .newCard.selected {
        border-color: #007bff; /* Same color as selected state in JavaScript */
    }
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
    .nav-arrow .nav-item{
        position: relative;
        font-size: 1rem;
        margin: 0.75rem;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        white-space: nowrap;
        border: 2px solid #ced4da;
    }
    .nav-arrow .nav-link.active {
        border-bottom: 3px solid var(--dagency-color);
        color: var(--dagency-color);
        font-weight: bold;
    }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="page-content service-details padding-top-20 padding-bottom-115">
        <div id="container" class="container-fluid mt-1">
                        <div class="d-flex align-items-center justify-content-center" >
                <ul class="nav nav-arrow mx-auto mb-4" style="flex-wrap:nowrap !important; overflow-x: scroll;" id="step-nav">
                    <li class="nav-item rounded-pill">
                        <span class="demo-link rounded-pill">
                            <i class="fa-solid fa-map"></i>
                        </span>
                    </li>
                    <li class="nav-item rounded-pill">
                        <span class="nav-link rounded-pill">
                            <i class="fa-solid fa-truck-front"></i>
                        </span>
                    </li>
                    <li class="nav-item rounded-pill">
                        <span class="nav-link rounded-pill">
                            <i class="fa-solid fa-house-chimney"></i>
                        </span>
                    </li>
                    <li class="nav-item rounded-pill">
                        <span class="nav-link rounded-pill">
                            <i class="fa-solid fa-address-card"></i>
                        </span>
                    </li>
                    <li class="nav-item rounded-pill">
                        <span class="nav-link active rounded-pill" >Confirmation</span>
                    </li>
                </ul>
            </div>
            <div class="row" >
                <div class="col-md-2" ></div>
                <div class="col-md-8" >
                    <div class="invoice" style="box-shadow: rgba(0, 0, 0, 0.25) 0px 25px 50px -12px;">
                     <!-- begin invoice-company -->
                     <div class="invoice-company text-inverse d-flex justify-content-between align-items-center">
                        <?php if(!empty(filter_static_option_value('site_logo',$global_static_field_data))): ?>
                            <?php echo render_image_markup_by_attachment_id(filter_static_option_value('site_logo',$global_static_field_data)); ?>

                        <?php else: ?>
                            <h2 class="site-title"><?php echo e(filter_static_option_value('site_'.$user_select_lang_slug.'_title',$global_static_field_data)); ?></h2>
                        <?php endif; ?>
                        <h3></h3>
                     </div>
                     <!-- end invoice-company -->
                     <!-- begin invoice-header -->
                     <div class="invoice-header row">
                        <div class="col-md-4">
                           <small>from</small>
                           <address class="m-t-5 m-b-5">
                              <strong class="text-inverse"><?php echo e(filter_static_option_value('site_'.$user_select_lang_slug.'_title',$global_static_field_data)); ?>®</strong>
                              <p>
                                  <?php echo e(getContactDetail('Email Address')->description); ?> </br>
                                  <?php echo e(getContactDetail('Phone')->description); ?> </br>
                                  <?php echo e(getContactDetail('Location')->description); ?> </br>
                                  <?php echo e(getContactDetail('Registration')->description); ?>

                              </p>
                           </address>
                        </div>
                        <div class="col-md-4">
                           <small>to</small>
                           <address class="m-t-5 m-b-5">
                              <strong class="text-inverse"><?php echo e($alldata->name); ?></strong>
                              <p>
                                  <?php echo e($alldata->email); ?></br>
                                  <?php echo e($alldata->phone); ?>

                              </p>
                           </address>
                        </div>
                        <div class="col-md-4 text-right">
                           <small>Order #<?php echo e($alldata->order_trx); ?></small>
                           <div class="date text-inverse m-t-5"><?php echo e(convertDate($alldata->date)); ?> at <?php echo e($alldata->time); ?></div>
                           <div class="invoice-detail">
                              Invoice for <?php echo e(getServiceDetails($alldata->service)->title); ?>

                           </div>
                           <div class="invoice-detail">
                              Ride along: <?php if($alldata->ride == 1): ?> Yes <?php else: ?> No <?php endif; ?>
                           </div>
                           <?php if($alldata->insurance != 0): ?>
                           <?php
                            $insurance = getInsurance($alldata->insurance);
                           ?>
                           <div class="invoice-detail">
                               Insurance cover upto <?php echo e(amount_with_currency_symbol($insurance->cover)); ?>

                           </div>
                           <?php endif; ?>
                        </div>
                        <div class="col-md-12" >
                            Message: <?php echo e($alldata->message); ?>

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
                                    <th>Postcode</th>
                                    <th>Parking</th>
                                 </tr>
                              </thead>
                              <tbody>
                                <?php $__currentLoopData = $alldata->location; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $place): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <tr>
                                    <td><?php echo e($key+1); ?></td>
                                    <td><?php echo e($alldata->house[$key]); ?></td>
                                    <td><?php echo e($place); ?></td>
                                    <td>
                                        <?php if(getFloorDetails($alldata->floor[$key])->elevator_price == 0): ?>
                                        <?php echo e(getFloorDetails($alldata->floor[$key])->name); ?>

                                        <?php else: ?>
                                        <?php echo e(getFloorDetails($alldata->floor[$key])->name); ?> <?php if($alldata->elevator[$key] == 1): ?> with <?php else: ?> without <?php endif; ?> Eelevator
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($alldata->postcode[$key]); ?></td>
                                    <td><?php echo e(getParkingDetails($alldata->parking[$key])->name); ?></td>
                                 </tr>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </tbody>
                           </table>
                        </div>
                        <?php if($alldata->inventoryInput): ?>
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
                                    <th class="text-right" >Total Price</th>
                                 </tr>
                              </thead>
                              <tbody>
                                <?php $Invtotal = 0; ?>
                                <?php $__currentLoopData = $alldata->inventoryInput; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <?php
                                    $ThisInvT = $alldata->inventoryPrice[$key] * $alldata->inventoryQty[$key];
                                    $Invtotal = $Invtotal + $ThisInvT;
                                 ?>
                                 <tr>
                                    <td><?php echo e($key+1); ?></td>
                                    <td><?php echo e($item); ?></td>
                                    <td><?php echo e(amount_with_currency_symbol($alldata->inventoryPrice[$key])); ?> X <?php echo e($alldata->inventoryQty[$key]); ?></td>
                                    <td class="text-right" ><?php echo e(amount_with_currency_symbol($ThisInvT)); ?></td>
                                 </tr>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 <tr>
                                     <td colspan="3">Total</td>
                                     <td class="text-right" ><?php echo e(amount_with_currency_symbol($Invtotal)); ?></td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                        <?php endif; ?>
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
                                 <tr>
                                    <td>
                                       <span class="text-inverse"><?php echo e(getTransport($alldata->transport)->name); ?></span><br>
                                    </td>
                                    <td class="text-center">
                                        <?php echo e(convertMinutesToHoursAndMinutes($alldata->duration*60)); ?>

                                    </td>
                                    <td class="text-right"><?php echo e(amount_with_currency_symbol($transport_price)); ?></td>
                                 </tr>
                                 
                                 <tr>
                                    <td>
                                        <?php if($alldata->helpers != 0): ?>
                                       <span class="text-inverse"><?php echo e(getHelperDetails($alldata->helpers)->persons); ?> Helpers</span><br>
                                       <?php else: ?>
                                       <span class="text-inverse">No Helpers</span><br>
                                       <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo e(convertMinutesToHoursAndMinutes($alldata->duration*60)); ?>

                                    </td>
                                    <td class="text-right"><?php echo e(amount_with_currency_symbol($helpers_price)); ?></td>
                                 </tr>
                                 
                                 <tr>
                                    <td>
                                       <span class="text-inverse">Gas Fee</span><br>
                                    </td>
                                    <td class="text-center" >
                                        <?php echo e($distance); ?> miles
                                    </td>
                                    <td class="text-right"><?php echo e(amount_with_currency_symbol($gas_fee)); ?></td>
                                 </tr>
                                 <?php if($floor_prices != 0): ?>
                                 <tr>
                                    <td colspan="2" >
                                       <span class="text-inverse">Floor Price</span><br>
                                    </td>
                                    <td class="text-right"><?php echo e(amount_with_currency_symbol($floor_prices)); ?></td>
                                 </tr>
                                 <?php endif; ?>
                                 <?php if($parking_prices != 0): ?>
                                 <tr>
                                    <td colspan="2" >
                                       <span class="text-inverse">Parking Price</span><br>
                                    </td>
                                    <td class="text-right"><?php echo e(amount_with_currency_symbol($parking_prices)); ?></td>
                                 </tr>
                                 <?php endif; ?>
                                 <?php if($sp_charge != 0): ?>
                                 <tr>
                                    <td colspan="2" >
                                       <span class="text-inverse">Ulez & CC Charge</span><br>
                                    </td>
                                    <td class="text-right"><?php echo e(amount_with_currency_symbol($sp_charge)); ?></td>
                                 </tr>
                                 <?php endif; ?>
                                 
                                 <?php if($alldata->insurance != 0): ?>
                                 <?php
                                 $insurance = getInsurance($alldata->insurance);
                                 ?>
                                 <tr>
                                    <td colspan="2" >
                                       <span class="text-inverse">Insurance Cover upto <?php echo e(amount_with_currency_symbol($insurance->cover)); ?></span><br>
                                    </td>
                                    <td class="text-right"><?php echo e(amount_with_currency_symbol($insurance->price)); ?></td>
                                 </tr>
                                 <?php endif; ?>
                                 
                                 <tr id="promo_code_row">
                                    <td colspan="2">
                                        <div class="input-group mb-3 coupon-wrapper">
                                            <input type="text" name="promo_code_input" id="promo_code_input" class="form-control" placeholder="<?php echo e(__('Promo Code')); ?>" style="border-radius: 5px 0 0 5px !important; height: auto !important; width: auto !important;">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button" id="apply_coupon_btn"><?php echo e(__('Apply')); ?></button>
                                            </div>
                                        </div>
                                        <div id="coupon_msg"></div>
                                    </td>
                                    <td></td>
                                 </tr>
                                 <tr id="discount_row" style="display: none;">
                                    <td colspan="2">
                                        <span class="text-inverse"><?php echo e(__('DISCOUNT')); ?></span><br>
                                    </td>
                                    <td class="text-right text-success" id="discount_amount"></td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <span class="text-inverse">SUBTOTAL</span><br>
                                    </td>
                                    <td></td>
                                    <td class="text-right" id="subtotal_price_val"><?php echo e(amount_with_currency_symbol($price)); ?></td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <span class="text-inverse">TAX</span><br>
                                    </td>
                                    <td class="text-center"><?php echo e(get_static_option('booking_tax')); ?>%</td>
                                    <td class="text-right" id="tax_val"><?php echo e(amount_with_currency_symbol($tax)); ?></td>
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
                                 </div>
                                 <div class="sub-price">
                                 </div>
                              </div>
                           </div>
                           <div class="invoice-price-right">
                              <small>TOTAL</small> <span class="f-w-600" id="total_price_val"><?php echo e(amount_with_currency_symbol($total_price)); ?></span>
                           </div>
                        </div>
                        <!-- end invoice-price -->
                     </div>
                     <!-- end invoice-content -->
                     <!-- begin invoice-note -->
                     <!-- end invoice-note -->
                     <!-- begin invoice-footer -->
                     <div class="invoice-footer text-center">
                        <?php 
                            $transport = getTransport($alldata->transport);
                            $transport_price = $transport->overtime_price;
                        ?>
                        <?php if($alldata->helpers != 0): ?>
                            <?php
                                $helper = getHelperDetails($alldata->helpers);
                                $helper_price = $helper->overtime_price;
                                $helper_invoice_name = $helper->invoice_name;
                            ?>
                        <?php else: ?>
                            <?php
                                $helper_price = 0;
                                $helper_invoice_name = "";
                            ?>
                        <?php endif; ?>
                        
                        <?php
                            $overtime_price = $transport_price +  $helper_price;
                            $obtitle = "Please note that if the booking is not completed within " . convertMinutesToHoursAndMinutes($alldata->duration*60) . ", we would charge you " . amount_with_currency_symbol($overtime_price) . " per hour until your job is completed";
                        ?>
                        <p style="font-size: 1rem;" class="text-danger" ><?php echo e($obtitle); ?></p>
                        <label style="font-size: 1rem;" ><input type="checkbox" id="tccheck"> Please accept <a class="text-primary" href="<?php echo e(route('frontend.dynamic.page', 'terms-and-conditions')); ?>" >Terms & Conditions</a></label>
                        <div class="mt-2 w-100 d-flex align-items-center justify-content-center" >
                            <button onclick="history.back()" class="btn-dagency px-3 m-2 noprint">Back</button>
                            
                            <form method="POST" action="<?php echo e(route('frontend.book.save')); ?>" onsubmit="return validateForm()" >
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="payment_type" value="full" >
                                <input type="hidden" name="service" value="<?php echo e($alldata->service); ?>" >
                                <input type="hidden" name="order_trx" value="<?php echo e($alldata->order_trx); ?>" >
                                <input type="hidden" name="duration" value="<?php echo e($alldata->duration); ?>" >
                                <input type="hidden" name="helpers" value="<?php echo e($alldata->helpers); ?>" >
                                <input type="hidden" name="name" value="<?php echo e($alldata->name); ?>" >
                                <input type="hidden" name="email" value="<?php echo e($alldata->email); ?>" >
                                <input type="hidden" name="phone" value="<?php echo e($alldata->phone); ?>" >
                                <input type="hidden" name="date" value="<?php echo e($alldata->date); ?>" >
                                <input type="hidden" name="time" value="<?php echo e($alldata->time); ?>" >
                                <input type="hidden" name="transport" value="<?php echo e($alldata->transport); ?>" >
                                <input type="hidden" name="insurance" value="<?php echo e($alldata->insurance); ?>" >
                                <input type="hidden" name="message" value="<?php echo e($alldata->message); ?>" >
                                <?php if($alldata->inventoryInput): ?>
                                <?php $__currentLoopData = $alldata->inventoryInput; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $InvInput): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <input type="hidden" name="inventoryInput[]" value="<?php echo e($InvInput); ?>" >
                                <input type="hidden" name="inventoryQty[]" value="<?php echo e($alldata->inventoryQty[$key]); ?>" >
                                <input type="hidden" name="inventoryPrice[]" value="<?php echo e($alldata->inventoryPrice[$key]); ?>" >
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                
                                <?php $__currentLoopData = $alldata->location; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $locs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <input type="hidden" name="location[]" value="<?php echo e($locs); ?>" >
                                <input type="hidden" name="house[]" value="<?php echo e($alldata->house[$key]); ?>" >
                                <input type="hidden" name="city[]" value="<?php echo e($alldata->city[$key]); ?>" >
                                <input type="hidden" name="postcode[]" value="<?php echo e($alldata->postcode[$key]); ?>" >
                                <input type="hidden" name="floor[]" value="<?php echo e($alldata->floor[$key]); ?>" >
                                <input type="hidden" name="elevator[]" value="<?php echo e($alldata->elevator[$key]); ?>" >
                                <input type="hidden" name="parking[]" value="<?php echo e($alldata->parking[$key]); ?>" >
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                                <input type="hidden" name="coupon" class="coupon_code_hidden" value="" >
                                <button type="submit" class="btn-dagency px-3 m-2 noprint">Pay Now</button>
                            </form>
                            
                            <form method="POST" action="<?php echo e(route('frontend.book.save')); ?>" onsubmit="return validateForm()" >
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="payment_type" value="advance" >
                                <input type="hidden" name="service" value="<?php echo e($alldata->service); ?>" >
                                <input type="hidden" name="order_trx" value="<?php echo e($alldata->order_trx); ?>" >
                                <input type="hidden" name="duration" value="<?php echo e($alldata->duration); ?>" >
                                <input type="hidden" name="helpers" value="<?php echo e($alldata->helpers); ?>" >
                                <input type="hidden" name="name" value="<?php echo e($alldata->name); ?>" >
                                <input type="hidden" name="email" value="<?php echo e($alldata->email); ?>" >
                                <input type="hidden" name="phone" value="<?php echo e($alldata->phone); ?>" >
                                <input type="hidden" name="date" value="<?php echo e($alldata->date); ?>" >
                                <input type="hidden" name="time" value="<?php echo e($alldata->time); ?>" >
                                <input type="hidden" name="transport" value="<?php echo e($alldata->transport); ?>" >
                                <input type="hidden" name="insurance" value="<?php echo e($alldata->insurance); ?>" >
                                <input type="hidden" name="message" value="<?php echo e($alldata->message); ?>" >
                                <?php if($alldata->inventoryInput): ?>
                                <?php $__currentLoopData = $alldata->inventoryInput; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $InvInput): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <input type="hidden" name="inventoryInput[]" value="<?php echo e($InvInput); ?>" >
                                <input type="hidden" name="inventoryQty[]" value="<?php echo e($alldata->inventoryQty[$key]); ?>" >
                                <input type="hidden" name="inventoryPrice[]" value="<?php echo e($alldata->inventoryPrice[$key]); ?>" >
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                
                                <?php $__currentLoopData = $alldata->location; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $locs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <input type="hidden" name="location[]" value="<?php echo e($locs); ?>" >
                                <input type="hidden" name="house[]" value="<?php echo e($alldata->house[$key]); ?>" >
                                <input type="hidden" name="city[]" value="<?php echo e($alldata->city[$key]); ?>" >
                                <input type="hidden" name="postcode[]" value="<?php echo e($alldata->postcode[$key]); ?>" >
                                <input type="hidden" name="floor[]" value="<?php echo e($alldata->floor[$key]); ?>" >
                                <input type="hidden" name="elevator[]" value="<?php echo e($alldata->elevator[$key]); ?>" >
                                <input type="hidden" name="parking[]" value="<?php echo e($alldata->parking[$key]); ?>" >
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <input type="hidden" name="coupon" class="coupon_code_hidden" value="" >
                                <button type="submit" class="btn-dagency px-3 m-2 noprint">Pay Advance 30%</button>
                            </form>
                        </div>
                        <?php echo get_footer_copyright_text(); ?>

                     </div>
                     <!-- end invoice-footer -->
                  </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
function validateForm() {
    const tcCheck = document.getElementById('tccheck');
    if (!tcCheck.checked) {
        alert('Please accept the Terms & Conditions before proceeding.');
        return false;
    }
    return true;
}

$(document).on('click','#apply_coupon_btn',function (e) {
    e.preventDefault();
    var code = $('#promo_code_input').val();
    var amount = "<?php echo e($price); ?>";
    var email = "<?php echo e($alldata->email); ?>";

    if(code == ''){
        $('#coupon_msg').html('<span class="text-danger"><?php echo e(__('Please enter a coupon code')); ?></span>');
        return false;
    }

    $.ajax({
        url: "<?php echo e(route('frontend.removal.validate.coupon')); ?>",
        type: "GET",
        data: {
            'code' : code,
            'amount' : amount,
            'email' : email
        },
        success: function (data) {
            if(data.status == 'success'){
                $('#coupon_msg').html('<span class="text-success">'+data.msg+'</span>');
                $('.coupon_code_hidden').val(code);
                
                // Update display
                var discount = data.discount;
                var tax_percent = "<?php echo e(get_static_option('booking_tax')); ?>";
                var updated_subtotal = amount - discount;
                var updated_tax = (updated_subtotal * tax_percent) / 100;
                var updated_total = updated_subtotal + updated_tax;

                $('#discount_row').show();
                $('#discount_amount').text("- " + format_amount(discount));
                $('#subtotal_price_val').text(format_amount(updated_subtotal));
                $('#tax_val').text(format_amount(updated_tax));
                $('#total_price_val').text(format_amount(updated_total));
                
            }else{
                $('#coupon_msg').html('<span class="text-danger">'+data.msg+'</span>');
                $('#coupon_code_full').val('');
                $('#coupon_code_advance').val('');
                $('#discount_row').hide();
                // Reset display (optional, but good for UX)
                $('#subtotal_price_val').text("<?php echo e(amount_with_currency_symbol($price)); ?>");
                $('#tax_val').text("<?php echo e(amount_with_currency_symbol($tax)); ?>");
                $('#total_price_val').text("<?php echo e(amount_with_currency_symbol($total_price)); ?>");
            }
        }
    });
});

function format_amount(amount) {
    var symbol = "<?php echo e(site_currency_symbol()); ?>";
    return symbol + parseFloat(amount).toFixed(2);
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.frontend-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\express-van\@core\resources\views/frontend/pages/book/confirmation.blade.php ENDPATH**/ ?>