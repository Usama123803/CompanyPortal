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
                  		<div class="card-header"><h3 class="card-title">View Companies</h3></div>

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
		                      		@foreach($companies as $val_CD)
				                        <tr class="align-middle">
				                          	<td>{{ $i++ }}</td>
				                          	<td>{{ $val_CD->name }}</td>
				                          	<td>{{ $val_CD->description }}</td>
				                          	<td>
				                          		@if($val_CD->packageCodes->isNotEmpty())
				                          			@php $pc = 1; @endphp
				                          			@foreach($val_CD->packageCodes as $val_PC)
				                          				@if($pc > 1)
				                          					<b class="hide_PC_{{ $i }}" style="display: none;">{{ $val_PC->code }}</b> <br>
				                          					@php $pc++; @endphp
				                          				@else
				                          					<b>{{ $val_PC->code }}</b> <br>
				                          					@php $pc++; @endphp
				                          				@endif
				                          			@endforeach
				                          			@if($pc > 2)
				                          				<a class="btn btn-info btn-info" id="show_PC_{{ $i }}" onclick="show_PC({{ $i }})" style="font-size: 10px;">...</a>
				                          				<a class="btn btn-info btn-info" id="hide_PC_{{ $i }}" onclick="hide_PC({{ $i }})" style="font-size: 10px; display: none;">HIDE</a>
				                          			@endif
				                          		@endif
				                          	</td>
				                          	<td>
				                          		@if($val_CD->reviews->isNotEmpty())
				                          			@php $rd = 1; @endphp
				                          			@foreach($val_CD->reviews as $val_RD)
				                          				@if($rd > 1)
				                          					<b class="hide_RD_{{ $i }}" style="display: none;">{{ $val_RD->experience }}</b> <br>
				                          					@php $rd++; @endphp
				                          				@else
				                          					<b>{{ $val_RD->experience }}</b> <br>
				                          					@php $rd++; @endphp
				                          				@endif
				                          				@if($rd > 2)
					                          				<a class="btn btn-info btn-info" id="show_RD_{{ $i }}" onclick="show_RD({{ $i }})" style="font-size: 10px;">...</a>
					                          				<a class="btn btn-info btn-info" id="hide_RD_{{ $i }}" onclick="hide_RD({{ $i }})" style="font-size: 10px; display: none;">HIDE</a>
					                          			@endif
				                          			@endforeach
				                          		@endif
				                          	</td>
				                          	<td>
				                          		<a href="{{ route('admin.editCompany', ['id' => $val_CD->id]) }}" class="btn btn-primary btn-primary">Edit</a>
				                          		@if($val_CD->packageCodes->isNotEmpty() || $val_CD->reviews->isNotEmpty())
												@else
												    <a href="{{ route('admin.deleteCompany', ['id' => $val_CD->id]) }}" class="btn btn-danger btn-danger" onclick="return confirm('Are you sure you want to delete?');">DELETE</a>
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

@section('scripts')
<script>
	$(document).ready(function () {
		window.show_PC = function(id){
			$('.hide_PC_'+id).css('display','');
			$('#show_PC_'+id).css('display','none');
			$('#hide_PC_'+id).css('display','');
		}

		window.hide_PC = function(id){
			$('.hide_PC_'+id).css('display','none');
			$('#show_PC_'+id).css('display','');
			$('#hide_PC_'+id).css('display','none');
		}

		window.show_RD = function(id){
			$('.hide_RD_'+id).css('display','');
			$('#show_RD_'+id).css('display','none');
			$('#hide_RD_'+id).css('display','');
		}

		window.hide_RD = function(id){
			$('.hide_RD_'+id).css('display','none');
			$('#show_RD_'+id).css('display','');
			$('#hide_RD_'+id).css('display','none');
		}
	});
</script>
@endsection