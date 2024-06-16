@extends('backend.superadmin.layout.app')
@section('title','General Settings | sikshapedia HRM Management')

@section('content')

    <!--**********************************
            Content body start
        ***********************************-->
        <div class="mainCon">
    
            <style>
                .nav-pills {
                    background-color: #ececec !important;
                    color:#ea5c39;
                    padding:2px;
                }
                .nav{
                    background-color: #ececec !important;
                    color:#ea5c39;
                    padding:2px;
            
                }
                .nav-item{
                    
                    background-color: ###ececec !important;
                    color:#ea5c39;
                    padding:2px;
                }
                .nav-item active{
                   
                    background-color: #ea5c39 !important;
                    color:white;
                    padding:2px;
                }
                .nav-pills .nav-link.active {
                    background-color: #ea5c39 !important;
                }
                .nav-pills > li > a:hover {
                color: #ffffff !important;
                }
            
                .nav-pills > li > a {
                color: #ea5c39 !important;
                }
                .nav-pills > li > .active {
                color: #ffffff !important;
                }
            
                .nav-link-color {
                color: #ffffff;
                }
            </style>
            
                
                <!--content start-->
            
                <div class="row">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="heading mb-0">Master <span>Settings</h4>
                            
                        </div>
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
                    
                  <div class="col-md-12">
                    
                    <ul class="nav nav-pills">
                        
                        
                       
                       
                        <li class="nav-item">
                        <a class="nav-link @if(Request::segment(3) == 'general-settings') active @endif"   href="{{route('general-settings')}}">General Settings</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link @if(Request::segment(3) == 'roles') active @endif"   href="{{ route('roles-settings')}}">Roles & Permission</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link @if(Request::segment(3) == 'smtp') active @endif"   href="{{route('smtp-settings')}}">SMTP Settings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(Request::segment(3) == 'product') active @endif"   href="{{route('product-settings')}}">Product Settings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(Request::segment(3) == 'modules') active @endif"   href="{{route('modules-settings')}}">Module Settings</a>
                        </li>
                        
                       
                        
                    </ul>
                    <div class="darkBox p-4 pb-2">
                            
                                    <!-- Nav pills -->
                        
                         
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane container @if(Request::segment(3) == 'general-settings') active @endif" id="personal-details">
                                
                               
                                @include('backend.superadmin.master-settings.settings.general-settings')
                      
                                  
            
                            </div>
                            <div class="tab-pane container @if(Request::segment(3) == 'roles') active @endif" id="education">
            
                                
                                @include('backend.superadmin.master-settings.settings.roles-settings')
                                
                                   
            
                            
            
                            </div>
                            <div class="tab-pane container @if(Request::segment(3) == 'smtp') active @endif" id="past-employment">
                                
                                @include('backend.superadmin.master-settings.settings.smtp-settings')
            
                            
                            
                            </div>
                            <div class="tab-pane container @if(Request::segment(3) == 'product') active @endif" id="bank-details">
                                @if(Request::segment(3) == 'product' && empty(Request::segment(4)))

                                 @include('backend.superadmin.master-settings.settings.product-settings')
                                
                                
                                 @elseif(Request::segment(3) == 'product' && !empty(Request::segment(4)))

                                    @if(Request::segment(4) == 'add')

                                        @include('backend.superadmin.master-settings.settings.create-product')

                                    @elseif(Request::segment(5) == 'edit')
                                        @include('backend.superadmin.master-settings.settings.edit-product')

                                    @endif


                                

                                @endif
                                
            
                            </div>
                            <div class="tab-pane container @if(Request::segment(3) == 'modules') active @endif" id="acknowlege">
                                
                                @include('backend.superadmin.master-settings.settings.modules-settings')
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