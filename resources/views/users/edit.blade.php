@extends('theme-layout.layout')
@extends('theme-layout.page-title')
@section('title', 'Users | Edit')
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
            
            <div class="row">
                
                <!-- Basic with Icons -->
                <div class="col-xxl">
                  <div class="card mb-6">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="mb-0">Edit User</h5>
                      <a href="{{route('users.index')}}" class="btn btn-primary">Back</a>
                    </div>
                    <div class="card-body">
                      <form action="{{route('users.update',$user->id)}}" method="POST">
                        @csrf
                        @method('put')
                        <div class="row mb-6">
                          <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Name</label>
                          <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                              <span id="basic-icon-default-fullname2" class="input-group-text"
                                ><i class="bx bx-user"></i
                              ></span>
                              <input
                                type="text"
                                class="form-control"
                                id="basic-icon-default-fullname"
                                name="name"
                                placeholder="John Doe"
                                aria-label="John Doe"
                                aria-describedby="basic-icon-default-fullname2"
                                value="{{$user->name}}"
                                required />
                            </div>
                          </div>
                        </div>
                        
                        <div class="row mb-6">
                          <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Email</label>
                          <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                              <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                              <input
                                type="text"
                                id="basic-icon-default-email"
                                class="form-control"
                                placeholder="john.doe"
                                aria-label="john.doe"
                                name="email"
                                aria-describedby="basic-icon-default-email2"
                                value="{{$user->email}}"
                                required />
                            </div>
                          </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label" for="password">Password</label>
                          <div class="mb-6 col-sm-10 form-password-toggle">
                            <div class="input-group input-group-merge">
                              <input
                                type="password"
                                id="password"
                                class="form-control"
                                name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password"
                                value=""
                                 />
                              <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label" for="password">Confirm Password</label>
                          <div class="mb-6 col-sm-10 form-password-toggle">
                            <div class="input-group input-group-merge">
                              <input
                                type="password"
                                id="confirm_password"
                                class="form-control"
                                name="confirm_password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password"
                                value=""
                                 />
                              <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                          </div>
                        </div>
                        @if (auth()->user()->hasRole('Regional Facilitator'))
                                        <div class="row">
                                            <label
                                                for="exampleFormControlSelect1"
                                                class="col-sm-2 col-form-label"
                                                >User Type</label
                                            >
                                            <div class="col-sm-10 mb-4">
                                                <select class="form-select" name="user_type" id="user_type" aria-label="Default select example" disabled>
                                                    <option>Select User Type</option>
                                                    <option value="user">User</option>
                                                    <option value="intra trainer">Intra Trainer</option>
                                                    <option value="local trainer" selected>Local Trainer</option>
                                                </select>
                                                <input type="hidden" name="user_type" value="local trainer">
                                            </div>
                                        </div>
                                        @else 
                                        <div class="row">
                                          <label
                                              for="exampleFormControlSelect1"
                                              class="col-sm-2 col-form-label"
                                              >User Type</label
                                          >
                                          <div class="col-sm-10 mb-4">
                                              <select class="form-select" name="user_type" id="user_type" aria-label="Default select example" required>
                                                  <option selected>Select User Type</option>
                                                  <option value="user"
                                                   @php
                                                      if($user->user_type == 'user'){
                                                         echo "selected";
                                                      }
                                                  @endphp
                                                  >User</option>
                                                  <option value="intra trainer" 
                                                  @php
                                                      if($user->user_type == 'intra trainer'){
                                                         echo "selected";
                                                      }
                                                  @endphp
                                                  >Intra Trainer</option>
                                                  <option value="local trainer"
                                                  @php
                                                      if($user->user_type == 'local trainer'){
                                                         echo "selected";
                                                      }
                                                  @endphp
                                                  >Local Trainer</option>
                                              </select>
                                          </div>
                                      </div>
                                        @endif
                                        @if (auth()->user()->hasRole('Regional Facilitator'))
                                            <div class="row" id="region_div"  style="display: none;">
                                                <label for="exampleFormControlSelect2" class="col-sm-2 col-form-label">Regions</label>
                                                <div class="col-sm-10 mb-4">
                                                    <select class="form-select" name="region" id="exampleFormControlSelect2" aria-label="Default select example">
                                                        <option>Select Region</option>
                                                        @if ($regions->isNotEmpty())
                                                            @foreach ($regions as $region)
                                                                @if (auth()->user()->region_id == $region->id)
                                                                <option value="{{ $region->id }}" selected>{{ $region->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div> 
                                        @else
                                        <div class="row" id="region_div"
                      @if ($user->user_type == 'intra trainer')
                          
                      @else
                          style="display: none;"
                      @endif
                        >
                          <label for="exampleFormControlSelect2" class="col-sm-2 col-form-label">Regions</label>
                          <div class="col-sm-10 mb-4">
                              <select class="form-select" name="region" id="exampleFormControlSelect2" aria-label="Default select example">
                                  <option selected>Select Region</option>
                                  @if ($regions->isNotEmpty())
                                      @foreach ($regions as $region)
                                         @if ($user->region_id == $region->id)
                                          <option value="{{ $region->id }}" selected>{{ $region->name }}</option>
                                         @endif
                                          <option value="{{ $region->id }}">{{ $region->name }}</option>
                                      @endforeach
                                  @endif
                              </select>
                          </div>
                      </div>  
                                        @endif
                                        @if (auth()->user()->hasRole('Regional Facilitator'))
                                        <div class="row mb-6" style="display: none">
                                            <label
                                                class="col-sm-2 col-form-label"
                                                for="password"
                                                >Roles</label
                                            >
                                            @if ($roles->isNotEmpty())
                                             @foreach($roles as $role)
                                            <div class="mb-6 col-sm-2">
                                                <div class="form-check mt-3">
                                                    @if ($role->name == 'Local Facilitator')
                                                        <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        name="roles[]"
                                                        value="{{ $role->name }}"
                                                        id="defaultCheck-{{$role->id}}"
                                                        checked
                                                        />
                                                        <label
                                                        class="form-check-label"
                                                        for="defaultCheck-{{$role->id}}"
                                                        >
                                                        {{ $role->name }}
                                                    </label>
                                                    @endif
                                                </div>
                                            </div>
                                            @endforeach
                                             @endif
                                        </div>
                                        @else
                                        <div class="row mb-6">
                                          <label class="col-sm-2 col-form-label" for="password">Roles</label>
                                          @if ($roles->isNotEmpty())
                                          @foreach ($roles as $role)
                                               <div class="mb-6 col-sm-2">
                                                  <div class="form-check mt-3">
                                                       <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->name }}" id="defaultCheck-{{$role->id}}" {{ $hasRoles->contains($role->id) ? 'checked' : '' }}/>
                                                       <label class="form-check-label" for="defaultCheck-{{$role->id}}"> {{ $role->name }} </label>
                                                   </div>   
                                               </div>
                                              @endforeach
                                          @endif
                                      </div>
                                        @endif 
                       
                        
                         
                        
                        
                        <div class="row justify-content-end">
                          <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                          </div>
                        </div>
                      </form>
                    </div>
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
      $(document).ready(function () {
          // Listen for changes in the user type dropdown
          $('#user_type').on('change', function () {
              var selectedUserType = $(this).val();
  
              // Check if 'Intra Trainer' is selected
              if (selectedUserType === 'intra trainer') {
                  // Show the regions dropdown and make it required
                  $('#region_div').show();
                  $('#exampleFormControlSelect2').attr('required', true);
              } else {
                  // Hide the regions dropdown and remove required attribute
                  $('#region_div').hide();
                  $('#exampleFormControlSelect2').removeAttr('required');
              }
          });
      });
  </script>
@endsection