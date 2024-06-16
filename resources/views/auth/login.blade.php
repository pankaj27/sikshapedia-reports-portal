<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sikshapedia - login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('assets/assets/css/style.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/backend/vendor/toastr/css/toastr.min.css') }}">
</head>
<body>

    <div class="loginWrap ">
        <!--- left panel start-->
        <div class="d-flex loginSide">
            <div class="logincon">
                <img src="{{asset('assets/assets/img/sikshapedia.png')}}" alt="" class="logo">
                <div class="loginBox">
                    <h2>User Login</h2>
                    <p class="text-white">Sign in to Sikshapedia Sales Portal </p>
                    @include('backend.flash-message.flash-message')	
                    <form action="{{ route('authenticate') }}" method="post" class="needs-validation" novalidate>
                    @csrf
                        <div class="form-gorup mb-3">
                            <input type="text" id="email" name="email" class="form-control loginField" placeholder="Enter Email" value="{{ old('email') }}" required>
                            
                            <div class="invalid-feedback" style="color:white;">
                                Please enter a Email.
                            </div>
                            @if ($errors->has('email'))
                                
                                <div class="invalid-feedback" style="color:white;">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        
                        </div>
                        <div class="form-gorup mb-3">
                            <input type="password" id="password" required="required" name="password" class="form-control loginField" placeholder="Password">
                            <div class="invalid-feedback" style="color:white;">
                                Please enter a password.
                            </div>
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                <div class="invalid-feedback" style="color:white;">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>
                        <div class="d-flex flex-md-row flex-sm-column justify-content-between align-items-center">
                            <div>
                                <button class="btn btn-primary loginBtn" type="submit" id="emp_login">Login</button>
                            </div>
                           
                        </div>
                    </form>
                </div>
            </div>   

        </div>
        <!--- left panel start-->

        <!--- right panel start-->
        <div class=" loginRight "> 
            <div class=""><img src="{{asset('assets/assets/img/siksh_icon.png')}}" alt="" class="logoIcon"></div>
            <div><img src="{{asset('assets/assets/img/login_right.png')}}" alt=""  class="loginrightImg"></div>

          
           
        </div>
         <!--- right panel end-->

    </div>
    
</body>
</html>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('assets/backend/vendor/global/global.min.js') }}"></script>
<script src="{{ asset('assets/backend/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{asset('assets/backend/js/custom.js') }}"></script>
<script src="{{ asset('assets/backend/vendor/toastr/js/toastr.min.js') }}"></script>

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

		
		
		@if(Session::get('success'))
				
				toastr.success("{{ Session::get('success') }}", "Success", {
                    positionClass: "toast-top-right",
                    timeOut: 5e3,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                })
		@endif
	  
	  
		@if(Session::get('info'))
				
				toastr.info("{{ Session::get('info') }}", "Info!", {
                    positionClass: "toast-top-right",
                    timeOut: 5e3,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                })
		@endif
	  
	  
		@if(Session::get('warning'))
				
				toastr.warning("{{ Session::get('warning') }}", "Warning!", {
                    positionClass: "toast-top-right",
                    timeOut: 5e3,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                })
		@endif
	  
	  
		@if(Session::get('error'))
				
				toastr.error("{{ Session::get('error') }}", "Error!", {
                    positionClass: "toast-top-right",
                    timeOut: 5e3,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                })
		@endif



    })()

    
   
    
</script>




