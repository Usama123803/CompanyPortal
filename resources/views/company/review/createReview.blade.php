@extends('layouts.app')

@section('title', 'Company Dashboard')

@section('content')

  <div class="card card-info card-outline mb-4">
      <!--begin::Header-->
      <div class="card-header"><div class="card-title">Create Review</div></div>
      <!--end::Header-->
      <!--begin::Form-->
      <form class="needs-validation" action="{{ route('company.addReview') }}" novalidate method="post">
        @csrf
        <!--begin::Body-->
        <div class="card-body">
          <!--begin::Row-->
          <div class="row g-3">

            <!--begin::Col-->
            <div class="col-md-4">
              <label for="validationCustom01" class="form-label">Name</label>
              <input
                name="name"
                type="text"
                class="form-control"
                id="validationCustom01"
                required
              />
              <div class="valid-feedback">Looks good!</div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-4">
              <label for="validationCustom02" class="form-label">Description</label>
              <input
                name="description"
                type="text"
                class="form-control"
                id="validationCustom02"
                required
              />
              <div class="valid-feedback">Looks good!</div>
            </div>
            <!--end::Col-->
            
            <!--begin::Col-->
            <div class="col-md-4">
              <label for="validationCustom03" class="form-label">Package Code</label>
              <input
                name="package_code"
                type="text"
                class="form-control"
                id="validationCustom03"
                required
              />
              <div class="invalid-feedback">Please provide a valid Package Code.</div>
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