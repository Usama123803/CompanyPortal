@extends('layouts.app')

@section('title', 'Company Dashboard')

@section('content')

	<div class="card card-info card-outline mb-4">
      <!--begin::Header-->
      <div class="card-header"><div class="card-title">Create Package Code</div></div>
      <!--end::Header-->
      <!--begin::Form-->
      <form class="needs-validation" action="{{ route('company.addPackageCode') }}" novalidate method="post">
      	@csrf
        <!--begin::Body-->
        <div class="card-body">
          <!--begin::Row-->
          <div class="row g-3">

          	<!--begin::Col-->
            <div class="col-md-4">
              	<label for="validationCustom01" class="form-label">Select Company</label>
              	<select name="company_id" type="text" class="form-control" id="validationCustom01" required>
              		<option selected value="{{ $companies->id }}">{{ $companies->name }}</option>
                </select>
              	<div class="valid-feedback">Looks good!</div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-4">
              	<label for="validationCustom01" class="form-label">Package Code</label>
              	<input name="code" type="text" class="form-control" id="validationCustom01" required/>
              	<div class="valid-feedback">Looks good!</div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-4">
              	<label for="validationCustom01" class="form-label">Package Type</label>
              	<select name="type" class="form-control" id="validationCustom01" required>
              		<option value="">Select</option>
              		<option value="shifting">Shifting</option>
              		<option value="Nonshifting">Non-Shifting</option>
              	</select>
              	<div class="valid-feedback">Looks good!</div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-4">
              	<label for="validationCustom01" class="form-label">Package Start Date</label>
              	<input name="start_date" type="date" class="form-control" id="validationCustom01" required/>
              	<div class="valid-feedback">Looks good!</div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-4">
              	<label for="validationCustom01" class="form-label">Package End Date</label>
              	<input name="end_date" type="date" class="form-control" id="validationCustom01" required/>
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