<form action="{{ route('save-personal-details')}}" method="post" enctype="multipart/form-data" class="needs-validation @if ($errors->any()) was-validated @endif" novalidate>
    @csrf
<div class="row">
    <div class="col-lg-4">
        <div class="form-group pb-3">
            <div class="d-flex justify-content-between mb-2" >
                <label for="forl-label">Candidate Name</label>
                <div class="text-danger asterik text-end mb-0 pb-0">*</div>
            </div>
            
            <input required="required" id="candidate_name" name="candidate_name" type="text"
              class="form-control round-input " placeholder="Candidate name" readonly="readonly" value="@if(isset($personal_details->candidate_name)){{$personal_details->candidate_name}} @endif" />

              <div class="invalid-feedback">
                  Please enter candidate name .
              </div>
              @if ($errors->has('candidate_name'))
                                
                <div class="invalid-feedback"  >
                    {{ $errors->first('candidate_name') }}
                </div>
            @endif

        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group pb-3">
            <div class="d-flex justify-content-between mb-2" >
                <label for="forl-label">Father's Name</label>
                <div class="text-danger asterik text-end mb-0 pb-0">*</div>
            </div>
              
              <input required="required" id="father_name" name="father_name" type="text"
                class="form-control round-input " placeholder="Father's name" value="{{ old('father_name') }}" />

                <div class="invalid-feedback">
                    Please enter father's name.
                </div>

                @if ($errors->has('father_name'))
                                
                <div class="invalid-feedback"  >
                    {{ $errors->first('father_name') }}
                </div>
                @endif

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
            <div class="d-flex justify-content-between mb-2" >
                <label for="forl-label">Mother's Name</label>
                <div class="text-danger asterik text-end mb-0 pb-0">*</div>
            </div>
              
              <input required="required" id="mother_name" name="mother_name" type="text"
                class="form-control round-input " placeholder="Mother's name" value="{{ old('mother_name') }}" />

            <div class="invalid-feedback">
                    Please enter mother's name.
            </div>

            @if ($errors->has('mother_name'))
                                
                <div class="invalid-feedback"  >
                    {{ $errors->first('mother_name') }}
                </div>
            @endif

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
            <div class="d-flex justify-content-between mb-2" >
                  <label for="forl-label">Date of Birth</label>
                  <div class="text-danger asterik text-end mb-0 pb-0">*</div>
            </div>
              
              <input required="required" id="dob" name="dob" type="date"
                class="form-control round-input " placeholder="Date of birth" value="{{ old('dob') }}" />

            <div class="invalid-feedback">
                    Please enter date of birth.
            </div>

            @if ($errors->has('dob'))
                                
                <div class="invalid-feedback"  >
                    {{ $errors->first('dob') }}
                </div>
            @endif

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
            <div class="d-flex justify-content-between mb-2" >
                <label for="forl-label">Place of Birth</label>
                <div class="text-danger asterik text-end mb-0 pb-0">*</div>
            </div>
              
              <input required="required" id="birth_place" name="birth_place" type="text"
                class="form-control round-input " placeholder="Place of birth" value="{{ old('birth_place') }}" />

            <div class="invalid-feedback">
                    Please enter date of birth.
            </div>

            @if ($errors->has('birth_place'))
                                
                <div class="invalid-feedback"  >
                    {{ $errors->first('birth_place') }}
                </div>
            @endif

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
            <div class="d-flex justify-content-between mb-2" >
                  <label for="forl-label">Gender</label>
                  
            </div>
              
            <select class="form-select round-input" id="gender"  name="gender" required="">
                <option value="">Select Gender</option>
                
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Others">Others</option>
                
            </select>

            @if ($errors->has('gender'))
                                
                <div class="invalid-feedback"  >
                    {{ $errors->first('gender') }}
                </div>
            @endif
                

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
            <div class="d-flex justify-content-between mb-2" >
                  <label for="forl-label">Blood Group</label>
                  <div class="text-danger asterik text-end mb-0 pb-0">*</div>
            </div>
              
            <select class="form-select round-input" id="blood_group"  name="blood_group" required="required">
                <option value="">Select Blood Group</option>
                
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
                
            </select>

            <div class="invalid-feedback">
                    Please select blood group.
            </div>

            @if ($errors->has('blood_group'))
                                
                <div class="invalid-feedback"  >
                    {{ $errors->first('blood_group') }}
                </div>
            @endif
                

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
            <div class="d-flex justify-content-between mb-2" >
                  <label for="forl-label">Maritial Status</label>
                  <div class="text-danger asterik text-end mb-0 pb-0">*</div>
            </div>
              
            <select class="form-select round-input" id="martial_status"  name="martial_status" required="required">
                <option value="">Select Martial Status</option>
                
                <option value="Married">Married</option>
                <option value="Not Married">Not Married</option>
                
                
            </select>

            <div class="invalid-feedback">
                    Please select martial status
            </div>

            @if ($errors->has('martial_status'))
                                
                <div class="invalid-feedback"  >
                    {{ $errors->first('martial_status') }}
                </div>
            @endif
                

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
            <div class="d-flex justify-content-between mb-2" >
                  <label for="forl-label">Spouce Name</label>
                  <div class="text-danger asterik text-end mb-0 pb-0">*</div>
            </div>
              
              <input  id="spouce_name" name="spouce_name" type="text"
                class="form-control round-input " placeholder="Spouce Name" value="{{ old('spouce_name') }}" />

                

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
            <div class="d-flex justify-content-between mb-2" >
                  <label for="forl-label">Nationality</label>
                  <div class="text-danger asterik text-end mb-0 pb-0">*</div>
            </div>
              
            <select class="form-select round-input" id="nationality"  name="nationality" required="required">
                
                
                <option value="Indian">Indian</option>
                
            </select>

            <div class="invalid-feedback">
                    Please select nationality
            </div>
                

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
            <div class="d-flex justify-content-between mb-2" >
                  <label for="forl-label">Religion</label>
                  <div class="text-danger asterik text-end mb-0 pb-0">*</div>
            </div>
              
            <select class="form-select round-input" id="religion"  name="religion" required="required">
                <option value="">Religion</option>
                
                <option value="Hinduism">Hinduism</option>
                <option value="Islam">Islam</option>
                <option value="Christianity">Christianity</option>
                <option value="Sikhism">Sikhism</option>
                <option value="Buddhism">Buddhism</option>
                <option value="Jains">Jains</option>
                
            </select>

            <div class="invalid-feedback">
                    Please select nationality
            </div>

            @if ($errors->has('religion'))
                                
                <div class="invalid-feedback">
                    {{ $errors->first('religion') }}
                </div>
            @endif
                

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
            <div class="d-flex justify-content-between mb-2" >
                  <label for="forl-label">Cast</label>
                  <div class="text-danger asterik text-end mb-0 pb-0">*</div>
            </div>
              
            <select class="form-select round-input" id="cast"  name="cast" required="required">
                <option value="">Cast</option>
                
                <option value="General">General</option>
                <option value="OBC-A">OBC-A</option>
                <option value="OBC-B">OBC-B</option>
                <option value="SC">SC</option>
                <option value="ST">ST</option>
                
                
            </select>

            <div class="invalid-feedback">
                    Please select nationality
            </div>

            @if ($errors->has('cast'))
                                
                <div class="invalid-feedback">
                    {{ $errors->first('cast') }}
                </div>
            @endif
                

        </div>
    </div>
    <div class="col-lg-12">
        <strong>
                Present Address
        </strong>
    </div>

