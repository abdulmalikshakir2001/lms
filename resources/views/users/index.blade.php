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
          <div class="container-xxl flex-grow-1 container-p-y">
            
            <div class="card">
                <div class="row card-header">
                    <div class="col-md-6">
                        <h5>Users</h5>
                    </div>
                    <div class="col-md-2 offset-4" >
                        <a href="{{route('users.create')}}" class="btn btn-primary">Add User</a>
                    </div>
                    
                </div>
                
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th class="col-md-1">Sr No:</th>
                        <th class="col-md-2">User</th>
                        <th class="col-md-2">Email</th>
                        <th class="col-md-3">Role</th>
                        <th class="col-md-2">Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if ($users->isNotEmpty())
                        @php
                            $i = 1;
                        @endphp
                          @foreach ($users as $user)
                            <tr>
                                <td>{{$i}}</td>                      
                                <td>{{$user->name}}</td>                      
                                <td>{{$user->email}}</td>                      
                                <td>{{ $user->roles->pluck('name')->implode(', ') }}</td>
                                <td>
                                    <form action="{{route('users.destroy',$user->id)}}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are You sure you want to delete this user?')">
                                            Delete
                                        </button>
                                    </form>
                                    <a href="{{route('users.edit',$user->id)}}" class="btn btn-primary btn-sm">Edit</a>
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