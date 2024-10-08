@extends('theme-layout.layout')
@extends('theme-layout.page-title')

@section('title', 'Schools')

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
            <div class="row">
                <div class="col-md-3 offset-9">
                    @include('theme-layout.msgs')
                </div>
            </div>
            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="card">
                        <div class="row card-header pb-0">
                            <div class="col-md-6">
                                <h5>Schools</h5>
                            </div>
                            
                        </div>

                        <div class="table table-responsive text-nowrap p-5 m-0">
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
                            <table class="table" id="datatable">
                                <thead>
                                    <tr>
                                        <th class="col-md-2 py-4">Sr No:</th>
                                        <th class="col-md-2 py-4">School Name</th>
                                        <th class="col-md-6 py-4">Location</th>
                                        <th class="col-md-6 py-4">Contact</th>
                                        <th class="col-md-6 py-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
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

<div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the selected schools?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button type="button" class="btn btn-danger mx-3" id="confirmDelete">OK</button>
            </div>
        </div>
    </div>
</div>

@include('theme-layout.confirmDeleteModals')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

    $(document).on('click', '.delete-button', function() {
        var schoolId = $(this).data('id');
        var formAction = '{{ route("schools.destroy", ":id") }}'; // Placeholder route
        formAction = formAction.replace(':id', schoolId); // Replace the placeholder with the actual ID
        $('#deleteForm').attr('action', formAction); // Set the form action URL dynamically
    });

    $('#confirmDelete').on('click', function () {
    $('#deleteForm').submit();  // Submit the form when OK is clicked
    });


    $(document).ready(function () {
        // Initialize DataTable
        var table = $("#datatable").DataTable({
            processing: true,
            serverSide: true,
            order: [[1, "desc"]], // Order by School Name
            ajax: {
                url: "{{ url('getSchoolsData') }}", // Updated to not include regionId here
                data: function (d) {
                    d.region_id = $('#regionFilter').val(); // Pass the selected region to the server
                }
            },
            columns: [
                { data: "id", name: "id" },           // Sr No:
                { data: "name", name: "name" },       // School Name
                { data: "location", name: "location" }, // Location
                { data: "contact", name: "contact" }, // Contact
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }  // Actions
            ],
            pagingType: "full_numbers",
            language: {
                lengthMenu: "Show _MENU_ records per page"
            },
            responsive: true,  // Make table responsive
            autoWidth: false   // Disable automatic column width calculation
        });

        // Reload DataTable when the region filter changes
        $('#regionFilter').on('change', function () {
            table.ajax.reload(); // Reload the table with the selected region
        });
    });

    // Handle Select All checkbox
    $('#select-all').on('click', function() {
        let rows = window.table.rows({ 'search': 'applied' }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
        toggleDeleteButton(); // Enable/Disable bulk delete button
    });

    // Handle single row checkbox change
    $('#datatable tbody').on('change', '.user-checkbox', function() {
        if (!this.checked) {
            $('#select-all').prop('checked', false);
        }
        toggleDeleteButton(); // Enable/Disable bulk delete button
    });

    // Function to enable/disable bulk delete button
    function toggleDeleteButton() {
        let anyChecked = $('.user-checkbox:checked').length > 0;
        $('#bulk-delete').prop('disabled', !anyChecked);
    }

    // Handle bulk delete button click
    $('#bulk-delete').on('click', function () {
        let selectedIds = [];
        $('.user-checkbox:checked').each(function () {
            selectedIds.push($(this).val());
        });

        if (selectedIds.length > 0) {
            $('#modalCenter').modal('show');  // Show modal instead of alert

            // Handle the "OK" button click inside the modal
            $('#confirmDelete').off('click').on('click', function () {
                $.ajax({
                    url: '{{ route("schools.bulkDelete") }}',  // Route for bulk delete
                    type: 'POST',
                    data: {
                        ids: selectedIds,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Reload the DataTable after deletion
                        window.table.ajax.reload();  
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
                                    Schools Deleted Successfully
                                </div>
                            </div>
                        `;

                        // Append the toast to the body
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
</script>
@endsection
