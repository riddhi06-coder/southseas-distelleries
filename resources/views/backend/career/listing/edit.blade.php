<!doctype html>
<html lang="en">
    
<head>
    @include('components.backend.head')
</head>
	   
		@include('components.backend.header')

	    <!--start sidebar wrapper-->	
	    @include('components.backend.sidebar')
	   <!--end sidebar wrapper-->


        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Add Category Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('manage-category-listing.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add Category</li>
                </ol>

                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                    <div class="card-header">
                        <h4>Category Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">

                                   <form class="row g-3 needs-validation custom-input" 
                                        novalidate 
                                        action="{{ route('manage-category-listing.update', $details->id) }}" 
                                        method="POST" 
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <!-- Job Category Dropdown -->
                                        <div class="col-6">
                                            <label class="form-label" for="job_category">Job Category <span class="txt-danger">*</span></label>
                                            <select class="form-control" id="job_category" name="job_category" required>
                                                <option value="">Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" 
                                                        {{ old('job_category', $details->category_id) == $category->id ? 'selected' : '' }}>
                                                        {{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Please select a Job Category.</div>
                                        </div>

                                        <hr><br><br>
                                        <h3>Banner Details</h3>

                                        <!-- Banner Heading -->
                                        <div class="col-6">
                                            <label class="form-label" for="banner_heading">Banner Heading </label>
                                            <input type="text" class="form-control" id="banner_heading" name="banner_heading"
                                                value="{{ old('banner_heading', $details->banner_heading) }}" placeholder="Enter Banner Heading">
                                            <div class="invalid-feedback">Please enter a Banner Heading.</div>
                                        </div>

                                        <!-- Banner Image Upload -->
                                        <div class="col-6">
                                            <label class="form-label" for="banner_image">Banner Image </label>
                                            <input type="file" class="form-control" id="banner_image" name="banner_image" accept="image/*" onchange="previewBannerImage(event)">
                                            <div class="invalid-feedback">Please upload a thumbnail image.</div>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small><br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>

                                            @if($details->banner_image)
                                                <img id="banner-preview" src="{{ asset('uploads/careers/' . $details->banner_image) }}" 
                                                    alt="Image Preview" style="margin-top: 10px; max-width: 200px; max-height: 200px;">
                                            @else
                                                <img id="banner-preview" src="#" alt="Image Preview" style="display:none; margin-top: 10px; max-width: 200px; max-height: 200px;">
                                            @endif
                                        </div>

                                        <!-- Section Heading -->
                                        <div class="col-12">
                                            <label class="form-label" for="section_heading">Section Heading </label>
                                            <textarea class="form-control" id="summernote" name="section_heading" placeholder="Enter Introduction">{{ old('section_heading', $details->section_heading) }}</textarea>
                                            <div class="invalid-feedback">Please enter a short introduction.</div>
                                        </div>

                                        <hr>

                                        <!-- Job Role -->
                                        <div class="col-6">
                                            <label class="form-label" for="job_role">Job Role <span class="txt-danger">*</span></label>
                                            <input type="text" class="form-control" id="job_role" name="job_role" 
                                                value="{{ old('job_role', $details->job_role) }}" placeholder="Enter Job Role" required>
                                            <div class="invalid-feedback">Please enter a Job Role.</div>
                                        </div>

                                        <!-- Department -->
                                        <div class="col-6">
                                            <label class="form-label" for="department">Department <span class="txt-danger">*</span></label>
                                            <input type="text" class="form-control" id="department" name="department" 
                                                value="{{ old('department', $details->department) }}" placeholder="Enter Department" required>
                                            <div class="invalid-feedback">Please enter a Department.</div>
                                        </div>

                                        <!-- Location -->
                                        <div class="col-6">
                                            <label class="form-label" for="location">Location <span class="txt-danger">*</span></label>
                                            <input type="text" class="form-control" id="location" name="location" 
                                                value="{{ old('location', $details->location) }}" placeholder="Enter Location" required>
                                            <div class="invalid-feedback">Please enter a Location.</div>
                                        </div>

                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('manage-category-listing.index') }}" class="btn btn-danger px-4">Cancel</a>
                                            <button class="btn btn-primary" type="submit">Update</button>
                                        </div>
                                    </form>


                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

          </div>
        </div>
        <!-- footer start-->
        @include('components.backend.footer')
        </div>
        </div>


       
       @include('components.backend.main-js')

    <script>
            // for thumbnail image preview
            function previewImage1(event) {
                const preview = document.getElementById('thumbnail-preview');
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    preview.style.display = 'none';
                }
            }


            function previewBannerImage(event) {
                const preview = document.getElementById('banner-preview');
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    preview.style.display = 'none';
                }
            }
    </script>



</body>

</html>