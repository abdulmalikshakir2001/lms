@extends('theme-layout.layout') @extends('theme-layout.page-title')
@section('title', 'LMS | Dashboard') @section('content')
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
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-3 mb-6">
                            <div class="card h-100">
                            <a href="{{ route('tables.students',['region_Id' => $regionId]) }}" class="" style="color: black">
                              <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between mb-2">
                                  <div class="avatar flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="book-reader"><path fill="#6563FF" d="M20.18,10.19A11.9,11.9,0,0,0,18,10c-.42,0-.83,0-1.24.08a5.91,5.91,0,0,0-1.91-1.65,3.81,3.81,0,0,0,1-2.57,3.86,3.86,0,0,0-7.72,0,3.81,3.81,0,0,0,1,2.57,6.11,6.11,0,0,0-1.91,1.64C6.83,10,6.42,10,6,10a11.9,11.9,0,0,0-2.18.21,1,1,0,0,0-.82,1v8.25a1,1,0,0,0,.36.77,1,1,0,0,0,.82.22A9.75,9.75,0,0,1,6,20.23a9.89,9.89,0,0,1,5.45,1.63h0l0,0,.13.05h0A1.09,1.09,0,0,0,12,22a.87.87,0,0,0,.28-.05l.07,0,.13-.05,0,0h0A9.89,9.89,0,0,1,18,20.23a9.75,9.75,0,0,1,1.82.18,1,1,0,0,0,.82-.22,1,1,0,0,0,.36-.77V11.17A1,1,0,0,0,20.18,10.19ZM12,4a1.86,1.86,0,0,1,0,3.71h0A1.86,1.86,0,0,1,12,4ZM11,19.33a11.92,11.92,0,0,0-5-1.1c-.33,0-.66,0-1,.05V12a9.63,9.63,0,0,1,2.52.05l.11,0A10,10,0,0,1,11,13.33Zm1-7.73a11.77,11.77,0,0,0-1.38-.68l-.06,0c-.33-.13-.66-.26-1-.36A4,4,0,0,1,12,9.69h0a4,4,0,0,1,2.44.85A12.43,12.43,0,0,0,12,11.6Zm7,6.68a11.6,11.6,0,0,0-6,1v-6a9.76,9.76,0,0,1,3.37-1.22l.2,0A9.39,9.39,0,0,1,19,12Z"></path></svg>
                                  </div>
                                </div>
                                <h4 class="card-title mb-2"> Total Students: {{$totStudents}}</h4>
                              </div>
                            </a>
                        </div>
                    </div>
                        <div class="col-lg-3 col-md-3 col-3 mb-6">
                            <div class="card h-100">
                            <a href="{{route('tables.parents',['region_Id' => $regionId])}}" class="" style="color: black">
                              <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between mb-2">
                                  <div class="avatar flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="book-reader"><path fill="#6563FF" d="M20.18,10.19A11.9,11.9,0,0,0,18,10c-.42,0-.83,0-1.24.08a5.91,5.91,0,0,0-1.91-1.65,3.81,3.81,0,0,0,1-2.57,3.86,3.86,0,0,0-7.72,0,3.81,3.81,0,0,0,1,2.57,6.11,6.11,0,0,0-1.91,1.64C6.83,10,6.42,10,6,10a11.9,11.9,0,0,0-2.18.21,1,1,0,0,0-.82,1v8.25a1,1,0,0,0,.36.77,1,1,0,0,0,.82.22A9.75,9.75,0,0,1,6,20.23a9.89,9.89,0,0,1,5.45,1.63h0l0,0,.13.05h0A1.09,1.09,0,0,0,12,22a.87.87,0,0,0,.28-.05l.07,0,.13-.05,0,0h0A9.89,9.89,0,0,1,18,20.23a9.75,9.75,0,0,1,1.82.18,1,1,0,0,0,.82-.22,1,1,0,0,0,.36-.77V11.17A1,1,0,0,0,20.18,10.19ZM12,4a1.86,1.86,0,0,1,0,3.71h0A1.86,1.86,0,0,1,12,4ZM11,19.33a11.92,11.92,0,0,0-5-1.1c-.33,0-.66,0-1,.05V12a9.63,9.63,0,0,1,2.52.05l.11,0A10,10,0,0,1,11,13.33Zm1-7.73a11.77,11.77,0,0,0-1.38-.68l-.06,0c-.33-.13-.66-.26-1-.36A4,4,0,0,1,12,9.69h0a4,4,0,0,1,2.44.85A12.43,12.43,0,0,0,12,11.6Zm7,6.68a11.6,11.6,0,0,0-6,1v-6a9.76,9.76,0,0,1,3.37-1.22l.2,0A9.39,9.39,0,0,1,19,12Z"></path></svg>
                                  </div>
                                </div>
                                <h4 class="card-title mb-2"> Total Parents: {{$totParents}}</h4>
                              </div>
                            </a>
                        </div>
                    </div>
                        <div class="col-lg-3 col-md-3 col-3 mb-6">
                            <div class="card h-100">
                            <a href="{{route('tables.teachers',['region_Id' => $regionId])}}" class="" style="color: black">
                              <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between mb-2">
                                  <div class="avatar flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="book-reader"><path fill="#6563FF" d="M20.18,10.19A11.9,11.9,0,0,0,18,10c-.42,0-.83,0-1.24.08a5.91,5.91,0,0,0-1.91-1.65,3.81,3.81,0,0,0,1-2.57,3.86,3.86,0,0,0-7.72,0,3.81,3.81,0,0,0,1,2.57,6.11,6.11,0,0,0-1.91,1.64C6.83,10,6.42,10,6,10a11.9,11.9,0,0,0-2.18.21,1,1,0,0,0-.82,1v8.25a1,1,0,0,0,.36.77,1,1,0,0,0,.82.22A9.75,9.75,0,0,1,6,20.23a9.89,9.89,0,0,1,5.45,1.63h0l0,0,.13.05h0A1.09,1.09,0,0,0,12,22a.87.87,0,0,0,.28-.05l.07,0,.13-.05,0,0h0A9.89,9.89,0,0,1,18,20.23a9.75,9.75,0,0,1,1.82.18,1,1,0,0,0,.82-.22,1,1,0,0,0,.36-.77V11.17A1,1,0,0,0,20.18,10.19ZM12,4a1.86,1.86,0,0,1,0,3.71h0A1.86,1.86,0,0,1,12,4ZM11,19.33a11.92,11.92,0,0,0-5-1.1c-.33,0-.66,0-1,.05V12a9.63,9.63,0,0,1,2.52.05l.11,0A10,10,0,0,1,11,13.33Zm1-7.73a11.77,11.77,0,0,0-1.38-.68l-.06,0c-.33-.13-.66-.26-1-.36A4,4,0,0,1,12,9.69h0a4,4,0,0,1,2.44.85A12.43,12.43,0,0,0,12,11.6Zm7,6.68a11.6,11.6,0,0,0-6,1v-6a9.76,9.76,0,0,1,3.37-1.22l.2,0A9.39,9.39,0,0,1,19,12Z"></path></svg>
                                  </div>
                                </div>
                                <h4 class="card-title mb-2"> Total Teachers: {{$totTeachers}}</h4>
                              </div>
                            </a>
                        </div>
                    </div>
                        <div class="col-lg-3 col-md-3 col-3 mb-6">
                            <div class="card h-100">
                            <a href="{{route('tables.schools',['region_Id' => $regionId])}}" class="" style="color: black">
                              <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between mb-2">
                                  <div class="avatar flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="book-reader"><path fill="#6563FF" d="M20.18,10.19A11.9,11.9,0,0,0,18,10c-.42,0-.83,0-1.24.08a5.91,5.91,0,0,0-1.91-1.65,3.81,3.81,0,0,0,1-2.57,3.86,3.86,0,0,0-7.72,0,3.81,3.81,0,0,0,1,2.57,6.11,6.11,0,0,0-1.91,1.64C6.83,10,6.42,10,6,10a11.9,11.9,0,0,0-2.18.21,1,1,0,0,0-.82,1v8.25a1,1,0,0,0,.36.77,1,1,0,0,0,.82.22A9.75,9.75,0,0,1,6,20.23a9.89,9.89,0,0,1,5.45,1.63h0l0,0,.13.05h0A1.09,1.09,0,0,0,12,22a.87.87,0,0,0,.28-.05l.07,0,.13-.05,0,0h0A9.89,9.89,0,0,1,18,20.23a9.75,9.75,0,0,1,1.82.18,1,1,0,0,0,.82-.22,1,1,0,0,0,.36-.77V11.17A1,1,0,0,0,20.18,10.19ZM12,4a1.86,1.86,0,0,1,0,3.71h0A1.86,1.86,0,0,1,12,4ZM11,19.33a11.92,11.92,0,0,0-5-1.1c-.33,0-.66,0-1,.05V12a9.63,9.63,0,0,1,2.52.05l.11,0A10,10,0,0,1,11,13.33Zm1-7.73a11.77,11.77,0,0,0-1.38-.68l-.06,0c-.33-.13-.66-.26-1-.36A4,4,0,0,1,12,9.69h0a4,4,0,0,1,2.44.85A12.43,12.43,0,0,0,12,11.6Zm7,6.68a11.6,11.6,0,0,0-6,1v-6a9.76,9.76,0,0,1,3.37-1.22l.2,0A9.39,9.39,0,0,1,19,12Z"></path></svg>
                                  </div>
                                </div>
                                <h4 class="card-title mb-2"> Total Schools: {{$totSchools}}</h4>
                              </div>
                            </a>
                        </div>
                      </div>
                        <div class="col-lg-3 col-md-3 col-3 mb-6">
                            <div class="card h-100">
                            <a href="{{route('tables.sessions',['region_Id' => $regionId])}}" class="" style="color: black">
                              <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between mb-2">
                                  <div class="avatar flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="book-reader"><path fill="#6563FF" d="M20.18,10.19A11.9,11.9,0,0,0,18,10c-.42,0-.83,0-1.24.08a5.91,5.91,0,0,0-1.91-1.65,3.81,3.81,0,0,0,1-2.57,3.86,3.86,0,0,0-7.72,0,3.81,3.81,0,0,0,1,2.57,6.11,6.11,0,0,0-1.91,1.64C6.83,10,6.42,10,6,10a11.9,11.9,0,0,0-2.18.21,1,1,0,0,0-.82,1v8.25a1,1,0,0,0,.36.77,1,1,0,0,0,.82.22A9.75,9.75,0,0,1,6,20.23a9.89,9.89,0,0,1,5.45,1.63h0l0,0,.13.05h0A1.09,1.09,0,0,0,12,22a.87.87,0,0,0,.28-.05l.07,0,.13-.05,0,0h0A9.89,9.89,0,0,1,18,20.23a9.75,9.75,0,0,1,1.82.18,1,1,0,0,0,.82-.22,1,1,0,0,0,.36-.77V11.17A1,1,0,0,0,20.18,10.19ZM12,4a1.86,1.86,0,0,1,0,3.71h0A1.86,1.86,0,0,1,12,4ZM11,19.33a11.92,11.92,0,0,0-5-1.1c-.33,0-.66,0-1,.05V12a9.63,9.63,0,0,1,2.52.05l.11,0A10,10,0,0,1,11,13.33Zm1-7.73a11.77,11.77,0,0,0-1.38-.68l-.06,0c-.33-.13-.66-.26-1-.36A4,4,0,0,1,12,9.69h0a4,4,0,0,1,2.44.85A12.43,12.43,0,0,0,12,11.6Zm7,6.68a11.6,11.6,0,0,0-6,1v-6a9.76,9.76,0,0,1,3.37-1.22l.2,0A9.39,9.39,0,0,1,19,12Z"></path></svg>
                                  </div>
                                </div>
                                <h4 class="card-title mb-2"> Total Sessions: {{$totSessions}}</h4>
                              </div>
                            </a>
                        </div>
                      </div>
                       
                    </div>
                    <div class="row">
                        
                        <div class="col-xl-12">
                            <div class="nav-align-top mb-6">
                            
                              <div class="tab-content">
                                <div class="tab-pane fade show active" id="navs-pills-justified-students" role="tabpanel">
                                    <div class="col-lg-12">
                                            <h4 class="card-title">Chart Data of {{ ucfirst($regionName) }}</h4>
                                            <div>
                                              <canvas id="bar-chart-regFacilitator" height="70"></canvas>
                                            </div>
                                    </div>
                                </div>
                                
                              </div>
                            </div>
                          </div>
                    </div>
                    <div class="row">
                        
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

<!-- Chart.js CDN -->
<script>

var studentData = {!! json_encode($studentData) !!};
var parentsData = {!! json_encode($parentsData) !!};
var teachersData = {!! json_encode($teachersData) !!};
var schoolsData = {!! json_encode($schoolsData) !!};
var regionName = {!! json_encode($regionName) !!};
var sessionsData = {!! json_encode($sessionsData) !!};

</script>
<script src="{{ asset('assets/chartjs/regchartjs.init.js') }}"></script>
@endsection
