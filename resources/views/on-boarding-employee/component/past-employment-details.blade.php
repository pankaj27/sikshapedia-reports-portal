<form action="{{ route('call-register.store-agent-data')}}" method="post" class="needs-validation @if ($errors->any()) was-validated @endif" novalidate>
    @csrf
<div class="row">
    <div class="col-lg-12">
        <strong>Past Employment Details</strong>
    </div>
    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">Company Name</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="board_name" name="board_name" type="text" required="required"
            class="form-control round-input " placeholder="Board naame" value="{{ old('board_name') }}" />

            <div class="invalid-feedback">
                Please enter board name
             </div>    

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">Brand name</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="passing_year" name="passing_year" type="text" required="required"
            class="form-control round-input " placeholder="Passing year" value="{{ old('passing_year') }}" />

            <div class="invalid-feedback">
                Please enter passing year
             </div>    

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">Joining Date</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="passing_year" name="passing_year" type="text" required="required"
            class="form-control round-input " placeholder="Passing year" value="{{ old('passing_year') }}" />

            <div class="invalid-feedback">
                Please enter passing year
             </div>    

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">Releasing Date</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="passing_year" name="passing_year" type="text" required="required"
            class="form-control round-input " placeholder="Passing year" value="{{ old('passing_year') }}" />

            <div class="invalid-feedback">
                Please enter passing year
             </div>    

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">Reason for Resignation</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="passing_year" name="passing_year" type="text" required="required"
            class="form-control round-input " placeholder="Passing year" value="{{ old('passing_year') }}" />

            <div class="invalid-feedback">
                Please enter passing year
             </div>    

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">Salary per Month</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="passing_year" name="passing_year" type="text" required="required"
            class="form-control round-input " placeholder="Passing year" value="{{ old('passing_year') }}" />

            <div class="invalid-feedback">
                Please enter passing year
             </div>    

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">Post Name</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="passing_year" name="passing_year" type="text" required="required"
            class="form-control round-input " placeholder="Passing year" value="{{ old('passing_year') }}" />

            <div class="invalid-feedback">
                Please enter passing year
             </div>    

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">Posting area</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="passing_year" name="passing_year" type="text" required="required"
            class="form-control round-input " placeholder="Passing year" value="{{ old('passing_year') }}" />

            <div class="invalid-feedback">
                Please enter passing year
             </div>    

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">Reporting to</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="passing_year" name="passing_year" type="text" required="required"
            class="form-control round-input " placeholder="Passing year" value="{{ old('passing_year') }}" />

            <div class="invalid-feedback">
                Please enter passing year
             </div>    

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">Company contact number</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="passing_year" name="passing_year" type="text" required="required"
            class="form-control round-input " placeholder="Passing year" value="{{ old('passing_year') }}" />

            <div class="invalid-feedback">
                Please enter passing year
             </div>    

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">Company email id</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="passing_year" name="passing_year" type="text" required="required"
            class="form-control round-input " placeholder="Passing year" value="{{ old('passing_year') }}" />

            <div class="invalid-feedback">
                Please enter passing year
             </div>    

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">Company website</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="passing_year" name="passing_year" type="text" required="required"
            class="form-control round-input " placeholder="Passing year" value="{{ old('passing_year') }}" />

            <div class="invalid-feedback">
                Please enter passing year
             </div>    

        </div>
    </div>

    

    

    

    
    
    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">UPLOAD APPOINTMENT LETTER</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="reference_person" name="reference_person" type="file" required="required"
            class="form-control round-input " />

            <div class="invalid-feedback">
                Please enter registration
             </div>    

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">UPLOAD RELEASE LETTER</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="reference_person" name="reference_person" type="file" required="required"
            class="form-control round-input " />

            <div class="invalid-feedback">
                Please enter marksheet
             </div>    

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">UPLOAD LAST 3 MONTHS SALARY SLIP</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="reference_person" name="reference_person" type="file" required="required"
            class="form-control round-input " />

            <div class="invalid-feedback">
                Please enter Reference Name
             </div>    

        </div>
    </div>
    <div class="col-lg-12" style="float:right;">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <br>
        </div>
        
        <button type="button" name="add_more_employment" class="btn btn-danger" style="float:right;">ADD MORE EMPLOYMENT</button>   

        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <center>

            <div class="form-group  pb-sm">
                <div class="text-danger asterik text-end mb-0 pb-0 d-mobileNone "></div>
                <button type="button" class="btn btn-primary menu menu-big btn-ok"
                  id="lead_callregister"> Save & Next </button>
              </div>
        </center>
    </div>
</div>
</form>