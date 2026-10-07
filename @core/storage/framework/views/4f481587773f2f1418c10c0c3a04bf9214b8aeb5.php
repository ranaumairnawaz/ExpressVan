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
        .image-wrap img{
            width: 5rem;
        }
    </style>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/media-uploader.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/summernote-bs4.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/nice-select.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/dropzone.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/media-uploader.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/bootstrap-tagsinput.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Transports')); ?>

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
                        <h4 class="header-title"><?php echo e(__('Copmany Settings')); ?></h4>
                        <div class="row" >
                            <div class="col-md-4" >
                                <a class="btn btn-primary" href="<?php echo e(route('admin.general.basic.settings')); ?>" >Company Details</a>
                            </div>
                            <div class="col-md-4" >
                                <a class="btn btn-primary" href="<?php echo e(route('admin.contact.info')); ?>" >Contact Details</a>
                            </div>
                        </div>
                        <h4 class="header-title mt-3"><?php echo e(__('Removal Settings')); ?></h4>
                        <form action="<?php echo e(route('admin.removal.settings.save')); ?>" method="POST" enctype="multipart/form-data" >
                            <?php echo csrf_field(); ?>
                            <div class="row" >
                                <div class="col-md-3" >
                                    <div class="form-group" >
                                        <label>Gas Charge per mile</label>
                                        <input type="text" name="per_km_price" value="<?php echo e(get_static_option('per_km_price')); ?>" class="form-control" placeholder="Gas Charge per mile" >
                                    </div>
                                </div>
                                <div class="col-md-3" >
                                    <div class="form-group" >
                                        <label class="text-capitalize" >maximum booking hours</label>
                                        <input type="number" name="maximum_booking_hours" value="<?php echo e(get_static_option('maximum_booking_hours')); ?>" class="form-control" placeholder="maximum booking hours" >
                                    </div>
                                </div>
                                <div class="col-md-3" >
                                    <div class="form-group" >
                                        <label class="text-capitalize" >minimum booking hours</label>
                                        <input type="number" name="minimum_booking_hours" value="<?php echo e(get_static_option('minimum_booking_hours')); ?>" class="form-control" placeholder="minimum booking hours" >
                                    </div>
                                </div>
                                <div class="col-md-3" >
                                    <div class="form-group" >
                                        <label>Congestion charge</label>
                                        <input type="text" name="congestion_charge" value="<?php echo e(get_static_option('congestion_charge')); ?>" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-3" >
                                    <div class="form-group" >
                                        <label>Ultra low emission charge</label>
                                        <input type="text" name="ultra_low_emission_charge" value="<?php echo e(get_static_option('ultra_low_emission_charge')); ?>" class="form-control" placeholder="Ultra low emission charge" >
                                    </div>
                                </div>
                                <div class="col-md-3" >
                                    <div class="form-group" >
                                        <label>Booking Tax</label>
                                        <input type="text" name="booking_tax" value="<?php echo e(get_static_option('booking_tax')); ?>" class="form-control" placeholder="Booking Tax" >
                                    </div>
                                </div>
                                <div class="col-md-3" >
                                    <div class="form-group" >
                                        <label>Google MAPS API key</label>
                                        <input type="text" name="google_api_key" value="<?php echo e(get_static_option('google_api_key')); ?>" class="form-control" placeholder="Google MAPS API key" >
                                    </div>
                                </div>
                                <div class="col-md-3" >
                                    <div class="form-group" >
                                        <label>Ideal Postcodes API Key</label>
                                        <input type="text" name="ideal_postcode_api_key" value="<?php echo e(get_static_option('ideal_postcode_api_key')); ?>" class="form-control" placeholder="Ideal Postcodes API" >
                                    </div>
                                </div>
                                <div class="col-md-3" >
                                    <div class="form-group" >
                                        <label>Whatsapp Number</label>
                                        <input type="text" name="whatsapp_number" value="<?php echo e(get_static_option('whatsapp_number')); ?>" class="form-control" placeholder="Whatsapp Number" >
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4" >
                                    <h4 class="header-title"><?php echo e(__('Automated Calendar Sync OAuth')); ?></h4>
                                </div>
                                <div class="col-md-6" >
                                    <div class="form-group" >
                                        <label>Google Calendar Client ID</label>
                                        <input type="text" name="google_calendar_client_id" value="<?php echo e(get_static_option('google_calendar_client_id')); ?>" class="form-control" placeholder="Google Client ID" >
                                    </div>
                                </div>
                                <div class="col-md-6" >
                                    <div class="form-group" >
                                        <label>Google Calendar Client Secret</label>
                                        <input type="secret" name="google_calendar_client_secret" value="<?php echo e(get_static_option('google_calendar_client_secret')); ?>" class="form-control" placeholder="Google Client Secret" >
                                    </div>
                                </div>
                                <div class="col-md-6" >
                                    <div class="form-group" >
                                        <label>Microsoft Calendar Client ID</label>
                                        <input type="text" name="microsoft_calendar_client_id" value="<?php echo e(get_static_option('microsoft_calendar_client_id')); ?>" class="form-control" placeholder="Microsoft Client ID" >
                                    </div>
                                </div>
                                <div class="col-md-6" >
                                    <div class="form-group" >
                                        <label>Microsoft Calendar Client Secret</label>
                                        <input type="secret" name="microsoft_calendar_client_secret" value="<?php echo e(get_static_option('microsoft_calendar_client_secret')); ?>" class="form-control" placeholder="Microsoft Client Secret" >
                                    </div>
                                </div>
                                <div class="col-md-12" >
                                    <h4 class="header-title mt-3"><?php echo e(__('Stripe Settings')); ?></h4>
                                    <div id="stripe_settings_content">
                                        <div class="row" >
                                            <div class="col-md-4" >
                                                <div class="form-group">
                                                    <label for="stripe_test_mode"><strong><?php echo e(__('Enable/Disable Stripe Test Mode')); ?></strong></label>
                                                    <select class="form-control" name="stripe_test_mode" id="stripe_test_mode" >
                                                        <option value="1" 
                                                        <?php if(get_static_option('stripe_test_mode') == 1): ?>
                                                        selected
                                                        <?php endif; ?>
                                                        >Enable</option>
                                                        <option value="0"
                                                        <?php if(get_static_option('stripe_test_mode') == 0): ?>
                                                        selected
                                                        <?php endif; ?>
                                                        >Disable</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label for="stripe_logo"><strong><?php echo e(__('Stripe Logo')); ?></strong></label>
                                            <div class="media-upload-btn-wrapper">
                                                <div class="img-wrap">
                                                    <?php
                                                        $stripe_img = get_attachment_image_by_id(get_static_option('stripe_preview_logo'),null,true);
                                                        $stripe_image_btn_label = __('Upload Image');
                                                    ?>
                                                    <?php if(!empty($stripe_img)): ?>
                                                        <div class="attachment-preview">
                                                            <div class="thumbnail">
                                                                <div class="centered">
                                                                    <img class="avatar user-thumb" src="<?php echo e($stripe_img['img_url']); ?>" alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php  $stripe_image_btn_label = __('Change Image'); ?>
                                                    <?php endif; ?>
                                                </div>
                                                <input type="hidden" id="stripe_preview_logo" name="stripe_preview_logo" value="<?php echo e(get_static_option('stripe_preview_logo')); ?>">
                                                <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                                    <?php echo e(__($stripe_image_btn_label)); ?>

                                                </button>
                                            </div>
                                            <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png. Recommended image size 160x50')); ?></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="stripe_public_key"><?php echo e(__('Stripe Public Key')); ?></label>
                                            <input type="text" name="stripe_public_key" id="stripe_public_key" value="<?php echo e(get_static_option('stripe_public_key')); ?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="stripe_secret_key"><?php echo e(__('Stripe Secret')); ?></label>
                                            <input type="text" name="stripe_secret_key" id="stripe_secret_key"  value="<?php echo e(get_static_option('stripe_secret_key')); ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 justify-content-end" >
                                    <button type="submit" class="btn btn-primary" >Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php echo $__env->make('backend.partials.media-upload.media-upload-markup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
    
    <script src="<?php echo e(asset('assets/backend/js/summernote-bs4.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/jquery.nice-select.min.js')); ?>"></script>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.auto-slug-js','data' => ['url' => route('admin.work.slug.check'),'type' => 'new']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('backend.auto-slug-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.work.slug.check')),'type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('new')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <script>
        $(document).ready(function () {

            $('.summernote').summernote({
                height: 250,   //set editable area's height
                codemirror: { // codemirror options
                    theme: 'monokai'
                },
                callbacks: {
                    onChange: function(contents, $editable) {
                        let finalContenat =  iFrameFilterInSummernote(contents);
                        
                        $(this).prev('input').val(finalContenat);
                        console.log($(this).prev('input').val())
                    }
                }
            });
            
            if($('.summernote').length > 1){
                $('.summernote').each(function(index, value){
                    $(this).summernote('code', $(this).data('content'));
                });
            }

            if($('.nice-select').length > 0){
                $('.nice-select').niceSelect();
            }


            $(document).on('change','#language',function (e) {
                e.preventDefault();
                var selectedLang = $(this).val();
                $.ajax({
                    url : "<?php echo e(route('admin.work.category.by.slug')); ?>",
                    type: "POST",
                    data: {
                        _token : "<?php echo e(csrf_token()); ?>",
                        lang: selectedLang
                    },
                    success:function (data) {
                        $('#category').html('');
                        $.each(data,function (index,value) {
                            $('#category').append('<option value="'+value.id+'">'+value.name+'</option>');
                            $('.nice-select').niceSelect('update');
                        });
                    }
                });
            });
        });
    </script>
    <script src="<?php echo e(asset('assets/backend/js/dropzone.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/bootstrap-tagsinput.js')); ?>"></script>
    <?php echo $__env->make('backend.partials.media-upload.media-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\express-van\@core\resources\views/backend/pages/removal/settings.blade.php ENDPATH**/ ?>