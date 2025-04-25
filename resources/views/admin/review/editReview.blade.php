@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

  <div class="card card-info card-outline mb-4">
      <!--begin::Header-->

      @if (session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      @endif

      @if (session('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('error') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      @endif

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="card-header"><div class="card-title">Edit Review</div></div>
      <!--end::Header-->
      <!--begin::Form-->
      <form class="needs-validation" action="{{ route('admin.updateReview' , ['id' => $id]) }}" novalidate method="post">
        @csrf
        <!--begin::Body-->
        <div class="card-body">
          <!--begin::Row-->
          <div class="row g-3">

            <h3><b>User Details</b></h3>

            <!--begin::Col-->
            <div class="col-md-4">
                <label for="validationCustom01" class="form-label">User Name</label>
                <input name="user_name" value="{{ $reviews->user_name }}" type="text" class="form-control" id="validationCustom01" required readonly/>
                <div class="valid-feedback">Looks good!</div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-4">
                <label for="validationCustom01" class="form-label">Email</label>
                <input name="email" value="{{ $reviews->email }}" type="email" class="form-control" id="validationCustom01" required readonly/>
                <div class="valid-feedback">Looks good!</div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-4">
                <label for="validationCustom01" class="form-label">Contact</label>
                <input name="contact_no" value="{{ $reviews->contact_no }}" type="number" class="form-control" id="validationCustom01" required readonly/>
                <div class="valid-feedback">Looks good!</div>
            </div>
            <!--end::Col-->

            <h3><b>Review</b></h3>

            <!--begin::Col-->
            <div class="col-md-4">
                <label for="validationCustom01" class="form-label">Select Package Code</label>
                <select name="package_code" type="text" class="form-control" id="validationCustom01" required>
                  @foreach($package_codes as $val_PC)  
                    @if($reviews->packagecode_id == $val_PC->id)
                      <option selected value="{{ $val_PC->id }}">{{ $val_PC->code }}</option>
                    @endif
                  @endforeach
                </select>
                <div class="valid-feedback">Looks good!</div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-4">
                <label for="validationCustom01" class="form-label">Nusuk Booking Number</label>
                <input name="nusuk_booking_no" value="{{ $reviews->nusuk_booking_no }}" type="text" class="form-control" id="validationCustom01" required/>
                <div class="valid-feedback">Looks good!</div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-4">
                <label for="validationCustom01" class="form-label">Guide Name</label>
                <input name="guide_name" value="{{ $reviews->guide_name }}" type="text" class="form-control" id="validationCustom01" required/>
                <div class="valid-feedback">Looks good!</div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-4">
              <label class="form-label">Accommodation</label>
              <select name="accommodation" id="accommodation" class="form-select" required>
                  @for ($i = 1; $i <= 5; $i++)
                      <option value="{{ $i }}" {{ $reviews->accommodation == $i ? 'selected' : '' }}>
                          {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                      </option>
                  @endfor
              </select>
              <div class="valid-feedback">Looks good!</div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-4">
              <label class="form-label">Transportation</label>
              <select name="transportation" class="form-select" required>
                  @for ($i = 1; $i <= 5; $i++)
                      <option value="{{ $i }}" {{ $reviews->transportation == $i ? 'selected' : '' }}>
                          {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                      </option>
                  @endfor
              </select>
              <div class="valid-feedback">Looks good!</div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-4">
              <label class="form-label">Meal</label>
              <select name="meal" class="form-select" required>
                  @for ($i = 1; $i <= 5; $i++)
                      <option value="{{ $i }}" {{ $reviews->meal == $i ? 'selected' : '' }}>
                          {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                      </option>
                  @endfor
              </select>
              <div class="valid-feedback">Looks good!</div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-6">
              <label class="form-label">Guide Support During Booking Process</label>
              <select name="guide_support_booking_process" class="form-select" required>
                  @for ($i = 1; $i <= 5; $i++)
                      <option value="{{ $i }}" {{ $reviews->guide_support_booking_process == $i ? 'selected' : '' }}>
                          {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                      </option>
                  @endfor
              </select>
              <div class="valid-feedback">Looks good!</div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-6">
              <label class="form-label">Guide Support During Hajj</label>
              <select name="guide_support_hajj" class="form-select" required>
                  @for ($i = 1; $i <= 5; $i++)
                      <option value="{{ $i }}" {{ $reviews->guide_support_hajj == $i ? 'selected' : '' }}>
                          {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                      </option>
                  @endfor
              </select>
              <div class="valid-feedback">Looks good!</div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-12">
                <label for="validationCustom01" class="form-label">Tell us more about your experience</label>
                <textarea name="experience" value="{{ $reviews->experience }}" class="form-control" id="validationCustom01" required/>{{ $reviews->experience }}</textarea>
                <div class="valid-feedback">Looks good!</div>
            </div>
            <!--end::Col-->

          </div>
          <!--end::Row-->
        </div>
        <!--end::Body-->
        <!--begin::Footer-->
        <div class="card-footer">
          <button class="btn btn-info" type="submit">Submit form</button>
        </div>
        <!--end::Footer-->
      </form>
      <!--end::Form-->
      <!--begin::JavaScript-->
      <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
          'use strict';

          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          const forms = document.querySelectorAll('.needs-validation');

          // Loop over them and prevent submission
          Array.from(forms).forEach((form) => {
            form.addEventListener(
              'submit',
              (event) => {
                if (!form.checkValidity()) {
                  event.preventDefault();
                  event.stopPropagation();
                }

                form.classList.add('was-validated');
              },
              false,
            );
          });
        })();
      </script>
      <!--end::JavaScript-->
    </div>

@endsection