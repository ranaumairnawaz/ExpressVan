
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
        margin: 0.25rem;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        white-space: nowrap;
        border: 2px solid #ced4da;
    }
    .nav-arrow .nav-link.active {
        
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
                        <span class="nav-link rounded-pill" data-step="1">Quote & Select Van</span>
                    </li>
                    <li class="nav-item rounded-pill">
                        <span class="nav-link rounded-pill" data-step="2">Address & Summary</span>
                    </li>
                    <li class="nav-item rounded-pill">
                        <span class="nav-link rounded-pill" data-step="3">Contact Details</span>
                    </li>
                    <li class="nav-item rounded-pill">
                        <span class="demo-link rounded-pill" >
                            <i class="fa-solid fa-credit-card"></i>
                        </span>
                    </li>
                </ul>
            </div>
            <div class="row" >
                <div class="col-md-12 py-3" >
                    <div class="w-100 h-100 p-3" >
                      <form id="back-form" action="<?php echo e(route('frontend.book')); ?>" method="POST" >
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="service" value="<?php echo e($service); ?>" >
                        <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <input type="hidden" name="location[]" value="<?php echo e($loc); ?>" >
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <h3>
                            <button type="button" class="btn btn-outline-dark rounded-pill p-3 mt-3 mx-auto mx-3" id="prev-btn" >
                                <i class="fa fa-arrow-left"></i> Previous
                            </button>
                        </h3>
                      </form>
                      <form action="<?php echo e(route('frontend.book.time')); ?>" method="POST" id="multi-step-form" onsubmit="return validateFormSubmission();">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="order_trx" value="<?php echo e($order_trx); ?>" >
                        <input type="hidden" name="service" value="<?php echo e($service); ?>" >
                        <div class="step w-100" id="step1">
                            <h4 id="alert1" class="text-center text-danger" ></h4>
                            <div class="row" >
                                <div class="col-md-4">
                                    <div class="form-group my-2">
                                        <label>Total Booking Time</label>
                                        <?php 
                                            // Get the max hours, defaulting to 0 if not set to prevent errors
                                            $minhours = get_static_option('minimum_booking_hours') ?? 2; 
                                            $maxhours = get_static_option('maximum_booking_hours') ?? 6; 
                                        ?>
                                        
                                        <select id="durationSelect" required class="form-control" name="duration">
                                            
                                            <?php for($i = $minhours; $i <= $maxhours; $i += 0.5): ?>
                                                <option value="<?php echo e($i); ?>">
                                                    <?php echo e($i); ?> <?php echo e($i == 1 ? 'hour' : 'hours'); ?>

                                                </option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4" >
                                    <div class="form-group my-2" >
                                        <label>Select Helpers</label>
                                        <select id="helperSelect" class="form-control" required name="helpers">
                                            <option data-price="0" data-overtimeprice="0" value="0">No helper</option>
                                            <?php $__currentLoopData = $helpers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $helper): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option data-price="<?php echo e($helper->price); ?>" data-overtimeprice="<?php echo e($helper->overtime_price); ?>" value="<?php echo e($helper->id); ?>"><?php echo e($helper->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4" ></div>
                                <input type="hidden" required id="CarInput" name="transport">
                                <?php $__currentLoopData = $transports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-3 mb-3 text-center">
                                    <div class="card newCard mb-3" id="card-<?php echo e($car->id); ?>">
                                        <div class="card-header d-flex align-items-center justify-content-between" >
                                            <div class="w-25" >
                                                <?php echo render_image_markup_by_attachment_id($car->image); ?>

                                            </div>
                                            <div class="75" >
                                                <h5 style="border: 3px solid transparent;" class="card-title p-3"><?php echo e($car->name); ?></h5>
                                            </div>
                                        </div>
                                        <div class="card-body px-3" >
                                            <div class="w-100 mt-2 text-center" >
                                                <h1 id="carPrice<?php echo e($car->id); ?>" class="text-center text-primary fw-700" ></h1>
                                                <p>For the first <span class="text-primary"  id="carShowTime<?php echo e($car->id); ?>" ></span></p>
                                                <p><span class="text-primary" id="carShowOvertime<?php echo e($car->id); ?>" ><?php echo e(site_currency_symbol()); ?><?php echo e($car->overtime_price); ?></span> perhour thereafter</p>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#" data-toggle="modal" data-target="#vanSpecification<?php echo e($car->id); ?>" class="mt-4 text-center text-primary">Van Specification <i class="fa fa-info-circle" ></i></a>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="w-100 d-flex justify-content-end mt-3" >
                                <button type="button" class="btn-dagency px-5 mx-3 next-btn">Next</button>
                            </div>
                        </div>
                        <div class="step w-100" id="step2">
                          <h4 id="alert2" class="text-center text-danger" ></h4>
                          <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <input type="hidden" name="city[]" value="<?php echo e($cities[$key]); ?>" >
                          <input type="hidden" name="postcode[]" value="<?php echo e($postcodes[$key]); ?>" >
                          <div class="row" >
                              <div class="col-md-8" >
                                <div class="form-group my-2" >
                                    <?php if($loop->first): ?>
                                        <label>Pickup (*)</label>
                                    <?php elseif($loop->last): ?>
                                        <label>Dropoff (*)</label>
                                    <?php else: ?>
                                        <label>STOP <?php echo e(chr(64 + $loop->iteration - 1)); ?> (*)</label>
                                    <?php endif; ?>
                                    <input type="text" placeholder="Postcode" class="form-control" readonly required name="location[]" value="<?php echo e($location); ?>" >
                                </div>
                              </div>
                              <div class="col-md-4" >
                                <div class="form-group my-2 house-lookups" data-postcode="<?php echo e($postcodes[$key]); ?>" >
                                    <label>House Number/ House Name (*)</label>
                                    <select class="form-control house-select d-none mb-2" onchange="toggleHouseInput(this)">
                                        <option value="" disabled selected>Loading addresses...</option>
                                    </select>
                                    <input type="text" placeholder="House Number or Name" required class="form-control" name="house[]" value="<?php echo e($houseNumbers[$key]); ?>" >
                                    <small class="text-info d-none loading-msg pt-1"><i class="fa fa-spinner fa-spin"></i> Fetching property list for <?php echo e($postcodes[$key]); ?>...</small>
                                </div>
                              </div>
                              <div class="col-md-4" >
                                <div class="form-group my-2" >
                                    <label>Select Floors (*)</label>
                                    <select class="form-control" id="floor<?php echo e($key); ?>" onchange="showLift(<?php echo e($key); ?>)" required name="floor[]" >
                                        <option value="" selected disabled >Select Floor</option>
                                        <?php $__currentLoopData = $floors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $floor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($floor->id); ?>" data-price="<?php echo e($floor->elevator_price); ?>" ><?php echo e($floor->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                              </div>
                              <div id="elevator<?php echo e($key); ?>" class="col-md-4 d-none" >
                                <div class="form-group my-2" >
                                    <label>Is there lift/ elevator in use? (*)</label>
                                    <select class="form-control" required name="elevator[]" >
                                        <option value="0" >No</option>
                                        <option value="1" >Yes</option>
                                    </select>
                                </div>
                              </div>
                              <div class="col-md-4" >
                                <div class="form-group my-2" >
                                    <label>What parking Option is Available (*)</label>
                                    <select class="form-control" required name="parking[]" >
										<option value="" selected disabled>Select Parking Option</option>
										<?php $__currentLoopData = $parkings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($parking->id); ?>"><?php echo e($parking->name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                              </div>
                              <div class="col-12" >
                                  <?php
                                  $spcode = checkSpecialZipCode($postcodes[$key]);
                                  ?>
                                  <?php if($spcode): ?>
                                      <?php if($spcode->type == 1): ?>
                                        <p class="text-danger" > Additional <?php echo e(site_currency_symbol()); ?><?php echo e(get_static_option('congestion_charge')); ?> has been added as <?php echo e($location); ?> is in congestion zone.</p>
                                      <?php elseif($spcode->type == 2): ?>
                                      <p class="text-danger" > Additional <?php echo e(site_currency_symbol()); ?><?php echo e(get_static_option('ultra_low_emission_charge')); ?> has been added as <?php echo e($location); ?> is in the ULEZ zone.</p>
                                      <?php elseif($spcode->type == 3): ?>
                                      <p class="text-danger" > Additional <?php echo e(site_currency_symbol()); ?><?php echo e(get_static_option('ultra_low_emission_charge')); ?> & <?php echo e(site_currency_symbol()); ?><?php echo e(get_static_option('congestion_charge')); ?> has been added as <?php echo e($location); ?> is in the ULEZ & congestion zone.</p>
                                      <?php endif; ?>
                                  <?php endif; ?>
                              </div>
                          </div>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <div class="w-100 d-flex justify-content-end mt-3" >
                            <button type="button" class="btn-dagency px-5 mx-3 next-btn">Next</button>
                          </div>
                        </div>
                        <div class="step w-100" id="step3">
                            <h4 id="alert3" class="text-center text-danger" ></h4>
                            <div class="row" >
                                <div class="col-md-4" >
                                    <div class="form-group my-2" >
                                        <label>Name (*)</label>
                                        <input type="text" required class="form-control" name="name" >
                                    </div>
                                </div>
                                <div class="col-md-4" >
                                    <div class="form-group my-2" >
                                        <label>Email (*)</label>
                                        <input type="email" required class="form-control" name="email" >
                                    </div>
                                </div>
                                <div class="col-md-4" >
                                    <div class="form-group my-2" >
                                        <label>Phone Number (*)</label>
                                        <input type="text" required class="form-control" name="phone" >
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center" >
                                <div class="col-md-4" >
                                    <div class="form-group my-2" >
                                        <label>Date (*)</label>
                                        <input type="date" required class="form-control w-100" name="date" >
                                    </div>
                                </div>
                                <div class="col-md-4" >
                                    <div class="form-group my-2">
                                        <label class="col-form-label">For what time?</label>
                                        <select class="form-control" name="time" required aria-invalid="false">
                                            <option value="" selected disabled>Preferred Time</option>
                                            <option value="06:00">06:00 - 07:00</option>
                                            <option value="06:30">06:30 - 07:30</option>
                                            <option value="07:00">07:00 - 08:00</option>
                                            <option value="07:30">07:30 - 08:30</option>
                                            <option value="08:00">08:00 - 09:00</option>
                                            <option value="08:30">08:30 - 09:30</option>
                                            <option value="09:00">09:00 - 10:00</option>
                                            <option value="09:30">09:30 - 10:30</option>
                                            <option value="10:00">10:00 - 11:00</option>
                                            <option value="10:30">10:30 - 11:30</option>
                                            <option value="11:00">11:00 - 12:00</option>
                                            <option value="11:30">11:30 - 12:30</option>
                                            <option value="12:00">12:00 - 13:00</option>
                                            <option value="12:30">12:30 - 13:30</option>
                                            <option value="13:00">13:00 - 14:00</option>
                                            <option value="13:30">13:30 - 14:30</option>
                                            <option value="14:00">14:00 - 15:00</option>
                                            <option value="14:30">14:30 - 15:30</option>
                                            <option value="15:00">15:00 - 16:00</option>
                                            <option value="15:30">15:30 - 16:30</option>
                                            <option value="16:00">16:00 - 17:00</option>
                                            <option value="16:30">16:30 - 17:30</option>
                                            <option value="17:00">17:00 - 18:00</option>
                                            <option value="17:30">17:30 - 18:30</option>
                                            <option value="18:00">18:00 - 19:00</option>
                                            <option value="18:30">18:30 - 19:30</option>
                                            <option value="19:00">19:00 - 20:00</option>
                                            <option value="19:30">19:30 - 20:30</option>
                                            <option value="20:00">20:00 - 21:00</option>
                                            <option value="20:30">20:30 - 21:30</option>
                                            <option value="21:00">21:00 - 22:00</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4" >
                                    <div class="form-group my-2">
                                        <label class="col-form-label">Would you like to ride along?</label>
                                        <select class="form-control" name="ride" required aria-invalid="false">
                                            <option value="" selected disabled >Would you like to ride along?</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row" >
                                <div class="col-md-3" >
                                    <div class="form-group">
                                        <label class="col-form-label">Would you like to take instance cover?</label>
                                        <select class="form-control" name="insurance" required id="insurance" aria-invalid="false">
                                            <option value="0" selected >No insurance needed</option>
                                            <?php $__currentLoopData = $insurances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ins): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($ins->id); ?>">Cover upto <?php echo e(amount_with_currency_symbol($ins->cover)); ?> - <?php echo e(amount_with_currency_symbol($ins->price)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-9" >
                                    <div class="form-group" id="hashtag-container" >
                                        <label>Additional Information</label>
                                        <input type="text" placeholder="Please tell us what we should need to know in regard to your move. (What are you moving access difficulities, the parking situation, etc.)" name="message" class="form-control w-100" >
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center d-none" id="Inventory" >
                                <div class="col-md-4" >
                                    <div class="form-group" id="hashtag-container" >
                                        <label>Inventory</label>
                                        <input type="text" placeholder="Add Inventory" id="inventoryInput" class="form-control w-100" >
                                    </div>
                                </div>
                                <div class="col-md-2" >
                                    <div class="form-group" id="hashtag-container" >
                                        <label>Quantity</label>
                                        <input type="number" placeholder="Quantity" id="inventoryQty" style="max-width: 100%;" class="form-control w-100" >
                                    </div>
                                </div>
                                <div class="col-md-2" >
                                    <div class="form-group" id="hashtag-container" >
                                            <label>Value</label>
                                        <input type="number" placeholder="Value" id="inventoryPrice" style="max-width: 100%;" class="form-control w-100" >
                                    </div>
                                </div>
                                <div class="col-md-2" >
                                    <button onclick="addElement()" type="button" class="btn-dagency btn-sm mt-3 px-5" >Add</button>
                                </div>
                            </div>
                            <input type="hidden" id="inventoryTotalPrice" >
                            <input type="hidden" id="insuranceCoverLimit" value="0">
                            <div class="d-flex mx-5 flex-wrap align-items-center" id="parentDiv" ></div>
                            <div class="text-danger" id="insuranceMessage" ></div>
                            
                            <div class="w-100 d-flex justify-content-end mt-3" >
                                <button type="submit" class="btn-dagency px-5 mx-3 next-btn">Next</button>
                            </div>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php $__currentLoopData = $transports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="modal fade" id="vanSpecification<?php echo e($car->id); ?>" tabindex="-1" role="dialog" aria-labelledby="vanSpecification<?php echo e($car->id); ?>" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="vanSpecificationLabel<?php echo e($car->id); ?>"><?php echo e($car->name); ?> Specifications</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row" >
                <div class="col-lg-12" >
                    <p><?php echo e($car->specification_description); ?></p>
                </div>
                <div class="col-lg-4" >
                    <?php
                        $car_images = explode("|",$car->specification_images);
                    ?>
                    <?php $__currentLoopData = $car_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo render_image_markup_by_attachment_id($img,'','large'); ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="col-lg-8" >
                    <h4>Inside Measurments</h4>
                    <p>
                        Length: <?php echo e($car->inside_length); ?>m </br>
                        Height: <?php echo e($car->inside_height); ?>m </br>
                        Width: <?php echo e($car->inside_width); ?>m
                    </p>
                    <h4>Outside Measurments</h4>
                    <p>
                        Length: <?php echo e($car->outside_length); ?>m <br>
                        Heigh: <?php echo e($car->outside_height); ?>m <br>
                        Width: <?php echo e($car->outside_width); ?>m
                    </p>
                    <h4>Volume/ Payload</h4>
                    <p>
                        <?php echo e($car->volume); ?> m³ </br>
                        <?php echo e($car->payload); ?> kg </br></br>
                        Number of Seats: <?php echo e($car->seats); ?> passenger can travel in the van.
                    </p>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- Go Address Integration ---
        const apiKey = "<?php echo e(get_static_option('go_address_api_key')); ?>";
        const goAddressStatus = "<?php echo e(get_static_option('go_address_status')); ?>";
        const containers = document.querySelectorAll('.house-lookups');
        
        if (goAddressStatus === "1" && apiKey) {
            containers.forEach(container => {
                const postcode = container.getAttribute('data-postcode');
                const select = container.querySelector('.house-select');
                const manualInput = container.querySelector('input[name="house[]"]');
                const loadingMsg = container.querySelector('.loading-msg');
                
                if (postcode) {
                    loadingMsg.classList.remove('d-none');
                    fetch(`https://portal.goaddress.io/api/address/${encodeURIComponent(postcode)}`, {
                        headers: {
                            'Authorization': `Bearer ${apiKey}`,
                            'Accept': 'application/json'
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            loadingMsg.classList.add('d-none');
                            
                            // Highly robust extraction to handle various address array response formats
                            let addresses = [];
                            if (Array.isArray(data)) {
                                addresses = data;
                            } else if (data && Array.isArray(data.result)) {
                                addresses = data.result;
                            } else if (data && Array.isArray(data.addresses)) {
                                addresses = data.addresses;
                            } else if (data && Array.isArray(data.data)) {
                                addresses = data.data;
                            } else if (data && Array.isArray(data.results)) {
                                addresses = data.results;
                            }
                            
                            if (addresses.length > 0) {
                                select.classList.remove('d-none');
                                if (!manualInput.value) {
                                    manualInput.classList.add('d-none'); 
                                } else {
                                    // If they already have a value, just add it as an option or leave manual open
                                    select.value = 'manual_entry';
                                }
                                
                                select.innerHTML = '<option value="" disabled selected>Select from registered addresses...</option><option value="manual_entry">-- Manually Enter Address / Not Listed --</option>';
                                
                                // Remove duplicates by combining lines
                                const uniqueAddresses = new Set();
                                addresses.forEach(address => {
                                    let fullLine = '';
                                    if (typeof address === 'string') {
                                        fullLine = address;
                                    } else if (address && typeof address === 'object') {
                                        if (address.formatted_address) {
                                            fullLine = address.formatted_address;
                                        } else if (address.address) {
                                            fullLine = address.address;
                                        } else if (address.summary) {
                                            fullLine = address.summary;
                                        } else {
                                            const parts = [
                                                address.line_1 || address.address_line_1 || address.line1,
                                                address.line_2 || address.address_line_2 || address.line2,
                                                address.line_3 || address.address_line_3 || address.line3,
                                                address.town || address.city || address.post_town
                                            ].filter(Boolean);
                                            fullLine = parts.join(', ');
                                        }
                                    }
                                    
                                    if (fullLine && !uniqueAddresses.has(fullLine)) {
                                        uniqueAddresses.add(fullLine);
                                        const opt = document.createElement('option');
                                        opt.value = fullLine;
                                        opt.innerText = fullLine;
                                        select.appendChild(opt);
                                    }
                                });
                            }
                        })
                        .catch(err => {
                            loadingMsg.classList.add('d-none');
                            console.error("Go Address Lookup Error:", err);
                        });
                }
            });
        }
    });

    window.toggleHouseInput = function(selectElement) {
        const container = selectElement.closest('.house-lookups');
        const manualInput = container.querySelector('input[name="house[]"]');
        if (selectElement.value === 'manual_entry') {
            manualInput.classList.remove('d-none');
            manualInput.value = '';
            manualInput.focus();
        } else if (selectElement.value) {
            manualInput.classList.add('d-none');
            manualInput.value = selectElement.value;
        }
    };
    

    document.addEventListener('DOMContentLoaded', function() {
    
        const dateInput = document.querySelector('input[name="date"]');
        const timeSelect = document.querySelector('select[name="time"]');
        const durationSelect = document.querySelector('select[name="duration"]');
        
        // Define the absolute latest allowed end time for a booking (22:00 = 10 PM)
        const MAX_END_TIME_MINUTES = 22 * 60; // 1320 minutes
    
        // --- Helper Functions for User Feedback ---
        
        // Finds or creates a message container specific to the time selector
        function getMessageElement() {
            let messageElement = document.getElementById('time-restriction-message');
            if (!messageElement && timeSelect && timeSelect.parentNode) {
                messageElement = document.createElement('div');
                messageElement.id = 'time-restriction-message';
                // Use Tailwind classes for simple, noticeable styling (or equivalent CSS)
                messageElement.className = 'mt-2 text-sm text-red-600 font-semibold'; 
                timeSelect.parentNode.appendChild(messageElement);
            }
            return messageElement;
        }
    
        function displayMessage(message) {
            const msgEl = getMessageElement();
            if (msgEl) {
                msgEl.textContent = message;
                msgEl.style.display = 'block';
            }
        }
    
        function clearMessage() {
            const msgEl = getMessageElement();
            if (msgEl) {
                msgEl.textContent = '';
                msgEl.style.display = 'none';
            }
        }
    
        // --- 1. Initial Setup: Set Minimum Date to Today (Prevents past dates) ---
        function setMinDate() {
            const today = new Date();
            let dd = today.getDate();
            let mm = today.getMonth() + 1; // January is 0!
            const yyyy = today.getFullYear();
    
            // Format the date components (ensure two digits for day and month)
            dd = dd < 10 ? '0' + dd : dd;
            mm = mm < 10 ? '0' + mm : mm;
    
            const minDate = `${yyyy}-${mm}-${dd}`; // YYYY-MM-DD format
            if (dateInput) {
                dateInput.setAttribute('min', minDate);
            }
        }
    
        // --- 2. Dynamic Restriction: Disable Invalid Time Slots ---
        function restrictTimeSlots() {
            if (!dateInput || !timeSelect || !durationSelect) return;
    
            const selectedDateStr = dateInput.value;
            const selectedDurationHours = parseFloat(durationSelect.value || 0); // Default to 0 if none selected
            const selectedDurationMinutes = selectedDurationHours * 60;
            
            const today = new Date();
            const yyyy = today.getFullYear();
            let mm = today.getMonth() + 1;
            let dd = today.getDate();
            
            mm = mm < 10 ? '0' + mm : mm;
            dd = dd < 10 ? '0' + dd : dd;
            
            const todayStr = `${yyyy}-${mm}-${dd}`; // YYYY-MM-DD format for comparison
            const isToday = selectedDateStr === todayStr;
            
            let hasValidSelection = false;
            let invalidationReason = null; // Track the reason for resetting the selection
    
            // Store the previous selection value before iterating
            const previousTimeValue = timeSelect.value; 
    
            // Iterate through all time options
            Array.from(timeSelect.options).forEach(option => {
                const timeValue = option.value; // e.g., "06:00"
                option.disabled = false; // Reset disabled state first
    
                // Skip the disabled placeholder option
                if (option.disabled && timeValue === "") {
                    return;
                }
    
                // Calculate option start time in total minutes
                const [optionHour, optionMinute] = timeValue.split(':').map(Number);
                const optionStartMinutes = optionHour * 60 + optionMinute;
                
                // --- Check 1: Maximum Working Hours Restriction ---
                const optionEndMinutes = optionStartMinutes + selectedDurationMinutes;
    
                if (optionEndMinutes > MAX_END_TIME_MINUTES) {
                    // If the booking goes past 22:00, disable this start time
                    option.disabled = true;
                    if (timeValue === previousTimeValue) {
                        invalidationReason = 'duration';
                    }
                }
    
                // --- Check 2: Past Time Restriction (Only for Today) ---
                if (isToday && !option.disabled) { // Only check if not already disabled by Check 1
                    // Calculate current time + 30 minutes buffer in total minutes
                    const bufferMinutes = 30;
                    const currentMinutes = today.getHours() * 60 + today.getMinutes() + bufferMinutes;
                    
                    // If the option's start time is earlier than the current time + buffer
                    if (optionStartMinutes < currentMinutes) {
                        option.disabled = true;
                        if (timeValue === previousTimeValue) {
                            invalidationReason = 'pastTime';
                        }
                    }
                }
    
                // Check if the current selection is still valid
                if (!option.disabled && timeSelect.value === timeValue) {
                    hasValidSelection = true;
                }
            });
    
            // --- Handle Selection Reset and Messaging ---
            if (previousTimeValue !== "" && !hasValidSelection) {
                 // The previous selection was just invalidated. Reset the selection and show a message.
                 timeSelect.value = "";
                 
                 if (invalidationReason === 'pastTime') {
                     displayMessage("The selected time slot has passed or is too soon (30 min buffer). Please choose a later time.");
                 } else if (invalidationReason === 'duration') {
                     displayMessage(`The selected time slot plus ${selectedDurationHours} hours exceeds the 22:00 working hour limit.`);
                 } else {
                     // Fallback for an unhandled reset case
                     displayMessage("Your previous time selection is no longer valid. Please choose a new time.");
                 }
            } else {
                // If the selection is valid or was already empty, clear the message
                clearMessage();
            }
        }
    
        // --- 3. Event Listeners ---
        
        // Set min date on load
        setMinDate();
        
        // Check time restriction whenever the date input changes
        if(dateInput) {
            dateInput.addEventListener('change', function() {
                // Reset selected time when the date changes to force re-selection
                timeSelect.value = ""; 
                clearMessage(); // Clear message immediately on date change
                restrictTimeSlots();
            });
        }
    
        // Check time restriction whenever the duration input changes
        if(durationSelect) {
            durationSelect.addEventListener('change', function() {
                restrictTimeSlots();
            });
        }
        
        // Clear message if user manually selects a new, valid time
        if(timeSelect) {
            timeSelect.addEventListener('change', clearMessage);
        }
    
        // Run once on load in case the date/duration fields are pre-filled
        restrictTimeSlots();
        
        // --- ICON MAP DEFINITION ---
        const iconMap = {
            1: '<i class="fa-solid fa-truck-front"></i>',
            2: '<i class="fa-solid fa-house-chimney"></i>',
            3: '<i class="fa-solid fa-address-card"></i>'
            // Add more mappings if you have more than 3 steps
        };
        // ---------------------------

        // Function to validate form before submission
        window.validateFormSubmission = function() {
            const insuranceSelect = document.getElementById('insurance');
            if (insuranceSelect && insuranceSelect.value !== '0') {
                // Insurance is selected, check if at least one inventory item exists
                const inventoryItems = document.querySelectorAll('input[name="inventoryInput[]"]');
                if (inventoryItems.length === 0) {
                    // Show error message
                    document.getElementById('insuranceMessage').innerHTML = 'Please add at least one inventory item when insurance is selected.';
                    // Scroll to the error message
                    document.getElementById('insuranceMessage').scrollIntoView({ behavior: 'smooth' });
                    return false;
                }
            }
            return true;
        };


        document.getElementById('insurance').addEventListener('change', function () {
            const inventoryDiv = document.getElementById('Inventory');
            let selectedInsuranceId = this.value;

            if (selectedInsuranceId !== '0') {
                inventoryDiv.classList.remove('d-none');
            } else {
                inventoryDiv.classList.add('d-none');
            }

            // Get the cover amount from the insurances array
            let insurances = <?php echo json_encode($insurances, 15, 512) ?>;
            let selectedInsurance = insurances.find(ins => ins.id == selectedInsuranceId);
            let coverLimit = selectedInsurance ? selectedInsurance.cover : 0;

            // Update the hidden input field with the cover amount
            document.getElementById('insuranceCoverLimit').value = coverLimit;

            checkInsuranceCover();
        });


        var currentStep = 1;
        var form = document.getElementById('multi-step-form');
        var steps = form.querySelectorAll('.step');
        var nextBtns = form.querySelectorAll('.next-btn');
        var prevBtns = document.getElementById('prev-btn');
        var navItems = document.querySelectorAll('.nav .nav-link'); // Navbar steps

        // Show the initial step
        showStep(currentStep);
        updateNavBar(currentStep); // Update navbar initially

        // Function to update the active step in the navigation bar
        function updateNavBar(step) {
            navItems.forEach((item, index) => {
                item.classList.remove('active');
                const stepIndex = index + 1;

                // Store the original text (only once)
                if (!item.dataset.originalText) {
                    item.dataset.originalText = item.textContent.trim();
                }

                if (stepIndex === step) {
                    // Active step: Show the original text (use innerHTML to safely restore the content)
                    item.innerHTML = item.dataset.originalText;
                    item.classList.add('active');
                } else {
                    // Inactive step: Show the icon HTML
                    const iconHtml = iconMap[stepIndex] || item.dataset.originalText; // Fallback to text if icon not found
                    item.innerHTML = iconHtml;
                }
            });
        }


        // Handle next button clicks
        nextBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth' // Smooth scrolling
                });
                var alert = 'alert' + currentStep;
                if (currentStep < steps.length) {
                    if (validateStep(currentStep)) {
                        hideStep(currentStep);
                        document.getElementById(alert).innerHTML = '';
                        currentStep++;
                        showStep(currentStep);
                        updateNavBar(currentStep); // Update navbar on next
                    } else {
                        document.getElementById(alert).innerHTML = 'Please fill in all required fields before proceeding.';
                    }
                }
            });
        });

        // Handle previous button clicks
        prevBtns.addEventListener('click', function() {
            if (currentStep == 1) {
                document.getElementById('back-form').submit();
            } else if (currentStep > 1) {
                hideStep(currentStep);
                currentStep--;
                showStep(currentStep);
                updateNavBar(currentStep); // Update navbar on previous
            }
        });

        // Function to show a step
        function showStep(stepNum) {
            steps[stepNum - 1].classList.add('active');
        }

        // Function to hide a step
        function hideStep(stepNum) {
            steps[stepNum - 1].classList.remove('active');
        }

        // Get all car cards
        const carCards = document.querySelectorAll('.newCard');
        const carInput = document.getElementById('CarInput');

        // Attach click event listener to each car card
        carCards.forEach(card => {
            card.addEventListener('click', function() {
                // Get the selected car ID from the card's ID
                const carId = this.id.split('-')[1];

                // Update the hidden CarInput field with the selected car ID
                carInput.value = carId;

                // Remove the highlight from all cards and add it to the selected card
                carCards.forEach(c => c.style.border = '2px solid transparent');
                this.style.border = '3px solid #007bff'; // Use your preferred color here
            });
        });

        function validateStep(stepNumber) {
            const requiredFields = document.querySelectorAll(`#step${stepNumber} input[required], #step${stepNumber} select[required]`);
            let isValid = true;

            requiredFields.forEach(field => {
                if (field.value.trim() === "") { // Only check for empty values, allow '0'
                    isValid = false;
                    field.classList.add('error');
                } else {
                    field.classList.remove('error');
                }
            });

            // Check if insurance is selected and inventory items are added
            const insuranceSelect = document.getElementById('insurance');
            if (insuranceSelect && insuranceSelect.value !== '0') {
                // Insurance is selected, check if at least one inventory item exists
                const inventoryItems = document.querySelectorAll('input[name="inventoryInput[]"]');
                if (inventoryItems.length === 0) {
                    isValid = false;
                    // Show error message
                    document.getElementById('insuranceMessage').innerHTML = 'Please add at least one inventory item when insurance is selected.';
                } else {
                    document.getElementById('insuranceMessage').innerHTML = '';
                }
            }

            return isValid;
        }


        // Calculate total price based on selected duration and helper price
        function calculateTotal() {
            const durationSelect = document.getElementById('durationSelect');
            const duration = parseFloat(durationSelect.value);
            const totalMins = duration * 60;

            const helperSelect = document.getElementById('helperSelect');
            // Get the selected option's data-price attribute
            const selectedHelper = helperSelect.options[helperSelect.selectedIndex];
            const helperPrice = parseFloat(selectedHelper.getAttribute('data-price') || 0) * duration;
            const helperOverPrice = parseFloat(selectedHelper.getAttribute('data-overtimeprice') || 0);

            // Assuming `window.cars` contains the transports array
            window.cars = <?php echo json_encode($transports); ?>;
            window.cars.forEach(car => {
                const carPrice = car.price;
                const carOverPrice = car.overtime_price;
                const carTotalOverPrice = carOverPrice + helperOverPrice;
                const carTotalPrice = (carPrice * duration) + helperPrice;
                document.getElementById('carPrice' + car.id).innerHTML = '<?php echo e(site_currency_symbol()); ?>' + carTotalPrice.toFixed(2);
                document.getElementById('carShowTime' + car.id).innerHTML = convertMinutesToHoursAndMinutes(totalMins);
                document.getElementById('carShowOvertime' + car.id).innerHTML = '<?php echo e(site_currency_symbol()); ?>' + carTotalOverPrice.toFixed(2);
            });

            document.getElementById('totalTime').value = convertMinutesToHoursAndMinutes(totalMins);
        }


        // Attach event listener to the duration select element to update total on change
        document.getElementById('durationSelect').addEventListener('change', calculateTotal);

        // Attach event listener to helper select dropdown to update total on change
        document.getElementById('helperSelect').addEventListener('change', calculateTotal);

        // Convert minutes to hours and minutes format
        function convertMinutesToHoursAndMinutes(minutes) {
            const hours = Math.floor(minutes / 60);
            const remainingMinutes = minutes % 60;
            let result = '';

            // Add hours only if hours > 0
            if (hours > 0) {
                result += `${hours} hour${hours !== 1 ? 's' : ''}`;
            }

            // Add minutes only if remainingMinutes > 0
            if (remainingMinutes > 0) {
                // Add a space if hours were added
                if (result !== '') {
                    result += ' ';
                }
                result += `${remainingMinutes} minute${remainingMinutes !== 1 ? 's' : ''}`;
            }

            // If both hours and minutes are 0, return "0 minutes"
            return result || '0 minutes';
        }

        calculateTotal(); // Initial calculation to display the total on page load

        const hashtagInput = document.getElementById('hashtagInput');
        const hashtagList = document.getElementById('hashtag-list');

        hashtagInput.addEventListener('keyup', (event) => {
            if (event.key === 'Enter') {
                const hashtag = `#${event.target.value.trim()}`;
                const listItem = document.createElement('li');
                listItem.textContent = hashtag;
                hashtagList.appendChild(listItem);
                event.target.value = '';
            }
        });
    });
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(get_static_option('google_api_key')); ?>&callback=initAutocomplete&libraries=places&v=weekly" defer ></script>
    <script>
        function addElement() {
            let input = document.getElementById('inventoryInput').value;
            let qty = parseFloat(document.getElementById('inventoryQty').value);
            let price = parseFloat(document.getElementById('inventoryPrice').value);
            let totalPrice = price * qty;
        
            let newDiv = document.createElement('div');
            newDiv.className = 'btn-dagency px-3 py-1 mx-1 my-3 d-flex align-items-center justify-content-between';
            
            newDiv.innerHTML = `
                <input type="hidden" name="inventoryInput[]" value="${input}">
                <input type="hidden" name="inventoryQty[]" value="${qty}">
                <input type="hidden" name="inventoryPrice[]" value="${price}">
                <h4 class="text-white m-0">${input} X ${qty} = £${totalPrice.toFixed(2)}</h4>
                <button type="button" onclick="removeElement(this, ${totalPrice})" class="btn btn-link h-100 text-danger m-0 fs-20">
                    <i class="fa fa-trash"></i>
                </button>
            `;
        
            document.getElementById('parentDiv').appendChild(newDiv);
        
            // Update the total inventory price
            updateInventoryTotalPrice(totalPrice);
            
            // Reset input fields
            document.getElementById('inventoryInput').value = "";
            document.getElementById('inventoryQty').value = 0;
            document.getElementById('inventoryPrice').value = 0;
        
            // Validate insurance cover
            checkInsuranceCover();
        }
        
        // Function to remove inventory item
        function removeElement(button, itemPrice) {
            let divToRemove = button.parentNode;
            divToRemove.parentNode.removeChild(divToRemove);
        
            // Deduct the removed item's price from the total
            updateInventoryTotalPrice(-itemPrice);
        
            // Validate insurance cover again
            checkInsuranceCover();
        }
        
        // Function to update total inventory price
        function updateInventoryTotalPrice(amount) {
            let totalInput = document.getElementById('inventoryTotalPrice');
            let currentTotal = parseFloat(totalInput.value) || 0;
            let newTotal = currentTotal + amount;
            totalInput.value = newTotal.toFixed(2);
        }
        
        function checkInsuranceCover() {
            let coverAllowed = parseFloat(document.getElementById('insuranceCoverLimit').value) || 0;
            let totalInventoryPrice = parseFloat(document.getElementById('inventoryTotalPrice').value) || 0;
        
            let messageDiv = document.getElementById('insuranceMessage');
            if (totalInventoryPrice > coverAllowed) {
                messageDiv.innerHTML = `Your insurance cover does not allow coverage more than £${coverAllowed.toFixed(2)}.`;
            } else {
                messageDiv.innerHTML = "";
            }
        }

    
        function selectHelper(carId){
            calculateTotal();
            SelectCar(carId);
        }
        function calculateTotal() {
            const inputs = document.querySelectorAll('.inputTime');
            let total = 0;
            inputs.forEach(input => {
                total += parseFloat(input.value) || 0;
            });
            let totalMins = total*60;
            
            const selectedHelper = document.querySelector('input[name="helpers"]:checked');
            let helperPrice = 0;
            if (selectedHelper) {
                helperPrice = selectedHelper.dataset.price*total;
            }
            window.cars = <?php echo json_encode($transports); ?>;
            window.cars.forEach(car => {
                const carPrice = car.price;
                const carTPrice = carPrice * total + helperPrice;
                document.getElementById('carPrice'+car.id).innerHTML = carTPrice;
            });
        }
        
        function SelectCar(carId){
            var card = document.getElementById('card-'+carId);
            var CarInput = document.getElementById('CarInput');
            var cards = document.getElementsByClassName('newCard');
            CarInput.value = carId;
            for (var i = 0; i < cards.length; i++) {
                cards[i].style.border = "2px solid transparent";
            }
            card.style.border = "2px solid red";
        }
        
        function showLift(key) {
            var selectElement = document.getElementById('floor'+key); // Replace 'yourSelectElementId' with the actual ID of your <select> element
            
            // Get the selected option
            var selectedOption = selectElement.options[selectElement.selectedIndex];
            
            // Get the value of the data-price attribute
            var dataPrice = selectedOption.getAttribute('data-price');
            
            //Get Elevator div
            var elevatorDiv = document.getElementById('elevator'+key);
            
            if(dataPrice != 0.00){
                elevatorDiv.classList.remove("d-none");
            }
            else{
                elevatorDiv.classList.add("d-none");
            }
        }
        
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
    </script>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.frontend-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\XAMPP\htdocs\removal\@core\resources\views/frontend/pages/book/address.blade.php ENDPATH**/ ?>