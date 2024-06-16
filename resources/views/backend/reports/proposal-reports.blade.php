<?php use Illuminate\Support\Facades\DB;
?>
@extends('backend.layout.app')
@section('title','Visiting Reports | sikshapedia Sales Portal')
@section('content')
<div class="mainCon">
    


    <div class="d-flex flex-md-row flex-sm-column sm-col justify-content-md-between pb-4">
      <h2 class="heading blue-text">Details Proposal Send Reports</h2>
      
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
      <div class="col-12">
        <div class="darkBox p-4 pb-2">
         
          
            
            <div class="row">
              
                  <div class="col-lg-4 col-md-3 col-4">
                    <div class="form-group pb-3">
                      <div class="d-flex justify-content-between mb-2" >
                          <label for="forl-label">User Category</label>
                          <div class="text-danger asterik text-end mb-0 pb-0">*</div>
                      </div>
                      
                      <select class="form-control round-input" style="width:100%;height:100% !important;" name="category" id="category" onchange="getemploye_name();">
                        <option value="">Select User category</option>
                        @foreach($roles as $role)
                            <option value="{{$role->name}}">{{$role->name}}</option>
                        @endforeach
                      </select>

                    </div>
                  </div>
                  <div class="col-lg-4 col-md-3 col-4">
                    <div class="form-group pb-3">
                      <div class="d-flex justify-content-between mb-2" >
                          <label for="forl-label">Employee Name</label>
                          
                      </div>
                      <select class="form-control round-input" style="width:100%;height:100% !important;" id="user_id" name="user_id" onchange="get_details_report()">
                        <option value="">Select User</option>
                        
                      </select>
                    
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-4">
                    <div class="form-group pb-3">
                      <div class="d-flex justify-content-between mb-2" >
                          <label for="forl-label">&nbsp;</label>
                          
                      </div>
                      <button type="button" class="btn btn-primary menu menu-big" onclick="get_details_report()">Search Reports</button>
                    
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-3">
                    <!--<div class="form-group pb-3">
                      <div class="d-flex justify-content-between mb-2" >
                          <label for="forl-label">Date Range</label>
                          
                      </div>
                     
                      <input type="text" name="daterange" class="form-control round-input" id="daterange" placeholder="select date range" />
                    
                    </div>-->
                  </div>

                  

                
            </div>

            
              
            
        </div>
        </form>
      </div>
    </div>

    <div class="col-12">
      <h2 class="heading blue-text py-3">Details Propoal Sending Reports</h2>

      <div class="table-responsive">
        <table class="table table-bordered tableDark">
          <thead>
            <tr>
                <th scope="col">SL No</th>
                <th scope="col">Date</th>
                <th scope="col">Institute / College Name</th>
                <th scope="col">Contact Person</th>
                <th scope="col">Address</th>
                <th scope="col">Suvscription Type</th>
                <th scope="col">Subscription Cost</th>
                
                <th scope="col">Message</th>
                <th scope="col">Proposal Copy</th>
                <th scope="col">Visited By</th>
              </tr>
          </thead>
          <tbody id="view_reports">
            

            <tr><td colspan="10" class="text-center">No information available</td></tr>

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

  function getemploye_name(){

    if($("#category").val() == '' || $("#category").val() == null){
      toastr.error('Error','Please select user Role');
      return;
    }

    $.ajaxSetup({
		  headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
	   
		$.ajax({
		  url: "{{ route('reports.user.list') }}",
		  type: 'POST',
		  data: {
			userrole: $("#category").val(),
			
		   },
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
  }


  function get_details_report(){

    if($("#category").val() == '' || $("#category").val() == null){
      toastr.error('Error','Please select user Role');
      return;
    }

    if($("#user_id").val() == '' || $("#user_id").val() == null){
      toastr.error('Error','Please select user name');
      return;
    }

    $.ajaxSetup({
		  headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
	   
		$.ajax({
		  url: "{{ route('reports.proposal-send.list') }}",
		  type: 'POST',
		  data: {
			userrole: $("#category").val(),
      userid:$("#user_id").val(),
      //daterange:$("#daterange").val(),
			
		   },
       beforeSend: function () {
                            $('.ajax-loader').css("visibility", "visible");
          },
		 success: function(result){
		   
		  
  
		   if(result.status == 1){
        $("#view_reports").html(result.data);
        toastr.success('Success','Reports fetch successfully');
		   }else{
        toastr.error('Error','Opps! something Wrong');
        $("#view_reports").html(result.data);
			
  
		   }
  
		   
  
		 },
     complete: function () {
          
          $('.ajax-loader').css("visibility", "hidden");

      }
    
    
    });
  }
</script>

@endsection