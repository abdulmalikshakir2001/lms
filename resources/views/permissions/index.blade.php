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
          @include('permissions.create')
          <div class="container-xxl flex-grow-1 container-p-y">
            
            <div class="card">
                <div class="row card-header">
                    <div class="col-md-6">
                        <h5>Permissions</h5>
                    </div>
                    <div class="col-md-2 offset-4">
                        <button
                    type="button"
                    class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#basicModal">
                      Add Permission
                      </button>
                    </div>
                </div>
                
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th class="col-md-2">Sr No:</th>
                        <th class="col-md-8">Permission</th>
                        <th class="col-md-2">Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if ($permissions->isNotEmpty())
                       @php
                            $i = 1;
                       @endphp
                        @foreach ($permissions as $permission)
                        <tr>
                            <td>{{$i }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>
                              <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                  <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                  <a class="dropdown-item" href="javascript:void(0)"
                                  data-bs-toggle="modal"
                                  data-bs-target="#basicModalEdit-{{$permission->id}}"
                                    ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                  >
                                  <form action="{{ route('permissions.destroy', ['id' => $permission->id]) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this permission?');">
                                        <i class="bx bx-trash me-1"></i> Delete
                                    </button>
                                </form>
                                
                                  
                                </div>
                              </div>
                            </td>
                          </tr> 
                          
                          @include('permissions.edit')
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
                <form action="{{ route('roles.store') }}" method="post">
                  @csrf
                <div class="modal-body">

        

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
@endsection