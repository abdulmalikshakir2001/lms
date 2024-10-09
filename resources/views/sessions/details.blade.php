@extends('theme-layout.layout')
@extends('theme-layout.page-title')
@section('title', 'LMS | Dashboard')
@section('content')
{{-- @dd($program) --}}
    <!-- Layout wrapper -->
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
              <div class="row">
                @if ($teachers > 0)
                <div class="col-3 mb-6">
                    <a href="{{route('sessionFor.teacherList',$session->id)}}" class="">
                    <div class="card h-100">
                      <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                          <div class="avatar flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="user"><path fill="#6563FF" d="M15.71,12.71a6,6,0,1,0-7.42,0,10,10,0,0,0-6.22,8.18,1,1,0,0,0,2,.22,8,8,0,0,1,15.9,0,1,1,0,0,0,1,.89h.11a1,1,0,0,0,.88-1.1A10,10,0,0,0,15.71,12.71ZM12,12a4,4,0,1,1,4-4A4,4,0,0,1,12,12Z"></path></svg>
                          </div>
                        </div>
                        <p class="mb-1">Teachers</p>
                        <h4 class="card-title mb-3">{{$teachers}}</h4>
                      </div>
                    </div>
                  </a>
                  </div>
                @endif
                @if($students > 0)
                <div class="col-3 mb-6">
                    <a href="{{route('sessionFor.studentList',$session->id)}}" class="">
                    <div class="card h-100">
                      <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                          <div class="avatar flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="user"><path fill="#6563FF" d="M15.71,12.71a6,6,0,1,0-7.42,0,10,10,0,0,0-6.22,8.18,1,1,0,0,0,2,.22,8,8,0,0,1,15.9,0,1,1,0,0,0,1,.89h.11a1,1,0,0,0,.88-1.1A10,10,0,0,0,15.71,12.71ZM12,12a4,4,0,1,1,4-4A4,4,0,0,1,12,12Z"></path></svg>
                          </div>
                        </div>
                        <p class="mb-1">Students</p>
                        <h4 class="card-title mb-3">{{$students}}</h4>
                      </div>
                    </div>
                  </a>
                  </div>
                @endif
                @if($parents > 0)
                <div class="col-3 mb-6">
                  <a href="{{route('sessionFor.parentList',$session->id)}}" class="">
                  <div class="card h-100">
                    <div class="card-body">
                      <div class="card-title d-flex align-items-start justify-content-between mb-4">
                        <div class="avatar flex-shrink-0">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="user"><path fill="#6563FF" d="M15.71,12.71a6,6,0,1,0-7.42,0,10,10,0,0,0-6.22,8.18,1,1,0,0,0,2,.22,8,8,0,0,1,15.9,0,1,1,0,0,0,1,.89h.11a1,1,0,0,0,.88-1.1A10,10,0,0,0,15.71,12.71ZM12,12a4,4,0,1,1,4-4A4,4,0,0,1,12,12Z"></path></svg>
                        </div>
                      </div>
                      <p class="mb-1">Parents</p>
                      <h4 class="card-title mb-3">{{$parents}}</h4>
                    </div>
                  </div>
                  </a>
                </div>
                @endif
                @if($facilitators > 0)
                <div class="col-3 mb-6">
                  <a href="{{route('sessionFor.facilitatorList',$session->id)}}" class="">
                  <div class="card h-100">
                    <div class="card-body">
                      <div class="card-title d-flex align-items-start justify-content-between mb-4">
                        <div class="avatar flex-shrink-0">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="user"><path fill="#6563FF" d="M15.71,12.71a6,6,0,1,0-7.42,0,10,10,0,0,0-6.22,8.18,1,1,0,0,0,2,.22,8,8,0,0,1,15.9,0,1,1,0,0,0,1,.89h.11a1,1,0,0,0,.88-1.1A10,10,0,0,0,15.71,12.71ZM12,12a4,4,0,1,1,4-4A4,4,0,0,1,12,12Z"></path></svg>
                        </div>
                      </div>
                      <p class="mb-1">Facilitators</p>
                      <h4 class="card-title mb-3">{{$facilitators}}</h4>
                    </div>
                  </div>
                  </a>
                </div>
                @endif

              </div>
              <div class="row">
                <!-- Order Statistics -->
                <div class="col-md-6 col-lg-6 col-xl-6 order-0 mb-6">
                  <div class="card h-100">
                    <div class="card-header d-flex justify-content-between">
                      <div class="card-title mb-0">
                        <h5 class="mb-1 me-2">{{ $session->name }}</h5>
                      </div>
                      
                    </div>
                    <div class="card-body">
                      
                      <ul class="p-0 m-0">
                        <li class="d-flex align-items-center mb-5">
                          <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-primary"
                              ><i class="bx bx-user"></i
                            ></span>
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0">Trainer</h6>
                            </div>
                            <div class="user-progress">
                              <h6 class="mb-0">{{ $trainer->name }}</h6>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex align-items-center mb-5">
                          <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-success"><i class="bx bx-tv"></i></span>
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0">Program</h6>
                            </div>
                            <div class="user-progress">
                              <h6 class="mb-0">{{ $program->name }}</h6>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex align-items-center mb-5">
                          <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-info"><i class="bx bx-objects-horizontal-center"></i></span>
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0">Region</h6>
                            </div>
                            <div class="user-progress">
                              <h6 class="mb-0">{{ $region->name }}</h6>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex align-items-center">
                          <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-secondary"
                              ><i class="bx bx-user"></i
                            ></span>
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0">Session For</h6>
                            </div>
                            <div class="user-progress">
                              <h6 class="mb-0">{{ $session_for->name }}</h6>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex align-items-end justify-content-between mt-10">
                          <h6 class="card-title">Start: <span class="text-muted">{{ $session->start_date->format('d M Y') }}</span></h6>
                          <h6 class="card-title">End: <span class="text-muted">{{ $session->end_date->format('d M Y') }}</span></h6>
                        </li>
                        

                      </ul>
                      
                    </div>
                  </div>
                </div>
                <!--/ Order Statistics -->

               

                <!-- Transactions -->
                <div class="col-md-6 col-lg-6 order-2 mb-6">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Session Deliverables</h5>
                      
                    </div>
                    <div class="card-body pt-4">
                      <ul class="p-0 m-0">
                        @foreach ($deliverables as $deliverable)
                          @php
                              $fileName = basename($deliverable->path);
                          @endphp
                          <li class="d-flex align-items-center mb-6">
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                              <div class="me-2">
                                <a href="{{route('sessions.downloadSingleDeliverable',['file' => $deliverable->id])}}" title="Click To download"><h6 class="fw-normal mb-0">{{$fileName}}</h6></a>
                              </div>
                            </div>
                          </li>
                        @endforeach  
                      </ul>
                      <a href="{{route('sessions.downloadDeliverables',$session->id)}}" class="btn btn-primary btn-block" >Download All</a>
                    </div>
                  </div>
                </div>
                <!--/ Transactions -->
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
    <!-- / Layout wrapper -->

    


    
@endsection