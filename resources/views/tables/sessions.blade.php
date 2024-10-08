@extends('theme-layout.layout')
@extends('theme-layout.page-title')
@section('title', 'LMS | Sessions')
@section('content')


<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->
        @include('theme-layout.sideBar')
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->
            @include('theme-layout.navBar')
            @include('theme-layout.msgs')
            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="card">
                        <div class="row card-header">
                            <div class="col-md-6">
                                <h5>Sessions</h5>
                            </div>
                            
                        </div>

                        
                        <div class="table-responsive text-nowrap p-5 m-0">
                            
                            @if (auth()->user()->hasRole('Super Admin'))
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <select id="regionFilter" class="form-select">
                                        <option value="">All Regions </option>
                                        @foreach($regions as $region)
                                            <option value="{{ $region->id }}" 
                                                {{ isset($_GET['region_Id']) && $region->id == $_GET['region_Id'] ? 'selected' : '' }}>
                                                {{ $region->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                        
                                
                            <div class="date-filter row mb-3">
                                <div class="col-md-3">
                                    <label for="start_date">From:</label>
                                    <input type="date" id="start_date" class="form-control" />
                                </div>
                                
                                <div class="col-md-3">
                                    <label for="end_date">To:</label>
                                    <input type="date" id="end_date" class="form-control" />
                                </div>
                                
                                <div class="col-md-3 d-flex align-items-end">
                                    <button id="filter" class="btn btn-primary mt-2">Filter</button>
                                    <button id="clear-filter" class="btn btn-secondary mt-2 mx-2">Clear</button>
                                </div>
                            </div>
                            <table class="table table-hover datatable" id="datatable">
                                <thead>
                                    <tr>
                                        <th class="py-4">Name</th>
                                        <th class="py-4">Trainer</th>
                                        <th class="py-4">Program</th>
                                        <th class="py-4">Session For</th>
                                        <th class="py-4">Region</th>
                                        <th class="py-4">Status</th>
                                        <th class="py-4">Start Date</th>
                                        <th class="py-4">End Date</th>
                                        <th class="py-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data will be populated via DataTables AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- / Content -->
                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>

@include('theme-layout.confirmDeleteModals')



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script>
 $(document).on('click', '.delete-button', function() {
        var schoolId = $(this).data('id');
        var formAction = '{{ route("sessions.destroy", ":id") }}'; // Placeholder route
        formAction = formAction.replace(':id', schoolId); // Replace the placeholder with the actual ID
        $('#deleteForm').attr('action', formAction); // Set the form action URL dynamically
});



   
$(document).ready(function () {

    let table;
    $(document).ready(function () {
    let regionId = null;
    let qry = ""; // Default empty string for qry

    // If user is not a Super Admin
    if ({{!auth()->user()->hasRole("Super Admin") ? 1 : 0}}) {
        regionId = "{{ $regionId }}"; // Get the regionId from Blade
        qry = regionId ? "/" + regionId : ""; // Set qry based on regionId

        console.log("Region ID: ", regionId);  // For debugging

        // Initialize DataTable
         table = $("#datatable").DataTable({
            processing: true,
            serverSide: true,
            ajax: function (data, callback, settings) {
                const startDate = $('#start_date').val();
                const endDate = $('#end_date').val();

                $.ajax({
                    url: "{{ url('getSessionsData') }}" + qry, 
                    type: "GET",
                    data: {
                        ...data,
                        start_date: startDate,
                        end_date: endDate,
                    },
                    success: function (response) {
                        callback(response);
                    }
                });
            },
            columns: [
                { data: 'name', name: 'name' },
                { data: 'trainer', name: 'trainer' },
                { data: 'program', name: 'program' },
                { data: 'session_for', name: 'session_for' },
                { data: 'region', name: 'region' },
                { data: 'status', name: 'status' },
                { data: 'start_date', name: 'start_date' },
                { data: 'end_date', name: 'end_date' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            order: [[0, "desc"]],
            pagingType: "full_numbers",
            language: {
                lengthMenu: "Show _MENU_ records per page"
            },
            responsive: true,
            autoWidth: false
        });

    } else {
        // If user is Super Admin

        document.addEventListener('DOMContentLoaded', function () {
            const regionFilter = document.getElementById('regionFilter');
            
            // Call the event when the page is loaded
            regionFilter.dispatchEvent(new Event('change'));

            // Add the change event listener
            regionFilter.addEventListener('change', function () {
                console.log("Region Filter Changed");
                table.draw();
            });
        });

        regionId = "{{ $regionId }}"; // Get the regionId from Blade or null
        qry = regionId ? "/" + regionId : ""; // Set qry based on regionId

        console.log("Region ID (Super Admin): ", regionId); // Debugging

        // Initialize DataTable
         table = $("#datatable").DataTable({
            processing: true,
            serverSide: true,
            ajax: function (data, callback, settings) {
                const startDate = $('#start_date').val();
                const endDate = $('#end_date').val();
                const selectedRegion = document.getElementById('regionFilter').value; // Get selected region

                console.log("Selected Region ID: ", selectedRegion); // Log selected region

                $.ajax({
                    url: "{{ url('getSessionsData') }}" + qry,
                    type: "GET",
                    data: {
                        ...data,
                        start_date: startDate,
                        end_date: endDate,
                        region_id: selectedRegion // Include the selected region
                    },
                    success: function (response) {
                        callback(response);
                    }
                });
            },
            columns: [
                { data: 'name', name: 'name' },
                { data: 'trainer', name: 'trainer' },
                { data: 'program', name: 'program' },
                { data: 'session_for', name: 'session_for' },
                { data: 'region', name: 'region' },
                { data: 'status', name: 'status' },
                { data: 'start_date', name: 'start_date' },
                { data: 'end_date', name: 'end_date' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            order: [[0, "desc"]],
            pagingType: "full_numbers",
            language: {
                lengthMenu: "Show _MENU_ records per page"
            },
            responsive: true,
            autoWidth: false
        });
    }
});



$('#filter').click(function () {
    table.draw(); // Redraw the table with the selected filters
});

$('#clear-filter').on('click', function () {
    $('#start_date').val('');
    $('#end_date').val('');
    $('#region-filter').val(''); // Clear the region filter
    table.draw();
});






    // Handle Select All checkbox
    $('#select-all').on('click', function() {
        let rows = table.rows({ 'search': 'applied' }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
        toggleDeleteButton(); // Enable/Disable bulk delete button
    });

    // Handle single row checkbox change
    $('#datatable tbody').on('change', '.session-checkbox', function() {
        if (!this.checked) {
            $('#select-all').prop('checked', false);
        }
        toggleDeleteButton(); // Enable/Disable bulk delete button
    });

    // Function to enable/disable bulk delete button
    function toggleDeleteButton() {
        let anyChecked = $('.session-checkbox:checked').length > 0;
        $('#bulk-delete').prop('disabled', !anyChecked);
    }

    // Handle bulk delete button click
    $('#bulk-delete').on('click', function () {
        let selectedIds = [];
        $('.session-checkbox:checked').each(function () {
            selectedIds.push($(this).val());
        });

        if (selectedIds.length > 0) {
            $('#modalCenter').modal('show');  // Show modal instead of alert

            // Handle the "OK" button click inside the modal
            $('#confirmDelete').off('click').on('click', function () {
                $.ajax({
                    url: '{{ route("sessions.bulkDelete") }}',  // Route for bulk delete
                    type: 'POST',
                    data: {
                        ids: selectedIds,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Reload the DataTable after deletion
                        table.ajax.reload();
                        $('#bulk-delete').prop('disabled', true);  // Disable the bulk delete button
                        $('#select-all').prop('checked', false);   // Uncheck the "select all" checkbox
                        $('#modalCenter').modal('hide');  // Hide the modal after success

                        // Create and append the toast dynamically
                        let toastHTML = `
                            <div class="bs-toast toast fade show bg-success custom-toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000" style="z-index: 10000; position: fixed; top: 20px; right: 20px;">
                                <div class="toast-header">
                                    <i class="bx bx-bell me-2"></i>
                                    <div class="me-auto fw-medium">Success</div>
                                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                                <div class="toast-body">
                                    Sessions Deleted Successfully
                                </div>
                            </div>
                        `;

                        // Append the toast to the body (or another appropriate container)
                        $('body').append(toastHTML);

                        // Show the toast using Bootstrap's toast method
                        $('.toast').toast('show');
                    },
                    error: function(xhr, status, error) {
                        alert('Something went wrong.');
                    }
                });
            });
        }
    });
});
</script>
@endsection
