<?php echo $__env->make('frontend.partials.homesupportbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
    $home_page_variant =$home_page ?? get_static_option('home_page_variant');
?>
<style>
    .inputCont{
        height: 5rem;
        border-radius: 5rem;
        padding: 0rem;
        background-color: white;
        border: 2px solid gainsboro;
        margin-top: -3rem;
    }
    .newInput{
        height: 5rem;
        border-radius: 5rem;
        font-size: 1.5rem;
        padding: 0rem 2rem;
        background-color: transparent;
        border: 0px solid transparent;
    }
    .inputSelectDiv{
        height: 8.1rem !important;
        /* border-radius: 5rem !important; */
        border-top-left-radius: 2.5rem;
        border-top-right-radius: 2.5rem;
        border-bottom-right-radius: 2.5rem;
        font-size: 1.5rem !important;
        padding: 0rem 0rem 3rem 0rem !important;
        background-color: var(--dagency-color) !important;
    }
    .inputSelect{
        height: 5rem !important;
        font-size: 1.5rem !important;
        padding: 1rem 2rem !important;
        border-top-left-radius: 2.5rem;
        border-top-right-radius: 2.5rem;
        font-weight: 700 !important;
        background-color: var(--dagency-color) !important;
        color: white;
        border: 0px solid transparent;
        outline: transparent solid 0px !important;
    }
    .inputSelect:hover{
        color: white;
        border: 0px solid transparent;
        outline: transparent solid 0px;
    }
    .inputSelectSM{
        height: 5rem;
        border-radius: 5rem;
        font-size: 1.5rem;
        padding: 1rem 2rem;
        background-color: var(--dagency-color) !important;
        color: white !important;
        font-weight: 700 !important;
        border: 0px solid transparent;
        outline: transparent solid 0px !important;
    }
    .inputSelectSM:hover{
        color: white;
        border: 0px solid transparent;
        outline: transparent solid 0px;
    }
    .inputSelectOption{
        height: 3rem !important;
        background-color: white !important;
        color: black !important;
        border-radius: 0.5rem !important;
        font-size: 1.2rem !important;
        padding: 0.5rem 2rem !important;
        font-weight: 700 !important;
        z-index: 100;
    }
    .inputSelectOption:hover{
        background-color: #f2f2f0 !important;
    }
    .inputSelectOptionSM{
        height: 3rem !important;
        background-color: white !important;
        color: black !important;
        border-radius: 0.5rem !important;
        font-size: 1.2rem !important;
        padding: 0.5rem 2rem !important;
        font-weight: 700 !important;
    }
    .inputSelectOptionSM:hover{
        background-color: #f2f2f0 !important;
    }
    .fromloc{
        border-top-right-radius: 0px;
        border-bottom-right-radius: 0px;
        border-right: 2px solid gainsboro;
    }
    .toloc{
        border-top-left-radius: 0px;
        border-bottom-left-radius: 0px;
    }
    .newBtn{
        height: 4rem;
        margin: 0.5rem 0rem;
        font-size: 1.5rem;
    }
    .newRightImage{
        margin-top: -6rem;
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
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="header-style-03  header-variant-08 navbar-variant-04">
    <nav class="navbar navbar-area navbar-expand-lg">
        <div class="container nav-container">
            <div class="responsive-mobile-menu">
                <div class="logo-wrapper">
                    <a href="<?php echo e(url('/')); ?>" class="logo">
                        <?php if(!empty(filter_static_option_value('site_logo',$global_static_field_data))): ?>
                            <?php echo render_image_markup_by_attachment_id(filter_static_option_value('site_logo',$global_static_field_data)); ?>

                        <?php else: ?>
                            <h2 class="site-title"><?php echo e(filter_static_option_value('site_'.$user_select_lang_slug.'_title',$global_static_field_data)); ?></h2>
                        <?php endif; ?>
                    </a>
                </div>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.product-cart-mobile','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product-cart-mobile'); ?>
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
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bizcoxx_main_menu"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bizcoxx_main_menu">
                <ul class="navbar-nav">
                    <?php echo render_frontend_menu($primary_menu); ?>

                </ul>
            </div>
        </div>
    </nav>
</div>

<div class="header-slider-wrapper cdesign-home"
<?php echo render_background_image_markup_by_attachment_id(filter_static_option_value('home_page_14_header_background_image',$static_field_data)); ?>

>
    <div class="header-area cdesign-agency-home" style="padding: 150px 0 270px;" >
        <div class="container"> 
            <div class="row">
                <div class="col-lg-6">
                    <div class="header-inner">
                        <h1 class="title"><?php echo e(filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_header_area_title',$static_field_data)); ?></h1>
                        <p class="description"><?php echo filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_header_area_description',$static_field_data); ?></p>
                        <div class="btn-wrapper margin-top-30">
                            <?php if(!empty(filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_header_area_button_one_text',$static_field_data))): ?>
                                <a href="<?php echo e(filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_header_area_button_one_url',$static_field_data)); ?>"
                                   class="btn-dagency"><?php echo e(filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_header_area_button_one_text',$static_field_data)); ?>

                                    <i class="<?php echo e(filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_header_area_button_one_icon',$static_field_data)); ?>"></i>
                                </a>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
                <div class="col-lg-6" >
                    <div class="right-image-wrap newRightImage">
                        <?php echo render_image_markup_by_attachment_id(filter_static_option_value('home_page_14_header_right_image',$static_field_data)); ?>

                    </div>
                </div>
            </div>
        </div>
        <form action="<?php echo e(route('frontend.book')); ?>" method="POST" enctype="multipart/form-data" >
        <div class="container d-none d-md-block">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-lg-1" ></div>
                <div class="col-lg-4 p-0" >
                    <div class="inputSelectDiv" > 
                        <select name="service" required class="my-select" data-size="7" data-style="inputSelect" data-width="100%">
                          <?php $__currentLoopData = $all_service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($data->id); ?>" class="inputSelectOption" data-icon="<?php echo e($data->icon); ?>" >
                            <?php echo e($data->title); ?>

                          </option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-7 p-0" ></div>
                <div class="col-lg-1" ></div>
                <div class="col-lg-10 inputCont" >
                    <div class="row" >
                        
                    </div>
                    <div class="row" >
                        <div class="col-lg-5 px-0">
                            <div class="form-group" >
                                <input type="text" class="form-control newInput fromloc locs" required name="location[]" placeholder="Pickup Address" >
                            </div>
                        </div>
                        <div class="col-lg-4 px-0">
                            <div class="form-group" >
                                <input type="text" class="form-control newInput toloc locs" required name="location[]" placeholder="Destination" >
                            </div>
                        </div>
                        <div class="col-lg-3 px-4">
                            <button type="submit" class="btn-dagency w-100 newBtn border-0">
                                Check Prices
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1" ></div>
            </div>
        </div>
        </form>
        <div class="container d-block d-md-none">
            <form action="<?php echo e(route('frontend.book')); ?>" method="POST" enctype="multipart/form-data" >
                <?php echo csrf_field(); ?>
                <div class="row" >
                    <div class="col-lg-4">
                        <div class="form-group" >
                            <select name="service" required class="my-select" data-size="5" data-style="inputSelectSM" data-width="100%">
                              <?php $__currentLoopData = $all_service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($data->id); ?>" class="inputSelectOptionSM" data-icon="<?php echo e($data->icon); ?>" >
                                <?php echo e($data->title); ?>

                              </option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group" >
                            <input type="text" class="form-control newInput locs" style="border: 2px solid gainsboro;" required name="location[]" placeholder="Pickup Address" >
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group" >
                            <input type="text" class="form-control newInput locs" style="border: 2px solid gainsboro;" required name="location[]" placeholder="Destination" >
                        </div>
                    </div>
                    <div class="col-lg-4 px-4">
                        <button type="submit" class="btn-dagency w-100 newBtn border-0">
                            Check Prices
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if(!empty(filter_static_option_value('home_page_brand_logo_section_status',$static_field_data))): ?>
    <div class="client-section padding-bottom-70 padding-top-60">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="client-area">
                        <div class="client-active-area global-carousel-init"
                             data-loop="true"
                             data-desktopitem="5"
                             data-mobileitem="1"
                             data-tabletitem="2"
                             data-autoplay="true"
                             data-margin="80"
                        >
                            <?php $__currentLoopData = $all_brand_logo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="single-brand">
                                    <div class="img-wrapper">
                                        <?php if(!empty($data->url) ): ?><a rel="canonical" href="<?php echo e($data->url); ?>"><?php endif; ?>
                                            <?php echo render_image_markup_by_attachment_id($data->image); ?>

                                            <?php if(!empty($data->url) ): ?>  </a><?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if(!empty(filter_static_option_value('home_page_service_section_status',$static_field_data))): ?>
    <div class="latest-cause-area padding-top-60 padding-bottom-20">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-100 dagency-home">
                        <span class="subtitle"><?php echo e(filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_service_area_subtitle',$static_field_data)); ?></span>
                        <h2 class="title"><?php echo e(filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_service_area_title',$static_field_data)); ?></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php $a=1;?>
                <?php $__currentLoopData = $all_service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-dagency-service-item">
                            <?php if($data->icon_type == 'icon' || $data->icon_type == ''): ?>
                                <div class="icon style-<?php echo e($a); ?>">
                                    <i class="<?php echo e($data->icon); ?>"></i>
                                </div>
                            <?php else: ?>
                                <div class="img-icon style-<?php echo e($a); ?>">
                                    <?php echo render_image_markup_by_attachment_id($data->img_icon); ?>

                                </div>
                            <?php endif; ?>
                            <div class="content">
                                <h4 class="title"><a href="<?php echo e(route('frontend.services.single', $data->slug)); ?>"><?php echo e($data->title); ?></a></h4>
                                <p><?php echo e($data->excerpt); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php ( $a == 6 ) ? $a = 1 : $a++; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if(!empty(filter_static_option_value('home_page_case_study_section_status',$static_field_data))): ?>
    <div class="dagency-project-area padding-top-60 padding-bottom-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center  dagency-home margin-bottom-60">
                        <span class="subtitle"><?php echo e(filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_project_area_subtitle',$static_field_data)); ?></span>
                        <h2 class="title"><?php echo e(filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_project_area_title',$static_field_data)); ?></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="case-studies-masonry-wrapper">
                        <ul class="case-studies-menu style-01">
                            <li class="active" data-filter="*"><?php echo e(__('All')); ?></li>
                            <?php $__currentLoopData = $all_work_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li data-filter=".<?php echo e(Str::slug($data->name)); ?>"><?php echo e($data->name); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <div class="case-studies-masonry">
                            <?php $__currentLoopData = $all_work; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-lg-4 col-md-4 col-sm-6 masonry-item <?php echo e(get_work_category_by_id($data->id,'slug')); ?>">
                                    <div class="single-case-studies-item">
                                        <div class="thumb">
                                            <?php echo render_image_markup_by_attachment_id($data->image); ?>

                                        </div>
                                        <div class="cart-icon">
                                            <h4 class="title"><a href="<?php echo e(route('frontend.work.single',$data->slug)); ?>"> <?php echo e($data->title); ?></a></h4>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if(!empty(filter_static_option_value('home_page_call_to_action_section_status',$static_field_data))): ?>
    <div class="dagency-cta-area padding-120" >
        <div class="right-image-area">
            <?php echo render_image_markup_by_attachment_id(filter_static_option_value('home_page_14_cta_area_right_image',$static_field_data)); ?>

        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="cta-area-inner">
                        <div class="left-content-area">
                            <h3 class="title"><?php echo e(filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_cta_area_title',$static_field_data)); ?></h3>
                            <p class="description"><?php echo e(filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_cta_area_description',$static_field_data)); ?></p>
                        </div>
                        <div class="right-content-area">
                            <?php if(!empty(filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_cta_area_button_status',$static_field_data))): ?>
                                <div class="btn-wrapper margin-top-40">
                                    <a href="<?php echo e(filter_static_option_value('home_page_14_cta_area_button_url',$static_field_data)); ?>"
                                       class="btn-dagency"><?php echo e(filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_cta_area_button_title',$static_field_data)); ?>

                                        <i class="<?php echo e(filter_static_option_value('home_page_14_cta_section_button_icon',$static_field_data)); ?>"></i></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if(!empty(filter_static_option_value('home_page_work_process_section_status',$static_field_data))): ?>
    <div class="creative-agency-work-process-area padding-top-115 padding-bottom-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60">
                        <span class="subtitle"><?php echo e(filter_static_option_value('home_page_14_work_process_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)); ?></span>
                        <h2 class="title"><?php echo e(filter_static_option_value('home_page_14_work_process_section_'.$user_select_lang_slug.'_title',$static_field_data)); ?></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="cagency-work-process-list">
                        <?php
                            $all_icon_fields =  filter_static_option_value('home_page_14_work_process_section_item_number',$static_field_data);
                            $all_icon_fields = !empty($all_icon_fields) ? unserialize($all_icon_fields) : [];
                            $all_title_fields = filter_static_option_value('home_page_14_work_process_section_item_'.$user_select_lang_slug.'_title',$static_field_data);
                            $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields) : [];
                        ?>
                        <?php $__currentLoopData = $all_icon_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $number): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="single-work-process-item">
                                <div class="num-wrap style-<?php echo e($loop->index + 1); ?>">
                                    <span class="number"><?php echo e($number); ?></span>
                                </div>
                                <h4 class="title"><?php echo e($all_title_fields[$loop->index] ?? ''); ?></h4>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_counterup_section_status',$static_field_data))): ?>
    <div class="dcagency-counterup-area padding-top-115 padding-bottom-120"
    <?php echo render_background_image_markup_by_attachment_id(filter_static_option_value('home_page_14_counterup_section_background_image',$static_field_data)); ?>

    >
        <div class="container">
            <div class="row">
                <?php $__currentLoopData = $all_counterup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="cagency-counterup-item dagency-home">
                            <div class="number style-<?php echo e($loop->index + 1); ?>">
                                <div class="count-wrap"><span class="count-num"><?php echo e($data->number); ?></span><?php echo e($data->extra_text); ?></div>
                            </div>
                            <div class="content">
                                <h4 class="title"><?php echo e($data->title); ?></h4>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if(!empty(filter_static_option_value('home_page_testimonial_section_status',$static_field_data))): ?>
    <div class="logistic-testimonial-area padding-top-120 padding-bottom-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 dagency-home">
                        <span class="subtitle"><?php echo e(filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_testimonial_section_subtitle',$static_field_data)); ?></span>
                        <h2 class="title"><?php echo e(filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_testimonial_section_title',$static_field_data)); ?></h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="testimonial-carousel-area margin-top-10 ">
                        <div class="global-carousel-init logistic-dots"
                             data-loop="true"
                             data-desktopitem="3"
                             data-mobileitem="1"
                             data-tabletitem="2"
                             data-dots="true"
                             data-autoplay="true"
                             data-margin="30"
                        >
                            <?php $__currentLoopData = $all_testimonial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="cagency-single-testimonial-item dagency-home">
                                    <div class="content">
                                        <i class="fas fa-quote-left"></i>
                                        <p class="description "><?php echo e($data->description); ?></p>
                                    </div>
                                    <div class="author-details">
                                        <div class="thumb ">
                                            <?php echo render_image_markup_by_attachment_id($data->image); ?>

                                        </div>
                                        <div class="content">
                                            <h4 class="title "><?php echo e($data->name); ?></h4>
                                            <span class="designation "><?php echo e($data->designation); ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if(!empty(filter_static_option_value('home_page_latest_news_section_status',$static_field_data))): ?>
    <div class="const-news-area padding-bottom-90 padding-top-115 dagency-bg-color">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 dagency-home">
                        <span class="subtitle"><?php echo e(filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_news_area_section_subtitle',$static_field_data)); ?></span>
                        <h2 class="title"><?php echo e(filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_news_area_section_title',$static_field_data)); ?></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-grid-carosel-wrapper">
                        <div class="global-carousel-init logistic-dots lawyer-home"
                             data-loop="true"
                             data-desktopitem="3"
                             data-mobileitem="1"
                             data-tabletitem="2"
                             data-dots="true"
                             data-autoplay="true"
                             data-margin="30"
                        >
                            <?php $__currentLoopData = $all_blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="single-portfolio-blog-grid dagency-home">
                                    <div class="thumb">
                                        <?php echo render_image_markup_by_attachment_id($data->image,'thumb'); ?>

                                        <div class="time-wrap">
                                            <span class="date"><?php echo e(date_format($data->created_at,'d')); ?></span>
                                            <span class="month"><?php echo e(date_format($data->created_at,'M')); ?></span>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <h4 class="title">
                                            <a href="<?php echo e(route('frontend.blog.single',$data->slug)); ?>"><?php echo e($data->title); ?></a>
                                        </h4>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if(!empty(filter_static_option_value('home_page_contact_section_status',$static_field_data))): ?>
    <div class="dagency-news-area padding-bottom-120 padding-top-115">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 dagency-home">
                        <span class="subtitle"><?php echo e(filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_contact_area_subtitle',$static_field_data)); ?></span>
                        <h2 class="title"><?php echo e(filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_contact_area_title',$static_field_data)); ?></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="contact-form-wrap">
                        <form action="<?php echo e(route('frontend.get.touch')); ?>" id="get_in_touch_form" method="post" enctype="multipart/form-data"
                              class="contact-page-form">
                            <div class="error-message"></div>
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="captcha_token" id="gcaptcha_token">
                                <?php echo render_form_field_for_frontend(filter_static_option_value('get_in_touch_form_fields',$static_field_data)); ?>

                                <div class="btn-wrapper">
                                    <button type="submit" id="get_in_touch_submit_btn"
                                            class="boxed-btn"><?php echo e(filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_contact_area_button_text',$static_field_data)); ?></button>
                                    <div class="ajax-loading-wrap hide">
                                        <div class="sk-fading-circle">
                                            <div class="sk-circle1 sk-circle"></div>
                                            <div class="sk-circle2 sk-circle"></div>
                                            <div class="sk-circle3 sk-circle"></div>
                                            <div class="sk-circle4 sk-circle"></div>
                                            <div class="sk-circle5 sk-circle"></div>
                                            <div class="sk-circle6 sk-circle"></div>
                                            <div class="sk-circle7 sk-circle"></div>
                                            <div class="sk-circle8 sk-circle"></div>
                                            <div class="sk-circle9 sk-circle"></div>
                                            <div class="sk-circle10 sk-circle"></div>
                                            <div class="sk-circle11 sk-circle"></div>
                                            <div class="sk-circle12 sk-circle"></div>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <ul class="dagency-info-list">
                        <?php $__currentLoopData = $all_contact_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="single-info-list">
                                <div class="icon">
                                    <i class="<?php echo e($data->icon); ?>"></i>
                                </div>
                                <div class="content">
                                    <h5 class="title"><?php echo e($data->title); ?></h5>
                                    <?php
                                        $info_details = !empty($data->description) ? explode("\n",$data->description) : [];
                                    ?>
                                    <?php $__currentLoopData = $info_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="details"><?php echo e($item); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php $__env->startSection('scripts'); ?>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(get_static_option('google_api_key')); ?>&callback=initAutocomplete&libraries=places&v=weekly" defer ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.my-select').selectpicker();
    
        function initAutocomplete() {
            // Get all elements with the class 'locs'
            const inputs = document.getElementsByClassName('locs');
            
            // Options for the SearchBox (same for all instances)
            const options = {
              types: ['geocode'],  // Restrict to geocodes (locations)
              componentRestrictions: { country: 'gb' }  // Limit to United Kingdom (code: 'gb')
            };
            
            // Initialize a SearchBox for each input element with class 'locs'
            Array.from(inputs).forEach(input => {
              new google.maps.places.SearchBox(input, options);
            });

        }
        
        window.initAutocomplete = initAutocomplete;
        
        
        $(document).ready(function () {
            $(document).on('click', '#get_in_touch_submit_btn', function (e) {
                e.preventDefault();
                var myForm = document.getElementById('get_in_touch_form');
                var formData = new FormData(myForm);

                $.ajax({
                    type: "POST",
                    url: "<?php echo e(route('frontend.get.touch')); ?>",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        $('#get_in_touch_submit_btn').parent().find('.ajax-loading-wrap').removeClass('hide').addClass('show');
                    },
                    success: function (data) {
                        var errMsgContainer = $('#get_in_touch_form').find('.error-message');
                        $('#get_in_touch_submit_btn').parent().find('.ajax-loading-wrap').removeClass('show').addClass('hide');
                        errMsgContainer.html('');

                        if(data.status == '400'){
                            errMsgContainer.append('<span class="text-danger">'+data.msg+'</span>');
                        }else{
                            errMsgContainer.append('<span class="text-success">'+data.msg+'</span>');
                        }
                    },
                    error: function (data) {
                        var error = data.responseJSON;
                        var errMsgContainer = $('#get_in_touch_form').find('.error-message');
                        errMsgContainer.html('');
                        $.each(error.errors,function (index,value) {
                            errMsgContainer.append('<span class="text-danger">'+value+'</span>');
                        });
                        $('#get_in_touch_submit_btn').parent().find('.ajax-loading-wrap').removeClass('show').addClass('hide');
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php /**PATH C:\XAMPP\htdocs\removal\@core\resources\views/frontend/home-pages/home-14.blade.php ENDPATH**/ ?>