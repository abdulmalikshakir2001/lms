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

        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->
          @include('roles.create')
          <div class="container-xxl flex-grow-1 container-p-y">
            
            <div class="card">
                <div class="row card-header">
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
                
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th class="col-md-2">Sr No:</th>
                        <th class="col-md-2">Role</th>
                        <th class="col-md-6">Permissions</th>
                        <th class="col-md-2">Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if ($roles->isNotEmpty())
                       @php
                            $i = 1;
                       @endphp
                        @foreach ($roles as $role)
                        <tr>
                            <td>{{$i }}</td>
                            <td>{{ $role->name }}</td>
                            <td class="px-6 py-3 text-left">{{ $role->permissions->pluck('name')->implode(', ') }}</td>
                            <td>
                              <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                  <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                  <a class="dropdown-item edit-role" href="#" 
                                    data-id="{{ $role->id }}" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editModal">
                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                  </a>

                                  {{-- <form action="{{ route('roles.destroy', ['id' => $role->id]) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this permission?');">
                                        <i class="bx bx-trash me-1"></i> Delete
                                    </button>
                                  </form> --}}
                                
                                  
                                </div>
                              </div>
                            </td>
                          </tr> 
                          
                          @php
                           $i++;

                          @endphp
                        @endforeach

                        
                        
                        @endif


                       
                     
                      
                      
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
                <form id="editRoleForm" action="{{ route('roles.update', ['id' => $role->id]) }}" method="post">
                  @csrf
                  @method('put')
                <div class="modal-body">
                
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

  </script>
@endsection