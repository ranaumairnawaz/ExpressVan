<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                 <?php if(check_page_permission('admin_manage')): ?>
                    <div class="col-md-3 mt-5 mb-3">
                        <div class="card text-dark mb-3 h-100">
                            <div class="dsh-box-style h-100">
                                <a href="<?php echo e(route('admin.new.user')); ?>" class="add-new"><i class="ti-plus"></i></a>
                                <div class="icon">
                                    <i class="ti-user"></i>
                                </div>
                                <div class="content">
                                    <span class="total"><?php echo e($total_admin); ?></span>
                                    <h4 class="title"><?php echo e(__('Total Admin')); ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-md-3 mt-md-5 mb-3">
                    <div class="card text-white bg-primary mb-3 h-100">
                        <div class="dsh-box-style h-100">
                            <a href="<?php echo e(route('admin.removal')); ?>?quick_book=true" class="add-new text-white"><i class="ti-plus"></i></a>
                            <div class="icon text-white">
                                <i class="ti-bolt"></i>
                            </div>
                            <div class="content pt-4">
                                <h4 class="title text-white mt-3"><?php echo e(__('Quick Add Booking')); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mt-md-5 mb-3">
                    <div class="card text-dark  mb-3 h-100">
                        <div class="dsh-box-style h-100">
                            <a href="<?php echo e(route('admin.removal')); ?>" class="add-new"><i class="ti-eye"></i></a>
                            <div class="icon">
                                <i class="ti-package"></i>
                            </div>
                            <div class="content">
                                <span class="total"><?php echo e(getOrdersCount(1)); ?></span>
                                <h4 class="title"><?php echo e(__('Total Ongoing Removals')); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mt-md-5 mb-3">
                    <div class="card text-dark  mb-3 h-100">
                        <div class="dsh-box-style h-100">
                            <a href="<?php echo e(route('admin.removal')); ?>" class="add-new"><i class="ti-eye"></i></a>
                            <div class="icon">
                                <i class="ti-package"></i>
                            </div>
                            <div class="content">
                                <span class="total"><?php echo e(getOrdersCount(0)); ?></span>
                                <h4 class="title"><?php echo e(__('Total Pending Removals')); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if(check_page_permission_by_string('Blogs Manage')): ?>
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card text-dark  mb-3 h-100">
                            <div class="dsh-box-style h-100">
                                <a href="<?php echo e(route('admin.blog.new')); ?>" class="add-new"><i class="ti-plus"></i></a>
                                <div class="icon">
                                    <i class="ti-comments"></i>
                                </div>
                                <div class="content">
                                    <span class="total"><?php echo e($blog_count); ?></span>
                                    <h4 class="title"><?php echo e(__('Total Blogs')); ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                 <?php endif; ?>
                <?php if(check_page_permission_by_string('Products Manage') && !empty(get_static_option('product_module_status'))): ?>
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card text-dark  mb-3 h-100">
                            <div class="dsh-box-style h-100">
                                <a href="<?php echo e(route('admin.products.new')); ?>" class="add-new"><i class="ti-plus"></i></a>
                                <div class="icon">
                                    <i class="ti-package"></i>
                                </div>
                                <div class="content">
                                    <span class="total"><?php echo e($total_products); ?></span>
                                    <h4 class="title"><?php echo e(__('Total Products')); ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card text-dark  mb-3 h-100">
                            <div class="dsh-box-style h-100">
                                <a href="<?php echo e(route('admin.products.order.logs')); ?>" class="add-new"><i class="ti-eye"></i></a>
                                <div class="icon">
                                    <i class="ti-shopping-cart"></i>
                                </div>
                                <div class="content">
                                    <span class="total"><?php echo e($total_product_order); ?></span>
                                    <h4 class="title"><?php echo e(__('Total Products Order')); ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if(check_page_permission_by_string('Services')): ?>
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card text-dark  mb-3 h-100">
                            <div class="dsh-box-style h-100">
                                <a href="<?php echo e(route('admin.services.new')); ?>" class="add-new"><i class="ti-plus"></i></a>
                                <div class="icon">
                                    <i class="ti-blackboard"></i>
                                </div>
                                <div class="content">
                                    <span class="total"><?php echo e($total_services); ?></span>
                                    <h4 class="title"><?php echo e(__('Total Services')); ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                     <?php if(check_page_permission_by_string('Case Study')): ?>
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card text-dark  mb-3 h-100">
                            <div class="dsh-box-style h-100">
                                <a href="<?php echo e(route('admin.work.new')); ?>" class="add-new"><i class="ti-plus"></i></a>
                                <div class="icon">
                                    <i class="ti-write"></i>
                                </div>
                                <div class="content">
                                    <span class="total"><?php echo e($total_works); ?></span>
                                    <h4 class="title"><?php echo e(__('Total Case Study')); ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                     <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card margin-top-40">
                    <div class="smart-card">
                        <h4 class="title"><?php echo e(__('Recent Removal Order')); ?></h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <th><?php echo e(__('Order TRX')); ?></th>
                                    <th><?php echo e(__('Amount')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th><?php echo e(__('Date')); ?></th>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = getRemovalOrders(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><a href="<?php echo e(route('admin.removal.view',$data->trx)); ?>" ><?php echo e($data->trx); ?></a></td>
                                            <td><?php echo e(amount_with_currency_symbol($data->total)); ?></td>
                                            <td>
                                                <?php if($data->status == 0): ?>
                                                 <a class="badge badge-primary text-white rounded-pill px-3 mb-1" >Pending</a>
                                                 <?php elseif($data->status == 1): ?>
                                                 <a class="badge badge-info text-white rounded-pill px-3 mb-1" >Ongoing</a>
                                                 <?php elseif($data->status == 2): ?>
                                                 <a class="badge badge-success text-white rounded-pill px-3 mb-1" >Completed</a>
                                                 <?php elseif($data->status == 3): ?>
                                                 <a class="badge badge-danger text-white rounded-pill px-3 mb-1" >Cancelled</a>
                                                 <?php elseif($data->status == 4): ?>
                                                 <a class="badge badge-danger text-white rounded-pill px-3 mb-1" >Cancelled & Returned</a>
                                                 <?php endif; ?>
                                                 
                                                 <?php if($data->payment_status == 0): ?>
                                                 <a class="badge badge-primary text-white rounded-pill px-3 mb-1" >Unpaid</a>
                                                 <?php elseif($data->payment_status == 2): ?>
                                                 <a class="badge badge-info text-white rounded-pill px-3 mb-1" >Partialy Paid</a>
                                                 <?php elseif($data->payment_status == 1): ?>
                                                 <a class="badge badge-success text-white rounded-pill px-3 mb-1" >Paid</a>
                                                 <?php elseif($data->payment_status == 3): ?>
                                                 <a class="badge badge-danger text-white rounded-pill px-3 mb-1" >Cancelled</a>
                                                 <?php endif; ?>
                                            </td>
                                            <td><?php echo e($data->booking_time); ?><br><?php echo e(date_format(date_create($data->date),'d M Y')); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
             <?php if(check_page_permission_by_string('Products Manage') && !empty(get_static_option('product_module_status'))): ?>
            <div class="col-lg-6">
                <div class="card margin-top-40">
                    <div class="smart-card">
                        <h4 class="title"><?php echo e(__('Recent Product Order')); ?></h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <th><?php echo e(__('Order ID')); ?></th>
                                    <th><?php echo e(__('Amount')); ?></th>
                                    <th><?php echo e(__('Payment Status')); ?></th>
                                    <th><?php echo e(__('Date')); ?></th>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $product_recent_order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>#<?php echo e($data->id); ?></td>
                                            <td><?php echo e(amount_with_currency_symbol($data->total)); ?></td>
                                            <td>
                                                <?php $pay_status = $data->payment_status; ?>
                                                <?php if($pay_status == 'complete'): ?>
                                                    <span class="alert alert-success"><?php echo e(__($pay_status)); ?></span>
                                                <?php elseif($pay_status == 'pending'): ?>
                                                    <span class="alert alert-warning"><?php echo e(__($pay_status)); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e(date_format($data->created_at,'d M Y h:i:s')); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\XAMPP\htdocs\removal\@core\resources\views/backend/admin-home.blade.php ENDPATH**/ ?>