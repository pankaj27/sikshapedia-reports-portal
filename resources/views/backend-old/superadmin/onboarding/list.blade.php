<?php use Illuminate\Support\Facades\DB;
?>
@extends('backend.superadmin.layout.app')
@section('title','Onboarding | sikshapedia Sales Portal')
@section('content')
<div class="mainCon">
    


    <div class="d-flex flex-md-row flex-sm-column sm-col justify-content-md-between pb-4">
      <h2 class="heading blue-text">Approve Onboarding</h2>
      
    </div>
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
      
    </div>

    <div class="col-12">
      
      <div class="table-responsive">
        <table class="table table-bordered tableDark">
          <thead>
            <tr>
                <th scope="col">SL No</th>
                <th scope="col">NAME</th>
                <th scope="col">DESIGNATION</th>
                <th scope="col">AREA</th>
                <th scope="col">EMAIL</th>
                <th scope="col">REPORTING TO</th>
                <th scope="col">STATUS</th>
                <th scope="col">VIEW FORM</th>
                <th scoope="col">ACTION</th>
                
              
            </tr>
          </thead>
          <tbody id="view_onboarding">
            

            <tr><td colspan="9" class="text-center">No information available</td></tr>

          </tbody>
        </table>
      </div>
    </div>
    
    
    <div class="d-flex flex-md-row flex-sm-column sm-col justify-content-md-between pb-4">
      <h2 class="heading blue-text">Approve Report</h2>
      
    </div>

    <div class="col-12">
      
      <div class="table-responsive">
        <table class="table table-bordered tableDark">
          <thead>
            <tr>
                <th scope="col">SL No</th>
                <th scope="col">NAME</th>
                <th scope="col">DESIGNATION</th>
                <th scope="col">EMP ID</th>
                <th scope="col">COMPANY EMAIL</th>
                <th scope="col">REPORTING TO</th>
                <th scope="col">LOGIN ID</th>
                <th scoope="col">ACTION</th>
                
              
            </tr>
          </thead>
          <tbody id="approve_onboarding">
            

            <tr><td colspan="8" class="text-center">No information available</td></tr>

          </tbody>
        </table>
      </div>
    </div>

    <div class="d-flex flex-md-row flex-sm-column sm-col justify-content-md-between pb-4">
      <h2 class="heading blue-text">Rejection Report</h2>
      
    </div>

    <div class="col-12">
      
      <div class="table-responsive">
        <table class="table table-bordered tableDark">
          <thead>
            <tr>
                <th scope="col">SL No</th>
                <th scope="col">NAME</th>
                <th scope="col">DESIGNATION</th>
                <th scope="col">EMAIL</th>
                <th scope="col">REJECTION REMARKS</th>
                <th scope="col">REJECTION DATE</th>
                <th scoope="col">ACTION</th>
                
              
            </tr>
          </thead>
          <tbody id="rejection_onboarding">
            

            <tr><td colspan="7" class="text-center">No information available</td></tr>

          </tbody>
        </table>
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

<script>
  $(document).ready(
    function(){

      
    $.ajaxSetup({
		  headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
	   
		$.ajax({
		  url: "{{ route('onboarding.list.view') }}",
		  type: 'GET',		  
      beforeSend: function () {
                            $('.ajax-loader').css("visibility", "visible");
      },
		  success: function(result){
		   
		  
  
        if(result.status == 1){
        
          $("#user_id").html(result.data);
          toastr.success('Success','user fetch successfully');
        }else{
          toastr.error('Error','Opps! something Wrong');
          $("#user_id").html(result.data);
        
    
        }
  
		   
  
		 },
     complete: function () {
          
          $('.ajax-loader').css("visibility", "hidden");

      }
    
    
    });


  });
</script>

@endsection