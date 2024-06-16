<?php use Illuminate\Support\Facades\DB;
?>
@extends('backend.layout.app')
@section('title','Book/Register Appointment  | sikshapedia Sales Portal')
@section('content')
<div class="mainCon">
    


    <div class="d-flex flex-md-row flex-sm-column sm-col justify-content-md-between pb-4">
      <h2 class="heading blue-text">Book/Register Appointment</h2>
      
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
         
          
            @if($userRole=='Superadmin')
				<form action="{{route('book-appointment.store') }}" method="post" class="needs-validation @if ($errors->any()) was-validated @endif" novalidate>
			@else
				<form action="{{ route('book-appointment.store-agent-data')}}" method="post" class="needs-validation @if ($errors->any()) was-validated @endif" novalidate>
		    @endif

            @csrf
            <div class="row">
              <div class="col-lg-12">
                <div class="row">
                  <div class="col-lg-4">
                    <div class="form-group pb-3">
                      <div class="d-flex justify-content-between mb-2" >
                          <label for="forl-label">Select Name of the Institute/College</label>
                          <div class="text-danger asterik text-end mb-0 pb-0">*</div>
                      </div>
                      
                      <select class="form-select round-input" id="organization_name"  name="organization_name" required="required" onchange="get_college_info_Details()" >
                      <option value="">Select name of the College/Institute</option>
                      @foreach($college_instlist as $instt)
                      <option value="{{$instt->id}}" @if(old('organization_name') == $instt->id)Selected @endif>{{$instt->organization_name}}</option>
                      @endforeach
                      </select>
                        <div class="invalid-feedback">
                            Please enter Name of the Institute / College.
                        </div>

                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group pb-3">
                      <div class="d-flex justify-content-between mb-2" >
                          <label for="forl-label">Contact Person Name</label>
                          <div class="text-danger asterik text-end mb-0 pb-0">*</div>
                      </div>
                      <input  class="form-control round-input" placeholder="Contact Person Name" required="required" type="text" name="contact_person_name" class="form-control" id="contact_person_name" placeholder="Contact person name" value="{{ old('contact_person_name') }}" />
                      <div class="invalid-feedback">
                        Please enter contact person name.
                      </div>
                    
                    </div>
                  </div>

                </div>

              </div>
            </div>

            <div class="col-lg-12">
              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group pb-3">
                      <div class="d-flex justify-content-between mb-2" >
                          <label for="forl-label">Mobile 1</label>
                          <div class="text-danger asterik text-end mb-0 pb-0">*</div>
                      </div>

                    <input type="number" class="form-control round-input"
                      required="required" name="contact_person_mobile" min="1000000000" max="9999999999"  id="contact_person_mobile" placeholder="Contact person mobile" required="required" value="{{ old('contact_person_mobile') }}" />
                      <div class="invalid-feedback">
                        Please enter mobile 1.
                      </div>
                  
                    </div>
                </div>

                <div class="col-lg-4">
                  <div class="form-group pb-3">
                      <div class="d-flex justify-content-between mb-2" >
                          <label for="forl-label">Mobile 2</label>
                          <div class="text-danger asterik text-end mb-0 pb-0"></div>
                      </div>
                    <input class="form-control round-input"
                    type="number" name="contact_person_mobile2" min="1000000000" max="9999999999"  class="form-control" id="contact_person_mobile2" placeholder="Contact person mobile"  value="{{ old('contact_person_mobile2') }}" />
                    <div class="invalid-feedback">
                        Please enter mobile 2.
                    </div>
                </div>
                </div>

                <div class="col-lg-4">
                  <div class="form-group pb-3">
                      <div class="d-flex justify-content-between mb-2" >
                          <label for="forl-label">Location</label>
                          <div class="text-danger asterik text-end mb-0 pb-0">*</div>
                      </div>
                    <input class="form-control round-input"
                     type="text" name="organization_address" class="form-control" id="organization_address" placeholder="Organization address" required="required" value="{{ old('organization_address') }}" />
                     <div class="invalid-feedback">
                        Please enter location.
                      </div>
                    </div>

                  
                  
                </div>

				<div class="col-lg-4">
					<div class="form-group pb-3">
						<div class="d-flex justify-content-between mb-2" >
							<label for="forl-label">Date</label>
							<div class="text-danger asterik text-end mb-0 pb-0">*</div>
						</div>
					  <input class="form-control round-input"
					   type="date" name="appointment_date" class="form-control" id="appointment_date" placeholder="Organization address" required="required" value="{{ old('appointment_date') }}" />
					   <div class="invalid-feedback">
						  Please enter date.
						</div>
					  </div>
  
					
					
				  </div>

				  <div class="col-lg-4">
					

					  <div class="form-group pb-3">
						<div class="d-flex justify-content-between mb-2" >
							<label for="forl-label">Time</label>
							<div class="text-danger asterik text-end mb-0 pb-0">*</div>
						</div>
						<div class="input-group bootstrap-timepicker timepicker">
							<input id="appointment_time" name="appointment_time" type="text" class="form-control round-input">
							<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
						</div>
						
						<div class="invalid-feedback">
						  Please enter timing.
						</div>

					</div>
  
					
					
				  </div>

				  <div class="col-lg-6">
					<div class="form-group pb-3">
						<div class="d-flex justify-content-between mb-2" >
							<label for="forl-label">Note</label>
							<div class="text-danger asterik text-end mb-0 pb-0">*</div>
						</div>

						<textarea class="form-control round-input" name="remarks" required="required" rows="2" cols="10" placeholder="Enter remarks">{{old('remarks')}}</textarea>
					    <div class="invalid-feedback">
						  Please enter note.
						</div>
					  </div>
  
					
					
				  </div>

                <div class="col-lg-4">
                  <div class="form-group  pb-sm">
                    <div class="text-danger asterik text-end mb-0 pb-0 d-mobileNone "></div>
                    <button type="submit" class="btn btn-primary menu menu-big"
                      id="lead_callregister"> Book Now </button>
                  </div>
                </div>

              </div>
            </div>
        </div>
        </form>
      </div>
    </div>

    <div class="col-12">
      <h2 class="heading blue-text py-3">Call List</h2>

      <div class="table-responsive">
        <table class="table table-bordered tableDark">
          <thead>
            <tr>
              <th scope="col">SL No</th>
              <th scope="col">Date</th>
              <th scope="col">Institute / College Name</th>
              <th scope="col">Contact Person</th>
              <th scope="col">Number 1</th>
              <th scope="col">Number 2</th>
              <th scope="col">Location</th>
              <th scope="col"  class="text-center" >Status/Action </th>
            </tr>
          </thead>
          <tbody>
            @php($i=1)
			@foreach($visitors_list as $list)

            <tr>
                
                <td><span>{{$i}}</span></td>
                
                <td>{{ date('d/m/Y',strtotime($list->created_at))}}</span>
                <td>
                    <div class="products">
                        <div>
                           
                            
                            <?php $orggt = DB::table('call_registers')->where('id',$list->organization_name)->first(); ?>
                            <?php echo $orggt->organization_name ; ?>
                            
                        </div>	
                    </div>
                </td>
                <td>
                    <div class="products">
                        <div>
                        {{$list->contact_person_name}}
                           
                        </div>	
                    </div>
                </td>
                <td>
                    <div class="products">
                        <div>
                            {{$list->contact_person_mobile}}
                            
                        </div>	
                    </div>
                </td>
                <td>
                    <div class="products">
                        <div>
                            
                            {{$list->contact_person_mobile2}}
                            
                        </div>	
                    </div>
                </td>

                <td>
                    <div class="products">
                        <div>
                        {{$list->organization_address}}
                            
                        </div>	
                    </div>
                <td class="text-center">
                     @if($list->visit_status == 'Appointment Registered' || $list->visit_status == 'Appointment Booked')
                      
                      <a href="javascript:void(0)" class="teal-btn-radius my-1">{{$list->visit_status}}</a>
                    @elseif($list->visit_status == 'Not Registered')
                      
                      <a href="javascript:void(0)" class="red-btn-radius my-1">{{$list->visit_status}}</a>
                    @else
                    
                        <a href="javascript:void(0)" class="yellow-btn-radius my-1">{{$list->visit_status}}</a>
                    @endif
                </td>
                
                </tr>

            @php($i++)
            @endforeach

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
  function get_college_info_Details(){
     var college_id = $("#organization_name").val();

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
          college_id: $("#organization_name").val(),
          
         },
       success: function(result){
         
         //const obj = JSON.parse(result.data);
         //console.log(result.success);

         if(result.success == 1){
          //console.log(result.data['name']);
          $("#contact_person_name").val(result.data.contact_person_name);
          $("#contact_person_mobile").val(result.data.contact_person_mobile);
          $("#contact_person_mobile2").val(result.data.contact_person_mobile2);
          $("#organization_address").val(result.data.organization_address);

         }else{

          $("#contact_person_name").val();
          $("#contact_person_mobile").val();
          $("#contact_person_mobile2").val();
          $("#organization_address").val();

         }

         

       }});
     
  }
</script>

@endsection