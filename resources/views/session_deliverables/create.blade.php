@extends('theme-layout.layout')
@extends('theme-layout.page-title')
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
                                    <h5 class="mb-0">Add Session Deliverables</h5>
                                    <a
                                        href="{{route('session_deliverables.index')}}"
                                        class="btn btn-primary"
                                        >Back</a
                                    >
                                </div>
                                <div class="card-body">
                                    <form
                                        action="{{route('session_deliverables.store')}}"
                                        method="POST"
                                        enctype="multipart/form-data"
                                    >
                                        @csrf
                                        <div class="row">
                                            <label
                                                    for="formFileMultiple"
                                                    class="col-form-label col-sm-2"
                                                    >Choose Files</label
                                                >
                                            <div class="mb-4 col-sm-10">
                                                
                                                <input
                                                    class="form-control"
                                                    type="file"
                                                    name="deliverables[]"
                                                    id="formFileMultiple"
                                                    multiple
                                                />
                                                <input type="hidden" name="region_id" value="{{$session->region_id}}">
                                                <input type="hidden" name="program_id" value="{{$session->program_id}}">
                                                <input type="hidden" name="user" value="{{$session->trainer}}">
                                                <input type="hidden" name="session_id" value="{{$session->id}}">
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-10">
                                                <button
                                                    type="submit"
                                                    class="btn btn-primary"
                                                >
                                                   Add Files
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
