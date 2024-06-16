<!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('assets/backend/vendor/global/global.min.js') }}"></script>
	<script src="{{ asset('assets/backend/vendor/chart.js/Chart.bundle.min.js') }}"></script>
	<script src="{{ asset('assets/backend/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
	<script src="{{ asset('assets/backend/vendor/apexchart/apexchart.js') }}"></script>
	
	<!-- Dashboard 1 -->
	<script src="{{ asset('assets/backend/js/dashboard/dashboard-1.js') }}"></script>
	<script src="{{ asset('assets/backend/vendor/draggable/draggable.js') }}"></script>
	
	
	<!-- tagify -->
	<script src="{{ asset('assets/backend/vendor/tagify/dist/tagify.js') }}"></script>
	 
	<script src="{{ asset('assets/backend/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/backend/vendor/datatables/js/dataTables.buttons.min.js') }}"></script>
	<script src="{{ asset('assets/backend/vendor/datatables/js/buttons.html5.min.js') }}"></script>
	<script src="{{ asset('assets/backend/vendor/datatables/js/jszip.min.js') }}"></script>
	<script src="{{ asset('assets/backend/js/plugins-init/datatables.init.js') }}"></script>
   
	<!-- Apex Chart -->
	
	<script src="{{ asset('assets/backend/vendor/bootstrap-datetimepicker/js/moment.js') }}"></script>
	<script src="{{ asset('assets/backend/vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>

	<!-- Toastr -->
    <script src="{{ asset('assets/backend/vendor/toastr/js/toastr.min.js') }}"></script>

    <!-- All init script -->
    <script src="{{ asset('assets/backend/js/plugins-init/toastr-init.js') }}"></script>
	

	<!-- Vectormap -->
    <script src="{{ asset('assets/backend/vendor/jqvmap/js/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/jqvmap/js/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/jqvmap/js/jquery.vmap.usa.js') }}"></script>
     <script src="{{ asset('assets/backend/js/custom.js') }}"></script>
	<script src="{{ asset('assets/backend/js/deznav-init.js') }}"></script>
	<script src="{{ asset('assets/backend/js/demo.js') }}"></script>
    <!--<script src="{{ asset('assets/backend/js/styleSwitcher.js') }}"></script>-->

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
})(jQuery);


		
	  
	  
	  </script>