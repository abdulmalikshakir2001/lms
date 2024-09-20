@extends('theme-layout.layout')
@extends('theme-layout.page-title')

@section('title', 'Students')

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
                                <h5>Teachers</h5>
                            </div>
                            <div class="col-md-3 offset-3 d-flex">
                                <a href="{{ route('teachers.create') }}" type="button" class="btn btn-primary">
                                    Add Teacher
                                </a>
                                <button id="bulk-delete" class="btn btn-danger mx-2" disabled>
                                    <i class="bx bx-trash me-1"></i>
                                </button>
                            </div>
                        </div>

                        <div class="table table-responsive text-nowrap p-5 m-0">
                            <table class="table" id="datatable">
                                <thead>
                                    <tr>
                                        <th class="col-md-1 py-4">
                                            <input type="checkbox" class="form-check-input" id="select-all">
                                        </th>
                                        <th class="py-4">Sr No:</th>
                                        <th class="py-4">Teacher Name</th>
                                        <th class="py-4">Contact</th>
                                        <th class="py-4">Region</th>
                                        <th class="py-4">Program</th>
                                        <th class="py-4">Session</th>
                                        <th class="py-4">Actions</th>
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
                <p>Are you sure you want to delete the selected Teachers?</p>
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
        var parentId = $(this).data('id');
        var formAction = '{{ route("teachers.destroy", ":id") }}'; // Placeholder route
        formAction = formAction.replace(':id', parentId); // Replace the placeholder with the actual ID
        $('#deleteForm').attr('action', formAction); // Set the form action URL dynamically
    });

    $(document).ready(function () {
    window.table = $("#datatable").DataTable({
        processing: true,
        serverSide: true,
        order: [[1, "desc"]], // Order by Sr No
        ajax: "{{ url('teachers-data') }}", // Update the AJAX URL to your route
        columns: [
            { 
                data: 'id', 
                name: 'checkbox', 
                orderable: false, 
                searchable: false, 
                render: function (data, type, full, meta) {
                    return '<input type="checkbox" class="form-check-input user-checkbox" value="' + data + '">';
                }
            },
            { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false }, // Auto-incrementing Sr No
            { data: "teacher_name", name: "teacher_name" }, // Teacher Name
            { data: "contact", name: "contact" }, // Contact
            { data: "region_name", name: "region_name" }, // Region
            { data: "program_name", name: "program_name" }, // Program
            { data: "session_name", name: "session_name" }, // Session
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
                    url: '{{ route("teachers.bulkDelete") }}',  // Route for bulk delete
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
                                    Teachers Deleted Successfully
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
