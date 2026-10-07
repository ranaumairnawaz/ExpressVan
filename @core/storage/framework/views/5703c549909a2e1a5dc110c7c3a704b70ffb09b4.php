
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
        .pac-container {
            z-index: 10000 !important;
        }
    </style>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/media-uploader.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Removal Orders')); ?>

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
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <h4 class="header-title"><?php echo e($type); ?> <?php echo e(__('Removal Orders')); ?></h4>
                            <div class="btn-wrapper">
                                <a href="#" data-toggle="modal" data-target="#quick_booking_modal" class="btn btn-primary mb-3"><?php echo e(__('Quick Booking')); ?></a>
                            </div>
                        </div>
                        <div class="table-wrap table-responsive">
                            <table class="table table-default" id="all_blog_table">
                                <thead>
                                <th><?php echo e(__('ID')); ?></th>
                                <th><?php echo e(__('Order #')); ?></th>
                                <th><?php echo e(__('Date')); ?></th>
                                <th><?php echo e(__('User')); ?></th>
                                <th><?php echo e(__('Distance')); ?></th>
                                <th><?php echo e(__('Total Price')); ?></th>
                                <th><?php echo e(__('Statuses')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($data->id); ?></td>
                                        <td><?php echo e($data->trx); ?></td>
                                        <td><?php echo e($data->date); ?></td>
                                        <td>
                                            <?php echo e($data->name); ?></br>
                                            <?php echo e($data->email); ?></br>
                                            <?php echo e($data->phone); ?>

                                            <?php if($data->lead_source): ?>
                                                </br><span class="badge badge-secondary p-1"><?php echo e($data->lead_source); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo e($data->distance); ?> Miles
                                        </td>
                                        <td>
                                            <span><?php echo e(amount_with_currency_symbol($data->total)); ?></span>
                                        </td>
                                        <td>
                                            <?php if($data->status == 0): ?>
                                                <?php if($data->payment_status == 0): ?>
                                                    <span class="alert alert-warning" >Unpaid & Pending</span>
                                                <?php elseif($data->payment_status == 1): ?>
                                                    <span class="alert alert-warning" >Fully Paid & Pending</span>
                                                <?php elseif($data->payment_status == 2): ?>
                                                    <span class="alert alert-warning" >Partialy Paid & Pending</span>
                                                <?php endif; ?>
                                            <?php elseif($data->status == 1): ?>
                                                <?php if($data->payment_status == 0): ?>
                                                    <span class="alert alert-info" >Unpaid & Ongoing</span>
                                                <?php elseif($data->payment_status == 1): ?>
                                                    <span class="alert alert-info" >Fully Paid & Ongoing</span>
                                                <?php elseif($data->payment_status == 2): ?>
                                                    <span class="alert alert-info" >Partialy Paid & Ongoing</span>
                                                <?php endif; ?>
                                            <?php elseif($data->status == 2): ?>
                                                <?php if($data->payment_status == 1): ?>
                                                    <span class="alert alert-success" >Fully Paid & Completed</span>
                                                <?php elseif($data->payment_status == 2): ?>
                                                    <span class="alert alert-danger" >Partialy Paid & Completed</span>
                                                <?php endif; ?>
                                            <?php elseif($data->status == 3): ?>
                                                <?php if($data->payment_status == 0): ?>
                                                    <span class="alert alert-danger" >Unpaid & Cancelled</span>
                                                <?php elseif($data->payment_status == 1): ?>
                                                    <span class="alert alert-danger" >Fully Paid & Cancelled</span>
                                                <?php elseif($data->payment_status == 2): ?>
                                                    <span class="alert alert-danger" >Partialy Paid & Cancelled</span>
                                                <?php endif; ?>
                                            <?php elseif($data->status == 4): ?>
                                                <span class="alert alert-danger" >Cancelled & Refunded</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($data->is_deleted == 0): ?>
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.delete-popover','data' => ['url' => route('admin.removal.delete',$data->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('delete-popover'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.removal.delete',$data->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            <?php else: ?>
                                            <a href="<?php echo e(route('admin.removal.recover',$data->trx)); ?>" class="btn btn-success btn-xs mb-3 mr-1" >
                                                <i class="fas fa-recycle" ></i>
                                            </a>
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.delete-popover','data' => ['url' => route('admin.removal.delete.permanent',$data->id),'title' => __('Permanent Delete')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('delete-popover'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.removal.delete.permanent',$data->id)),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Permanent Delete'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            <?php endif; ?>
                                            <a href="<?php echo e(route('admin.removal.view',$data->trx)); ?>" class="btn btn-info btn-xs mb-3 mr-1" >
                                                <i class="fas fa-eye" ></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Booking Modal -->
    <div class="modal fade" id="quick_booking_modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo e(__('Quick Booking / Lead Entry')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="<?php echo e(route('admin.removal.quick.book')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name"><?php echo e(__('Customer Name')); ?></label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email"><?php echo e(__('Customer Email')); ?></label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone"><?php echo e(__('Customer Phone')); ?></label>
                                    <input type="text" class="form-control" name="phone" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lead_source"><?php echo e(__('Lead Source')); ?></label>
                                    <select name="lead_source" class="form-control">
                                        <option value="Phone"><?php echo e(__('Phone')); ?></option>
                                        <option value="WhatsApp"><?php echo e(__('WhatsApp')); ?></option>
                                        <option value="Facebook"><?php echo e(__('Facebook')); ?></option>
                                        <option value="Email"><?php echo e(__('Email')); ?></option>
                                        <option value="Others"><?php echo e(__('Others')); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="date"><?php echo e(__('Booking Date')); ?></label>
                                    <input type="date" class="form-control" name="date" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="time"><?php echo e(__('Booking Time')); ?></label>
                                    <input type="time" class="form-control" name="time" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="coupon"><?php echo e(__('Coupon Code')); ?></label>
                                    <input type="text" class="form-control" name="coupon" placeholder="<?php echo e(__('Optional')); ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="service_id"><?php echo e(__('Service')); ?></label>
                                    <select name="service_id" class="form-control" required>
                                        <?php $__currentLoopData = $all_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($service->id); ?>"><?php echo e($service->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="van_id"><?php echo e(__('Van Type')); ?></label>
                                    <select name="van_id" class="form-control" required>
                                        <?php $__currentLoopData = $van_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $van): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($van->id); ?>"><?php echo e($van->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="helpers"><?php echo e(__('Helpers')); ?></label>
                                    <select name="helpers" class="form-control">
                                        <option value="0"><?php echo e(__('No Helper')); ?></option>
                                        <?php $__currentLoopData = $helpers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $helper): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($helper->id); ?>"><?php echo e($helper->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="duration"><?php echo e(__('Duration (Hrs)')); ?></label>
                                    <input type="number" class="form-control" name="duration" value="1" min="0.5" step="0.5" required>
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <h6 class="border-bottom pb-2 mb-3 text-info"><i class="fas fa-map-marker-alt"></i> <?php echo e(__('Pickup Details')); ?></h6>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="pickup_address"><?php echo e(__('Pickup Search')); ?></label>
                                    <input type="text" class="form-control google-autocomplete" name="pickup_address" id="pickup_address" placeholder="<?php echo e(__('Search Pickup Address')); ?>" required>
                                    <input type="hidden" name="pickup_city" id="pickup_city">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="pickup_house"><?php echo e(__('House/Flat')); ?></label>
                                    <input type="text" class="form-control" name="pickup_house">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="pickup_postcode"><?php echo e(__('Postcode')); ?></label>
                                    <input type="text" class="form-control" name="pickup_postcode" id="pickup_postcode" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="pickup_floor"><?php echo e(__('Floor')); ?></label>
                                    <select name="pickup_floor" class="form-control">
                                        <option value=""><?php echo e(__('Select Floor')); ?></option>
                                        <?php $__currentLoopData = $floors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $floor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($floor->id); ?>"><?php echo e($floor->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="pickup_elevator"><?php echo e(__('Elevator')); ?></label>
                                    <select name="pickup_elevator" class="form-control">
                                        <option value="0"><?php echo e(__('No')); ?></option>
                                        <option value="1"><?php echo e(__('Yes')); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="pickup_parking"><?php echo e(__('Parking')); ?></label>
                                    <select name="pickup_parking" class="form-control">
                                        <option value=""><?php echo e(__('Select Parking')); ?></option>
                                        <?php $__currentLoopData = $parkings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($parking->id); ?>"><?php echo e($parking->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">
                                <h6 class="border-bottom pb-2 mb-3 text-info"><i class="fas fa-map-pin"></i> <?php echo e(__('Destination Details')); ?></h6>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="destination_address"><?php echo e(__('Destination Search')); ?></label>
                                    <input type="text" class="form-control google-autocomplete" name="destination_address" id="destination_address" placeholder="<?php echo e(__('Search Destination Address')); ?>" required>
                                    <input type="hidden" name="destination_city" id="destination_city">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="destination_house"><?php echo e(__('House/Flat')); ?></label>
                                    <input type="text" class="form-control" name="destination_house">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="destination_postcode"><?php echo e(__('Postcode')); ?></label>
                                    <input type="text" class="form-control" name="destination_postcode" id="destination_postcode" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="destination_floor"><?php echo e(__('Floor')); ?></label>
                                    <select name="destination_floor" class="form-control">
                                        <option value=""><?php echo e(__('Select Floor')); ?></option>
                                        <?php $__currentLoopData = $floors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $floor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($floor->id); ?>"><?php echo e($floor->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="destination_elevator"><?php echo e(__('Elevator')); ?></label>
                                    <select name="destination_elevator" class="form-control">
                                        <option value="0"><?php echo e(__('No')); ?></option>
                                        <option value="1"><?php echo e(__('Yes')); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="destination_parking"><?php echo e(__('Parking')); ?></label>
                                    <select name="destination_parking" class="form-control">
                                        <option value=""><?php echo e(__('Select Parking')); ?></option>
                                        <?php $__currentLoopData = $parkings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($parking->id); ?>"><?php echo e($parking->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        <div class="col-md-12 mt-4">
                                <h6 class="border-bottom pb-2 mb-3 text-info"><i class="fas fa-clipboard-list"></i> <?php echo e(__('Additional Details')); ?></h6>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="contents_to_move"><?php echo e(__('Contents to Move (Checklist/Key Items)')); ?></label>
                                    <textarea class="form-control" name="contents_to_move" rows="3" placeholder="<?php echo e(__('e.g., 2 Bedroom Flat, Piano, Heavy Wardrobe...')); ?>"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="admin_notes"><?php echo e(__('Admin Notes (Internal)')); ?></label>
                                    <textarea class="form-control" name="admin_notes" rows="3" placeholder="<?php echo e(__('e.g., Customer is very concerned about the piano.')); ?>"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Create Booking')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
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
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(get_static_option('google_api_key')); ?>&libraries=places"></script>
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){
                // Initialize Google Autocomplete for pickup and destination
                function initAutocomplete() {
                    const pickupInput = document.getElementById('pickup_address');
                    const destInput = document.getElementById('destination_address');
                    
                    const options = {
                        componentRestrictions: { country: "gb" }
                    };

                    const pickupAutocomplete = new google.maps.places.Autocomplete(pickupInput, options);
                    const destAutocomplete = new google.maps.places.Autocomplete(destInput, options);
                    
                    const extractComponents = (place) => {
                        let postcode = "";
                        let city = "";
                        if(place.address_components){
                            for (const component of place.address_components) {
                                if (component.types.includes("postal_code")) postcode = component.long_name;
                                if (component.types.includes("postal_town") || component.types.includes("locality")) city = component.long_name;
                            }
                        }
                        return { postcode, city };
                    };

                    pickupAutocomplete.addListener("place_changed", () => {
                        const place = pickupAutocomplete.getPlace();
                        const { postcode, city } = extractComponents(place);
                        document.getElementById('pickup_postcode').value = postcode;
                        document.getElementById('pickup_city').value = city;
                    });
                    
                    destAutocomplete.addListener("place_changed", () => {
                        const place = destAutocomplete.getPlace();
                        const { postcode, city } = extractComponents(place);
                        document.getElementById('destination_postcode').value = postcode;
                        document.getElementById('destination_city').value = city;
                    });
                }

                if (typeof google === 'object' && typeof google.maps === 'object') {
                    initAutocomplete();
                }

                // Check for date/action in URL to open Quick Booking modal
                const urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has('date') || urlParams.has('quick_book')) {
                    if (urlParams.has('date')) {
                        const dateStr = urlParams.get('date');
                        const dateObj = new Date(dateStr);
                        
                        if (!isNaN(dateObj.getTime())) {
                            const formattedDate = dateObj.toISOString().split('T')[0];
                            $('input[name="date"]').val(formattedDate);
                            
                            if (dateStr.includes('T')) {
                                const timeStr = dateObj.toTimeString().split(' ')[0].substring(0, 5);
                                $('input[name="time"]').val(timeStr);
                            }
                        }
                    }
                    $('#quick_booking_modal').modal('show');
                }
            });
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\express-van\@core\resources\views/backend/pages/removal/index.blade.php ENDPATH**/ ?>