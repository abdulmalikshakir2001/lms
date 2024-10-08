@extends('theme-layout.layout')
@extends('theme-layout.page-title')
@section('title', 'Facilitators | Create') @section('content')
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
                                <div
                                    class="card-header d-flex align-items-center justify-content-between"
                                >
                                    <h5 class="mb-0">Edit Facilitator</h5>
                                    <a
                                        href="{{route('facilitators.index')}}"
                                        class="btn btn-primary"
                                        >Back</a
                                    >
                                </div>
                                <div class="card-body">
                                    <form
                                        action="{{route('facilitators.update',$facilitator->id)}}"
                                        method="POST"
                                        enctype="multipart/form-data"
                                    >
                                        @csrf
                                        @method('put')
                                        <div class="row mb-6">
                                            <label
                                                class="col-sm-2 col-form-label"
                                                for="basic-icon-default-fullname"
                                                >Facilitator Name</label
                                            >
                                            <div class="col-sm-10">
                                                <div
                                                    class="input-group input-group-merge"
                                                >
                                                    
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="basic-icon-default-fullname"
                                                        name="name"
                                                        placeholder="John Doe"
                                                        aria-label="John Doe"
                                                        aria-describedby="basic-icon-default-fullname2"
                                                        value="{{$facilitator->name}}"
                                                        required
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-6">
                                            <label
                                                class="col-sm-2 col-form-label"
                                                for="basic-icon-default-fullname"
                                                >Facilitator Contact</label
                                            >
                                            <div class="col-sm-10">
                                                <div
                                                    class="input-group input-group-merge"
                                                >
                                                    
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="basic-icon-default-fullname"
                                                        name="contact"
                                                        placeholder="John Doe"
                                                        aria-label="John Doe"
                                                        value="{{$facilitator->contact}}"
                                                        aria-describedby="basic-icon-default-fullname2"
                                                        required
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="row mb-6">
                                            <label
                                                class="col-sm-2 col-form-label"
                                                for="basic-icon-default-fullname"
                                                >Select Session</label
                                            >

                                           
                                            <div class="col-sm-10">
                                                <select class="form-control select2" style="width: 100%;" name="session_id">
                                                    <option selected="selected">Select Session</option>
                                                    @if ($sessions->isNotEmpty())
                                                        @foreach ($sessions as $session)
                                                            @if ($session->id == $facilitator->session_id)
                                                                <option value="{{ $session->id }}" selected>{{ $session->name }}</option> 
                                                            @else
                                                                <option value="{{ $session->id }}">{{ $session->name }}</option> 
                                                            @endif 
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        
                                        <div class="row justify-content-end">
                                            <div class="col-sm-10">
                                                <input type="hidden" name="region_id" value="{{auth()->user()->region_id}}">
                                                <button
                                                    type="submit"
                                                    class="btn btn-primary"
                                                >
                                                   Save Changes
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


  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <!-- Select2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  
  <!-- Your custom script -->
  <script>
 
      $(document).ready(function () {
        $('.select2').select2();
      });
  
  </script>
@endsection

