@extends('backend.layout.app')
@section('title','Dashboard | ncriptech website CMS')

@section('content')

    <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->	
			<div class="page-titles">
				<ol class="breadcrumb">
					<li><h5 class="bc-title">Dashboard</h5></li>
					<li class="breadcrumb-item"><a href="javascript:void(0)">
						<svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M2.125 6.375L8.5 1.41667L14.875 6.375V14.1667C14.875 14.5424 14.7257 14.9027 14.4601 15.1684C14.1944 15.4341 13.8341 15.5833 13.4583 15.5833H3.54167C3.16594 15.5833 2.80561 15.4341 2.53993 15.1684C2.27426 14.9027 2.125 14.5424 2.125 14.1667V6.375Z" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M6.375 15.5833V8.5H10.625V15.5833" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
						Home </a>
					</li>
					<li class="breadcrumb-item active"><a href="javascript:void(0)">Dashboard</a></li>
				</ol>
				
			</div>
			<div class="container-fluid">
				<div class="row">
					@include('backend.flash-message.flash-message')	
					<div class="col-xl-12 wid-100">
                        <div class="col-xl-12 col-sm-12">
                            <h3>WELCOME TO SIKSHAPEDIA SALES PORTAL</h3>
                        </div>
						<div class="row">
							
							
                                <div class="col-xl-4  col-lg-6 col-sm-6">
                                    <a href="{{route('call-register.list')}}">
                                <div class="widget-stat card bg-primary">
                                    <div class="card-body  p-4">
                                        <div class="media">
                                            <span class="me-3">
                                                <i class="la la-phone"></i>
                                            </span>
                                            <div class="media-body text-white">
                                                
                                                <h4 class="text-white">Call Register</h4>
                                                <p>Add numbers to Register New call</p>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            </div>
                        

                            <div class="col-xl-4  col-lg-6 col-sm-6">
                                <a href="{{route('book-appointment.list')}}">
                                <div class="widget-stat card bg-primary">
                                    <div class="card-body  p-4">
                                        <div class="media">
                                            <span class="me-3">
                                                <i class="la la-users"></i>
                                            </span>
                                            <div class="media-body text-white">
                                                
                                                <h4 class="text-white">Appointment</h4>
                                                <p>ADD INFORMATIOn TO REGISTER APPOINTMENTS</p>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            </div>

                            <div class="col-xl-4  col-lg-6 col-sm-6">
                                <a href="{{route('visit-register.list')}}">
                                <div class="widget-stat card bg-primary">
                                    <div class="card-body  p-4">
                                        <div class="media">
                                            <span class="me-3">
                                                <i class="la la-file"></i>
                                            </span>
                                            <div class="media-body text-white">
                                                
                                                <h4 class="text-white">Visit Report</h4>
                                                <p> GET DETAILS REPORT OF APOINTMENT & CALL REGISTER</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            </div>
							
						</div>
					</div>
					
					
					
					
					
					
					
					
				</div>
			
			</div>
        </div>
		
        <!--**********************************
            Content body end
        ***********************************-->

@endsection