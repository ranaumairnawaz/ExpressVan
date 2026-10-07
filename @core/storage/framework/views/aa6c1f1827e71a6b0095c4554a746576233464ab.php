
<?php $__env->startSection('style'); ?>
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
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/media-uploader.css')); ?>">
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    Order #<?php echo e($order->trx); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.error-msg','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('error-msg'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.flash-msg','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('flash-msg'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                <div class="d-flex justify-content-end align-items-end flex-column mb-4 px-4 w-100">
                    <div>
                        <?php if($order->payment_status == 0): ?>
                        <form action="<?php echo e(route('admin.removal.payment.reminder', $order->id)); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-warning rounded-sm" onclick="return confirm('Send a payment reminder email to the customer?');"><i class="ti-email"></i> Send Payment Reminder</button>
                        </form>
                        <?php endif; ?>
                    </div>
                    <?php if($order->payment_reminder_sent_at): ?>
                    <small class="text-muted d-block mt-1">Last reminder sent: <?php echo e(\Carbon\Carbon::parse($order->payment_reminder_sent_at)->format('d M Y, h:i A')); ?></small>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-12 px-4">
                <div class="invoice" style="box-shadow: rgba(0, 0, 0, 0.25) 0px 25px 50px -12px;">
                 <!-- end invoice-company -->
                 <!-- begin invoice-header -->
                 <div class="invoice-header row">
                    <div class="col-md-6">
                       <small>User Details</small>
                        <address class="m-t-5 m-b-5">
                          <strong class="text-inverse"><?php echo e($order->name); ?></strong>
                          <p>
                              <?php echo e($order->email); ?></br>
                              <?php echo e($order->phone); ?>

                          </p>
                       </address>
                    </div>
                    <div class="col-md-6 text-right">
                       <small>Order #<?php echo e($order->trx); ?></small>
                       <div class="date text-inverse m-t-5"><?php echo e(date_format(date_create($order->date), "l jS \of M Y")); ?></div>
                       <?php
                            $startTime = new DateTime($order->booking_time);
                            $totalTime = $order->time;
                            
                            // Convert total time to minutes and add to start time
                            $minutesToAdd = $totalTime * 60;
                            $endTime = clone $startTime;
                            $endTime->modify("+{$minutesToAdd} minutes");
                        ?>
                        
                        <div class="date text-inverse m-t-5">
                            <?php echo e($startTime->format('H:i')); ?> - <?php echo e($endTime->format('H:i')); ?>

                        </div>
                       <div class="invoice-detail">
                          Invoice for Packers and Shifters Booking <?php if($order->payment_status == 0): ?> (UNPAID) <?php endif; ?>
                          </br>
                          Booked at: <?php echo e(date_format(date_create($order->created_at), "l jS \\of M Y, h:i A")); ?>

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
                                <th>House</th>
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
                                <td><?php echo e($place->address); ?></td>
                                <td><?php echo e($place->house); ?></td>
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
                            <?php
                            $order_bills = getOrderBills($order->trx);
                            ?>
                            <?php $__currentLoopData = $order_bills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ob): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <tr>
                                <td>
                                   <span class="text-inverse"><?php echo e($ob->name); ?></span><br>
                                </td>
                                <td class="text-center">
                                    <?php if($ob->quantity != 0): ?>
                                        <?php echo e($ob->quantity); ?>

                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if($ob->unit != 0): ?>
                                        <?php echo e($ob->unit); ?>

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
                                <td></td>
                                <td class="text-right text-success">- <?php echo e(amount_with_currency_symbol($order->coupon_discount)); ?></td>
                             </tr>
                             <?php endif; ?>
                             <tr>
                                <td>
                                   <span class="text-inverse">SUBTOTAL</span><br>
                                </td>
                                <td></td>
                                <td></td>
                                <td class="text-right"><?php echo e(amount_with_currency_symbol($order->price)); ?></td>
                             </tr>
                             <tr>
                                <td>
                                   <span class="text-inverse">TAX</span><br>
                                </td>
                                <td></td>
                                <td class="text-center"><?php echo e(get_static_option('booking_tax')); ?>%</td>
                                <td class="text-right"><?php echo e(amount_with_currency_symbol($order->tax)); ?></td>
                             </tr>
                             <?php if($order->payment_status == 2): ?>
                             <tr>
                                 <td>Paid Amount</td>
                                 <td></td>
                                 <td></td>
                                 <td class="text-right" >
                                     <?php echo e(amount_with_currency_symbol(($order->total*30)/100)); ?>

                                 </td>
                             </tr>
                             <tr>
                                 <td>Remaining Amount</td>
                                 <td></td>
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
                                 <td></td>
                                 <td class="text-right" >
                                     <?php echo e(amount_with_currency_symbol($order->total)); ?>

                                 </td>
                             </tr>
                             <?php endif; ?>
                             <tr>
                                 <td>total</td>
                                 <td></td>
                                 <td></td>
                                 <td class="text-right" >
                                     <?php echo e(amount_with_currency_symbol($order->total)); ?>

                                 </td>
                             </tr>
                          </tbody>
                       </table>
                    </div>
                    <!-- end table-responsive -->
                    <!-- begin invoice-price -->
                    <div class="invoice-price">
                       <div class="row">
                         <a href="#" onclick="openSmallWindow('<?php echo e(route('frontend.book.order.print',$order->trx)); ?>')" class="col-md-3 mb-1 p-3 badge badge-primary text-white noprint">Print Invoice</a>
                         
                         <?php if($order->payment_status == 0): ?>
                         <a class="badge badge-primary text-white col-md-3 mb-1 p-3" >UNPAID</a>
                         <?php elseif($order->payment_status == 2): ?>
                         <a class="badge badge-info text-white col-md-3 mb-1 p-3" >DEPOSIT PAID</a>
                         <div class="col-md-3 mb-1" >
                             <form action="<?php echo e(route('admin.removal.change',$order->trx)); ?>" method="POST" >
                                 <?php echo csrf_field(); ?>
                                 <div class="form-group mb-0 mx-2" >
                                     <select onchange="confirmStatusChange(event)" class="form-control" name="status" <?php echo e($order->status == 4 ? 'disabled' : ''); ?> >
                                         <?php if($order->status == 0): ?>
                                         <option selected value="0" >Pending</option>
                                         <?php else: ?>
                                         <option value="0">Pending</option>
                                         <?php endif; ?>
                                         <?php if($order->status == 1): ?>
                                         <option selected value="1" >Booking Accepted</option>
                                         <?php else: ?>
                                         <option value="1">Booking Accepted</option>
                                         <?php endif; ?>
                                         <?php if($order->status == 2): ?>
                                         <option selected value="2" >Completed</option>
                                         <?php else: ?>
                                         <option value="2">Completed</option>
                                         <?php endif; ?>
                                         <?php if($order->status == 3): ?>
                                         <option selected value="3" >Cancelled</option>
                                         <?php else: ?>
                                         <option value="3">Cancelled</option>
                                         <?php endif; ?>
                                         <?php if($order->status == 4): ?>
                                         <option selected value="4" >Cancelled & Refunded</option>
                                         <?php else: ?>
                                         <option value="4">Cancelled & Refunded</option>
                                         <?php endif; ?>
                                     </select>
                                 </div>
                             </form>
                         </div>
                         
                         <?php if($order->status != 4): ?><a class="badge badge-primary text-white noprint col-md-3 mb-1 p-3" href="<?php echo e(route('admin.removal.remaining.notify',$order->trx)); ?>" >Notify user</a><?php endif; ?>
                         
                         
                         <?php elseif($order->payment_status == 1): ?>
                         <a class="badge badge-success text-white col-md-3 mb-1 p-3" >PAID</a>
                         <div class="col-md-3 mb-1" >
                             <form action="<?php echo e(route('admin.removal.change',$order->trx)); ?>" method="POST" >
                                 <?php echo csrf_field(); ?>
                                 <div class="form-group mb-0" >
                                     <select onchange="confirmStatusChange(event)" class="form-control" name="status" <?php echo e($order->status == 4 ? 'disabled' : ''); ?> >
                                         <?php if($order->status == 0): ?>
                                         <option selected value="0" >Pending</option>
                                         <?php else: ?>
                                         <option value="0">Pending</option>
                                         <?php endif; ?>
                                         <?php if($order->status == 1): ?>
                                         <option selected value="1" >Booking Accepted</option>
                                         <?php else: ?>
                                         <option value="1">Booking Accepted</option>
                                         <?php endif; ?>
                                         <?php if($order->status == 2): ?>
                                         <option selected value="2" >Completed</option>
                                         <?php else: ?>
                                         <option value="2">Completed</option>
                                         <?php endif; ?>
                                         <?php if($order->status == 3): ?>
                                         <option selected value="3" >Cancelled</option>
                                         <?php else: ?>
                                         <option value="3">Cancelled</option>
                                         <?php endif; ?>
                                         <?php if($order->status == 4): ?>
                                         <option selected value="4" >Cancelled & Refunded</option>
                                         <?php else: ?>
                                         <option value="4">Cancelled & Refunded</option>
                                         <?php endif; ?>
                                     </select>
                                 </div>
                             </form>
                         </div>
                         <?php elseif($order->payment_status == 3): ?>
                         <a class="badge badge-danger text-white col-md-3 mb-1 p-3" >CANCELLED</a>
                         <?php endif; ?>
                     </div>
                    </div>
                    <!-- end invoice-price -->
                 </div>
                 
                <?php 
                    $transport = getTransport($order->van_id);
                    $transport_price = $transport->overtime_price;
                ?>
                
                <?php if($order->helpers != 0): ?>
                    <?php
                        $helper = getHelperDetails($order->helpers);
                        $helper_invoice_name = $helper->invoice_name;
                        $helper_price = $helper->overtime_price;
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
                 <div class="invoice-content">
                    <div class="table-responsive w-100">
                       <table class="table table-invoice">
                          <thead>
                             <tr>
                                <th>ITEM</th>
                                <th class="text-center">QUANTITY</th>
                                <th class="text-right" width="20%">PRICE</th>
                             </tr>
                          </thead>
                          <tbody>
                            <?php if($order->remaining != 0): ?>
                             <tr>
                                <td>
                                   <span class="text-inverse">Unpaid <?php echo e($obtitle); ?></span><br>
                                </td>
                                <td class="text-center" ><?php echo e(convertMinutesToHoursAndMinutes(($order->remaining/$overtime_price)*60)); ?></td>
                                <td class="text-right"><?php echo e(amount_with_currency_symbol($order->remaining)); ?></td>
                             </tr>
                            <?php endif; ?>
                            <?php if($order->paid_overtime != 0): ?>
                             <tr>
                                <td>
                                   <span class="text-inverse">Paid <?php echo e($obtitle); ?></span><br>
                                </td>
                                <td class="text-center" ><?php echo e(convertMinutesToHoursAndMinutes(($order->paid_overtime/$overtime_price)*60)); ?></td>
                                <td class="text-right"><?php echo e(amount_with_currency_symbol($order->paid_overtime)); ?></td>
                             </tr>
                            <?php endif; ?>
                            <tr>
                                <td>
                                   <span class="text-inverse">GRAND TOTAL</span><br>
                                </td>
                                <td class="text-right" colspan="2"><?php echo e(amount_with_currency_symbol($order->total + $order->paid_overtime + $order->remaining)); ?></td>
                             </tr>
                          </tbody>
                       </table>
                    </div>
                    
                    <div class="invoice-price">
                       <div class="invoice-price-left">
                          <div class="invoice-price-row">
                             <div class="sub-price row align-items-center">
                                <?php if($order->remaining_paid == 0): ?>
                                <a class="badge badge-primary text-white p-3 mx-2" >UNPAID</a>
                                <?php if($order->status != 4): ?>
                                <a class="badge badge-primary p-3 text-white mx-2 noprint" href="<?php echo e(route('admin.removal.overtime.notify',$order->trx)); ?>" >Notify user</a>
                                <?php endif; ?>
                                <?php else: ?>
                                <a class="badge badge-success text-white p-3 mx-2" >PAID</a>
                                <?php endif; ?>
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>
                 <?php endif; ?>
                 
                 <div class="invoice-footer text-center">
                    <p style="font-size: 1rem;" class="text-danger">
                        <?php echo e($obtitle); ?> is £<?php echo e($overtime_price); ?>/hr
                    </p>
                    <form action="<?php echo e(route('admin.removal.update')); ?>" method="POST" >
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="trx" value="<?php echo e($order->trx); ?>" >
                        <input type="hidden" name="title" value="<?php echo e($obtitle); ?>" >
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <input type="number" class="form-control" id="overtime_hours" name="overtime_hours" placeholder="Overtime Hours" <?php if($order->remaining != 0): ?> min="-<?php echo e($order->remaining/$overtime_price); ?>" <?php else: ?> min="0" <?php endif; ?> step="0.5" <?php echo e($order->status == 4 ? 'disabled' : ''); ?> />
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <input type="text" readonly class="form-control" id="overtime_price" name="overtime_price" placeholder="Overtime Price" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100" <?php echo e($order->status == 4 ? 'disabled' : ''); ?>>Update</button>
                            </div>
                        </div>
                    </form>
                    
                    <script>
                        // Get the overtime price per hour from the server-side variable
                        const overtimeRate = <?php echo e($overtime_price); ?>;
                        
                        document.getElementById('overtime_hours').addEventListener('input', function () {
                            const hours = parseFloat(this.value) || 0;
                            const totalPrice = (overtimeRate * hours).toFixed(2);
                            document.getElementById('overtime_price').value = `${totalPrice}`;
                        });
                    </script>
                 </div>
                 
                 <!-- begin invoice-note -->
                 <!-- end invoice-note -->
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
<?php $__env->startSection('script'); ?>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Function to handle status change confirmation
        function confirmStatusChange(event) {
            event.preventDefault(); // Prevent the default form submission

            const form = event.target.closest('form'); // Get the form element
            const selectedStatus = event.target.value; // Get the selected status

            // Define status messages for the confirmation pop-up
            const statusMessages = {
                0: "Pending",
                1: "Booking Accepted",
                2: "Completed",
                3: "Cancelled",
                4: "Cancelled & Refunded"
            };

            // Show SweetAlert2 confirmation pop-up
            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to change the status to "${statusMessages[selectedStatus]}".`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, change it!',
                cancelButtonText: 'No, cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    form.submit();
                } else {
                    // If cancelled, reset the dropdown to its previous value
                    event.target.value = "<?php echo e($order->status); ?>";
                }
            });
        }

        
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\XAMPP\htdocs\removal\@core\resources\views/backend/pages/removal/view.blade.php ENDPATH**/ ?>