</div>
<div class="row">    
    <div class="col-lg-4">
        <div class="form-group pb-3">
            <div class="d-flex justify-content-between mb-2" >
                <label for="forl-label">House no./Flat no./Building name</label>
                <div class="text-danger asterik text-end mb-0 pb-0">*</div>
            </div>
            
            <input  id="house_name" name="house_name" type="text" required="required"
                class="form-control round-input " placeholder="House no./Flat no./Building name" value="{{ old('house_name') }}" />

                <div class="invalid-feedback">
                   Enter House no/Flat no/Building name
                </div> 
                
                @if ($errors->has('house_name'))
                                
                <div class="invalid-feedback">
                    {{ $errors->first('house_name') }}
                </div>
            @endif

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
            <div class="d-flex justify-content-between mb-2" >
                <label for="forl-label">Street name/Locality Name</label>
                <div class="text-danger asterik text-end mb-0 pb-0">*</div>
            </div>
            
            <input  id="locality_name" name="locality_name" type="text" required="required"
                class="form-control round-input " placeholder="Street name/Locality Name" value="{{ old('locality_name') }}" />

            <div class="invalid-feedback">
                Enter street name /Locality name
            </div> 
            
            @if ($errors->has('locality_name'))
                                
                <div class="invalid-feedback">
                    {{ $errors->first('locality_name') }}
                </div>
            @endif

        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group pb-3">
            <div class="d-flex justify-content-between mb-2" >
                <label for="forl-label">Post Office</label>
                <div class="text-danger asterik text-end mb-0 pb-0">*</div>
            </div>
            
            <input  id="post_office" name="post_office" type="text" required="required"
                class="form-control round-input " placeholder="Post office" value="{{ old('post_office') }}" />

                <div class="invalid-feedback">
                    Enter post office name
                 </div> 
                 
                 @if ($errors->has('post_office'))
                                
                    <div class="invalid-feedback">
                        {{ $errors->first('post_office') }}
                    </div>
                    @endif

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
            <div class="d-flex justify-content-between mb-2" >
                <label for="forl-label">Nearest Land Mark</label>
                <div class="text-danger asterik text-end mb-0 pb-0">*</div>
            </div>
            
            <input  id="nearest_land_mrk" name="nearest_land_mrk" type="text" required="required"
                class="form-control round-input " placeholder="Nearest land mark" value="{{ old('nearest_land_mrk') }}" />

                <div class="invalid-feedback">
                    Enter nearest land mark
                 </div> 
                 
                 @if ($errors->has('nearest_land_mrk'))
                                
                 <div class="invalid-feedback">
                     {{ $errors->first('nearest_land_mrk') }}
                 </div>
                 @endif

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
            <div class="d-flex justify-content-between mb-2" >
                <label for="forl-label">State</label>
                <div class="text-danger asterik text-end mb-0 pb-0">*</div>
            </div>
            
            <select class="form-select round-input" id="state_id"  name="state" required="required" onchange="getDistrict()">
                    <option value="">select state</option>
                    @foreach($state_list as $statel)
                    <option value="{{$statel->State}}">{{$statel->State}}</option>
                    @endforeach
            </select> 
            
            <div class="invalid-feedback">
               Please select state
             </div>

             @if ($errors->has('state'))
                                
                 <div class="invalid-feedback">
                     {{ $errors->first('state') }}
                 </div>
                 @endif

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
            <div class="d-flex justify-content-between mb-2" >
                <label for="forl-label">District</label>
                <div class="text-danger asterik text-end mb-0 pb-0">*</div>
            </div>
            
            <select class="form-select round-input" id="district_id"  name="district" required="required">
                <option value="">select district</option>
            </select> 
            
            <div class="invalid-feedback">
               Please select district
             </div>
             @if ($errors->has('district'))
                                
             <div class="invalid-feedback">
                 {{ $errors->first('district') }}
             </div>
             @endif

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
            <div class="d-flex justify-content-between mb-2" >
                <label for="forl-label">Town</label>
                <div class="text-danger asterik text-end mb-0 pb-0">*</div>
            </div>
            
            <input  id="nearest_land_mrk" name="town" type="town" required="required"
                class="form-control round-input " placeholder="Enter City or Town name" value="{{ old('nearest_land_mrk') }}" />

                <div class="invalid-feedback">
                    Please enter city/Town
                 </div> 
                 
                 @if ($errors->has('town'))
                                
                 <div class="invalid-feedback">
                     {{ $errors->first('town') }}
                 </div>
                 @endif

        </div>
    </div>


    <div class="col-lg-4">
        <div class="form-group pb-3">
            <div class="d-flex justify-content-between mb-2" >
                <label for="forl-label">Pincode</label>
                <div class="text-danger asterik text-end mb-0 pb-0">*</div>
            </div>
            
            <input  id="pincode" name="pincode" type="number" required="required"
                class="form-control round-input " placeholder="Enter pincode" value="{{ old('pincode') }}" />

                <div class="invalid-feedback">
                    Please enter pincode
                 </div>  
                 
                 @if ($errors->has('pincode'))
                                
                 <div class="invalid-feedback">
                     {{ $errors->first('pincode') }}
                 </div>
                 @endif


        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
            <div class="d-flex justify-content-between mb-2" >
                <label for="forl-label">Police Station</label>
                <div class="text-danger asterik text-end mb-0 pb-0">*</div>
            </div>
            
            <input  id="police_station" name="police_station" type="town" required="required"
                class="form-control round-input " placeholder="Enter police station" value="{{ old('police_station') }}" />

                <div class="invalid-feedback">
                    Please enter police station
                 </div> 
                 
                 @if ($errors->has('police_station'))
                                
                 <div class="invalid-feedback">
                     {{ $errors->first('police_station') }}
                 </div>
                 @endif

        </div>
    </div>

    <div class="col-lg-12">
        <strong>
            Permanent Address
        </strong>
    </div>

    <div class="col-lg-12">
        <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="same_as_present">
                <label class="form-check-label" for="flexCheckDefault">
                 Same as Present Address
                </label>
        </div>
    </div>

