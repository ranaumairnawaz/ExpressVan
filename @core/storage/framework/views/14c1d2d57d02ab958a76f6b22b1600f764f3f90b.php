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
    <div class="page-content service-details padding-top-20 padding-bottom-115">
        <div id="container" class="container mt-5">
            <?php
            if(isset($notify)){
                $not = showNotification($notify);
            }
            else{
                $not = "";
            }
            ?>
            <?php echo e($not); ?>

            <div class="row" style="padding-top: 100px;padding-bottom: 100px;" >
                <div class="col-md-3" ></div>
                <div class="col-md-6" >
                    <div class="invoice" style="box-shadow: rgba(0, 0, 0, 0.25) 0px 25px 50px -12px;">
                     <!-- begin invoice-company -->
                     <div class="invoice-company text-inverse d-flex justify-content-between align-items-center">
                        <?php if(!empty(filter_static_option_value('site_logo',$global_static_field_data))): ?>
                            <?php echo render_image_markup_by_attachment_id(filter_static_option_value('site_logo',$global_static_field_data)); ?>

                        <?php else: ?>
                            <h2 class="site-title"><?php echo e(filter_static_option_value('site_'.$user_select_lang_slug.'_title',$global_static_field_data)); ?></h2>
                        <?php endif; ?>
                     </div>
                     <div class="invoice-content text-center">
                         <h5>Enter OTP</h5>
                         <form class="mt-2" action="<?php echo e(route('frontend.book.order.otp.submit',$order->trx)); ?>" method="POST" >
                             <?php echo csrf_field(); ?>
                             <div class="form-group" >
                                 <input class="form-control" name="otp" type="text" placeholder="Enter OTP" >
                             </div>
                             <button type="submit" class="w-100 btn btn-dagency" >
                                 Submit
                             </button>
                         </form>
                     </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.frontend-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\express-van\@core\resources\views/frontend/pages/book/otp.blade.php ENDPATH**/ ?>