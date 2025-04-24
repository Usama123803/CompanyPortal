@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

	<div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">

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

         	<!--begin::Row-->
            <div class="row">
              	<div class="col-md-12">
                	<div class="card mb-4">
                  		<div class="card-header"><h3 class="card-title">View Package Codes</h3></div>

              			<!-- /.card-header -->
              			<div class="card-body">
		                    <table class="table table-bordered">
		                      	<thead>
			                        <tr>
			                        	<th style="width: 10px">#</th>
			                          	<th>Package Code</th>
			                          	<th>Company Name</th>
			                          	<th>Package Type</th>
			                          	<th>Start Date</th>
			                          	<th>End Date</th>
			                          	<th>Options</th>		                          	
			                        </tr>
		                      	</thead>
		                      	<tbody>
		                      		@php $i = 1; @endphp
		                      		@foreach($package_codes as $val_CR)
				                        <tr class="align-middle">
				                          	<td>{{ $i++ }}</td>
				                          	<td>{{ $val_CR->code }}</td>
				                          	<td>{{ $val_CR->company->name }}</td>
				                          	<td>{{ $val_CR->type }}</td>
				                          	<td>{{ date('d M Y', strtotime($val_CR->start_date)) }}</td>
				                          	<td>{{ date('d M Y', strtotime($val_CR->end_date)) }}</td>
				                          	<td>
				                          		<a href="{{ route('admin.editPackageCode', ['id' => $val_CR->id]) }}" class="btn btn-primary btn-primary">Edit</a>
				                          		@if($val_CR->reviews->isNotEmpty())
												@else
				                          			<a href="{{ route('admin.deletePackageCode', ['id' => $val_CR->id]) }}" class="btn btn-danger btn-danger" onclick="return confirm('Are you sure you want to delete?');">DELETE</a>
				                          		@endif
				                          	</td>
				                        </tr>
				                    @endforeach
		                      	</tbody>
		                    </table>
              			</div>
              			<!-- /.card-body -->
                	</div>
              	</div>              
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>

@endsection