</div>

<div class="row">
    
    <div class="col-lg-4">
        <div class="form-group pb-3">
            <div class="d-flex justify-content-between mb-2" >
                <label for="forl-label">House no./Flat no./Building name</label>
                <div class="text-danger asterik text-end mb-0 pb-0">*</div>
            </div>
        
            <input  id="permanent_house_name" name="permanent_house_name" type="text" required="required"
            class="form-control round-input " placeholder="House no./Flat no./Building name" value="{{ old('permanent_house_name') }}" />

            <div class="invalid-feedback">
               Enter House no/Flat no/Building name
            </div> 
            
            @if ($errors->has('permanent_house_name'))
                                
                 <div class="invalid-feedback">
                     {{ $errors->first('permanent_house_name') }}
                 </div>
            @endif


        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">Street name/Locality Name</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="permanent_locality_name" name="permanent_locality_name" type="text" required="required"
            class="form-control round-input " placeholder="Street name/Locality Name" value="{{ old('permanent_locality_name') }}" />

            <div class="invalid-feedback">
                Enter street name /Locality name
             </div> 
             
             @if ($errors->has('permanent_locality_name'))
                                
             <div class="invalid-feedback">
                 {{ $errors->first('permanent_locality_name') }}
             </div>
            @endif

        </div>
    </div>

    
    


    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">Post Office</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="permanent_post_office" name="permanent_post_office" type="text" required="required"
            class="form-control round-input " placeholder="Post office" value="{{ old('permanent_post_office') }}" />

            <div class="invalid-feedback">
                Enter post office name
             </div> 
             
             @if ($errors->has('permanent_post_office'))
                                
             <div class="invalid-feedback">
                 {{ $errors->first('permanent_post_office') }}
             </div>
            @endif

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">Nearest Land Mark</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="permanent_nearest_land_mrk" name="permanent_nearest_land_mrk" type="text" required="required"
            class="form-control round-input " placeholder="Nearest Land mark" value="{{ old('permanent_nearest_land_mrk') }}" />

            <div class="invalid-feedback">
                Enter nearest land mark
             </div>   
             
             @if ($errors->has('permanent_nearest_land_mrk'))
                                
             <div class="invalid-feedback">
                 {{ $errors->first('permanent_nearest_land_mrk') }}
             </div>
            @endif

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">State</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <select class="form-select round-input" id="permanent_state"  name="permanent_state" required="required" onchange="getPermanentDistrict()">
            <option value="">select state</option>
                @foreach($state_list as $statel)
                <option value="{{$statel->State}}">{{$statel->State}}</option>
                @endforeach
        </select> 
        
        <div class="invalid-feedback">
           Please select state
         </div>

            @if ($errors->has('permanent_state'))
                                    
                <div class="invalid-feedback">
                    {{ $errors->first('permanent_state') }}
                </div>
            @endif

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">District</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <select class="form-select round-input" id="permanent_district"  name="permanent_district" required="required">
            <option value="">select district</option>
        </select> 
        
        <div class="invalid-feedback">
           Please select district
         </div>

         @if ($errors->has('permanent_district'))
                                    
         <div class="invalid-feedback">
             {{ $errors->first('permanent_district') }}
         </div>
         @endif

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">Town</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="permanent_town" name="permanent_town" type="text" required="required"
            class="form-control round-input " placeholder="Enter City or Town name" value="{{ old('permanent_town') }}" />

            <div class="invalid-feedback">
                Please enter city/Town
             </div>  
             
             @if ($errors->has('permanent_town'))
                                    
                <div class="invalid-feedback">
                    {{ $errors->first('permanent_town') }}
                </div>
             @endif

        </div>
    </div>


    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">Pincode</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="permanent_pincode" name="permanent_pincode" type="number" required="required"
            class="form-control round-input " placeholder="Enter pincode" value="{{ old('permanent_pincode') }}" />

            <div class="invalid-feedback">
                Please enter pincode
             </div> 
             
             @if ($errors->has('permanent_pincode'))
                                    
             <div class="invalid-feedback">
                 {{ $errors->first('permanent_pincode') }}
             </div>
            @endif

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">Police Station</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="permanent_police_station" name="permanent_police_station" type="text" required="required"
            class="form-control round-input " placeholder="Enter police station" value="{{ old('permanent_police_station') }}" />

            <div class="invalid-feedback">
                Please enter Police Station
             </div>  
             
             @if ($errors->has('permanent_police_station'))
                                    
             <div class="invalid-feedback">
                 {{ $errors->first('permanent_police_station') }}
             </div>
            @endif

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">PAN Number</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="pan_number" name="pan_number" type="number" required="required"
            class="form-control round-input " placeholder="PAN card number" value="{{ old('pan_number') }}" />

            <div class="invalid-feedback">
                Please enter PAN Number
             </div> 
             
             @if ($errors->has('pan_number'))
                                    
             <div class="invalid-feedback">
                 {{ $errors->first('pan_number') }}
             </div>
            @endif

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">AADHAAR Number</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="aadhaar" name="aadhaar" type="number" required="required"
            class="form-control round-input " placeholder="AADHAAR card Number" value="{{ old('aadhaar') }}" />

            <div class="invalid-feedback">
                Please enter AADHAAR Number
             </div> 
             
             @if ($errors->has('aadhaar'))
                                    
             <div class="invalid-feedback">
                 {{ $errors->first('aadhaar') }}
             </div>
            @endif

        </div>
    </div>


    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">Mobile Number</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="mobile" name="mobile" type="text" required="required"
            class="form-control round-input " placeholder="10 digit mobile number" readonly="readonly" value="@if(isset($personal_details->mobile_number)){{$personal_details->mobile_number}} @endif" />

            <div class="invalid-feedback">
                Please enter 10 digit Mobile number
             </div>
             
             @if ($errors->has('mobile'))
                                    
             <div class="invalid-feedback">
                 {{ $errors->first('mobile') }}
             </div>
            @endif

        </div>
    </div>


    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">E-mail</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="email" name="email" type="email" required="required"
            class="form-control round-input " placeholder="Email address" readonly="readonly" value="@if(isset($personal_details->email_id)){{$personal_details->email_id}} @endif" />

            <div class="invalid-feedback">
                Please enter Email Address
             </div> 
             @if ($errors->has('email'))
                                    
             <div class="invalid-feedback">
                 {{ $errors->first('email') }}
             </div>
            @endif
             

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">Emergency Contact number</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="emergency" name="emergency" type="number" required="required"
            class="form-control round-input " placeholder="Emergency contact number" value="{{ old('emergency') }}" />
           
            <div class="invalid-feedback">
                Please enter Emergency contact number
             </div> 
             
             @if ($errors->has('emergency'))
                                    
             <div class="invalid-feedback">
                 {{ $errors->first('emergency') }}
             </div>
            @endif

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">Parent's/Spouce Mobile Number</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="spouce_number" name="spouce_number" type="number" required="required"
            class="form-control round-input " placeholder="Parent's/Spouce mobile number" value="{{ old('spouce_number') }}" />

            <div class="invalid-feedback">
                Please enter Emergency contact number
             </div> 
             
             @if ($errors->has('spouce_number'))
                                    
             <div class="invalid-feedback">
                 {{ $errors->first('spouce_number') }}
             </div>
            @endif

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">Reference person Name</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="reference_person" name="reference_person" type="text" required="required"
            class="form-control round-input " placeholder="Reference person name" value="{{ old('reference_person') }}" />

            <div class="invalid-feedback">
                Please enter Reference Name
             </div>    
             @if ($errors->has('reference_person'))
                                    
             <div class="invalid-feedback">
                 {{ $errors->first('reference_person') }}
             </div>
            @endif
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">Reference Contact Number</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="reference_contact_number" name="reference_contact_number" type="number" required="required"
            class="form-control round-input " placeholder="Reference person contact number" value="{{ old('reference_contact_number') }}" />

            <div class="invalid-feedback">
                Please enter Reference Contact number
             </div>    
             @if ($errors->has('reference_contact_number'))
                                    
             <div class="invalid-feedback">
                 {{ $errors->first('reference_contact_number') }}
             </div>
            @endif
        </div>
    </div>

    <div class="col-lg-12">
        <strong>
            Uploads Documents
        </strong><span style="color:#ea5c39;">(FILE SIZE 100KB, FILE FORMAT JPEG, PNG)</span>
    </div>

   

    
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">UPLOAD PAN CARD</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="upload_pan_card" name="upload_pan_card" type="file" required="required" onchange="uploadFiles(this.id)"
            class="form-control round-input "/>
            <span class="text-primary" id="previous_upload_pan_card">
            @if($personal_details->uploaded_pan_card !='' || $personal_details->uploaded_pan_card != null )
                <a style="text-decoration: none !important;" target="_blank" href="{{asset('storage/app/public/personal_Details/pan_card/'.$personal_details->uploaded_pan_card) }}" >Previous uploaded PAN card</a>
            @endif

            </span>
            
            <div class="invalid-feedback">
                Please upload pan card
            </div>    
            @if ($errors->has('upload_pan_card'))
                                    
             <div class="invalid-feedback">
                 {{ $errors->first('upload_pan_card') }}
             </div>
            @endif
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">UPLOAD AADHAAR CARD</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="upload_adhaar_card" name="upload_adhaar_card" type="file" required="required" onchange="uploadFiles(this.id)"
            class="form-control round-input " />
            <span class="text-primary" id="previous_upload_adhaar_card">
                @if($personal_details->uploaded_adhaar_card !='' || $personal_details->uploaded_adhaar_card != null )
                    <a style="text-decoration: none !important;" target="_blank" href="{{asset('storage/app/public/personal_details/adhar_card/'.$personal_details->uploaded_adhaar_card) }}" >Previous uploaded ADHAAR card</a>
                @endif
            </span>
            <div class="invalid-feedback">
                Please upload adhaar card
            </div> 
            
            @if ($errors->has('upload_adhaar_card'))
                                    
             <div class="invalid-feedback">
                 {{ $errors->first('upload_adhaar_card') }}
             </div>
            @endif

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">UPLOAD PHOTO</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>

        
        <input  id="upload_photo" name="upload_photo" type="file" required="required" onchange="uploadFiles(this.id)"
            class="form-control round-input " />
            <span class="text-primary" id="previous_upload_photo">
                @if($personal_details->uploaded_photo !='' || $personal_details->uploaded_photo != null )
                    <a style="text-decoration: none !important;" target="_blank" href="{{asset('storage/app/public/personal_details/photo/'.$personal_details->uploaded_photo) }}" >Previous uploaded photo</a>
                @endif
            </span>
            <div class="invalid-feedback">
                Please upload your photo
            </div> 
            
            @if ($errors->has('upload_photo'))
                                    
             <div class="invalid-feedback">
                 {{ $errors->first('upload_photo') }}
             </div>
            @endif

        </div>
    </div>

