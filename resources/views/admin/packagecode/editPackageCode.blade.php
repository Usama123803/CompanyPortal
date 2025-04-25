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

      <div class="card-header"><div class="card-title">Edit Package Code</div></div>
      <!--end::Header-->
      <!--begin::Form-->
      <form class="needs-validation" action="{{ route('admin.updatePackageCode' , ['id' => $id]) }}" novalidate method="post">
        @csrf
        <!--begin::Body-->
        <div class="card-body">
          <!--begin::Row-->
          <div class="row g-3">

            <!--begin::Col-->
            <div class="col-md-4">
                <label for="validationCustom01" class="form-label">Select Company</label>
                <select name="company_id" type="text" class="form-control" id="validationCustom01" required>
                  @foreach($companies as $val_CD)
                    @if($package_codes->company_id == $val_CD->id)
                      <option selected value="{{ $val_CD->id }}">{{ $val_CD->name }}</option>
                    @endif
                  @endforeach
                </select>
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please select company.</div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-4">
                <label for="validationCustom01" class="form-label">Package Code</label>
                <input name="code" value="{{ $package_codes->code }}" type="text" class="form-control" id="validationCustom01" required/>
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter package code.</div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-4">
                <label for="validationCustom01" class="form-label">Package Type</label>
                <select name="type" class="form-control" id="validationCustom01" required>
                  <option value="">Select</option>
                  <option <?php if($package_codes->type == 'shifting') echo 'selected'; ?> value="shifting">Shifting</option>
                  <option <?php if($package_codes->type == 'Nonshifting') echo 'selected'; ?> value="Nonshifting">Non-Shifting</option>
                </select>
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please select package type.</div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-4">
                <label for="validationCustom01" class="form-label">Package Start Date</label>
                <input name="start_date" value="{{ $package_codes->start_date }}" type="date" class="form-control" id="validationCustom01" required/>
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter start date.</div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-4">
                <label for="validationCustom01" class="form-label">Package End Date</label>
                <input name="end_date" value="{{ $package_codes->end_date }}" type="date" class="form-control" id="validationCustom01" required/>
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter end date.</div>
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