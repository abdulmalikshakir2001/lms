@extends('theme-layout.layout') @extends('theme-layout.page-title')
@section('title', 'Sessions | Create') @section('content')
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->
        @include('theme-layout.sideBar')
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->

            @include('theme-layout.navBar') @include('theme-layout.msgs')

            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row">
                        <!-- Basic with Icons -->
                        <div class="col-xxl">
                            <div class="card mb-6">
                                <div
                                    class="card-header d-flex align-items-center justify-content-between"
                                >
                                    <h5 class="mb-0">Add Session</h5>
                                    <a
                                        href="{{route('sessions.index')}}"
                                        class="btn btn-primary"
                                        >Back</a
                                    >
                                </div>
                                <div class="card-body">
                                    <form
                                        action="{{route('sessions.store')}}"
                                        method="POST"
                                    >
                                        @csrf
                                        <div class="row mb-6">
                                            <label
                                                class="col-sm-2 col-form-label"
                                                for="basic-icon-default-fullname"
                                                >Session Name</label
                                            >  
                                            <div class="col-sm-10">
                                                <div
                                                    class="input-group input-group-merge"
                                                >
                                                    
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="basic-icon-default-fullname"
                                                        name="session_name"
                                                        placeholder="John Doe"
                                                        aria-label="John Doe"
                                                        aria-describedby="basic-icon-default-fullname2"
                                                        required
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label
                                                for="exampleFormControlSelect1"
                                                class="col-sm-2 col-form-label"
                                                >Trainer</label
                                            >
                                            <div class="col-sm-10 mb-4">
                                                <select class="form-select" name="trainer" aria-label="Default select example" required>
                                                    <option selected>Select Trainer</option>
                                                    @if ($trainers->isNotEmpty())
                                                        @foreach ($trainers as $trainer)
                                                          <option value="{{$trainer->id}}">{{$trainer->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row" id="region_div">
                                            <label for="exampleFormControlSelect2" class="col-sm-2 col-form-label">Regions</label>
                                            <div class="col-sm-10 mb-4">
                                                <select class="form-select" name="region" id="exampleFormControlSelect2" aria-label="Default select example" required>
                                                    <option selected>Select Region</option>
                                                    @if ($regions->isNotEmpty())
                                                        @foreach ($regions as $region)
                                                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>                                        
                                        <div class="row" id="region_div">
                                            <label for="exampleFormControlSelect2" class="col-sm-2 col-form-label">Programs</label>
                                            <div class="col-sm-10 mb-4">
                                                <select class="form-select" name="program" id="exampleFormControlSelect2" aria-label="Default select example" required>
                                                    <option selected>Select Program</option>
                                                    @if ($programs->isNotEmpty())
                                                        @foreach ($programs as $program)
                                                            <option value="{{ $program->id }}">{{ $program->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div> 
                                        <div class="row" id="region_div">
                                            <label for="exampleFormControlSelect2" class="col-sm-2 col-form-label">Session For</label>
                                            <div class="col-sm-10 mb-4">
                                                <select class="form-select" name="session_for" id="exampleFormControlSelect2" aria-label="Default select example" required>
                                                    <option selected>Session For</option>
                                                    @if ($session_fors->isNotEmpty())
                                                        @foreach ($session_fors as $session_for)
                                                            <option value="{{ $session_for->id }}">{{ $session_for->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div> 
                                        
                                        <div class="row mb-6">
                                            <label
                                                class="col-sm-2 col-form-label"
                                                for="basic-icon-default-fullname"
                                                >Start Date</label
                                            >
                                            <div class="col-sm-4">
                                                <div
                                                    class="input-group input-group-merge"
                                                >
                                                    
                                                    <input
                                                        type="date"
                                                        class="form-control"
                                                        id="basic-icon-default-fullname"
                                                        name="start_date"
                                                        placeholder="John Doe"
                                                        aria-label="John Doe"
                                                        aria-describedby="basic-icon-default-fullname2"
                                                        required
                                                    />
                                                </div>
                                            </div>
                                            <label
                                                class="col-sm-1 offset-1 col-form-label"
                                                for="basic-icon-default-fullname"
                                                > End Date</label
                                            >
                                            <div class="col-sm-4">
                                                <div
                                                    class="input-group input-group-merge"
                                                >
                                                    
                                                    <input
                                                        type="date"
                                                        class="form-control"
                                                        id="basic-icon-default-fullname"
                                                        name="end_date"
                                                        placeholder="John Doe"
                                                        aria-label="John Doe"
                                                        aria-describedby="basic-icon-default-fullname2"
                                                        required
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-6">
                                            <label
                                                class="col-sm-2 col-form-label"
                                                for="basic-icon-default-email"
                                                >Description</label
                                            >
                                            <div class="col-sm-10">
                                                <div
                                                    class="input-group input-group-merge"
                                                >
                                                    <textarea name="description" id="" class="form-control" cols="30" rows="2"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row justify-content-end">
                                            <div class="col-sm-10">
                                                <button
                                                    type="submit"
                                                    class="btn btn-primary"
                                                >
                                                   Add Session
                                                </button>
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
@endsection
