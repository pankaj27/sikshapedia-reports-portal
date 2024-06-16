@extends('backend.layout.app')
@section('title','User Role List | ncriptech website CMS')

@section('content')

    <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->	
			<div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)"><h5 class="bc-title">User Management</h5></a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Roles Listing</a></li>
					</ol>
             </div>
			<div class="container-fluid">
				<div class="row">
					<div class="d-flex align-items-center justify-content-between">
						<h4 class="heading mb-3">User Role</h4>
					</div>
					@include('backend.flash-message.flash-message')	
					@if (count($errors) > 0)
					<div class="alert alert-danger">
						<strong>Whoops!</strong> There were some problems with your input.<br><br>
						<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
						</ul>
					</div>
					@endif
					<div class="col-xl-4 col-lg-4">
						<div class="row">
							<div class= "col-xl-12">
								<div class="card h-auto">
									<div class="card-header py-3">
										<h4 class="heading mb-0">User Role List</h4>
									</div>
									<div class="card-body p-0">
										<div class="table-responsive active-projects">
											<table id="projects-tbl" class="table">
												<thead>
													<tr>
														<th>#</th>
														<th>Role Name</th>
														<th>Status</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													@foreach($roles as $rolwlist)
													<tr>
														<td>
															{{$rolwlist->id}}
														</td>
														<td>{{$rolwlist->name}}</td>
														<td>
															@if($rolwlist->status == '1')
																<span class="badge badge-rounded badge-success">Enabled</span>
															@else
																<span class="badge badge-rounded badge-danger">Disabled</span>
															@endif
														</td>
														<td>
															<div class="action-button">
																@can('role-edit')
																	@php($id = encrypt($rolwlist->id))
																	<a href="{{ route('roles.edit',$id)}}"><button type="button" class="btn btn-primary btn-icon-xxs"><i class="fas fa-pencil-alt"></i></button></a>
																@endcan
																@can('role-delete')
																    @php($id = encrypt($rolwlist->id))
																	<a onclick="if(confirm('Are you sure you want to permenent delete?')){ event.preventDefault();
																	document.getElementById('role-delete-{{$id}}').submit(); }else{}" href="#" class="btn btn-danger btn-icon-xxs"><i class="fas fa-trash-alt"></i></a>
																	<form id="role-delete-{{$id}}" action="{{ route('roles.destroy',$id)}}" method="POST">
																		@csrf
																		@method('DELETE')
																	</form>
																@endcan
															</div>
														</td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							
						</div>
					</div>
					<div class="col-xl-8 col-lg-8">
						<div class="row">
							<div class="col-xl-12">
								<div class="card">
									<div class="card-header py-3">
										<h4 class="heading mb-0">Add Roles</h4>
									</div>
									<div class="card-body">
										<div class="basic-form">
											<form action="{{ route('admin.addUserRole') }}" method="post" class="needs-validation" novalidate>
												@csrf
												<div class="mb-3">
													<label class="text-label form-label" for="validationCustomUsername">Rolename*</label>
													<div class="input-group">
														<input type="text" class="form-control" name="name" id="validationCustomUsername" placeholder="Enter a rolename.." required>
														<div class="invalid-feedback">
															Please Enter a rolename.
														  </div>
													</div>
												</div>
												<div class="mb-3">
													<label class="text-label form-label" for="dz-password">Status *</label>
													<div class="input-group transparent-append">
														
														<select class="form-control" name="role_status"  required>
															<option value="">-Select status -</option>
															<option value="1">Enabled</option>
															<option value="0">Disabled</option>
														</select>
														<div class="invalid-feedback">
															Please choose status
														</div>
													</div>
												</div>
												
												<div class="mb-3">
													<label class="text-label form-label" for="dz-password">Permission *</label>
														<div class="table-responsive active-projects">
														<table class="table table-bordered table-hover">
															<thead>
																<tr>
																	<th>#</th>
																	<th>Module Name</th>
																	<th>View</th>
																	<th>List</th>
																	<th>Create</th>
																	<th>Edit</th>
																	<th>Delete</th>
																	
																</tr>
															</thead>
															<tbody>
																@php($i=1)
																@foreach($permission as $value)
																@php($check_view = DB::table('permissions')->where('name','=',strtolower($value->module_name).'-view')->where('module_name','=',$value->module_name)->get())
																@php($check_list = DB::table('permissions')->where('name','=',strtolower($value->module_name).'-list')->where('module_name','=',$value->module_name)->get())
																@php($check_create = DB::table('permissions')->where('name','=',strtolower($value->module_name).'-create')->where('module_name','=',$value->module_name)->get())
																@php($check_edit = DB::table('permissions')->where('name','=',strtolower($value->module_name).'-edit')->where('module_name','=',$value->module_name)->get())
																@php($check_delete = DB::table('permissions')->where('name','=',strtolower($value->module_name).'-delete')->where('module_name','=',$value->module_name)->get())
																<tr>
																	<td>{{$i}}</td>
																	<td>{{$value->module_name}}</td>
																	<td>
																		@if(isset($check_view[0]))
																			<div class="form-check custom-checkbox mb-3">
																				<input type="checkbox" name="permission[]" class="form-check-input" id="customCheckBox1" value="{{$check_view[0]->id}}">
																				<label class="form-check-label" for="customCheckBox1">{{ucwords(str_replace('-',' ',$check_view[0]->name)) }}</label>
																			</div>
																		@endif
																	</td>
																	<td>
																		@if(isset($check_list[0]))
																			<div class="form-check custom-checkbox mb-3">
																				<input type="checkbox" name="permission[]" class="form-check-input" id="customCheckBox1" value="{{$check_list[0]->id}}">
																				<label class="form-check-label" for="customCheckBox1">{{ucwords(str_replace('-',' ',$check_list[0]->name)) }}</label>
																			</div>
																		@endif
																	</td>
																	<td>
																		@if(isset($check_create[0]))
																			<div class="form-check custom-checkbox mb-3">
																				<input type="checkbox" name="permission[]" class="form-check-input" id="customCheckBox1" value="{{$check_create[0]->id}}">
																				<label class="form-check-label" for="customCheckBox1">{{ucwords(str_replace('-',' ',$check_create[0]->name)) }}</label>
																			</div>
																		@endif
																	</td>
																	<td>
																		@if(isset($check_edit[0]))
																			<div class="form-check custom-checkbox mb-3">
																				<input type="checkbox" name="permission[]" class="form-check-input" id="customCheckBox1" value="{{$check_edit[0]->id}}">
																				<label class="form-check-label" for="customCheckBox1">{{ucwords(str_replace('-',' ',$check_edit[0]->name)) }}</label>
																			</div>
																		@endif
																	</td>
																	<td>
																		@if(isset($check_delete[0]))
																			<div class="form-check custom-checkbox mb-3">
																				<input type="checkbox" name="permission[]" class="form-check-input" id="customCheckBox1" value="{{$check_delete[0]->id}}">
																				<label class="form-check-label" for="customCheckBox1">{{ucwords(str_replace('-',' ',$check_delete[0]->name)) }}</label>
																			</div>
																		@endif
																	</td>
																</tr>
																@php($i++)
																@endforeach
															</tbody>
														</table>

													</div>
														
													
												</div>
												
												
												<button type="submit" class="btn me-2 btn-primary" style="float:right;">Submit</button>
												<button type="reset" class="btn btn-danger light" style="float:left;">Cancel</button>
											</form>
										</div>
									</div>
								</div>
							</div>
							
						</div>
					</div>
					
				</div>
			
			</div>
        </div>
		<div class="offcanvas offcanvas-end customeoff" tabindex="-1" id="offcanvasExample">
			<div class="offcanvas-header">
			<h5 class="modal-title" id="#gridSystemModal">Add a Role</h5>
			  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
				  <i class="fa-solid fa-xmark"></i>
			  </button>
			</div>
			<div class="offcanvas-body">
			  <div class="container-fluid">
				<div class="col-xl-12 mb-3">
					<label for="exampleFormControlInput1" class="form-label font-w500">Role Name<span class="text-danger">*</span></label>
					<input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Role Name">
				</div>	
				  <h4 class="heading">User Access levels</h4>
				  <div class="table-responsive">
					 <table id="role" class="table role-tble">
						<thead>
							<tr>
								<th>Entity</th>
								<th class="text-end">Add</th>
								<th class="text-end">Edit</th>
								<th class="text-end">Delete</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>User Management	</td>
								<td>
									<div class="form-check custom-checkbox checkbox-primary">
										<input type="checkbox" class="form-check-input" id="customCheckBox4" required="">
										<label class="form-check-label" for="customCheckBox4">Add</label>
									</div>
								</td>
								<td>
									<div class="form-check custom-checkbox checkbox-warning">
										<input type="checkbox" class="form-check-input" checked="" id="customCheckBox5" required="">
										<label class="form-check-label" for="customCheckBox5">Edit</label>
									</div>
								</td>
								<td>
									<div class="form-check custom-checkbox checkbox-danger">
										<input type="checkbox" class="form-check-input" checked="" id="customCheckBox6" required="">
										<label class="form-check-label" for="customCheckBox6">Delete</label>
									</div>
								</td>
							</tr>
							<tr>
								<td>Release</td>
								<td>
									<div class="form-check custom-checkbox checkbox-primary">
										<input type="checkbox" class="form-check-input"  id="customCheckBox7" required="">
										<label class="form-check-label" for="customCheckBox7">Add</label>
									</div>
								</td>
								<td>
									<div class="form-check custom-checkbox checkbox-warning">
										<input type="checkbox" class="form-check-input" id="customCheckBox8" required="">
										<label class="form-check-label" for="customCheckBox8">Edit</label>
									</div>
								</td>
								<td>
									<div class="form-check custom-checkbox checkbox-danger">
										<input type="checkbox" class="form-check-input" id="customCheckBox9" required="">
										<label class="form-check-label" for="customCheckBox9">Delete</label>
									</div>
								</td>
							</tr>
							<tr>
								<td>Content Management</td>
								<td>
									<div class="form-check custom-checkbox checkbox-primary">
										<input type="checkbox" class="form-check-input"  id="customCheckBox10" required="">
										<label class="form-check-label" for="customCheckBox10">Add</label>
									</div>
								</td>
								<td>
									<div class="form-check custom-checkbox checkbox-warning">
										<input type="checkbox" class="form-check-input" checked="" id="customCheckBox11" required="">
										<label class="form-check-label" for="customCheckBox11">Edit</label>
									</div>
								</td>
								<td>
									<div class="form-check custom-checkbox checkbox-danger">
										<input type="checkbox" class="form-check-input" id="customCheckBox12" required="">
										<label class="form-check-label" for="customCheckBox12">Delete</label>
									</div>
								</td>
							</tr>
							<tr>
								<td>Libabry Management</td>
								<td>
									<div class="form-check custom-checkbox checkbox-primary">
										<input type="checkbox" class="form-check-input" id="customCheckBox131" required="">
										<label class="form-check-label" for="customCheckBox131">Add</label>
									</div>
								</td>
								<td>
									<div class="form-check custom-checkbox checkbox-warning">
										<input type="checkbox" class="form-check-input" checked="" id="customCheckBox132" required="">
										<label class="form-check-label" for="customCheckBox132">Edit</label>
									</div>
								</td>
								<td>
									<div class="form-check custom-checkbox checkbox-danger">
										<input type="checkbox" class="form-check-input" checked="" id="customCheckBox13" required="">
										<label class="form-check-label" for="customCheckBox13">Delete</label>
									</div>
								</td>
							</tr>
							<tr>
								<td>Permissions for work items</td>
								<td>
									<div class="form-check custom-checkbox checkbox-primary">
										<input type="checkbox" class="form-check-input" checked="" id="customCheckBox14" required="">
										<label class="form-check-label" for="customCheckBox14">Add</label>
									</div>
								</td>
								<td>
									<div class="form-check custom-checkbox checkbox-warning">
										<input type="checkbox" class="form-check-input"  id="customCheckBox15" required="">
										<label class="form-check-label" for="customCheckBox15">Edit</label>
									</div>
								</td>
								<td>
									<div class="form-check custom-checkbox checkbox-danger">
										<input type="checkbox" class="form-check-input" id="customCheckBox16" required="">
										<label class="form-check-label" for="customCheckBox16">Delete</label>
									</div>
								</td>
							</tr>
							<tr>
								<td>User Management	</td>
								<td>
									<div class="form-check custom-checkbox checkbox-primary">
										<input type="checkbox" class="form-check-input" checked="" id="customCheckBox17" required="">
										<label class="form-check-label" for="customCheckBox17">Add</label>
									</div>
								</td>
								<td>
									<div class="form-check custom-checkbox checkbox-warning">
										<input type="checkbox" class="form-check-input" checked="" id="customCheckBox18" required="">
										<label class="form-check-label" for="customCheckBox18">Edit</label>
									</div>
								</td>
								<td>
									<div class="form-check custom-checkbox checkbox-danger">
										<input type="checkbox" class="form-check-input" checked="" id="customCheckBox19" required="">
										<label class="form-check-label" for="customCheckBox19">Delete</label>
									</div>
								</td>
							</tr>
							<tr>
								<td>Release</td>
								<td>
									<div class="form-check custom-checkbox checkbox-primary">
										<input type="checkbox" class="form-check-input" checked="" id="customCheckBox20" required="">
										<label class="form-check-label" for="customCheckBox20">Add</label>
									</div>
								</td>
								<td>
									<div class="form-check custom-checkbox checkbox-warning">
										<input type="checkbox" class="form-check-input" checked="" id="customCheckBox21" required="">
										<label class="form-check-label" for="customCheckBox21">Edit</label>
									</div>
								</td>
								<td>
									<div class="form-check custom-checkbox checkbox-danger">
										<input type="checkbox" class="form-check-input" checked="" id="customCheckBox22" required="">
										<label class="form-check-label" for="customCheckBox22">Delete</label>
									</div>
								</td>
							</tr>
							<tr>
								<td>Content Management</td>
								<td>
									<div class="form-check custom-checkbox checkbox-primary">
										<input type="checkbox" class="form-check-input" checked="" id="customCheckBox23" required="">
										<label class="form-check-label" for="customCheckBox23">Add</label>
									</div>
								</td>
								<td>
									<div class="form-check custom-checkbox checkbox-warning">
										<input type="checkbox" class="form-check-input" checked="" id="customCheckBox24" required="">
										<label class="form-check-label" for="customCheckBox24">Edit</label>
									</div>
								</td>
								<td>
									<div class="form-check custom-checkbox checkbox-danger">
										<input type="checkbox" class="form-check-input" checked="" id="customCheckBox25" required="">
										<label class="form-check-label" for="customCheckBox25">Delete</label>
									</div>
								</td>
							</tr>
							<tr>
								<td>Libabry Management</td>
								<td>
									<div class="form-check custom-checkbox checkbox-primary">
										<input type="checkbox" class="form-check-input" checked="" id="customCheckBox26" required="">
										<label class="form-check-label" for="customCheckBox26">Add</label>
									</div>
								</td>
								<td>
									<div class="form-check custom-checkbox checkbox-warning">
										<input type="checkbox" class="form-check-input" checked="" id="customCheckBox27" required="">
										<label class="form-check-label" for="customCheckBox27">Edit</label>
									</div>
								</td>
								<td>
									<div class="form-check custom-checkbox checkbox-danger">
										<input type="checkbox" class="form-check-input" checked="" id="customCheckBox28" required="">
										<label class="form-check-label" for="customCheckBox28">Delete</label>
									</div>
								</td>
							</tr>
							<tr>
								<td>Permissions for work items</td>
								<td>
									<div class="form-check custom-checkbox checkbox-primary">
										<input type="checkbox" class="form-check-input" checked="" id="customCheckBox29" required="">
										<label class="form-check-label" for="customCheckBox29">Add</label>
									</div>
								</td>
								<td>
									<div class="form-check custom-checkbox checkbox-warning">
										<input type="checkbox" class="form-check-input" checked="" id="customCheckBox30" required="">
										<label class="form-check-label" for="customCheckBox30">Edit</label>
									</div>
								</td>
								<td>
									<div class="form-check custom-checkbox checkbox-danger">
										<input type="checkbox" class="form-check-input" id="customCheckBox31" required="">
										<label class="form-check-label" for="customCheckBox31">Delete</label>
									</div>
								</td>
							</tr>
							<tr>
								<td>User Management	</td>
								<td>
									<div class="form-check custom-checkbox checkbox-primary">
										<input type="checkbox" class="form-check-input" checked="" id="customCheckBox32" required="">
										<label class="form-check-label" for="customCheckBox32">Add</label>
									</div>
								</td>
								<td>
									<div class="form-check custom-checkbox checkbox-warning">
										<input type="checkbox" class="form-check-input" checked="" id="customCheckBox33" required="">
										<label class="form-check-label" for="customCheckBox33">Edit</label>
									</div>
								</td>
								<td>
									<div class="form-check custom-checkbox checkbox-danger">
										<input type="checkbox" class="form-check-input" id="customCheckBox34" required="">
										<label class="form-check-label" for="customCheckBox34">Delete</label>
									</div>
								</td>
							</tr>
							<tr>
								<td>Release</td>
								<td>
									<div class="form-check custom-checkbox checkbox-primary">
										<input type="checkbox" class="form-check-input" checked="" id="customCheckBox35" required="">
										<label class="form-check-label" for="customCheckBox35">Add</label>
									</div>
								</td>
								<td>
									<div class="form-check custom-checkbox checkbox-warning">
										<input type="checkbox" class="form-check-input" checked="" id="customCheckBox36" required="">
										<label class="form-check-label" for="customCheckBox36">Edit</label>
									</div>
								</td>
								<td>
									<div class="form-check custom-checkbox checkbox-danger">
										<input type="checkbox" class="form-check-input" checked="" id="customCheckBox37" required="">
										<label class="form-check-label" for="customCheckBox37">Delete</label>
									</div>
								</td>
							</tr>
							<tr>
								<td>Content Management</td>
								<td>
									<div class="form-check custom-checkbox checkbox-primary">
										<input type="checkbox" class="form-check-input" id="customCheckBox38" required="">
										<label class="form-check-label" for="customCheckBox38">Add</label>
									</div>
								</td>
								<td>
									<div class="form-check custom-checkbox checkbox-warning">
										<input type="checkbox" class="form-check-input"  id="customCheckBox39" required="">
										<label class="form-check-label" for="customCheckBox39">Edit</label>
									</div>
								</td>
								<td>
									<div class="form-check custom-checkbox checkbox-danger">
										<input type="checkbox" class="form-check-input" checked="" id="customCheckBox40" required="">
										<label class="form-check-label" for="customCheckBox40">Delete</label>
									</div>
								</td>
							</tr>
						</tbody>
					 </table>
				  </div>
					<div>
						<a href="javascript:void(0)" class="btn btn-light btn-sm" >Discard</a>
						<a href="javascript:void(0)" class="btn btn-primary btn-sm" >Submit</a>
					</div>
				</div>
			</div>
		  </div>		
		
        <!--**********************************
            Content body end
        ***********************************-->
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