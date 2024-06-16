@extends('backend.layout.app')
@section('title','System Mosules List | ncriptech website CMS')

@section('content')

    <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->	
			<div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)"><h5 class="bc-title">Settings</h5></a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">System Modules</a></li>
					</ol>
             </div>
			<div class="container-fluid">
				<div class="row">
					<div class="d-flex align-items-center justify-content-between">
						<h4 class="heading mb-3">System Modules</h4>
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
							<div class="col-xl-12">
								<div class="card">
									<div class="card-header py-3">
										<h4 class="heading mb-0">Update System Modules</h4>
									</div>
									<div class="card-body">
										<div class="basic-form">
											<form action="{{ route('update-system-modules') }}" method="post" class="needs-validation" novalidate>
												@csrf
												<div class="mb-3">
													<label class="text-label form-label" for="validationCustomUsername">Modules Name*</label>
													<div class="input-group">
														<input type="text" class="form-control" name="modules_name" id="validationCustomUsername" value="{{$s_module['modules_name']}}" placeholder="Enter a module name.." required>
														<input type="hidden" name="modules_id" value="{{$id}}"/>
                                                        <div class="invalid-feedback">
															Please Enter a module name.
														  </div>
													</div>
												</div>
												<div class="mb-3">
													<label class="text-label form-label" for="validationCustomUsername">URL*</label>
													<div class="input-group">
														<input type="text" class="form-control" name="modules_url" id="validationCustomUsername" value="{{$s_module['modules_url']}}" placeholder="Enter a module url.." required>
														<div class="invalid-feedback">
															Please Enter a module url.
														  </div>
													</div>
												</div>
												<div class="mb-3">
													<label class="text-label form-label" for="validationCustomUsername">Modules Permission*</label>
													<div class="input-group">
                                                        @php($permission_name_explode =explode(",",$s_module['permission_name']) )
														<div class="form-check custom-checkbox mb-3 col-md-6">
															<input type="checkbox" name="permission_name[]" @if(in_array("manage",$permission_name_explode)) {{ 'checked' }} @endif class="form-check-input" id="customCheckBox1" value="manage">
															<label class="form-check-label" for="customCheckBox1">Manage</label>
														</div>
														<div class="form-check custom-checkbox mb-3 col-md-6">
															<input type="checkbox" name="permission_name[]" class="form-check-input" @if(in_array("view",$permission_name_explode)) {{ 'checked' }} @endif id="customCheckBox1" value="view">
															<label class="form-check-label" for="customCheckBox1">View</label>
														</div>
														<div class="form-check custom-checkbox mb-3 col-md-6">
															<input type="checkbox" name="permission_name[]" class="form-check-input" id="customCheckBox1" @if(in_array("create",$permission_name_explode)) {{ 'create' }} @endif value="create">
															<label class="form-check-label" for="customCheckBox1">Create</label>
														</div>
														<div class="form-check custom-checkbox mb-3 col-md-6">
															<input type="checkbox" name="permission_name[]" class="form-check-input" id="customCheckBox1" @if(in_array("edit",$permission_name_explode)) {{ 'edit' }} @endif value="edit">
															<label class="form-check-label" for="customCheckBox1">Edit</label>
														</div>
														<div class="form-check custom-checkbox mb-3 col-md-6">
															<input type="checkbox" name="permission_name[]" class="form-check-input" id="customCheckBox1" @if(in_array("delete",$permission_name_explode)) {{ 'delete' }} @endif value="delete">
															<label class="form-check-label" for="customCheckBox1">Delete</label>
														</div>
														<div class="form-check custom-checkbox mb-3 col-md-6">
															<input type="checkbox" name="permission_name[]" class="form-check-input" id="customCheckBox1" @if(in_array("list",$permission_name_explode)) {{ 'list' }} @endif value="list" checked="checked">
															<label class="form-check-label" for="customCheckBox1">List</label>
														</div>
														<div class="invalid-feedback">
															Please Select a permission name.
														  </div>
													</div>
												</div>
												<div class="mb-3">
													<label class="text-label form-label" for="dz-password">Status *</label>
													<div class="input-group transparent-append">
														
														<select class="form-control" name="module_status"  required>
															<option value="">-Select status -</option>
															<option value="Yes" @if($s_module['is_active'] == 'Yes') {{ 'selected' }} @endif >Enabled</option>
															<option value="No" @if($s_module['is_active'] == 'No') {{ 'selected' }} @endif>Disabled</option>
														</select>
														<div class="invalid-feedback">
															Please choose status
														</div>
													</div>
												</div>

												<button type="submit" class="btn me-2 btn-primary" style="float:right;">Update</button>
												<button type="reset" class="btn btn-danger light" style="float:left;">Cancel</button>
											</form>
										</div>
									</div>
								</div>
							</div>
							
						</div>
					</div>
					<div class="col-xl-8 col-lg-8">
						<div class="row">
							<div class= "col-xl-12">
								<div class="card h-auto">
									<div class="card-header py-3">
										<h4 class="heading mb-0">system Modules List</h4>
									</div>
									<div class="card-body p-0">
										<div class="table-responsive active-projects">
											<table id="projects-tbl" class="table">
												<thead>
													<tr>
														<th>#</th>
														<th>Modules Name</th>
                                                        <th>Modules Url</th>
														<th>Status</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
                                                    @php($i=1)
													@foreach($modules as $modulelist)
													<tr>
														<td>
															{{$i}}
														</td>
														<td>{{$modulelist->modules_name}}</td>
														<td>{{url($modulelist->modules_url)}}</td>
                                                        <td><a href=""><span class="badge badge-rounded badge-primary">Enabled</span></a></td>
														<td>
															<div class="action-button">
																@can('role-edit')
																@php($id = encrypt($modulelist->id))
																	<a href="{{ route('system-modules.edit',$id)}}"><button type="button" class="btn btn-primary btn-icon-xxs"><i class="fas fa-pencil-alt"></i></button></a>
																@endcan
																@can('role-delete')
																@php($id = encrypt($modulelist->id))
                                                                <a onclick="if(confirm('Are you sure you want to permenent delete?')){ event.preventDefault();
																	document.getElementById('modules-delete-{{$id}}').submit(); }else{}" href="#" class="btn btn-danger btn-icon-xxs"><i class="fas fa-trash-alt"></i></a>
																	<form id="modules-delete-{{$id}}" action="{{ route('system-modules.destroy', $id)}}" method="POST">
																		@csrf
																		@method('DELETE')
																	</form>
																@endcan
															</div>
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