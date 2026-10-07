<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Removal Coupon')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/bootstrap-datepicker.min.css')); ?>">
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button{
            padding: 0 !important;
        }
        div.dataTables_wrapper div.dataTables_length select {
            width: 60px;
            display: inline-block;
        }
    </style>
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
            <div class="col-lg-7 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__('All Removal Coupons')); ?></h4>
                        <div class="bulk-delete-wrapper">
                            <div class="select-box-wrap">
                                <select name="bulk_option" id="bulk_option">
                                    <option value=""><?php echo e(__('Bulk Action')); ?></option>
                                    <option value="delete"><?php echo e(__('Delete')); ?></option>
                                </select>
                                <button class="btn btn-primary btn-sm" id="bulk_delete_btn"><?php echo e(__('Apply')); ?></button>
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
                                    <th><?php echo e(__('ID')); ?></th>
                                    <th><?php echo e(__('Code')); ?></th>
                                    <th><?php echo e(__('Discount')); ?></th>
                                    <th><?php echo e(__('Expiry')); ?></th>
                                    <th><?php echo e(__('Limits')); ?></th>
                                    <th><?php echo e(__('Used')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $all_coupon; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <div class="bulk-checkbox-wrapper">
                                                    <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="<?php echo e($data->id); ?>">
                                                </div>
                                            </td>
                                            <td><?php echo e($data->id); ?></td>
                                            <td><?php echo e($data->code); ?></td>
                                            <td>
                                                <?php if($data->discount_type == 'percentage'): ?> 
                                                    <?php echo e($data->discount_value); ?>% 
                                                <?php elseif($data->discount_type == 'fixed'): ?>
                                                    <?php echo e(amount_with_currency_symbol($data->discount_value)); ?>

                                                <?php else: ?>
                                                    <?php echo e(__('Free Shipping')); ?>

                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e($data->expire_date ? date('d M Y', strtotime($data->expire_date)) : __('No Expiry')); ?></td>
                                            <td>
                                                <ul>
                                                    <li><?php echo e(__('Total')); ?>: <?php echo e($data->total_limit ?? __('Unlimited')); ?></li>
                                                    <li><?php echo e(__('Per Customer')); ?>: <?php echo e($data->limit_per_customer); ?></li>
                                                </ul>
                                            </td>
                                            <td><?php echo e($data->usages->count()); ?></td>
                                            <td>
                                                <?php if('publish' == $data->status): ?>
                                                    <span class="btn btn-success btn-xs"><?php echo e(ucfirst($data->status)); ?></span>
                                                <?php else: ?>
                                                    <span class="btn btn-warning btn-xs"><?php echo e(ucfirst($data->status)); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.delete-popover','data' => ['url' => route('admin.removal.coupon.delete',$data->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('delete-popover'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.removal.coupon.delete',$data->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                <a href="#"
                                                   data-toggle="modal"
                                                   data-target="#coupon_edit_modal"
                                                   class="btn btn-primary btn-xs mb-3 mr-1 coupon_edit_btn"
                                                   data-id="<?php echo e($data->id); ?>"
                                                   data-code="<?php echo e($data->code); ?>"
                                                   data-discount_value="<?php echo e($data->discount_value); ?>"
                                                   data-discount_type="<?php echo e($data->discount_type); ?>"
                                                   data-expire_date="<?php echo e($data->expire_date ? date('Y-m-d', strtotime($data->expire_date)) : ''); ?>"
                                                   data-total_limit="<?php echo e($data->total_limit); ?>"
                                                   data-limit_per_customer="<?php echo e($data->limit_per_customer); ?>"
                                                   data-min_amount="<?php echo e($data->min_amount); ?>"
                                                   data-status="<?php echo e($data->status); ?>"
                                                >
                                                    <i class="ti-pencil"></i>
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
            <div class="col-lg-5 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__('Add New Coupon')); ?></h4>
                        <form action="<?php echo e(route('admin.removal.coupon.new')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="code"><?php echo e(__('Coupon Code')); ?></label>
                                <input type="text" class="form-control" name="code" placeholder="<?php echo e(__('e.g. SAVE50')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="discount_type"><?php echo e(__('Coupon Type')); ?></label>
                                <select name="discount_type" class="form-control">
                                    <option value="percentage"><?php echo e(__("Percentage (%)")); ?></option>
                                    <option value="fixed"><?php echo e(__("Fixed Amount (£)")); ?></option>
                                    <option value="free_shipping"><?php echo e(__("Free Shipping")); ?></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="discount_value"><?php echo e(__('Discount Value')); ?></label>
                                <input type="number" step="0.01" class="form-control" name="discount_value" placeholder="<?php echo e(__('Value')); ?>">
                                <small><?php echo e(__('Leave empty for Free Shipping')); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="min_amount"><?php echo e(__('Minimum Order Value')); ?></label>
                                <input type="number" step="0.01" class="form-control" name="min_amount" placeholder="<?php echo e(__('Minimum Spend')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="expire_date"><?php echo e(__('Expiry Date')); ?></label>
                                <input type="date" class="form-control" name="expire_date">
                            </div>
                            <div class="form-group">
                                <label for="total_limit"><?php echo e(__('Total Usage Limit')); ?></label>
                                <input type="number" class="form-control" name="total_limit" placeholder="<?php echo e(__('e.g. 100')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="limit_per_customer"><?php echo e(__('Usage Per Customer')); ?></label>
                                <input type="number" class="form-control" name="limit_per_customer" value="1">
                            </div>
                            <div class="form-group">
                                <label for="status"><?php echo e(__('Status')); ?></label>
                                <select name="status" class="form-control">
                                    <option value="publish"><?php echo e(__("Publish")); ?></option>
                                    <option value="draft"><?php echo e(__("Draft")); ?></option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Add New Coupon')); ?></button>
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
                    <h5 class="modal-title"><?php echo e(__('Update Coupon')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="<?php echo e(route('admin.removal.coupon.update')); ?>"  method="post">
                    <input type="hidden" name="id" id="coupon_id">
                    <div class="modal-body">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="edit_code"><?php echo e(__('Coupon Code')); ?></label>
                            <input type="text" class="form-control" id="edit_code" name="code">
                        </div>
                        <div class="form-group">
                            <label for="edit_discount_type"><?php echo e(__('Coupon Type')); ?></label>
                            <select name="discount_type" class="form-control" id="edit_discount_type">
                                <option value="percentage"><?php echo e(__("Percentage (%)")); ?></option>
                                <option value="fixed"><?php echo e(__("Fixed Amount (£)")); ?></option>
                                <option value="free_shipping"><?php echo e(__("Free Shipping")); ?></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_discount_value"><?php echo e(__('Discount Value')); ?></label>
                            <input type="number" step="0.01" class="form-control" id="edit_discount_value" name="discount_value">
                        </div>
                        <div class="form-group">
                            <label for="edit_min_amount"><?php echo e(__('Minimum Order Value')); ?></label>
                            <input type="number" step="0.01" class="form-control" id="edit_min_amount" name="min_amount">
                        </div>
                        <div class="form-group">
                            <label for="edit_expire_date"><?php echo e(__('Expiry Date')); ?></label>
                            <input type="date" class="form-control" id="edit_expire_date" name="expire_date">
                        </div>
                        <div class="form-group">
                            <label for="edit_total_limit"><?php echo e(__('Total Usage Limit')); ?></label>
                            <input type="number" class="form-control" id="edit_total_limit" name="total_limit">
                        </div>
                        <div class="form-group">
                            <label for="edit_limit_per_customer"><?php echo e(__('Usage Per Customer')); ?></label>
                            <input type="number" class="form-control" id="edit_limit_per_customer" name="limit_per_customer">
                        </div>
                        <div class="form-group">
                            <label for="edit_status"><?php echo e(__('Status')); ?></label>
                            <select name="status" class="form-control" id="edit_status">
                                <option value="draft"><?php echo e(__("Draft")); ?></option>
                                <option value="publish"><?php echo e(__("Publish")); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Save Change')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
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
                    $(this).text('<?php echo e(__('Deleting...')); ?>');
                    $.ajax({
                        'type' : "POST",
                        'url' : "<?php echo e(route('admin.removal.coupon.bulk.action')); ?>",
                        'data' : {
                            _token: "<?php echo e(csrf_token()); ?>",
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\express-van\@core\resources\views/backend/removal/coupon/all-coupon.blade.php ENDPATH**/ ?>