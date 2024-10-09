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
                        
                        
                        

                        <div class="table table-responsive text-nowrap p-5 m-0">
                            
                            <table class="table" id="datatable">
                                <thead>
                                    <tr>
                                        <th class="py-4">Sr No:</th>
                                        <th class="py-4">Student Name</th>
                                        <th class="py-4">Father Name</th>
                                        <th class="py-4">Region</th>
                                        <th class="py-4">Program</th>
                                        <th class="py-4">Session</th>
                                        {{-- <th class="py-4">Actions</th> --}}
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



@include('theme-layout.confirmDeleteModals')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

    // let sessionId = {{ $sessionId }}
 $(document).on('click', '.delete-button', function() {
        var schoolId = $(this).data('id');
        var formAction = '{{ route("students.destroy", ":id") }}'; // Placeholder route
        formAction = formAction.replace(':id', schoolId); // Replace the placeholder with the actual ID
        $('#deleteForm').attr('action', formAction); // Set the form action URL dynamically
    });
   

    $(document).ready(function () {
       

        $(document).ready(function () {
    var sessionId = "{{ $sessionId }}"; // Assuming $sessionId is available
    var table = $("#datatable").DataTable({
        processing: true,
        serverSide: true,
        order: [[1, "desc"]],
        ajax: {
            url: "{{ url('sessionForStudentsData') }}/" + sessionId, // Correctly concatenate session ID
            data: function (d) {
                d.region_id = $('#regionFilter').val(); // Pass selected region
            }
        },
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
            { data: "name", name: "name" }, // Student Name
            { data: "father_name", name: "father_name" }, // Father Name
            { data: "region_name", name: "region_name" }, // Region
            { data: "program_name", name: "program_name" }, // Program
            { data: "session_name", name: "session_name" }  // Session
        ],
        pagingType: "full_numbers",
        language: {
            lengthMenu: "Show _MENU_ records per page"
        },
        responsive: true,
        autoWidth: false
    });

    // Reload DataTable when region filter changes
    $('#regionFilter').on('change', function () {
        table.ajax.reload(); // Reload the table with the selected region
    });
});


    // Reload DataTable when the region filter changes
    $('#regionFilter').on('change', function () {
        table.ajax.reload();
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
                    url: '{{ route("students.bulkDelete") }}',  // Route for bulk delete
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
                                    Students Deleted Successfully
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
