@extends('theme-layout.layout')
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
          @include('roles.create')
          <div class="container-xxl flex-grow-1 container-p-y">
            
            <div class="card">
                <div class="row card-header pb-0">
                    <div class="col-md-6">
                        <h5>Roles</h5>
                    </div>
                    <div class="col-md-2 offset-4">
                        <button
                    type="button"
                    class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#createModal">
                      Add Role
                      </button>
                    </div>
                </div>
                
                <div class="table-responsive text-nowrap p-5 m-0">
                  <table class="table" id="datatable">
                    <thead>
                        <tr>
                            <th class="col-md-2 py-4">Sr No:</th>
                            <th class="col-md-2 py-4">Role</th>
                            <th class="col-md-6 py-4">Permissions</th>
                            <th class="col-md-2 py-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                    </tbody>
                </table>
                
                </div>
              </div>
          </div>
          <!-- / Content -->


          <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel3">Edit Roles</h5>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
                </div>
                <form id="editRoleForm" action="" method="post">
                  @csrf
                  @method('put')
                  <div class="modal-body">
                      <!-- Modal content will be loaded via AJAX -->
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                          Close
                      </button>
                      <button type="submit" class="btn btn-primary mx-3">Save Changes</button>
                  </div>
              </form>              
                </div>
              </div>
            </div>
        

          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>
    

  </div>

  @include('theme-layout.confirmDeleteModals')
 


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
$(document).on('click', '.edit-role', function (e) {
    e.preventDefault();

    var roleId = $(this).data('id');

    $.ajax({
        url: '/roles/' + roleId + '/edit',
        type: 'GET',
        success: function (response) {
            // Populate the modal with the response data
            $('#editRoleForm').attr('action', '/roles/' + roleId);
            $('#editRoleForm .modal-body').html(response);

            // Show the modal
            $('#editModal').modal('show');
        },
        error: function (xhr) {
            console.error(xhr.responseText);
        }
    });
});



$(document).ready(function () {
    $("#datatable").DataTable({
        processing: true,
        serverSide: true,
        order: [[0, "desc"]],
        ajax: "{{ url('roles-data') }}",
        columns: [
            { data: "id", name: "id" },           // Sr No:
            { data: "name", name: "name" },       // Role
            { data: "permissions", name: "permissions", orderable: false, searchable: false },  // Permissions
            { data: "action", name: "action", orderable: false, searchable: false }  // Actions
        ],
        pagingType: "full_numbers",
        language: {
            lengthMenu: "Show _MENU_ records per page"
        },
        responsive: true,  // Make table responsive
        autoWidth: false   // Disable automatic column width calculation
    });
});

$(document).on('click', '.delete-role', function() {
    var roleId = $(this).data('id');
    var formAction = '{{ route("roles.destroy", ":id") }}'; // Placeholder route
    formAction = formAction.replace(':id', roleId); // Replace with actual role ID
    $('#deleteForm').attr('action', formAction); // Set the form action dynamically
});

</script>
@endsection