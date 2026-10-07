@extends('backend.admin-master')
@section('site-title')
    {{__('Removal Calendar')}}
@endsection

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
    <style>
        .cancelled-job {
            text-decoration: line-through !important;
            opacity: 0.7;
        }
        .cancelled-job .fc-event-title, .cancelled-job .fc-list-event-title {
            text-decoration: line-through !important;
        }
    </style>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-error-msg/>
                <x-flash-msg/>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between" >
                            <h4 class="header-title">{{__('Removal Calendar')}}</h4>
                        </div>
                        <div id="calendar"></div> <!-- Calendar will render here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderDetailsModalLabel">Order Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="order-details-content">
                    <!-- Details will be dynamically loaded here -->
                    <div class="text-center">Loading...</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline-primary" id="copyFullData">Copy Full</button>
                    <button type="button" class="btn btn-outline-success" id="copySelectedData">Copy Partial</button>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="dateFilterModal" tabindex="-1" aria-labelledby="dateFilterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dateFilterModalLabel">Select Date Range</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="startDateInput" class="form-label">Start Date:</label>
                    <input type="date" id="startDateInput" class="form-control mb-3">
                    
                    <label for="endDateInput" class="form-label">End Date:</label>
                    <input type="date" id="endDateInput" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="applyDateFilter">Apply Filter</button>
                </div>
            </div>
        </div>
    </div>


    
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'customDatePicker dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                events: '{{ route("admin.removal.calendar.data") }}',
                
                // Define custom button for filtering
                customButtons: {
                    customDatePicker: {
                        text: 'Select Date Range',
                        click: function () {
                            var dateFilterModal = new bootstrap.Modal(document.getElementById('dateFilterModal'));
                            dateFilterModal.show();
                        }
                    }
                },
                dateClick: function (info) {
                    // Redirect to the removal orders page with the selected date/time
                    window.location.href = "{{ route('admin.removal') }}?date=" + encodeURIComponent(info.dateStr);
                },
                eventClick: function (info) {
                    info.jsEvent.preventDefault();
        
                    var orderId = info.event.id;
        
                    var modal = new bootstrap.Modal(document.getElementById('orderDetailsModal'));
                    modal.show();
        
                    fetch('{{ route("admin.removal.calendar.details", ":id") }}'.replace(':id', orderId))
                    .then(response => response.json())
                    .then(data => {
                        const order = data.order;
                        const inventory = data.inventory;
                        const locationsHtml = data.locations.map((location, index) => `
                            <p><strong>Location ${index + 1}:</strong> ${location.house}, ${location.address}, ${location.zip}</p>
                        `).join('');
                
                        const orderDetailsContent = `
                            <small><strong>Date :</strong> ${data.date}</small>
                            <p><strong>Client:</strong> ${order.name}</p>
                            <p><strong>Total Time:</strong> ${order.time} hours</p>
                            <p><strong>Van Size:</strong> ${data.van_size}</p>
                            <p><strong>Workers :</strong> ${data.helpers}</p>
                            ${locationsHtml}
                            <a href="${data.details_url}" class="btn btn-primary">See More Details</a>
                        `;
                        
                        document.getElementById('order-details-content').innerHTML = orderDetailsContent;
                
                        // Copy Full Data Button
                        document.getElementById('copyFullData').addEventListener('click', () => {
                            
                            let depositAmount;

                            // Determine deposit amount based on payment status
                            if (order.payment_status === 2) {
                                depositAmount = (order.total * 0.7).toFixed(2); // 70% of the total
                            } else if (order.payment_status === 1) {
                                depositAmount = order.total.toFixed(2); // Full amount
                            } else {
                                depositAmount = 'N/A'; // If not partially or fully paid
                            }
                            
                            let fullData = `Booking Id: #${order.trx}\nClient Name: ${order.name}\nClient Email: ${order.email}\nClient Phone: ${order.phone}\n\nDate & Time: ${data.date}\nBooked Time: ${order.time}hours \nVan Size: ${data.van_size}\nWorkers: ${data.helpers}\nDistance: ${order.distance} miles\n\nLocations:\n`; // Full JSON data
                            data.locations.forEach((location, index) => {
                                fullData += `${index + 1}. ${location.house}, ${location.address}, ${location.zip}\n`;
                            });
                            fullData += `\n\nInventory Details: \n`;
                            data.inventory.forEach((inv, index) => {
                                fullData += `  ${index + 1}. ${inv.item}, ${inv.qty}\n`;
                            });
                            fullData += `\n\nMessage for driver: ${order.note} \nPassenger: ${order.passengers}\n\nTotal Amount: ${order.total}\nPaid Amount: ${depositAmount}`;
                            
                            navigator.clipboard.writeText(fullData)
                                .then(() => console.log('Full Data Copied!'))
                                .catch(() => alert('Failed to copy.'));
                        });
                
                        // Copy Selected Data Button
                        document.getElementById('copySelectedData').addEventListener('click', () => {
                            
                            let depositAmount;

                            // Determine deposit amount based on payment status
                            if (order.payment_status === 2) {
                                depositAmount = (order.total * 0.7).toFixed(2); // 70% of the total
                            } else if (order.payment_status === 1) {
                                depositAmount = order.total.toFixed(2); // Full amount
                            } else {
                                depositAmount = 'N/A'; // If not partially or fully paid
                            }
                            
                            let selectedData = `Date & Time: ${data.date}\nBooked Time: ${order.time}hours \nVan Size: ${data.van_size}\nWorkers: ${data.helpers}\nDistance: ${order.distance} miles\n\nLocations:\n`;
                            
                            data.locations.forEach((location, index) => {
                                selectedData += `${index + 1}. ${location.house}, ${location.address}, ${location.zip}\n`;
                            });
                            selectedData += `\n\nInventory Details: \n`;
                            data.inventory.forEach((inv, index) => {
                                selectedData += `  ${index + 1}. ${inv.item}, ${inv.qty}\n`;
                            });
                            selectedData += `\n\nMessage for driver: ${order.note} \nPassenger: ${order.passengers}\n\nTotal Amount: ${order.total}\nPaid Amount: ${depositAmount}`;
                            navigator.clipboard.writeText(selectedData)
                                .then(() => console.log('Selected Data Copied!'))
                                .catch(() => alert('Failed to copy.'));
                        });
                    })
                    .catch(error => {
                        document.getElementById('order-details-content').innerHTML = `
                            <div class="alert alert-danger">Failed to load details. Please try again later.</div>
                        `;
                    });
                }
            });
        
            calendar.render();
        
            document.getElementById('applyDateFilter').addEventListener('click', function () {
                var startDate = document.getElementById('startDateInput').value;
                var endDate = document.getElementById('endDateInput').value;
        
                if (!startDate || !endDate) {
                    alert('Please select both start and end dates.');
                    return;
                }
        
                calendar.removeAllEvents();
                calendar.addEventSource(`{{ route("admin.removal.calendar.data") }}?start=${startDate}&end=${endDate}`);
                var modal = bootstrap.Modal.getInstance(document.getElementById('dateFilterModal'));
                modal.hide();
            });
        });
    </script>
@endsection