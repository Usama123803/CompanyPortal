@extends('layouts.app')

@section('title', 'Company Dashboard')

@section('content')

	<div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
         	<!--begin::Row-->
            <div class="row">
              	<div class="col-md-12">
                	<div class="card mb-4">
                  		<div class="card-header"><h3 class="card-title">View Reviews</h3></div>

              			<!-- /.card-header -->
              			<div class="card-body">
		                    <table class="table table-bordered">
		                      	<thead>
			                        <tr>
			                          <th style="width: 10px">#</th>
			                          <th>User Details</th>
			                          <th>Package</th>
			                          <th>Nusuk Booking #</th>
			                          <th>Guide Name</th>
			                          <th>Ratings</th>
			                          <th>Support</th>
			                          <th>Experience</th>
			                        </tr>
		                      	</thead>
		                      	<tbody>
		                      		@php $i = 1; @endphp
		                      		@foreach($reviews as $val_CR)
				                        <tr class="align-middle">
				                          	<td>{{ $i++ }}</td>
				                          	<td>
				                          		<b>{{ $val_CR->user_name }}</b><br>
				                          		<b>({{ $val_CR->email }})</b><br>
				                          		<b>({{ $val_CR->contact_no }})</b>
				                          	</td>
				                          	<td>{{ $val_CR->package_code }}</td>
				                          	<td>{{ $val_CR->nusuk_booking_no }}</td>
				                          	<td>{{ $val_CR->guide_name }}</td>
				                          	<td>
				                          		Accommodation: <b>{{ $val_CR->accommodation }}</b><br>
				                          		Transportation: <b>{{ $val_CR->transportation }}</b><br>
				                          		Meal: <b>{{ $val_CR->meal }}</b><br>  	
				                          	</td>
				                          	<td>
				                          		Booking Process: <b>{{ $val_CR->guide_support_booking_process }}</b><br>
				                          		During Hajj:: <b>{{ $val_CR->guide_support_hajj }}</b><br>	
				                          	</td>
				                          	<td>{{ $val_CR->experience }}</td>
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