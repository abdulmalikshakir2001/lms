@extends('theme-layout.layout') @extends('theme-layout.page-title')
@section('title', 'Sessions | Edit') @section('content')
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
                                    <h5 class="mb-0">Edit Session</h5>
                                    <a
                                        href="{{route('sessions.index')}}"
                                        class="btn btn-primary"
                                        >Back</a
                                    >
                                </div>
                                <div class="card-body">
                                    <form
                                        action="{{route('sessions.update',$session->id)}}"
                                        method="POST"
                                        enctype="multipart/form-data"
                                    >
                                        @csrf
                                        @method('put')
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
                                                        value="{{$session->name}}"
                                                        required
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="region_div">
                                            <label for="exampleFormControlSelect2" class="col-sm-2 col-form-label">Programs</label>
                                            <div class="col-sm-10 mb-4">
                                                <select class="form-select" name="program" id="exampleFormControlSelect2" aria-label="Default select example" required>
                                                    <option selected>Select Program</option>
                                                    @if ($programs->isNotEmpty())
                                                        @foreach ($programs as $program)
                                                        @if ($program->id == $session->program_id)
                                                          <option value="{{ $program->id }}" selected>{{ $program->name }}</option>
                                                        @else
                                                          <option value="{{ $program->id }}">{{ $program->name }}</option>
                                                        @endif
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
                                                        @if ($session_for->id == $session->session_for_id)
                                                            <option value="{{ $session_for->id }}" selected>{{ $session_for->name }}</option>
                                                        @else 
                                                            <option value="{{ $session_for->id }}">{{ $session_for->name }}</option>
                                                        @endif
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
                                                <div class="input-group input-group-merge">
                                                    <input
                                                        type="date"
                                                        class="form-control"
                                                        id="basic-icon-default-fullname"
                                                        name="start_date"
                                                        placeholder="John Doe"
                                                        aria-label="John Doe"
                                                        aria-describedby="basic-icon-default-fullname2"
                                                        value="{{ $session->start_date ? $session->start_date->format('Y-m-d') : '' }}"
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
                                                        value="{{ $session->end_date ? $session->end_date->format('Y-m-d') : '' }}"
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
                                                    <textarea name="description" id="" class="form-control" cols="30" rows="2">{{ $session->description }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="formFileMultiple" class="col-form-label col-sm-2">Choose Files</label>
                                            <div class="mb-4 col-sm-10">
                                                <input class="form-control" type="file" name="deliverables[]" id="formFileMultiple" multiple>
                                            </div>
                                        </div>
                                        <!-- Preview of selected files -->
                                        <div class="row mb-5">
                                            <div class="col-sm-10 offset-sm-2">
                                                <ul id="file-preview-list" class="list-group">
                                                    <!-- Selected files will be shown here -->
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        <div class="row justify-content-end">
                                            <div class="col-sm-10">
                                                <button
                                                    type="submit"
                                                    class="btn btn-primary"
                                                >
                                                    Save Changes
                                                </button>
                                            </div>
                                        </div>
                                        <input type="hidden" name="trainer" value="{{$session->trainer}}">
                                        <input type="hidden" name="region" value="{{$session->region_id}}">
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
    document.getElementById('formFileMultiple').addEventListener('change', function (event) {
        const fileList = event.target.files;
        const filePreviewList = document.getElementById('file-preview-list');
        
        // Clear previous preview list
        filePreviewList.innerHTML = '';
    
        // Loop through selected files and display them
        Array.from(fileList).forEach((file, index) => {
            const li = document.createElement('li');
            li.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'align-items-center');
            li.textContent = file.name;
    
            // Remove button
            const removeButton = document.createElement('button');
            removeButton.classList.add('btn', 'btn-danger', 'btn-sm');
            removeButton.textContent = 'Remove';
    
            // Prevent form submission on button click and remove file
            removeButton.addEventListener('click', function (e) {
                e.preventDefault();  // Prevent form submission
                removeFile(index);   // Remove the specific file
            });
    
            li.appendChild(removeButton);
            filePreviewList.appendChild(li);
        });
    });
    
    // Function to remove a file from the input
    function removeFile(removeIndex) {
        const fileInput = document.getElementById('formFileMultiple');
        const dataTransfer = new DataTransfer(); // to hold the modified file list
    
        // Filter the files except the one being removed
        Array.from(fileInput.files).forEach((file, index) => {
            if (index !== removeIndex) {
                dataTransfer.items.add(file); // Add back all files except the removed one
            }
        });
    
        // Update the file input with the new file list
        fileInput.files = dataTransfer.files;
    
        // Refresh the file preview list
        const filePreviewList = document.getElementById('file-preview-list');
        filePreviewList.innerHTML = ''; // Clear existing preview list
        Array.from(fileInput.files).forEach((file, index) => {
            const li = document.createElement('li');
            li.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'align-items-center');
            li.textContent = file.name;
    
            // Remove button
            const removeButton = document.createElement('button');
            removeButton.classList.add('btn', 'btn-danger', 'btn-sm');
            removeButton.textContent = 'Remove';
    
            // Add click event to remove the file again
            removeButton.addEventListener('click', function (e) {
                e.preventDefault();
                removeFile(index);  // Recursively call remove function for the updated index
            });
    
            li.appendChild(removeButton);
            filePreviewList.appendChild(li);
        });
    }
    
    
    </script>
@endsection
