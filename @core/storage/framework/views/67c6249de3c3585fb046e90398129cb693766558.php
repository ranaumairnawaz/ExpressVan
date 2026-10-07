<?php $__env->startSection('site-title'); ?>
    Order# <?php echo e($order->trx); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    Order# <?php echo e($order->trx); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
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
<?php echo $__env->make('frontend.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('frontend.partials.navbar-variant.navbar-'.get_static_option('navbar_variant'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="page-content service-details padding-top-20">
        <div id="container" class="container my-5">
            <?php
            if(isset($notify)){
                $not = showNotification($notify);
            }
            else{
                $not = "";
            }
            ?>
            <?php echo e($not); ?>

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
                              <strong class="text-inverse"><?php echo e(filter_static_option_value('site_'.$user_select_lang_slug.'_title',$global_static_field_data)); ?></strong>
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
                              <strong class="text-inverse"><?php echo e($order->name); ?></strong>
                              <p>
                                  <?php echo e($order->email); ?></br>
                                  <?php echo e($order->phone); ?>

                              </p>
                           </address>
                        </div>
                        <div class="col-md-4 text-right">
                           <small>Order #<?php echo e($order->trx); ?></small>
                           <?php
                                $startTime = new DateTime($order->booking_time);
                                $totalTime = $order->time;
                                
                                // Convert total time to minutes and add to start time
                                $minutesToAdd = $totalTime * 60;
                                $endTime = clone $startTime;
                                $endTime->modify("+{$minutesToAdd} minutes");
                            ?>
                            <div class="date text-inverse m-t-5"><?php echo e(date_format(date_create($order->date), "D jS \of M Y")); ?></div>
                            <div class="date text-inverse m-t-5"><?php echo e($startTime->format('H:i')); ?> - <?php echo e($endTime->format('H:i')); ?></div>
                           <div class="invoice-detail"><?php if(getServiceDetails($order->service_id) != NULL): ?> <?php echo e(getServiceDetails($order->service_id)->title); ?> <?php else: ?> Packers and Shifters <?php endif; ?>
                           </div>
                           <div class="invoice-detail">
                              Ride along: <?php if($order->passengers == 1): ?> Yes <?php else: ?> No <?php endif; ?>
                           </div>
                           <?php if($order_insurance): ?>
                           <div class="invoice-detail">
                               Insurance cover upto <?php echo e(amount_with_currency_symbol($order_insurance->cover)); ?>

                           </div>
                           <?php endif; ?>
                        </div>
                        <?php if($order->note != ""): ?>
                        <div class="col-md-12" >
                            <p>Message: <?php echo e($order->note); ?></p>
                        </div>
                        <?php endif; ?>
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
                                <?php
                                $places = getOrderPlaces($order->trx);
                                ?>
                                <?php $__currentLoopData = $places; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $place): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <tr>
                                    <td><?php echo e($key+1); ?></td>
                                    <td><?php echo e($place->house); ?></td>
                                    <td><?php echo e($place->address); ?></td>
                                    <td>
                                        <?php if(getFloorDetails($place->floor)->elevator_price == 0): ?>
                                        <?php echo e(getFloorDetails($place->floor)->name); ?>

                                        <?php else: ?>
                                        <?php echo e(getFloorDetails($place->floor)->name); ?> <?php if($place->elevator == 1): ?> with <?php else: ?> without <?php endif; ?> Eelevator
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($place->city); ?></td>
                                    <td><?php echo e($place->postcode); ?></td>
                                    <td><?php echo e(getParkingDetails($place->parking)->name); ?></td>
                                 </tr>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </tbody>
                           </table>
                        </div>
                        <?php
                        $items = getInventoryItems($order->trx);
                        ?>
                        <?php if($items->count() > 0): ?>
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
                                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <tr>
                                    <td><?php echo e($key+1); ?></td>
                                    <td><?php echo e($item->item); ?></td>
                                    <td><?php echo e($item->qty); ?></td>
                                 </tr>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                <?php $__currentLoopData = $order_bills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ob): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <tr>
                                    <td>
                                       <span class="text-inverse"><?php echo e($ob->name); ?></span><br>
                                    </td>
                                    <td class="text-center">
                                        <?php if($ob->quantity != 0): ?>
                                            <?php if($ob->unit == 'mins'): ?>
                                                <?php echo e(convertMinutesToHoursAndMinutes($ob->quantity)); ?>

                                            <?php else: ?>
                                                <?php if($ob->unit != 0): ?>
                                                    <?php echo e($ob->quantity); ?>  <?php echo e($ob->unit); ?>

                                                <?php else: ?>
                                                    <?php echo e($ob->quantity); ?>

                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-right"><?php echo e(amount_with_currency_symbol($ob->price)); ?></td>
                                 </tr>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 <?php if($order->coupon_code): ?>
                                 <tr>
                                    <td>
                                       <span class="text-inverse">DISCOUNT (<?php echo e($order->coupon_code); ?>)</span><br>
                                    </td>
                                    <td></td>
                                    <td class="text-right text-success">- <?php echo e(amount_with_currency_symbol($order->coupon_discount)); ?></td>
                                 </tr>
                                 <?php endif; ?>
                                 <tr>
                                    <td>
                                       <span class="text-inverse">SUBTOTAL</span><br>
                                    </td>
                                    <td></td>
                                    <td class="text-right"><?php echo e(amount_with_currency_symbol($order->price)); ?></td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <span class="text-inverse">TAX</span><br>
                                    </td>
                                    <td class="text-center"><?php echo e(get_static_option('booking_tax')); ?>%</td>
                                    <td class="text-right"><?php echo e(amount_with_currency_symbol($order->tax)); ?></td>
                                 </tr>
                                 <?php if($order->payment_status == 2): ?>
                                 <tr>
                                     <td>Paid Amount</td>
                                     <td></td>
                                     <td class="text-right" >
                                         <?php echo e(amount_with_currency_symbol(($order->total*30)/100)); ?>

                                     </td>
                                 </tr>
                                 <tr>
                                     <td>Remaining Amount</td>
                                     <td></td>
                                     <td class="text-right" >
                                         <?php echo e(amount_with_currency_symbol(($order->total*70)/100)); ?>

                                     </td>
                                 </tr>
                                 <?php endif; ?>
                                 <?php if($order->payment_status == 1): ?>
                                 <tr>
                                     <td>Paid Amount</td>
                                     <td></td>
                                     <td class="text-right" >
                                         <?php echo e(amount_with_currency_symbol($order->total)); ?>

                                     </td>
                                 </tr>
                                 <?php endif; ?>
                                 <tr>
                                     <td>Total</td>
                                     <td></td>
                                     <td class="text-right" >
                                         <?php echo e(amount_with_currency_symbol($order->total)); ?>

                                     </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     
                    <?php 
                        $transport = getTransport($order->van_id);
                        $transport_price = $transport->overtime_price;
                    ?>
                    
                    <?php if($order->helpers != 0): ?>
                        <?php
                            $helper = getHelperDetails($order->helpers);
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
                        $obtitle = "Overtime price for " . $transport->name . "" . $helper_invoice_name;
                    ?>
                    
                 <?php if($order->remaining != 0 || $order->paid_overtime != 0): ?>
                    <div class="table-responsive w-100">
                       <table class="table table-invoice">
                          <thead>
                             <tr>
                              <th colspan="100%" class="text-center" >
                                  Overtime Prices
                              </th>
                             </tr>
                             <tr>
                                <th>ITEM</th>
                                <th class="text-center">QUANTITY</th>
                                <th class="text-right">PRICE</th>
                                <th class="text-right">STATUS</th>
                             </tr>
                          </thead>
                          <tbody>
                            <?php if($order->remaining != 0): ?>
                             <tr>
                                <td>
                                   <span class="text-inverse"><?php echo e($obtitle); ?></span><br>
                                </td>
                                <td class="text-center" ><?php echo e(convertMinutesToHoursAndMinutes(($order->remaining/$overtime_price)*60)); ?></td>
                                <td class="text-center"><?php echo e(amount_with_currency_symbol($order->remaining)); ?></td>
                                <td class="text-right">Unpaid</td>
                             </tr>
                            <?php endif; ?>
                            <?php if($order->paid_overtime != 0): ?>
                             <tr>
                                <td>
                                   <span class="text-inverse"><?php echo e($obtitle); ?></span><br>
                                </td>
                                <td class="text-center" ><?php echo e(convertMinutesToHoursAndMinutes(($order->paid_overtime/$overtime_price)*60)); ?></td>
                                <td class="text-center"><?php echo e(amount_with_currency_symbol($order->paid_overtime)); ?></td>
                                <td class="text-right" >Paid</td>
                             </tr>
                            <?php endif; ?>
                          </tbody>
                       </table>
                    </div>
                 <?php endif; ?>
                 
                <div class="invoice-price">
                   <div class="invoice-price-left" style="padding: 5px;">
                      <div class="invoice-price-row">
                         <div class="sub-price d-flex align-items-center justify-content-evenly" style="flex-wrap: wrap;">
                             <?php if($order->status == 0): ?>
                             <a class="badge badge-primary text-white rounded-pill px-1 mx-1 mb-1" >Pending</a>
                             <?php elseif($order->status == 1): ?>
                             <a class="badge badge-info text-white rounded-pill px-1 mx-1 mb-1" >Booking Accepted</a>
                             <?php elseif($order->status == 2): ?>
                             <a class="badge badge-success text-white rounded-pill px-1 mx-1 mb-1" >Completed</a>
                             <?php elseif($order->status == 3): ?>
                             <a class="badge badge-danger text-white rounded-pill px-1 mx-1 mb-1" >Cancelled</a>
                             <?php elseif($order->status == 4): ?>
                             <a class="badge badge-danger text-white rounded-pill px-1 mx-1 mb-1" >Cancelled & Returned</a>
                             <?php endif; ?>
                             
                             <?php if($order->payment_status == 0): ?>
                             <a class="badge badge-primary text-white rounded-pill px-1 mx-1 mb-1" >Unpaid</a>
                             <?php elseif($order->payment_status == 2): ?>
                             <a class="badge badge-info text-white rounded-pill px-1 mx-1 mb-1" >Deposit Paid</a>
                             <small class="my-0 mx-1" >Remaining <?php echo e(amount_with_currency_symbol(($order->total*70)/100)); ?></small>
                             <?php elseif($order->payment_status == 1): ?>
                             <a class="badge badge-success text-white rounded-pill px-1 mx-1 mb-1" >Paid</a>
                             <?php elseif($order->payment_status == 3): ?>
                             <a class="badge badge-danger text-white rounded-pill px-1 mx-1 mb-1" >Cancelled</a>
                             <?php endif; ?>
                         </div>
                      </div>
                   </div>
                   <div class="invoice-price-right">
                      <small>GRAND TOTAL</small> <span class="f-w-600"><?php echo e(amount_with_currency_symbol($order->total + $order->paid_overtime + $order->remaining)); ?></span>
                   </div>
                </div>
                     
                     <div class="invoice-footer text-center">
                        <?php if($order->remaining == 0): ?>
                        <p style="font-size: 1rem;" class="text-danger">
                            <?php echo e($obtitle); ?> is £<?php echo e($overtime_price); ?>/hr
                        </p>
                        <?php endif; ?>
                        <div class="mt-2 w-100 d-flex align-items-center justify-content-center flex-wrap" >
                            <a href="<?php echo e(route('frontend.book.order.back',$order->trx)); ?>" class="btn-dagency px-3 m-2 noprint"> Close Order Page</a>
                            <?php if($order->payment_status == 0): ?>
                            <a href="<?php echo e(route('frontend.book.order.checkout',[$order->trx,'full'])); ?>" class="btn-dagency px-3 m-2 noprint">Pay Now</a>
                            <a href="<?php echo e(route('frontend.book.order.checkout',[$order->trx,'advance'])); ?>" class="btn-dagency px-3 m-2 noprint">Pay Advance 30%</a>
                            <?php elseif($order->payment_status == 2): ?>
                            <a href="<?php echo e(route('frontend.book.order.checkout',[$order->trx,'remaining'])); ?>" class="btn-dagency px-3 m-2 noprint">Pay Remaining</a>
                            <a href="#" onclick="openSmallWindow('<?php echo e(route('frontend.book.order.print',$order->trx)); ?>')" class="btn-dagency px-3 m-2 noprint">Print</a>
                            <?php else: ?>
                            <a href="#" onclick="openSmallWindow('<?php echo e(route('frontend.book.order.print',$order->trx)); ?>')" class="btn-dagency px-3 m-2 noprint">Print</a>
                            <?php endif; ?>
                            
                            <?php if($order->remaining != 0): ?>
                                <?php if($order->remaining_paid == 0): ?>
                                    <a href="<?php echo e(route('frontend.book.order.checkout',[$order->trx,'overtime'])); ?>" class="btn-dagency px-3 m-2 noprint">Pay Overtime</a>
                                <?php endif; ?>
                            <?php endif; ?>
                            
                        </div>
                        <?php echo get_footer_copyright_text(); ?>

                     </div>
                     <!-- end invoice-footer -->
                  </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function openSmallWindow(url) {
            var width = 600;
            var height = 900;
            var left = (screen.width - width) / 2;
            var top = (screen.height - height) / 2;

            window.open(
                url,
                '_blank',
                'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left
            );
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.frontend-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\express-van\@core\resources\views/frontend/pages/book/invoice.blade.php ENDPATH**/ ?>