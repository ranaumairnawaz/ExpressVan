
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
    .inputCont{
        height: 5rem;
        border-radius: 5rem;
        padding: 0rem;
        background-color: white;
        box-shadow: rgba(0, 0, 0, 0.25) 0px 25px 50px -12px;
    }
    .locs{
        height: 5rem;
        border-radius: 5rem;
        font-size: 1.5rem;
        padding: 0rem 2rem;
        background-color: transparent;
        border: 2px solid gainsboro;
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
    #map{
        min-height: 35rem !important;
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
    <div class="d-flex align-items-center justify-content-center" >
        <ul class="nav nav-arrow mx-auto mb-4" style="flex-wrap:nowrap !important; overflow-x: scroll;"  >
            <li class="nav-item rounded-pill">
                <span class="nav-link active rounded-pill">Service Level</span>
            </li>
            <li class="nav-item rounded-pill">
                <span class="nav-link rounded-pill">
                    <i class="fa-solid fa-truck-front"></i>
                </span>
            </li>
            <li class="nav-item rounded-pill">
                <span class="nav-link rounded-pill">
                    <i class="fa-solid fa-house-chimney"></i>
                </span>
            </li>
            <li class="nav-item rounded-pill">
                <span class="nav-link rounded-pill">
                    <i class="fa-solid fa-address-card"></i>
                </span>
            </li>
            <li class="nav-item rounded-pill">
                <span class="nav-link rounded-pill">
                    <i class="fa-solid fa-credit-card"></i>
                </span>
            </li>
        </ul>
    </div>
    <div class="page-content service-details padding-top-20 padding-bottom-115">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 py-2 text-center">
                    <form action="<?php echo e(route('frontend.book.address')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="service" value="<?php echo e($request->service); ?>">
                        <div class="form-group inputCont my-2">
                            <input type="text" class="form-control locs text-light" style="background-color:var(--dagency-color);" disabled value="<?php echo e(getServiceDetails($request->service)->title); ?> Service">
                        </div>
                        <div class="form-group inputCont my-2">
                            <input type="text" class="form-control locs newInput" onkeyup="calculateDistanceAndDuration()" required name="location[]" value="<?php echo e($request->location[0]); ?>" placeholder="Pickup Address">
                        </div>
                        <div class="w-100" id="parentDiv"></div>
                        <div class="form-group inputCont my-2">
                            <input type="text" class="form-control locs newInput" onkeyup="calculateDistanceAndDuration()" required name="location[]" value="<?php echo e($request->location[1]); ?>" placeholder="Destination Address">
                        </div>
                        <button class="btn btn-outline-dark rounded-pill p-3 mt-3 w-50 mx-auto mx-3" id="add_btn" onclick="addElement()">Add additional Stop</button>
                        <p class="mt-3 text-left">Duration: <span id="duration"></span></p>
                        <p class="text-left">Distance: <span id="distance"></span></p>
                        <div class="d-flex w-100" >
                            <span class="btn btn-success text-left mb-0 d-none" id="zip-warning" ></span>
                            <span class="btn btn-success text-left mb-0 d-none mx-2" id="code-warning" ></span>
                        </div>
                        <br>
                        <button type="submit" class="btn-dagency p-3 mt-3 border-0 mx-3 w-50 mx-auto">Get Quote</button>
                        <a href="<?php echo e(url('/')); ?>" class="btn btn-outline-dark rounded-pill p-3 mt-3 w-50 mx-auto mx-3">
                            <i class="fa fa-arrow-left"></i> Go Back
                        </a>
                    </form>
                </div>
                <div class="col-lg-6">
                    <div class="w-100">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php
$zipcodes = getSpecialZipCodes();
?>

<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(get_static_option('google_api_key')); ?>&callback=initAutocomplete&libraries=places&v=weekly" defer></script>
<script>
    // Pass the zip codes and their types from Laravel to JavaScript
    const zipcodes = <?php echo json_encode($zipcodes, 15, 512) ?>;  // This will contain an array of objects with { zip: 'code', type: 1 or 2 }

    function initAutocomplete() {
        const inputs = document.getElementsByClassName('locs');
        const options = {
            types: ['geocode'],
            componentRestrictions: { country: 'gb' }
        };

        Array.from(inputs).forEach(input => {
            const autocomplete = new google.maps.places.Autocomplete(input, options);
            autocomplete.addListener('place_changed', function() {
                calculateDistanceAndDuration();
            });
        });

        calculateDistanceAndDuration();
    }

    function extractZipCode(address) {
        const zipRegex = /\b([A-Z]{1,2}\d[A-Z\d]? ?\d[A-Z]{2}|GIR ?0AA)\b/i;  // Strict UK Postcode regex
        const match = address.match(zipRegex);
        return match ? match[0].toUpperCase() : null;
    }

    function checkForZipCode(addresses) {
        let type1Found = false;
        let type2Found = false;
    
        addresses.forEach(address => {
            const zipCode = extractZipCode(address);
    
            if (zipCode) {
                const matchedZip = zipcodes.find(item => item.code === zipCode);
    
                if (matchedZip) {
                    if (matchedZip.type === 1) {
                        type1Found = true;
                    } 
                    else if (matchedZip.type === 2) {
                        type2Found = true;
                    }
                    else if (matchedZip.type === 3) {
                        type1Found = true;
                        type2Found = true;
                    }
                }
            }
        });
    
        // Show or hide warnings based on the presence of type 1 or type 2
        const zipWarningElement = document.getElementById('zip-warning');
        const codeWarningElement = document.getElementById('code-warning');
    
        if (type1Found) {
            zipWarningElement.textContent = `Congestion charge`;
            zipWarningElement.classList.remove('d-none');
        } else {
            zipWarningElement.classList.add('d-none');
        }
    
        if (type2Found) {
            codeWarningElement.textContent = `Ultra Low Emission Zone`;
            codeWarningElement.classList.remove('d-none');
        } else {
            codeWarningElement.classList.add('d-none');
        }
    }

    function calculateDistanceAndDuration() {
        const inputs = document.querySelectorAll('.newInput');
        const addresses = Array.from(inputs).map(input => input.value);

        if (addresses.length < 2) {
            console.log('At least two addresses are required.');
            return;
        }

        if (addresses.length > 3) {
            document.getElementById('add_btn').classList.add("d-none");
        } else {
            document.getElementById('add_btn').classList.remove("d-none");
        }

        const service = new google.maps.DistanceMatrixService();
        const directionsService = new google.maps.DirectionsService();
        const directionsRenderer = new google.maps.DirectionsRenderer();

        let totaldistance = 0;
        let totalduration = 0;

        const map = new google.maps.Map(document.getElementById('map'), {
            zoom: 7,
            center: { lat: 41.85, lng: -87.65 }
        });
        directionsRenderer.setMap(map);

        const promises = [];

        for (let i = 0; i < addresses.length - 1; i++) {
            const origin = addresses[i];
            const destination = addresses[i + 1];

            const promise = new Promise((resolve, reject) => {
                service.getDistanceMatrix({
                    origins: [origin],
                    destinations: [destination],
                    travelMode: 'DRIVING',
                    unitSystem: google.maps.UnitSystem.METRIC,
                }, (response, status) => {
                    if (status !== 'OK') {
                        console.log('Error:', status);
                        reject(status);
                    } else {
                        const result = response.rows[0].elements[0];
                        totaldistance += result.distance.value;
                        totalduration += result.duration.value;
                        resolve();
                    }
                });
            });

            promises.push(promise);
        }

        Promise.all(promises).then(() => {
            totalduration = totalduration / 60;
            totaldistance = (totaldistance / 1000) * 0.621371;

            document.getElementById('duration').innerHTML = totalduration.toFixed(2) + ' mins';
            document.getElementById('distance').innerHTML = totaldistance.toFixed(2) + ' miles';

            const waypoints = addresses.slice(1, -1).map(location => ({
                location: location,
                stopover: true
            }));

            directionsService.route({
                origin: addresses[0],
                destination: addresses[addresses.length - 1],
                waypoints: waypoints,
                travelMode: 'DRIVING',
            }, (response, status) => {
                if (status === 'OK') {
                    directionsRenderer.setDirections(response);
                } else {
                    console.log('Directions request failed due to ' + status);
                }
            });

            checkForZipCode(addresses);  // Check for ZIP code matches after addresses are processed
        }).catch(error => {
            console.log('Error calculating distances:', error);
        });
    }

    function addElement() {
        var newDiv = document.createElement('div');
        newDiv.className = 'form-group inputCont d-flex justify-content-between align-items-center my-2';
        newDiv.innerHTML = '<input type="text" class="form-control w-75 locs newInput" onkeyup="calculateDistanceAndDuration()" name="location[]" required placeholder="New Address"><button type="button" onclick="removeElement(this)" class="btn btn-link h-100 text-danger mx-3 fs-20"><i class="fa fa-trash"></i></button>';

        var elements = document.getElementsByClassName('newInput');
        document.getElementById('parentDiv').appendChild(newDiv);
        initAutocomplete();
    }

    function removeElement(el) {
        el.parentNode.remove();
        initAutocomplete();
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\express-van\@core\resources\views/frontend/pages/book/index.blade.php ENDPATH**/ ?>