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
					<li><h5 class="bc-title">Visitor Management</h5></li>
					
				</ol>
				
			</div>
			<div class="container-fluid">
				<div class="d-flex justify-content-between align-items-center mb-4">
					
					<div class="d-flex align-items-center">
						
						<a class="btn btn-primary fs-13" data-bs-toggle="offcanvas" href="#offcanvasExample1" role="button" aria-controls="offcanvasExample1">+ Add New Visitor</a>
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
												<h2 class="text-primary count">{{$total_visit}}</h2> 
												<span>Total Visit</span>
											</div>
											<p>My Total visit</p>
										</div>
									</div>
									<div class="col-xl-2 col-sm-4 col-6">
										<div class="task-summary">
											<div class="d-flex align-items-center">
												<h2 class="text-purple count">{{$positive_visit}}</h2>
												<span>Positive</span>
											</div>	
											<p>Status is Positive</p>
										</div>
									</div>
									<div class="col-xl-2 col-sm-4 col-6">
										<div class="task-summary">
											<div class="d-flex align-items-center">
												<h2 class="text-warning count">{{$interested_visit}}</h2>
												<span>Very Interested</span>
											</div>	
											<p>Status is Very Interested </p>
										</div>
									</div>
									<div class="col-xl-2 col-sm-4 col-6">
										<div class="task-summary">
											<div class="d-flex align-items-center">
												<h2 class="text-danger count">{{$ask_to_visit}}</h2>
												<span>Asked to Visit Again</span>
											</div>	
											<p>Status is Visit Again</p>
										</div>
									</div>
                                    <div class="col-xl-2 col-sm-4 col-6">
										<div class="task-summary">
											<div class="d-flex align-items-center">	
												<h2 class="text-danger count">{{$actual_person_not_present}}</h2>
												<span>Person not Present</span>
											</div>	
											<p>Tasks assigne</p>
										</div>
									</div>
									<div class="col-xl-2 col-sm-4 col-6">
										<div class="task-summary">
											<div class="d-flex align-items-center">
												<h2 class="text-success count">{{$completed}}</h2>
												<span>Complete</span>
											</div>	
											<p>Tasks assigne</p>
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
										<h4 class="heading mb-0">List of Visitor Details</h4>
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
												<!--<th class="text-end">Action</th>-->
												<th>Org./Inst. <br> Info</th>
												<th>Orgnz. <br> Address</th>
												<th>Contact <br> Person Info</th>
												<th>Visiting<br> Date</th>
												<th>Followup <br> Date</th>
												<th>Remarks</th>
												<th>Agent Name</th>
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
												<!--<td>
													<div class="d-flex">
														<a href="#" class="btn btn-success shadow btn-xs sharp me-1"><i class="fa fa-eye"></i></a>
													<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
													<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
													</div>
												</td>-->
												<td>
													<div class="products">
														<div>
															<h6>{{$list->organization_name}}</h6>
															<span>{{$list->organization_mobile}}</span><br>
															<span>{{$list->organization_email}}</span>
														</div>	
													</div>
												</td>
												<td>
													<div class="products">
														<div>
															<h6>{{$list->organization_address}}</h6>
															<span>{{$list->organization_city}}</span><br>
															<span>{{$list->organization_district}}</span><br>
															<span>{{$list->organization_state}}</span><br>
															<span>{{$list->organization_pincode}}</span><br>
														</div>	
													</div>
												</td>
												<td>
													<div class="products">
														<div>
															<h6>{{$list->contact_person_name}}</h6>
															<span><b>D:</b>{{$list->contact_person_designation}}</span><br>
															<span><b>M:</b>{{$list->contact_person_mobile}}</span><br>
															
														</div>	
													</div>
												</td>
												<td><span>{{$list->agent_visiting_date}}</span></td>
												
												<td>
													<span>{{$list->next_followup_date}}</span>
												</td>	
												<td>
													<div>{{$list->remarks}}</div>
												</td>
												<td class="text-end">
													@php($userdetails = DB::table('users')->where('id',$list->agent_id)->first() )
													{{$userdetails->name}}
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
		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
			  <div class="modal-content">
				<div class="modal-header">
				  <h1 class="modal-title fs-5" id="exampleModalLabel">Add Task</h1>
				  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
				  <div class="row">
					  <div class="'col-xl-12">
						  <div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Title<span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Title Name">
						  </div>
					  </div>
					  <div class="col-xl-6">
						  <div class="mb-3">
							<label for="exampleFormControlInput2" class="form-label">Contacts<span class="text-danger">*</span></label>
							<input type="number" class="form-control" id="exampleFormControlInput2" placeholder="+910213598458">
						  </div>
					  </div>
					  <div class="col-xl-6 mb-3">
						  <label class="form-label">priority<span class="text-danger">*</span></label>
						  <select class="default-select style-1 form-control">
							  <option  data-display="Select">priority</option>
							  <option value="html">Hight</option>
							  <option value="css">Medium</option>
							  <option value="javascript">Low</option>
						  </select>
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
		  <div class="offcanvas offcanvas-end customeoff @if ($errors->any())show @endif" tabindex="-1" id="offcanvasExample1">
			<div class="offcanvas-header">
			<h5 class="modal-title" id="#gridSystemModal1">Add New Visitor Information</h5>
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
				<form action="{{route('visitor-management.store') }}" method="post" class="needs-validation @if ($errors->any()) was-validated @endif" novalidate>
				@else
				<form action="{{ route('visitor-management.store-agent-data')}}" method="post" class="needs-validation @if ($errors->any()) was-validated @endif" novalidate>
				@endif
					@csrf
					  <div class="row">
						  <div class="col-xl-12 mb-3">
							  <label for="exampleFormControlInputfirst" class="form-label">Organization/Intitute Name<span class="text-danger">*</span></label>
							  <input type="text" name="organization_name" class="form-control" id="organization_name" placeholder="Organization/Intitute Name" value="{{ old('organization_name') }}">
							  <div class="invalid-feedback">
								Please enter organization name.
							  </div>
							</div>	
						  <div class="col-xl-6 mb-3">
							  <label class="form-label">Contact Person Name<span class="text-danger">*</span></label>
							  <input type="text" name="contact_person_name" class="form-control" id="contact_person_name" placeholder="Contact person name" value="{{ old('contact_person_name') }}">
							  <div class="invalid-feedback">
								Please enter contact person name.
							  </div>
							  
							</div>
						  <div class="col-xl-6 mb-3">
							<label class="form-label">Designation<span class="text-danger">*</span></label>
							<input type="text" name="contact_person_designation" class="form-control" id="contact_person_designation" placeholder="Contact person designation" required="required" value="{{ old('contact_person_designation') }}">
							<div class="invalid-feedback">
								Please enter contact person designation.
							  </div>
						</div>
						  
						  <div class="col-xl-6 mb-3">
							<label class="form-label">Contact person mobile<span class="text-danger">*</span></label>
							<input type="number" name="contact_person_mobile" min="1000000000" max="9999999999"  class="form-control" id="contact_person_mobile" placeholder="Contact person mobile" required="required" value="{{ old('contact_person_mobile') }}">
							<div class="invalid-feedback">
								Please enter contact person mobile.
							  </div>
						</div>

						  <div class="col-xl-6 mb-3">
							<label class="form-label">Organization mobile<span class="text-danger">*</span></label>
							<input type="number" name="organization_mobile" min="1000000000" max="9999999999"  class="form-control" id="organization_mobile" placeholder="Organization mobile" required="required" value="{{ old('organization_mobile') }}">
							<div class="invalid-feedback">
								Please enter organization mobile.
							  </div>
						</div>

						  <div class="col-xl-12 mb-3">
							<label class="form-label">Organization Email<span class="text-danger">*</span></label>
							<input type="email" name="organization_email" class="form-control" id="organization_email" placeholder="Organization email id" required="required" value="{{ old('organization_email') }}">
							<div class="invalid-feedback">
								Please enter organization email.
							  </div>
						</div>

						  <div class="col-xl-12 mb-3">
							<label class="form-label">Address<span class="text-danger">*</span></label>
							<input type="text" name="organization_address" class="form-control" id="organization_address" placeholder="Organization address" required="required" value="{{ old('organization_address') }}">
							<div class="invalid-feedback">
								Please enter address.
							  </div>
						</div>

						  <div class="col-xl-3 mb-3">
							<label class="form-label">State<span class="text-danger">*</span></label>
							<input type="text" name="organization_state" class="form-control" id="organization_state" placeholder="Organization state" required="required" value="{{ old('organization_state') }}">
							<div class="invalid-feedback">
								Please enter state.
							  </div>
						</div>

						  <div class="col-xl-3 mb-3">
							<label class="form-label">District<span class="text-danger">*</span></label>
							<input type="text" name="organization_district" class="form-control" id="organization_district" placeholder="Organization district" required="required" value="{{ old('organization_district') }}">
							<div class="invalid-feedback">
								Please enter district.
							  </div>
						</div>
						<div class="col-xl-3 mb-3">
							<label class="form-label">City/Village<span class="text-danger">*</span></label>
							<input type="text" name="organization_city" class="form-control" id="organization_city" placeholder="Organization city" required="required" value="{{ old('organization_city') }}">
							<div class="invalid-feedback">
								Please enter city/village.
							  </div>
						</div>

						  <div class="col-xl-3 mb-3">
							<label class="form-label">Pincode<span class="text-danger">*</span></label>
							<input type="number" min="100000" max="999999" name="organization_pincode" class="form-control" id="organization_pincode" placeholder="Organization pincode" required="required" value="{{ old('organization_pincode') }}">
							<div class="invalid-feedback">
								Please enter organization pincode.
							  </div>
						</div>

						  <div class="col-xl-6 mb-3">
							  <label for="exampleFormControlInputthree" class="form-label">Visiting Date<span class="text-danger">*</span></label>
							  <input type="text" readonly name="agent_visiting_date" class="form-control" id="exampleFormControlInputthree" value="<?php echo date('Y-m-d');  ?>">
						  </div>
						  <div class="col-xl-6 mb-3">
							  <label for="exampleFormControlInputfour" class="form-label">Followup Date<span class="text-danger">*</span></label>
							  <input type="date" name="next_followup_date" class="form-control" id="exampleFormControlInputfour" required="required" value="{{ old('next_followup_date') }}">
							  <div class="invalid-feedback">
								Please enter next followup date.
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
								<option value="Positive">Positive</option>
								<option vlaue="Very Interested">Very Interested</option>
								<option value="Asked to Visit Again">Asked to Visit Again</option>
								<option value="Actual Person absent">Actual Person absent</option>
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