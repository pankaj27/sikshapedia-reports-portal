<?php use Illuminate\Support\Facades\DB;
?>
@extends('backend.layout.app')
@section('title','Enter Visit Entry  | sikshapedia Sales Portal')
@section('content')
<div class="mainCon">
	
	<div class="d-flex flex-md-row flex-sm-column sm-col justify-content-md-between pb-4">
	  <h2 class="heading blue-text">Enter Your Visit Entry</h2>
	  <!-- <a href="#" class="btn btn-primary menu">+ New Report</a> -->
	</div>

	<!--content start-->
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
	<div class="row">
		
	  <div class="col-12">
		<div class="darkBox p-4  pb-2">
			@if($userRole=='Superadmin')
			<form action="{{route('visit-register.store') }}" method="post" class="needs-validation @if ($errors->any()) was-validated @endif" enctype="multipart/form-data" novalidate>
			@else
				<form action="{{ route('visit-register.store-agent-data')}}" method="post" class="needs-validation @if ($errors->any()) was-validated @endif" enctype="multipart/form-data" novalidate>
			@endif

			@csrf
			<div class="row">
			  <div class="col-lg-12">
				<div class="row">
				  <div class="col-lg-3">
					<!-- <div class="form-group pb-3">
					  <div class="text-danger asterik text-end mb-0 pb-0">*</div>
					  <select name="visit_list_id" id="visit_list_id" class="form-select round-input">
						<option value="">Pending Visit List</option>
					  </select>

					</div> -->
				  </div>
				</div>
			  </div>
			</div>

			<div class="col-lg-12">
			  <div class="row">
				<div class="col-lg-3">
				  <div class="form-group pb-3">
						<div class="d-flex justify-content-between mb-2" >
							<label for="forl-label">Select Institute/College</label>
							<div class="text-danger asterik text-end mb-0 pb-0">*</div>
						</div>
						
						<select class="form-select round-input" id="institute_name"  name="institute_name" required="required" onchange="get_college_info_Details()" >
						<option value="">Select College/Institute</option>
						@foreach($college_instlist as $instt)
						<option value="{{$instt->id}}" @if(old('institute_name') == $instt->id)Selected @endif>{{$instt->organization_name}}</option>
						@endforeach
						</select>
						<div class="invalid-feedback">
							Please enter Institute / College.
						</div>
					</div>                        
				  </div>
				  <div class="col-lg-2">
					<div class="form-group pb-3">
					  <div class="d-flex justify-content-between mb-2" >
						<label for="forl-label">Contact Person</label>
						<div class="text-danger asterik text-end mb-0 pb-0">*</div>
					  </div>
					  <input type="text" name="contact_person_name" id="contact_person_name"
						class="form-control round-input" placeholder="Contact Person" required="required" value="{{old('contact_person_name')}}" />
						<div class="invalid-feedback">
							Please enter contact person name.
						</div>
					</div>
				  </div>
				  <div class="col-lg-2">
					<div class="form-group pb-3">
					  <div class="d-flex justify-content-between mb-2" >
						<label for="forl-label">Mobile 1</label>
						<div class="text-danger asterik text-end mb-0 pb-0">*</div>
					  </div>
					  <input type="text" name="mobile_1" id="mobile_1" class="form-control round-input"
						placeholder="Mobile 1" required="required" value="{{old('mobile_1')}}" />
						<div class="invalid-feedback">
							Please enter Mobile 1.
						</div>
					</div>
				  </div>
				  <div class="col-lg-2">
					<div class="form-group pb-3">
					  <div class="d-flex justify-content-between mb-2" >
						<label for="forl-label">Mobile 2</label>
						<div class="text-danger asterik text-end mb-0 pb-0"></div>
					  </div>
					  <input type="text" name="mobile_2" id="mobile_2" class="form-control round-input"
						placeholder="Mobile 2"  value="{{old('mobile_2')}}"/>

						<div class="invalid-feedback">
							Please enter Mobile 2.
						</div>
					
					</div>
				  </div>
				  <div class="col-lg-3">
					<div class="form-group pb-2">
					  <div class="d-flex justify-content-between mb-2" >
						<label for="forl-label">Institution Email ID</label>
						<div class="text-danger asterik text-end mb-0 pb-0">*</div>
					  </div>
					  <input type="email" name="institution_email_id" id="institution_email_id"
						class="form-control round-input" placeholder="Institution Email ID" required="required" value="{{old('institution_email_id')}}" />

						<div class="invalid-feedback">
							Please enter email id.
						</div>
					</div>
				  </div>
			  </div>
			</div>

			<div class="col-lg-12">
			  <div class="row">
				<div class="col-lg-3">
				  <div class="form-group pb-3">
					<div class="d-flex justify-content-between mb-2" >
					  <label for="forl-label">Institution Address</label>
					  <div class="text-danger asterik text-end mb-0 pb-0">*</div>
					</div>
					<input type="text" name="institution_address" required="required" id="institution_address" class="form-control round-input" placeholder="Institution Address" value="{{old('institution_address')}}" />
					<div class="invalid-feedback">
						Please enter Institution address.
					</div>
				</div>
				</div>

				<div class="col-lg-2">
				  <div class="form-group pb-3">
					<div class="d-flex justify-content-between mb-2" >
					  <label for="forl-label">City</label>
					  <div class="text-danger asterik text-end mb-0 pb-0">*</div>
					</div>
					<input type="text" name="city" id="city" required="required" class="form-control round-input" placeholder="City" value="{{old('city')}}" />
					<div class="invalid-feedback">
						Please enter city.
					</div>
				  </div>
				</div>

				<div class="col-lg-2">
				  <div class="form-group pb-3">
					<div class="d-flex justify-content-between mb-2" >
					  <label for="forl-label">Select State Name</label>
					  <div class="text-danger asterik text-end mb-0 pb-0">*</div>
					</div>
					  <select class="form-select round-input" required="required" name="state_id" id="state_id" onchange="getDistrict()">
						<option value="">Select State</option>
						@foreach($state_list as $slist)
							<option value="{{$slist->State}}">{{$slist->State}}</option>
						@endforeach
					  </select>
					  	<div class="invalid-feedback">
							Please select state.
						</div>
					</div>                        
				</div>                        
			  


				<div class="col-lg-2">
				  <div class="form-group pb-3">
					<div class="d-flex justify-content-between mb-2" >
					  <label for="forl-label">District Name</label>
					  <div class="text-danger asterik text-end mb-0 pb-0">*</div>
					</div>
					  <select class="form-select round-input" required="required" name="district_id" id="district_id">
						<option value="">Select District</option>
					  </select>
					  	<div class="invalid-feedback">
							Please select district.
						</div>
					</div>                       
				</div>

				<div class="col-lg-1">
				  <div class="form-group pb-3">
					<div class="d-flex justify-content-between mb-2" >
					  <label for="forl-label">Pin</label>
					  <div class="text-danger asterik text-end mb-0 pb-0">*</div>
					</div>
					<input type="text" name="pin" id="pin" class="form-control round-input" placeholder="Pin" required="required" value="{{old('pin')}}" />
					<div class="invalid-feedback">
						Please enter pincode.
					</div>
				  </div>
				</div>

				<div class="col-lg-2">
				  <div class="form-group pb-3">
					<div class="d-flex justify-content-between mb-2" >
					  <label for="forl-label">Select Staus</label>
					  <div class="text-danger asterik text-end mb-0 pb-0">*</div>
					</div>  
					<select class="form-select round-input" name="status" id="status" required="required" >
						<option value="">Select Status</option>
						<option value="Positive Meeting"  @if(old('status') == 'Positive Meeting')Selected @endif>Positive Meeting</option>
						<option value="Very Interested" @if(old('status') == 'Very Interested')Selected @endif>Very Interested</option>
						<option value="Interested But Not Sure" @if(old('status') == 'Interested But Not Sure')Selected @endif>Interested But Not Sure</option>
						<option value="Asked to Visit Again" @if(old('status') == 'Asked to Visit Again')Selected @endif>Asked to Visit Again</option>
						<option value="Not Interested" @if(old('status') == 'Not Interested')Selected @endif>Not Interested</option>
						<option value="Next Follow up" @if(old('status') == 'Next Follow up')Selected @endif>Next Follow up</option>
						<option value="Long Time Ph not Received" @if(old('status') == 'Long Time Ph not Received')Selected @endif>Long Time Ph not Received</option>
						<option value="Appointment Booked" @if(old('status') == 'Appointment Booked')Selected @endif>Appointment Booked</option>
						<option value="Visited" @if(old('status') == 'Visited')Selected @endif>Visited</option>
						<option value="Re-Visit" @if(old('status') == 'Re-Visit')Selected @endif>Re-Visit</option>

					</select>
					</div>                        
				</div>

				

				<div class="col-lg-2">
				  <div class="form-group pb-3">
					<div class="d-flex justify-content-between mb-2" >
					  <label for="forl-label">Date</label>
					  <div class="text-danger asterik text-end mb-0 pb-0">*</div>
					</div>
					<input type="date" class="form-control round-input" name="visit_date" id="visit_date"  value="{{old('visit_date')}}" placeholder="Visit Date" required="required" />
					<div class="invalid-feedback">
						Please enter visiting date.
					</div>
				  </div>
				</div>



				<div class="col-lg-2">
				  <div class="form-group pb-3">
					<div class="d-flex justify-content-between mb-2" >
					  <label for="forl-label">Time</label>
					  <div class="text-danger asterik text-end mb-0 pb-0">*</div>
					</div>
					<div class="input-group bootstrap-timepicker timepicker">
					  <input id="appointment_time" name="appointment_time" type="text" class="form-control round-input" value="{{old('appointment_time')}}" required="required">
					  <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
					</div>

					<div class="invalid-feedback">
						Please enter visiting timing.
					</div>
	
				  </div>
				  </div>


				<div class="col-lg-5">
				  <div class="form-group pb-3">
					<div class="d-flex justify-content-between mb-2" >
					  <label for="forl-label">Notes</label>
					  <div class="text-danger asterik text-end mb-0 pb-0">*</div>
					</div>
					<input name="special_note" id="special_note" class="form-control round-input" required="required" placeholder="Notes" value="{{old('special_note')}}" />
					<div class="invalid-feedback">
						Please enter remarks.
					</div>
				  </div>
				</div>
			 
			   
			  </div>
			</div>

		   



			<div class="col-lg-12">
			  <div class="row">


				<div class="col-lg-2">
				  <div class="form-group pb-3">
					<div class="text-danger asterik text-end mb-0 pb-0 d-mobileNone"></div>
					<div class="p-2"><img src="{{asset('assets/assets/img/thumb.png')}}" id="blah" alt="" class="round-input thumb"></div>
				  </div>
				</div>
				<div class="col-lg-3">
				  <div class="pt-5">
				  <input type="file" value="{{old('doc_uplode_path')}}"  id="imgInp" name="doc_uplode_path" accept="image/*"  class="pt-5"></div>
				  <div class="invalid-feedback">
					Please upload images
				</div>
				</div>

				<div class="col-lg-3">
				<div class="form-group pb-3">
				  <div class="text-danger asterik text-end mb-0 pb-0"></div>
				  <div class="">
				  <button type="submit" class="btn btn-primary menu menu-big marginbooknow" id="visitregister"> Save Now </button></div>
				</div>
			  </div>
			</div>

				

				<div class="col-lg-2">
				  
			  </div>
			</div>
		  </form>
		</div>
	  </div>
	</div>
	<div class="col-12">
	  <h2 class="heading blue-text py-3">My Visits</h2>

	  <div class="table-responsive">
		<table class="table table-bordered table-hover" id="data_table">
		  <thead>
			<tr>
			  <th scope="col">SL No</th>
			  <th scope="col">Date</th>
			  <th scope="col">Institute / College Name</th>
			  <th scope="col">Contact Person</th>
			  <th scope="col">Number 1</th>
			  <th scope="col">Number 2</th>
			  <th scope="col">Address</th>
			  <th scope="col">Remarks / Note</th>
			  <th scope="col">Status / Action</th>
			</tr>
		  </thead>
		  @php($sll = 1)
		  @foreach($visitors_list as $lisst)
		  <tr>
			<td>{{$sll}}</td>
			<td>{{date('d/m/Y',strtotime($lisst->visit_date))}}</td>
			<td>
			    @php($orggt = DB::table('call_registers')->where('id',$lisst->institution_name)->first())
                {{ $orggt->organization_name}}
			</td>
			<td>{{$lisst->contact_person_name}}</td>
			<td>{{$lisst->mobile_1}}</td>
			<td>{{$lisst->mobile_2}}</td>
			<td>{{$lisst->institution_address}}</td>
			<td>{{$lisst->special_note}}
				@php($followups = DB::table('visit_register_followups')->where('visit_id',$lisst->id)->get())
				@if(count($followups)>0)

				
				<a href="javascript:void(0)" class="openFollowupModal" data-bs-toggle="modal" data-bs-target="#leadModal_<?php echo $sll; ?>"><img src="{{asset('assets/assets/img/shield.png')}}" alt=""></a>
                              <div class="modal" id="leadModal_<?php echo $sll; ?>">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                              
                                    <!-- Modal Header -->
                                    <div class="modal-header">
										<strong><h3>Followup remarks of {{ $orggt->organization_name}} </h3></strong>
									
                                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                              
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                      <div class="table-responsive">
                                        <table class="table table-bordered tableDark">
                                          <thead>
                                          <tr>
                                            <th scope="col">SL No</th>
                                            <th scope="col">Follow up Date</th>
                                            <th scope="col">Follow up status</th>
                                            <th scope="col">Follow up Note</th>
                                    
                                          </tr>
                                          </thead>
                                          <tbody>
                                            <?php if(count($followups)>0){  $sllw = 1;?>
                                              @foreach($followups as $liostt)
                                                <tr>
                                                    <td>{{$sllw}}</td>
                                                    <td>{{$liostt->followup_date}}</td>
                                                    <td>{{$liostt->status}}</td>
                                                    <td>{{$liostt->remarks}}</td>
                                                   

                                                </tr>
                                                <?php $sllw++; ?>
                                              @endforeach

                                            <?php  }else{ ?>
                                            <tr><td colspan="4">No Data Found</td></tr>

                                            <?php } ?>
                                          
                                          </tbody>
                                        </table>
                                        </div>
                                    </div>
                              
                                    <!-- Modal footer -->
                                    
                              
                                  </div>
                                </div>
                              </div>

				@endif
			</td>
			<td>
			    
			    @if($lisst->visit_status == 'Positive Meeting' || $lisst->visit_status == 'Appointment Booked')
                      
                      <a href="javascript:void(0)" class="teal-btn-radius my-1">{{$lisst->visit_status}}</a>
                      
                @elseif($lisst->visit_status == 'Not Registered')
                      
                      <a href="javascript:void(0)" class="red-btn-radius my-1">{{$lisst->visit_status}}</a>
                      
                @elseif($lisst->visit_status == 'Visited')
                
			        <a href="javascript:void(0)" class="deepGreen-btn-radius my-1">{{$lisst->visit_status}}</a>
			        
			    @else
                    
                    <a href="javascript:void(0)" class="yellow-btn-radius my-1">{{$lisst->visit_status}}</a>
                    
                @endif
			    
			    
			    
				
				<a href="{{route('details-visit-report',base64_encode($lisst->id))}}" class="green-btn my-1">View Report</a> 

				<br>
				<a href="#" class="deepGreen-btn-radius" data-bs-toggle="modal" data-bs-target="#myModal_<?php echo $sll; ?>" data-bs-backdrop="static" data-bs-keyboard="false">Action</a>
                    
                      <div class="modal" id="myModal_<?php echo $sll; ?>">
                        <div class="modal-dialog">
                          <div class="modal-content">
                      
                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title"><img src="{{asset('assets/assets/img/sikshapedia.png')}}" style="width:50%"></h4>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                      
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="row">

                                    <div class="col-md-12">
										<strong><h3>Update remarks of {{ $orggt->organization_name}} </h3></strong>
										<hr>
										<br>
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
                                <form action="{{ route('visit-register.updatestatus')}}" method="post" class="needs-validation @if ($errors->any()) was-validated @endif" novalidate>
                                @csrf

                                <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group pb-3">
                                                <div class="d-flex justify-content-between mb-2" >
                                                    <label for="forl-label">Date</label>
                                                    <div class="text-danger asterik text-end mb-0 pb-0">*</div>
                                                </div>
                                            <input type="hidden" name="visit_id"  value="{{$lisst->id}}"/>
                                            <input class="form-control round-input"
                                            type="date" name="date" min="{{ date('d-m-Y')}}"   class="form-control" id="contact_person_mobile2" placeholder="Contact person mobile"  value="{{ old('date') }}" required="required" />
                                            
                                            <div class="invalid-feedback">
                                                Please enter date
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group pb-3">
                                                <div class="d-flex justify-content-between mb-2" >
                                                    <label for="forl-label">Select Status</label>
                                                    <div class="text-danger asterik text-end mb-0 pb-0">*</div>
                                                </div>

                                                <select class="form-control round-input" name="status" required="required">
                                                    <option value="">Select Status</option>
                            						<option value="Positive Meeting"  @if(old('status') == 'Positive Meeting')Selected @endif>Positive Meeting</option>
                            						<option value="Very Interested" @if(old('status') == 'Very Interested')Selected @endif>Very Interested</option>
                            						<option value="Interested But Not Sure" @if(old('status') == 'Interested But Not Sure')Selected @endif>Interested But Not Sure</option>
                            						<option value="Asked to Visit Again" @if(old('status') == 'Asked to Visit Again')Selected @endif>Asked to Visit Again</option>
                            						<option value="Not Interested" @if(old('status') == 'Not Interested')Selected @endif>Not Interested</option>
                            						<option value="Next Follow up" @if(old('status') == 'Next Follow up')Selected @endif>Next Follow up</option>
                            						<option value="Long Time Ph not Received" @if(old('status') == 'Long Time Ph not Received')Selected @endif>Long Time Ph not Received</option>
                            						<option value="Appointment Booked" @if(old('status') == 'Appointment Booked')Selected @endif>Appointment Booked</option>
                            						<option value="Visited" @if(old('status') == 'Visited')Selected @endif>Visited</option>
                            						<option value="Re-Visit" @if(old('status') == 'Re-Visit')Selected @endif>Re-Visit</option>
                                                         
                                                    
                                                </select>
                                                
                                                
                                            
                                            <div class="invalid-feedback">
                                                Please enter status
                                            </div>
                                            </div>
                                        </div>



                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group pb-3">
                                            <div class="d-flex justify-content-between mb-2" >
                                                <label for="forl-label">Note</label>
                                                <div class="text-danger asterik text-end mb-0 pb-0">*</div>
                                            </div>
                                        <textarea class="form-control round-input" name="remarks" placeholder="please enter note" rows="5" cols="10" required="required"></textarea>
                                        <div class="invalid-feedback">
                                            Please enter remarks
                                        </div>
                                        </div>
                                    </div>
                                </div>

                             
                            </div>
                      
                            <!-- Modal footer -->
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-primary menu"  style="float:left;">Submit</button>
                            </div>
                            </form>
                          </div>
                        </div>
                      </div>
				
			</td>
		 </tr>
		  @php($sll++)
		  @endforeach
		  
		  <tbody>

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
	imgInp.onchange = evt => {
		const [file] = imgInp.files
		if (file) {
			blah.src = URL.createObjectURL(file)
		}
	}
	function get_college_info_Details(){
	   var college_id = $("#institute_name").val();
  
	   //e.preventDefault();
		$.ajaxSetup({
		  headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
	   
		$.ajax({
		  url: "{{ route('get-institute-details') }}",
		  type: 'POST',
		  data: {
			college_id: $("#institute_name").val(),
			
		   },
		 success: function(result){
		   
		   
		   if(result.success == 1){
			//console.log(result.data['name']);
			$("#contact_person_name").val(result.data.contact_person_name);
			$("#mobile_1").val(result.data.contact_person_mobile);
			$("#mobile_2").val(result.data.contact_person_mobile2);
			$("#institution_address").val(result.data.organization_address);
  
		   }else{
  
			$("#contact_person_name").val();
			$("#mobile_1").val();
			$("#mobile_2").val();
			$("#institution_address").val();
  
		   }
  
		   
  
		 }});
	   
	}
 
	function getDistrict(){
	   var state_name = $("#state_id").val();
  
	   //e.preventDefault();
		$.ajaxSetup({
		  headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
	   
		$.ajax({
		  url: "{{ route('get-district-details') }}",
		  type: 'POST',
		  data: {
			state_name: $("#state_id").val(),
			
		   },
		 success: function(result){
		   
		  
  
		   if(result.success == 1){
			
			$("#district_id").html(result.data);
  
		   }else{
			
			$("#district_id").html(result.data);
			
  
		   }
  
		   
  
		 }});
	   
	}
  </script>
<script>
   // $(document).ready(function() {
        
    //});
</script>
@endsection