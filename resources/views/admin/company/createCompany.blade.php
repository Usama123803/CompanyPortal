@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

	<div class="card card-info card-outline mb-4">
      <!--begin::Header-->
      <div class="card-header"><div class="card-title">Create Company</div></div>
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
      <form class="needs-validation" action="{{ route('admin.addCompany') }}" method="post" enctype="multipart/form-data" novalidate>
      	@csrf
        <!--begin::Body-->
        <div class="card-body">
          <!--begin::Row-->
          <div class="row g-3">

          	<!--begin::Col-->
            <div class="col-md-6">
              <label for="validationCustomUsername" class="form-label">Email</label>
              <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">@</span>
                <input
                  name="email"
                  type="email"
                  class="form-control"
                  id="validationCustomUsername"
                  value="{{ old('email') }}"
                  aria-describedby="inputGroupPrepend"
                  pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
                  required
                />
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter a valid email without spaces and with a valid domain (e.g., user@example.com)</div>
              </div>
            </div>
            <!--end::Col-->

          	<!--begin::Col-->
            <div class="col-md-6">
              <label for="inputPassword3" class="form-label">Password</label>
              <div class="input-group has-validation">
                <input
                  name="password"
                  type="password"
                  id="inputPassword3"
                  class="form-control"
                  minlength="6"
                  required
                />
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter alleast 6 character password.</div>
              </div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-6">
              <label for="validationCustom01" class="form-label">Name</label>
              <input
                name="name"
                type="text"
                class="form-control"
                value="{{ old('name') }}"
                id="validationCustom01"
                required
              />
              <div class="valid-feedback">Looks good!</div>
              <div class="invalid-feedback">Please enter company name.</div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-6">
              <label for="validationCustom02" class="form-label">Description</label>
              <input
                name="description"
                type="text"
                class="form-control"
                value="{{ old('description') }}"
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