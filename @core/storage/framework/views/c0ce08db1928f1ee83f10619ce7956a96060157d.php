<?php $__env->startSection('style'); ?>
    <style>
        .report-card { border-radius: 15px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .gradient-primary { background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); color: white; }
        .revenue-text { font-size: 24px; font-weight: bold; }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Lead Source Performance Report')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <h4 class="header-title mb-4"><?php echo e(__('Lead Source ROI Analysis')); ?></h4>
            </div>
            
            <?php $__currentLoopData = $report_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 mb-4">
                <div class="card report-card p-3 <?php if($loop->first): ?> gradient-primary <?php endif; ?>">
                    <div class="card-body">
                        <h5 class="text-uppercase mb-2 <?php if(!$loop->first): ?> text-muted <?php endif; ?>"><?php echo e($data->lead_source ?: 'Direct / Unknown'); ?></h5>
                        <div class="revenue-text mb-2"><?php echo e(amount_with_currency_symbol($data->total_revenue)); ?></div>
                        <div class="small">Total Bookings: <strong><?php echo e($data->total_bookings); ?></strong></div>
                        <div class="small mt-1">Average per Booking: <strong><?php echo e(amount_with_currency_symbol($data->total_revenue / ($data->total_bookings ?: 1))); ?></strong></div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="col-lg-12 mt-4">
                <div class="card report-card">
                    <div class="card-body">
                        <h4 class="header-title mb-3"><?php echo e(__('Detailed Performance Breakdown')); ?></h4>
                        <div class="table-wrap table-responsive">
                            <table class="table table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th><?php echo e(__('Source')); ?></th>
                                        <th><?php echo e(__('Bookings')); ?></th>
                                        <th><?php echo e(__('Total Revenue')); ?></th>
                                        <th><?php echo e(__('Profitability Index')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $grand_total = $report_data->sum('total_revenue'); ?>
                                    <?php $__currentLoopData = $report_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><strong><?php echo e($data->lead_source ?: 'Others'); ?></strong></td>
                                        <td><?php echo e($data->total_bookings); ?></td>
                                        <td><?php echo e(amount_with_currency_symbol($data->total_revenue)); ?></td>
                                        <td>
                                            <?php $percentage = ($grand_total > 0) ? ($data->total_revenue / $grand_total) * 100 : 0; ?>
                                            <div class="progress" style="height: 10px;">
                                                <div class="progress-bar" role="progressbar" style="width: <?php echo e($percentage); ?>%;" aria-valuenow="<?php echo e($percentage); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <small><?php echo e(number_format($percentage, 1)); ?>% of total revenue</small>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\XAMPP\htdocs\removal\@core\resources\views/backend/pages/removal/lead-source-report.blade.php ENDPATH**/ ?>