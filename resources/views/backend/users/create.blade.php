@extends('backend.layout.app')
@section('title','Add New User | ncriptech website CMS')

@section('content')

    <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->	
			<div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)"><h5 class="bc-title">User Management</h5></a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Add user</a></li>
					</ol>
             </div>
			<div class="container-fluid">
				<div class="row">
					<div class="d-flex align-items-center justify-content-between">
						<h4 class="heading mb-3">Add user</h4>
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
                    <div class="col-xl-12 col-lg-12">
						<div class="row">
							<div class="col-xl-6">
								<div class="card">
									<div class="card-header py-3">
										<h4 class="heading mb-0">Add new user</h4>
									</div>
									<div class="card-body">
										<div class="basic-form">
											<form action="{{ route('users.store') }}" method="post" class="needs-validation" novalidate>
												@csrf
												<div class="mb-3">
													<label class="text-label form-label" for="validationCustomUsername">Name*</label>
													<div class="input-group">
														<input type="text" class="form-control" name="name" id="validationCustomUsername" placeholder="Enter a name.." required>
														<div class="invalid-feedback">
															Please Enter name.
														  </div>
													</div>
												</div>
												<div class="mb-3">
													<label class="text-label form-label" for="validationCustomUsername">Email*</label>
													<div class="input-group">
														<input type="email" class="form-control" name="email" id="validationCustomUsername" placeholder="Enter  email id." required>
														<div class="invalid-feedback">
															Please Enter Email.
														  </div>
													</div>
												</div>

                                                <div class="mb-3">
													<label class="text-label form-label" for="validationCustomUsername">Password*</label>
													<div class="input-group">
														<input type="password" class="form-control" name="password" id="validationCustomUsername" placeholder="Enter password." required>
														<div class="invalid-feedback">
															Please Enter passord.
														  </div>
													</div>
												</div>

                                                
                                                <div class="mb-3">
													<label class="text-label form-label" for="dz-password">Role *</label>
													<div class="input-group transparent-append">
														
														<select class="form-control" name="roles"  required>
                                                            <option value="">Selecet user Role-</option>
                                                            @foreach($roles as $rolename)
															    <option value="{{$rolename->name}}">{{$rolename->name}}</option>
                                                            @endforeach
															
														</select>
														<div class="invalid-feedback">
															Please choose user role
														</div>
													</div>
												</div>
												
												<div class="mb-3">
													<label class="text-label form-label" for="dz-password">Status *</label>
													<div class="input-group transparent-append">
														
														<select class="form-control" name="status"  required>
															<option value="">-Select status -</option>
															<option value="1">Enabled</option>
															<option value="0">Disabled</option>
														</select>
														<div class="invalid-feedback">
															Please choose status
														</div>
													</div>
												</div>

												<button type="submit" class="btn me-2 btn-primary" style="float:right;">Submit</button>
												<button type="reset" class="btn btn-danger light" style="float:left;">Cancel</button>
											
										</div>
									</div>
								</div>
							</div>

                            <!--<div class="col-xl-6">
								<div class="card">
									<div class="card-header py-3">
										<h4 class="heading mb-0">Set user permission</h4>
									</div>
									<div class="card-body">
										<div class="basic-form">
                                            <div class="table-responsive active-projects" id="user_permission_table">
											    <table class="table table-bordered table-hover" style="width:75%;">
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
									</div>
								</div>
							</div>-->
						</form>
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