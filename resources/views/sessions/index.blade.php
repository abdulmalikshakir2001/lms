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
                            <div class="col-md-3 offset-3 d-flex">
                                <a href="{{route('sessions.create')}}" class="btn btn-primary">Add Session</a>
                                <button id="bulk-delete" class="btn btn-danger mx-2" disabled>
                                    <i class="bx bx-trash me-1"></i>
                                </button>
                            </div>
                        </div>

                        
                        <div class="table-responsive text-nowrap p-5 m-0">
                            <div class="date-filter row mb-5">
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
                                        <th class="py-4">
                                            <input type="checkbox" class="form-check-input" id="select-all">
                                        </th>
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

<div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the selected sessions?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger mx-3" id="confirmDelete">OK</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script>
    $(document).on('click', '.delete-button', function() {
    var sessionId = $(this).data('id');
    var formAction = '{{ route("sessions.destroy", ":id") }}'; // Placeholder route
    formAction = formAction.replace(':id', sessionId); // Replace the placeholder with the actual ID
    $('#deleteForm').attr('action', formAction); // Set the form action URL dynamically
});
$(document).ready(function () {

    
    let table = $("#datatable").DataTable({
    processing: true,
    serverSide: true,
    ajax: function (data, callback, settings) {
            // Get the date filter values
            const startDate = $('#start_date').val();
            const endDate = $('#end_date').val();

            // Add the date filter values to the AJAX request
            $.ajax({
                url: "{{ url('sessions-data') }}",
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
        }, // Server-side endpoint to fetch data
    columns: [
        {
            data: 'id',
            name: 'id',
            orderable: false,
            searchable: false,
            render: function (data, type, full, meta) {
                return '<input type="checkbox" class="form-check-input session-checkbox" value="' + data + '">';
            }
        }, // Checkbox column
        { data: 'name', name: 'name' },  // Session Name
        { data: 'trainer', name: 'trainer' },  // Trainer
        { data: 'program', name: 'program' },  // Program
        { data: 'session_for', name: 'session_for' },  // Session For
        { data: 'region', name: 'region' },  // Region
        { data: 'status', name: 'status' },  // status
        { data: 'start_date', name: 'start_date' },  // Start Date
        { data: 'end_date', name: 'end_date' },  // End Date
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
        }  // Actions
    ],
    order: [[1, "desc"]],  // Order by session name by default
    pagingType: "full_numbers",
    language: {
        lengthMenu: "Show _MENU_ records per page"
    },
    responsive: true,
    autoWidth: false
});

    $('#filter').click(function () {
        table.draw(); // Redraw the table with new filters
    });
    $('#clear-filter').on('click', function() {
        $('#start_date').val('');
        $('#end_date').val('');
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
