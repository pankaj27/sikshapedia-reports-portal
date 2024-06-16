@extends('backend.superadmin.layout.app')
@section('title','Employee List | sikshapedia HRM Management')

@section('content')

   
<div class="mainCon">
	<div class="d-flex flex-md-row flex-sm-column  justify-content-md-between pb-4 ">
	
	</div>
	<div class="row">
					<div class="d-flex justify-content-between align-items-center mb-4">
						<h4 class="heading mb-0">Employee List <span>(Block & Unblock)</h4>
						<div class="d-flex align-items-center">
							
							<a href="{{route('users.add')}}" class="btn btn-primary menu menu-big">Add Employee</a>
						</div>
					</div>
					@include('backend.flash-message.flash-message')	
					<div class="col-xl-12 active-p">
					<div class="tab-content" id="pills-tabContent">
						<div class="tab-pane fade show active" id="pills-list" role="tabpanel">
						<div class="row">
						
							@foreach($users as $userlist)
							<div class="col-xl-4 col-lg-4 col-sm-6 p-2" >
								<div class="card">
									<div class="card-header py-3">
										<b>Role: </b><span>@if(!empty($userlist->roles)) @foreach($userlist->roles as $rol) {{$is_admin = $rol->name}} @endforeach @endif</span>
									</div>
									<div class="card-body">
										<div class="card-use-box">
											<div class="crd-bx-img">
											   <img src="{{ asset('assets/logo/profile_images_icon.png') }}" class="rounded-circle" style="height:80px;" alt="">
											   <div class="active"></div>
											</div>
											<div class="card__text">
											  <h4 class="mb-0">{{$userlist->name}}</h4>
											  <p>{{$userlist->email}}</p>
											</div>
											
											<ul class="post-pos">
												<li>
													<span class="card__info__stats">Role: </span>
													<span>@if(!empty($userlist->roles)) @foreach($userlist->roles as $rol) {{$is_admin = $rol->name}} @endforeach @endif</span>
												</li>
												<li>
													<span class="card__info__stats">Created Date: </span>
													<span>{{ date('d F, Y', strtotime($userlist->created_at)) }}</span>
												</li>
											</ul>
											<div>
												@if($is_admin != 'Superadmin')
												@can('user-edit')
													@php($id = encrypt($userlist->id))
													<a href="{{ route('users.edit',[$id]) }}" class="btn btn-success btn-sm ms-2">Edit</a>
												@endcan
												@can('user-delete')
													@php($id = encrypt($userlist->id))
													
													<a onclick="if(confirm('Are you sure you want to permenent delete?')){ event.preventDefault();
														document.getElementById('users-delete-{{$id}}').submit(); }else{}" href="#" class="btn btn-danger btn-sm ms-2">Delete</a>
														<form id="users-delete-{{$id}}" action="{{ route('users.destroy', $id)}}" method="POST">
															@csrf
															@method('DELETE')
														</form>
												@endcan
												@endif
												@if($userlist->status == '0')
												<img src="{{asset('assets/assets/img/blocked-icon.png')}}" style="width:80%;position: absolute;bottom: 63px;" class="block-icon">
												@endif
												
											</div>	
										</div>
									</div>
								</div>
							</div>
							@endforeach
							
						</div>
						</div>
						
					</div>
					</div>
				</div>
</div>

@endsection