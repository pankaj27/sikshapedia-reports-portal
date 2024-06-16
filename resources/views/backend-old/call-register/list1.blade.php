<?php use Illuminate\Support\Facades\DB; ?>
@extends('backend.layout.app')
@section('title','Visitor Management | ncriptech website CMS')

@section('content')
<style>
	.buttons-excel{
		display:none;
	}
</style>
    <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->	
			<div class="page-titles">
				<ol class="breadcrumb">
					<li><h5 class="bc-title">Call Register Management</h5></li>
					
				</ol>
				
			</div>
			<div class="container-fluid">
				<div class="d-flex justify-content-between align-items-center mb-4">
					
					<div class="d-flex align-items-center">
						
						<a class="btn btn-primary fs-13" data-bs-toggle="offcanvas" href="#offcanvasExample1" role="button" aria-controls="offcanvasExample1">+ Add New Call</a>
					</div>
				</div>
				<div class="row">
					@include('backend.flash-message.flash-message')	
					
					<div class="col-xl-12">
						<div class="card">
							<div class="card-body">
								<div class="row task">
									<div class="col-xl-2 col-sm-4 col-6">
										<div class="task-summary">
											<div class="d-flex align-items-center">
												<h2 class="text-primary count">{{$total_call}}</h2> 
												<span>Total Call</span>
											</div>
											<p>Total call</p>
										</div>
									</div>
									<div class="col-xl-2 col-sm-4 col-6">
										<div class="task-summary">
											<div class="d-flex align-items-center">
												<h2 class="text-purple count">{{$call_receive}}</h2>
												<span>Call Receive</span>
											</div>	
											<p>Call Receive</p>
										</div>
									</div>
									<div class="col-xl-2 col-sm-4 col-6">
										<div class="task-summary">
											<div class="d-flex align-items-center">
												<h2 class="text-warning count">{{$call_rejected}}</h2>
												<span>Call Rejected</span>
											</div>	
											<p>Call Rejected</p>
										</div>
									</div>
									
                                    <div class="col-xl-2 col-sm-4 col-6">
										<div class="task-summary">
											<div class="d-flex align-items-center">	
												<h2 class="text-danger count">{{$call_not_interested}}</h2>
												<span>Not Interested</span>
											</div>
											
											<p>Not Interested</p>
											
										</div>
									</div>
									<div class="col-xl-2 col-sm-4 col-6">
										<div class="task-summary">
											<div class="d-flex align-items-center">	
												<h2 class="text-danger count">{{$appointment_fixed}}</h2>
												<span>Appointment Fixed</span>
											</div>
											
											<p>Appointment Fixed</p>
											
										</div>
									</div>
									
									
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-12">
						<div class="card">
							<div class="card-body p-0">
								<div class="table-responsive active-projects task-table">
									<div class="tbl-caption">
										<h4 class="heading mb-0">List of Call Register Details</h4>
									</div>
									<table id="empoloyeestbl2" class="table table-bordered table-hover">
										<thead>
											<tr>
												<th>
													<div class="form-check custom-checkbox">
														<input type="checkbox" class="form-check-input" id="checkAll" required>
														<label class="form-check-label" for="checkAll"></label>
													</div>
												</th>
												<th>#</th>
												<th class="text-end">Action</th>
												<th>Date</th>
												<th>Orgnz./Inst. <br> Name</th>
												<th>Contact <br> Person</th>
												<th>Contact Number 1</th>
												<th>Comntact Number 2</th>
												<th>Location</th>
												<th>Status</th>
																						
												
											</tr>
										</thead>
										<tbody>
											@php($i=1)
											@foreach($visitors_list as $list)
											<tr>
											<td>
												<div class="form-check custom-checkbox">
													<input type="checkbox" class="form-check-input" id="customCheckBox3" required>
													<label class="form-check-label" for="customCheckBox3"></label>
												</div>
											</td>
											<td><span>{{$i}}</span></td>
											<td>
												<div class="d-flex">
													<a href="#" class="btn btn-success shadow btn-xs sharp me-1"><i class="fa fa-eye"></i></a>
													<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
													<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
												</div>
											</td>
											<td><span>{{ date('d-m-Y',strtotime($list->created_at))}}</span></td>
											<td>
												<div class="products">
													<div>
														<h6>{{$list->organization_name}}</h6>
														
													</div>	
												</div>
											</td>
											<td>
												<div class="products">
													<div>
														<h6>{{$list->contact_person_name}}</h6>
														
														
														
													</div>	
												</div>
											</td>
											<td>
												<div class="products">
													<div>
														<span><b>M1:</b>{{$list->contact_person_mobile}}</span><br>
														
													</div>	
												</div>
											</td>
											<td>
												<div class="products">
													<div>
														
														<span><b>M2:</b>{{$list->contact_person_mobile2}}</span>
														
													</div>	
												</div>
											</td>

											<td>
												<div class="products">
													<div>
														<h6>{{$list->organization_address}}</h6>
														
													</div>	
												</div>
											</td>

											<td>
												<span class="badge badge-primary light border-0 me-1">{{$list->visit_status}}</span>
											</td>
											</tr>
										    @php($i++)
											@endforeach
											
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			
			</div>
        </div>
		
        <!--**********************************
            Content body end
        ***********************************-->

		<!-- Modal -->
		
		  <div class="offcanvas offcanvas-end customeoff @if ($errors->any())show @endif" tabindex="-1" id="offcanvasExample1">
			<div class="offcanvas-header">
			<h5 class="modal-title" id="#gridSystemModal1">Add New Call Register Information</h5>
			  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
				  <i class="fa-solid fa-xmark"></i>
			  </button>
			</div>
			<div class="offcanvas-body">
			  <div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						@include('backend.flash-message.flash-message')	
						@if ($errors->any())
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
							</ul>
						</div>
						@endif
						</div>
				</div>
				@if($userRole=='Superadmin')
				<form action="{{route('call-register.store') }}" method="post" class="needs-validation @if ($errors->any()) was-validated @endif" novalidate>
				@else
				<form action="{{ route('call-register.store-agent-data')}}" method="post" class="needs-validation @if ($errors->any()) was-validated @endif" novalidate>
				@endif
					@csrf
					  <div class="row">
						  <div class="col-xl-12 mb-3">
							  <label for="exampleFormControlInputfirst" class="form-label">Organization/Intitute Name<span class="text-danger">*</span></label>
							  <input required="required" type="text" name="organization_name" class="form-control" id="organization_name" placeholder="Organization/Intitute Name" value="{{ old('organization_name') }}">
							  <div class="invalid-feedback">
								Please enter organization/Institute name.
							  </div>
							</div>	
						  <div class="col-xl-6 mb-3">
							  <label class="form-label">Contact Person Name<span class="text-danger">*</span></label>
							  <input required="required" type="text" name="contact_person_name" class="form-control" id="contact_person_name" placeholder="Contact person name" value="{{ old('contact_person_name') }}">
							  <div class="invalid-feedback">
								Please enter contact person name.
							  </div>
							  
							</div>
						  
						  
						  <div class="col-xl-6 mb-3">
							<label class="form-label">Contact person number 1<span class="text-danger">*</span></label>
							<input type="number" name="contact_person_mobile" min="1000000000" max="9999999999"  class="form-control" id="contact_person_mobile" placeholder="Contact person mobile" required="required" value="{{ old('contact_person_mobile') }}">
							<div class="invalid-feedback">
								Please enter contact person number 1.
							  </div>
						</div>

                        <div class="col-xl-6 mb-3">
							<label class="form-label">Contact person number 2</label>
							<input type="number" name="contact_person_mobile2" min="1000000000" max="9999999999"  class="form-control" id="contact_person_mobile2" placeholder="Contact person mobile"  value="{{ old('contact_person_mobile2') }}">
							<div class="invalid-feedback">
								Please enter contact person number 2.
							  </div>
						</div>

						  

						  

						  <div class="col-xl-12 mb-3">
							<label class="form-label">Location<span class="text-danger">*</span></label>
							<input type="text" name="organization_address" class="form-control" id="organization_address" placeholder="Organization address" required="required" value="{{ old('organization_address') }}">
							<div class="invalid-feedback">
								Please enter location.
							  </div>
						</div>

						  

						  <div class="col-xl-12 mb-3">
							<label class="form-label">Remarks<span class="text-danger">*</span></label>
							<textarea rows="3" class="form-control" name="remarks" required="required" placeholder="Please enter remarks">{{ old('remarks') }}</textarea>
							<div class="invalid-feedback">
								Please enter remarks.
							  </div>
						  </div>
						@if($userRole == 'Superadmin' || $userRole == 'Admin' )
						  <div class="col-xl-6 mb-3">
								<label class="form-label">Status<span class="text-danger">*</span></label>
								<select name="agent_id" id="agent_id" class="form-control" required="required">
									<option value="">Select Ajent Name</option>
									@foreach($userList as $agent)
										<option value="{{$agent->id}}">{{$agent->name}}</option>
									@endforeach
								</select>

								<div class="invalid-feedback">
									Please select agent name.
								</div>
							</div>
                        @endif
						  <div class="col-xl-6 mb-3">
							<label class="form-label">Status<span class="text-danger">*</span></label>
							<select name="visit_status" id="visit_status" class="form-control" required="required">
								<option value="">Status</option>
								<option value="Call-Receive">Call Received</option>
								<option vlaue="Call-Rejected">Call Rejected</option>
								<option value="Call-Not-Picked">Call Not Picked</option>
								<option value="Not-Interested">Not Interested</option>
                                <option value="Appointment-Fixed">Appointment Fixed</option>
							</select>

							<div class="invalid-feedback">
								Please select status.
							  </div>
						</div>
						  
						
						  
						  
					  </div>
					  <div>
						  <button type="reset" class="btn btn-danger light ms-1" style="float:left;" data-bs-dismiss="offcanvas" aria-label="Close">Cancel</button>
						  <button type="submit" class="btn btn-primary me-1" style="float:right;">Submit</button>
					  </div>
				  </form>
				</div>
			</div>
		  </div>	
		  
		  <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
			<div class="modal-dialog modal-dialog-center">
			  <div class="modal-content">
				<div class="modal-header">
				  <h1 class="modal-title fs-5" id="exampleModalLabel1">Invite Employee</h1>
				  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					  <div class="row">
						  <div class="col-xl-12">
							  <input type="email" class="form-control" placeholder="hello@gmail.com">
							  <label class="form-label mt-3">Employment date<span class="text-danger">*</span></label>
							  <input class="form-control" type="date">
							  <div class="row">
								  <div class="col-xl-6">
									  <label class="form-label mt-3">First Name<span class="text-danger">*</span></label>
									  <div class="input-group">
										  <input type="text" class="form-control" placeholder="Name">
									  </div>
								  </div>
								  <div class="col-xl-6">
									  <label class="form-label mt-3">Last Name<span class="text-danger">*</span></label>
									  <div class="input-group">
										  <input type="text" class="form-control" placeholder="Surname">
									  </div>
								  </div>
							  </div>
							  <div class="mt-3 invite">
								  <label class="form-label">Send invitation email<span class="text-danger">*</span></label>
								  <input type ="email" class="form-control " placeholder="+ invite">
							  </div>
							  
					  
						  </div>
					  </div>
					  
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
				  <button type="button" class="btn btn-primary">Save changes</button>
				</div>
			  </div>
			</div>
		  </div>

		  <script>
			(function () {
			  'use strict'
		
			  // Fetch all the forms we want to apply custom Bootstrap validation styles to
			  var forms = document.querySelectorAll('.needs-validation')
		
			  // Loop over them and prevent submission
			  Array.prototype.slice.call(forms)
				.forEach(function (form) {
				  form.addEventListener('submit', function (event) {
					if (!form.checkValidity()) {
					  event.preventDefault()
					  event.stopPropagation()
					}
		
					form.classList.add('was-validated')
				  }, false)
				})
			})()
			
			
		</script>

@endsection