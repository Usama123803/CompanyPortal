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

      <div class="card-header"><div class="card-title">Edit Review</div></div>
      <!--end::Header-->
      <!--begin::Form-->
      <form class="needs-validation" action="{{ route('admin.updateReview' , ['id' => $id]) }}" novalidate method="post">
        @csrf
        <!--begin::Body-->
        <div class="card-body">
          <!--begin::Row-->
          <div class="row g-3">

            <!--begin::Col-->
            <div class="col-md-4">
                <label for="validationCustom01" class="form-label">User Name</label>
                <input name="user_name" value="{{ $reviews->user_name }}" type="text" class="form-control" id="validationCustom01" required/>
                <div class="valid-feedback">Looks good!</div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-4">
                <label for="validationCustom01" class="form-label">Select Company</label>
                <select name="company_id" type="text" class="form-control" id="validationCustom01" required>
                  @if($reviews->company_id == $companies->id)
                    <option selected value="{{ $companies->id }}">{{ $companies->name }}</option>
                  @endif
                </select>
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