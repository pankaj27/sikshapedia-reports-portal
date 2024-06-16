<?php use Illuminate\Support\Facades\DB;
?>
@extends('backend.layout.app')
@section('title','Call Register | sikshapedia Sales Portal')
@section('content')
<div class="mainCon">
    


    <div class="d-flex flex-md-row flex-sm-column sm-col justify-content-md-between pb-4">
      <h2 class="heading blue-text">Input Data to Register a Call</h2>
      
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
				<form action="{{route('call-register.store') }}" method="post" class="needs-validation @if ($errors->any()) was-validated @endif" novalidate>
			@else
				<form action="{{ route('call-register.store-agent-data')}}" method="post" class="needs-validation @if ($errors->any()) was-validated @endif" novalidate>
		    @endif

            @csrf
            <div class="row">
              <div class="col-lg-12">
                <div class="row">
                  <div class="col-lg-4">
                    <div class="form-group pb-3">
                      <div class="d-flex justify-content-between mb-2" >
                          <label for="forl-label">Name of the Institute / College</label>
                          <div class="text-danger asterik text-end mb-0 pb-0">*</div>
                      </div>
                      
                      <input required="required" id="organization_name" name="organization_name" type="text"
                        class="form-control round-input " placeholder="Name of the Institute / College" value="{{ old('organization_name') }}" />

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
                  <div class="form-group  pb-sm">
                    <div class="text-danger asterik text-end mb-0 pb-0 d-mobileNone "></div>
                    <button type="submit" class="btn btn-primary menu menu-big"
                      id="lead_callregister"> + Add New Call </button>
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
              <th scope="col"  class="text-center">Status</th>
              <th scope="col"  class="text-center" >Action </th>
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
                            {{$list->organization_name}}
                            
                            <?php 
                                $call_log = DB::table('follow_ups')->where('call_register_id',$list->id)->get();

                                if(count($call_log)==0){
                                  echo '<br><a href="javascript:void(0)" class="green-btn-radius my-1">New Call</a>';
                                }

                                if(isset($call_log) && !empty($call_log)){

                            ?>
                              <a href="javascript:void(0)" class="openFollowupModal" data-bs-toggle="modal" data-bs-target="#leadModal_<?php echo $i; ?>"><img src="{{asset('assets/assets/img/shield.png')}}" alt=""></a>
                              <div class="modal" id="leadModal_<?php echo $i; ?>">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                              
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                      <img src="{{asset('assets/assets/img/sikshapedia.png')}}" alt="" class="modal-logo  ml-3" width="200">
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
                                            <?php if(count($call_log)>0){  $sll = 1;?>
                                              @foreach($call_log as $liostt)
                                                <tr>
                                                    <td>{{$sll}}</td>
                                                    <td>{{$liostt->follow_up_date}}</td>
                                                    <td>{{$liostt->visit_status}}</td>
                                                    <td>{{$liostt->remarks}}</td>
                                                   

                                                </tr>
                                                <?php $sll++; ?>
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
                              

                            <?php 

                                }
                            
                            ?>
                            
                            
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
                <td>
                    
                    <a href="#" class="deepGreen-btn-radius" data-bs-toggle="modal" data-bs-target="#myModal_<?php echo $i; ?>" data-bs-backdrop="static" data-bs-keyboard="false">Action</a>
                    
                      <div class="modal" id="myModal_<?php echo $i; ?>">
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
                                <form action="{{ route('call-register.updatestatus')}}" method="post" class="needs-validation @if ($errors->any()) was-validated @endif" novalidate>
                                @csrf

                                <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group pb-3">
                                                <div class="d-flex justify-content-between mb-2" >
                                                    <label for="forl-label">Date</label>
                                                    <div class="text-danger asterik text-end mb-0 pb-0">*</div>
                                                </div>
                                            <input type="hidden" name="call_reg_id"  value="{{$list->id}}"/>
                                            <input class="form-control round-input"
                                            type="date" name="date" min="1000000000" max="9999999999"  class="form-control" id="contact_person_mobile2" placeholder="Contact person mobile"  value="{{ old('date') }}" required="required" />
                                            
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
                                                    <option value="Appointment Registered">Appointment Registered</option>
                                                    <option value="Positive Meeting">Positive Meeting</option>
                                                    <option value="Very Interested">Very Interested</option>
                                                    <option value="Appointment Registered">Interested But Not Sure</option>
                                                    <option value="Asked to Visit Again">Asked to Visit Again</option>
                                                    <option value="Not Interested">Not Interested</option>
                                                    <option value="Next Followup">Next Followup</option>
                                                    <option value="Long time Ph. not Received">Long time Ph. not Received</option>
                                                    <option value="Appointment Booked">Appointment Booked</option>
                                                    <option value="Visited">Visited</option>
                                                    <option value="Re-Visit">Re-Visit</option>
                                                         
                                                    
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

@endsection