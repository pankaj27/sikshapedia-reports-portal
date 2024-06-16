<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<meta name="robots" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="ncriptech website cms">
	<meta property="og:title" content="ncriptech website cms">
	
	
	<!-- PAGE TITLE HERE -->
	<title>Login | ncriptech website CMS</title>
	
	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="{{ asset('assets/logo/favicon.png') }}">
	<link href="{{ asset('assets/backend/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
	<!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/toastr/css/toastr.min.css') }}">

   <link href="{{ asset('assets/backend/css/style.css') }}" rel="stylesheet">

</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row h-100">
				<div class="col-lg-6 col-md-12 col-sm-12 mx-auto align-self-center">
					<div class="login-form">
						<div class="text-center">
							<h3 class="title">Sign In</h3>
							<p>Sign in to your account to start using ncriptech Agent Portal</p>
						</div>
						@include('backend.flash-message.flash-message')	
						<form action="{{ route('authenticate') }}" method="post" class="needs-validation" novalidate>
                            @csrf
							<div class="mb-4">
								<label class="mb-1 text-dark">Email</label>
								<input type="email" class="form-control form-control" name="email" value="{{ old('email') }}"  placeholder="user@gmail.com" required >
                                <div class="invalid-feedback">
                                    Please enter a Email.
                                </div>
                                @if ($errors->has('email'))
                                    
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
							</div>
							<div class="mb-4 position-relative">
								<label class="mb-1 text-dark">Password</label>
								<input type="password" id="dz-password" name="password" value="{{ old('password') }}"   class="form-control" placeholder="******" required>
								<span class="show-pass eye">
								
									<i class="fa fa-eye-slash"></i>
									<i class="fa fa-eye"></i>
								
								</span>
                                <div class="invalid-feedback">
                                    Please enter a password.
                                </div>
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
							</div>
							<div class="form-row d-flex justify-content-between mt-4 mb-2">
								<div class="mb-4">
									<div class="form-check custom-checkbox mb-3">
										<input type="checkbox" class="form-check-input" id="customCheckBox1">
										<label class="form-check-label" for="customCheckBox1">Remember my preference</label>
									</div>
								</div>
								<div class="mb-4">
									<a href="#" class="btn-link text-primary">Forgot Password?</a>
								</div>
							</div>
							<div class="text-center mb-4">
								<button type="submit" class="btn btn-primary btn-block">Sign In</button>
							</div>
							
							
							
						</form>
					</div>
				</div>
                <div class="col-xl-6 col-lg-6">
					<div class="pages-left h-100">
						<div class="login-content">
							<a href="index.html"><img src="{{ asset('assets/logo/ncriptech-logo.png') }}" class="mb-3 logo-dark" alt="" style="width:75%"></a>
							<a href="index.html"><img src="{{ asset('assets/logo/ncriptech-logo') }}" class="mb-3 logo-light" alt="" style="width:75%"></a>
							
							<p>ncriptech Website CMS  is a web content management system. It was originally created as a tool to publishing  web content, including more traditional websites, mailing lists and Internet forum, media galleries, membership sites, learning management systems and online stores.</p>
						</div>
						<div class="login-media text-center">
							<img src="{{ asset('assets/backend/images/login.png') }}" alt="">
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>

<!--**********************************
	Scripts
***********************************-->
<!-- Required vendors -->
 <script src="{{ asset('assets/backend/vendor/global/global.min.js') }}"></script>
<script src="{{ asset('assets/backend/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/deznav-init.js') }}"></script>
<script src="{{ asset('assets/backend/js/demo.js') }}"></script>
  <script src="{{asset('assets/backend/js/custom.js') }}"></script>
<!--<script src="{{ asset('assets/backend/js/styleSwitcher.js') }}"></script>-->
<!-- Toastr -->
<script src="{{ asset('assets/backend/vendor/toastr/js/toastr.min.js') }}"></script>

<!-- All init script -->
<!--<script src="{{ asset('assets/backend/js/plugins-init/toastr-init.js') }}"></script>-->
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


</body>


</html>