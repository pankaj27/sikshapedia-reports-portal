<?php use Illuminate\Support\Facades\DB;
?>
@extends('frontend.layout.app')
@section('title','Employee Onboarding | sikshapedia Sales Portal')
@section('content')
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
      <div class="col-12">
        <ul class="nav nav-pills">
            <li class="nav-item">
            <a class="nav-link @if(Request::segment(1) == 'personal-details') active @endif"  href="{{route('personal-details')}}">Personal Details</a>
            </li>
            <li class="nav-item">
            <a class="nav-link @if(Request::segment(1) == 'education-details') active @endif"  href="{{route('education-details')}}">Education</a>
            </li>
            <li class="nav-item">
            <a class="nav-link @if(Request::segment(1) == 'employment-details') active @endif"  href="{{route('employment-details')}}">Past Employment</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(Request::segment(1) == 'bank-details') active @endif"  href="{{route('bank-details')}}">Bank Details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(Request::segment(1) == 'acknowledge-details') active @endif"  href="{{route('acknowledge-details')}}">Acknowledgement</a>
                </li>
        </ul>
        <div class="darkBox p-4 pb-2">
                
                        <!-- Nav pills -->
            
             
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane container @if(Request::segment(1) == 'personal-details') active @endif" id="personaldetails">
                    
                   @include('frontend.on-boarding-employee.component.personal-details')

                 
          
                      

                </div>
                <div class="tab-pane container @if(Request::segment(1) == 'education-details') active @endif" id="education">

                    <form action="{{ route('call-register.store-agent-data')}}" method="post" class="needs-validation @if ($errors->any()) was-validated @endif" novalidate>
                        @csrf

                    @include('frontend.on-boarding-employee.component.10th-details')

                    @include('frontend.on-boarding-employee.component.12th-details')

                    @include('frontend.on-boarding-employee.component.higher-education-details')

                    @include('frontend.on-boarding-employee.component.other-education-details')

                    
                       

                        

                        <div class="row">
                            <div class="col-lg-12">
                                <center>

                                  
                                    <div class="form-group  pb-sm">
                                        <div class="text-danger asterik text-end mb-0 pb-0 d-mobileNone "></div>
                                        <button type="submit" class="btn btn-primary menu menu-big"
                                          id="lead_callregister"> Save & Next </button>
                                      </div>
                                </center>
                            </div>
                        </div>

                    </form>
                    

                </div>
                <div class="tab-pane container @if(Request::segment(1) == 'employment-details') active @endif" id="pastemployment">

                    @include('frontend.on-boarding-employee.component.past-employment-details')

                   


                </div>
                <div class="tab-pane container @if(Request::segment(1) == 'bank-details') active @endif" id="bankdetails">

                    @include('frontend.on-boarding-employee.component.bank-details')

                    

                </div>
                <div class="tab-pane container @if(Request::segment(1) == 'acknowledge-details') active @endif" id="acknowledgement">
                    <form action="{{ route('call-register.store-agent-data')}}" method="post" class="needs-validation @if ($errors->any()) was-validated @endif" novalidate>
                        @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <strong>Declaration</strong>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required="required">
                                <label class="form-check-label" for="flexCheckDefault">
                                    I hereby declare that the information given by me in the Application is true, complete and
                                    correct to the best of my knowledge and belief and that nothing has been concealed or distorted
                                </label>
                              </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <center>

                                <div class="form-group  pb-sm">
                                    <div class="text-danger asterik text-end mb-0 pb-0 d-mobileNone "></div>
                                    <button type="submit" class="btn btn-primary menu menu-big"
                                      id="lead_callregister">Final Submit </button>
                                  </div>
                            </center>
                        </div>
                    </div>

                    </form>

                </div>
            </div>
          
            
				
        
            
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