</div>
<div class="row">
    <div class="col-lg-12">
        <center>
            <div class="form-group  pb-sm">
                <div class="text-danger asterik text-end mb-0 pb-0 d-mobileNone "></div>
                <button type="submit" class="btn btn-primary menu menu-big "
                  id="lead_callregister"> Save & Next </button>
              </div>
        </center>
    </div>
  </div>
</form>

<script>
    function getDistrict(){
	   var state_name = $("#state_id").val();
  
	   //e.preventDefault();
		$.ajaxSetup({
		  headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
	   
		$.ajax({
		  url: "{{ route('get-district-list') }}",
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
    function getPermanentDistrict(){
	   var state_name = $("#permanent_state").val();
  
	   //e.preventDefault();
		$.ajaxSetup({
		  headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
	   
		$.ajax({
		  url: "{{ route('get-district-list') }}",
		  type: 'POST',
		  data: {
			state_name: $("#permanent_state").val(),
			
		   },
		 success: function(result){
		   
		  
  
		   if(result.success == 1){
			
			$("#permanent_district").html(result.data);
  
		   }else{
			
			$("#permanent_district").html(result.data);
			
  
		   }
  
		   
  
		 }});
	   
	}

    function uploadFiles(id){
	   //var fileid = $(this).val();

       
       var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        if(id == 'upload_pan_card'){

            var filety = 'pan_card';
            var ff = 'PAN Card';
        }else if(id == 'upload_adhaar_card'){
            var filety = 'adhar_card';
            var ff = 'ADHAAR Card';

        }else if(id == 'upload_photo'){
            var filety = 'photo';

            var ff = 'Photo';

        }
       
  
	   // Get the selected file
       var files = $('#'+id)[0].files;

                if(files.length > 0){
                    var fd = new FormData();

                    // Append data 
                    fd.append('file',files[0]);
                    fd.append('_token',CSRF_TOKEN);
                    fd.append('filetype',filety);

                    // Hide alert 
                    $('#responseMsg').hide();

                    // AJAX request 
                    $.ajax({
                        url: "{{ route('uploadFile') }}",
                        method: 'post',
                        data: fd,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(response){
                            
                            if(response.success == 1){


                                toastr.success(ff+" has been uploaded successfully", "Success", {
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

                                $("#previous_"+id).html('<a style="text-decoration: none !important;" target="_blank" href="'+response.filepath+'">Previous uploaded '+ff+' </a>');

                            }else{

                                toastr.error(response.message, "Error!", {
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

                            $("#previous_"+id).html();
                            $('#'+id).val('');


                            }
                       },
                        error: function(response){
                                console.log("error : " + JSON.stringify(response) );
                        }
                    });
                }else{
                    alert("Please select a file.");
                }

	   
	}

    
</script>