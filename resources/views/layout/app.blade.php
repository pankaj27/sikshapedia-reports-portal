<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Onboarding | sikshapedia sales portal</title>
    <link rel="icon" type="image/x-icon" href="https://www.sikshapedia.com/public/data/app/2021/favicon.png">
    <link href="{{asset('assets/assets/css/icon.css')}}" rel="stylesheet" /> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.css" integrity="" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('assets/assets/css/style.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/toastr/css/toastr.min.css') }}">
</head>
<body>



    <div class="wrap">
        <div class="wrapcon">
            @include('frontend._partials.left-menu')

            @yield('content')
            
            


        </div> 
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js" integrity="" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Toastr -->
    <script src="{{ asset('assets/backend/vendor/toastr/js/toastr.min.js') }}"></script>

    <!-- All init script -->
    <script src="{{ asset('assets/backend/js/plugins-init/toastr-init.js') }}"></script>

	<script src="{{asset('assets/assets/js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
		
	<script>
		//window.onpaint = isItMe();
	
		$(function(){ 
		 // $("#nav").load("nav.html"); 
		  $("#mob_nav").addClass("desktopOff mobileOn"); 
		 // $("#mob_nav").load("nav.html"); 
		});
		
		$(document).ready(function(){
			//isItMe();
		});
	</script>

<script type="text/javascript">
    $('#appointment_time').timepicker();
</script>

<script>

    (function ($) {
        "use strict"

        $("#same_as_present").click(function(){

            if ($(this).prop('checked')==true){ 
                    //alert('is checked');

                    var state_name = $("#state_id").val();
  
                    //e.preventDefault();
                        $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                        });
                    
                        $.ajax({
                        url: "{{ route('get-district-lst') }}",
                        type: 'POST',
                        data: {
                            state_name: $("#state_id").val(),
                            district_id:$("#district_id").val()
                            
                        },
                        success: function(result){
                        
                        
                
                        if(result.success == 1){
                            
                            $("#permanent_district").html(result.data);
                
                        }else{
                            
                            $("#permanent_district").html(result.data);
                            
                
                        }
                
                        
                
                        }});

                    $("#permanent_house_name").val($("#house_name").val());
                    $("#permanent_locality_name").val($("#locality_name").val());
                    $("#permanent_post_office").val($("#post_office").val());
                    $("#permanent_nearest_land_mrk").val($("#nearest_land_mrk").val());
                    $("#permanent_state").val($("#state_id").val());
                    //$("#permanent_district").val($("#district_id").val());
                    $("#permanent_town").val($("#town").val());
                    $("#permanent_pincode").val($("#pincode").val());
                    $("#permanent_police_station").val($("#police_station").val());
                    



            }else{
                //alert('not is checked');
                $("#permanent_house_name").val('');
                $("#permanent_locality_name").val('');
                $("#permanent_post_office").val('');
                $("#permanent_nearest_land_mrk").val('');
                $("#permanent_state").val('');
                $("#permanent_district").val('');
                $("#permanent_town").val('');
                $("#permanent_pincode").val('');
                $("#permanent_police_station").val('');

            }
        });


        $('.js-example-basic-single').select2();
    
    
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
    })(jQuery);
    
    
            
          
          
          </script>

          
       
</body>
</html>