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
	<title>Access Denied</title>
	
	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="{{ asset('assets/logo/favicon.png') }}">
	<link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
	<link href="{{ asset('assets/backend/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
	
    <link href="{{ asset('assets/backend/css/style.css') }}" rel="stylesheet">
    
</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
					<div class="error-page">
						<div class="error-inner text-center">
							<div class="dz-error" data-text="403">403</div>
							<h4 class="error-head"><i class="fa fa-times-circle text-danger"></i> Forbidden Error!</h4>
							<p class="error-head">You do not have permission to access this page.</p>
							<div>
								<a href="{{route('login')}}" class="btn btn-secondary">BACK TO DASHBOARD</a>
							</div>
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
 <script src="{{ asset('assets/backend/js/custom.js') }}"></script>
<script src="{{ asset('assets/backend/js/deznav-init.js') }}"></script>
<script src="{{ asset('assets/backend/js/demo.js') }}"></script>

</body>

</html>
