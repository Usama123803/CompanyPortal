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

			@if ($errors->any())
		        <div class="alert alert-danger">
		          <ul class="mb-0">
		            @foreach ($errors->all() as $error)
		              <li>{{ $error }}</li>
		            @endforeach
		          </ul>
		        </div>
		      @endif

         	<!--begin::Row-->
            <div class="row">
              	<div class="col-md-12">
                	<div class="card mb-4">
                  		<div class="card-header"><h3 class="card-title">View Contact Details</h3></div>

              			<!-- /.card-header -->
              			<div class="card-body">
		                    <table class="table table-bordered">
		                      	<thead>
			                        <tr>
			                          <th style="width: 10px">#</th>
			                          <th>Name</th>
			                          <th>Description</th>
			                          <th>Package Codes</th>
			                          <th>Reviews</th>
			                          <th>Options</th>
			                        </tr>
		                      	</thead>
		                      	<tbody>
		                      		@php $i = 1; @endphp
		                      		@foreach($data as $val)
				                        <tr class="align-middle">
				                          	<td>{{ $i++ }}</td>
				                          	<td>{{ $val->name }}</td>
				                          	<td>{{ $val->email }}</td>
				                          	<td>{{ $val->subject }}</td>
				                          	<td>{{ $val->message }}</td>
				                          	<td><a class="btn btn-primary btn-primary">{{ $val->status }}</a></td>
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