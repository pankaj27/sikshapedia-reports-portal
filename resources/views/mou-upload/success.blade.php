<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sikshapedia - Upload Mou</title>

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
            <div class="col-xl-12 col-lg-12">
                <div class="alert alert-danger solid alert-dismissible fade show">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                    <strong>success!</strong> This Signed Mou has been successfully uploaded
                    
                </div>
            </div>
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




