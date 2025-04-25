@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

	<div class="card card-info card-outline mb-4">
      <!--begin::Header-->
      <div class="card-header"><div class="card-title">Edit Company</div></div>
      <!--end::Header-->

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

      <!--begin::Form-->
      <form class="needs-validation" action="{{ route('admin.updateCompany', ['id' => $id]) }}" method="post" enctype="multipart/form-data" novalidate>
      	@csrf
        <!--begin::Body-->
        <div class="card-body">
          <!--begin::Row-->
          <div class="row g-3">

          	<!--begin::Col-->
            <div class="col-md-4">
              <label for="validationCustomUsername" class="form-label">Email</label>
              <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">@</span>
                <input
                  value="{{ $companies->email }}"
                  name="email"
                  type="text"
                  class="form-control"
                  id="validationCustomUsername"
                  aria-describedby="inputGroupPrepend"
                  required
                  readonly
                />
                <div class="valid-feedback">Looks good!</div>
              </div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-4">
              <label for="validationCustom01" class="form-label">Name</label>
              <input
                value="{{ $companies->name }}"
                name="name"
                type="text"
                class="form-control"
                id="validationCustom01"
                required
              />
              <div class="valid-feedback">Looks good!</div>
              <div class="invalid-feedback">Please enter company name.</div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-4">
              <label for="validationCustom02" class="form-label">Description</label>
              <input
                value="{{ $companies->description }}"
                name="description"
                type="text"
                class="form-control"
                id="validationCustom02"
                required
              />
              <div class="valid-feedback">Looks good!</div>
              <div class="invalid-feedback">Please enter company description.</div>
            </div>
            <!--end::Col-->
            
            <!--begin::Col-->
            <div class="col-md-6">
              <label for="validationCustom02" class="form-label">Company Logo</label>
              <input
                name="companylogo"
                type="file"
                class="form-control"
                id="validationCustom02"                
              />
              @if($companies->companylogo != null && $companies->companylogo != '')
                <img src="{{ asset('uploads/company_logos/') }}/{{ $companies->companylogo }}" style="height: 150px; width: 150px;">
                <input
                  value="{{ $companies->companylogo }}"
                  name="companylogoelse"
                  type="hidden"
                />
              @endif
              <div class="valid-feedback">Looks good!</div>
              <div class="invalid-feedback">Please select company image.</div>
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