<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sikshapedia - Dashboard</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/assets/img/siksh_icon.png')}}">
    <link href="{{asset('assets/assets/css/icon.css')}}" rel="stylesheet" /> 
    
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.css" integrity="" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('assets/assets/css/style.css')}}">
	<link rel="stylesheet" type="text/css" href="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/toastr/css/toastr.min.css') }}">
    <style>
        .mt-10rem {
            margin-top: 10rem;
        }
        .z-9999 {
            z-index: 9999;
        }
        .d--none {
            display: none;
        }
        .position-fixed {
            position: fixed !important;
        }
    </style>
    <style>
        .ajax-loader {
      visibility: hidden;
      background-color: rgba(255,255,255,0.7);
      position: fixed;
      z-index: +100 !important;
      top:0px;
      left:0px;
      width: 100%;
      height:100%;
    }
    
    .ajax-loader img {
      position: relative;
      top:50%;
      left:50%;
    }

    
    .modal-body{
        height: 60vh;
        overflow-y: auto;
    }

    .tbl_open{
        display:none;
        }
        .tbl_close{
        display:block;
        }
    </style>
</head>
<body>

    <div class="ajax-loader" id="loading">
        <img src="{{ asset('assets/assets/img/loading-gif.gif') }}" class="img-responsive" />
    </div>

    <div class="wrap">
        <div class="wrapcon">
            @include('backend.superadmin._partials.left-menu')

            @yield('content')
            
            


        </div> 
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js" integrity="" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Toastr -->
    <script src="{{ asset('assets/backend/vendor/toastr/js/toastr.min.js') }}"></script>

    <!-- All init script -->
    <script src="{{ asset('assets/backend/js/plugins-init/toastr-init.js') }}"></script>

	<script src="{{asset('assets/assets/js/main.js')}}"></script>
		
	<script>
		//window.onpaint = isItMe();
	
		$(function(){ 
		 // $("#nav").load("nav.html"); 
		  $("#mob_nav").addClass("desktopOff mobileOn"); 
		 // $("#mob_nav").load("nav.html"); 
		});
		
		$(document).ready(function(){
			//isItMe();
            $('#data_table').dataTable();
		});
	</script>

<script type="text/javascript">
    $('#appointment_time').timepicker();
</script>

<script>

    (function ($) {
        "use strict"
    
    
    /*******************
    Toastr
    *******************/
    
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

            $("#update_form").submit(function(event) {
                
      var formData = $("#update_form").serialize();
      //var form = $('#update_form')[0];
      //var data = new FormData(form);
      $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
      $.ajax({
        type: "POST",
        url: "{{route('product.update')}}",
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        beforeSend: function () {
          $("#loading").show();
                  
        },
        success: function(res) {
          console.log(res);
            if(res.status == 'Success'){

                //window.reload();
                
               

                toastr.success("Product Updated Successfully", "Success", {
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

                //window.location.href="{{route('product-settings')}}";

         }else{

            if(res.errors){

                $.each(res.errors, function(prefix, val){
                    toastr.error("Some thing error occurred", "Error", {
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
                });

            }else{

                toastr.error("Some thing error occurred", "Error", {
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

            }

           

                    window.reload();

         }
        },
        complete: function () {
            $("#loading").hide();
        }
      });

      return false;
    });
            


    })(jQuery);
    
    
            
          
          
          </script>

<link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />
 <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script>
$(function() { 
  
  $('#data_table').dataTable();

  $('#exampleModal').modal({
        backdrop: 'static',
        keyboard: false
    })

  
});
</script> 
       
</body>
</html>