<form action="{{ route('call-register.store-agent-data')}}" method="post" class="needs-validation @if ($errors->any()) was-validated @endif" novalidate>
    @csrf
<div class="row">
    <div class="col-lg-12">
        <strong>Bank Account Details</strong>
    </div>
    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">Account name</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="board_name" name="board_name" type="text" required="required"
            class="form-control round-input " placeholder="Account naame" value="{{ old('board_name') }}" />

            <div class="invalid-feedback">
                Please enter board name
             </div>    

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">Bank Name</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="passing_year" name="passing_year" type="text" required="required"
            class="form-control round-input " placeholder="Bank name" value="{{ old('passing_year') }}" />

            <div class="invalid-feedback">
                Please enter passing year
             </div>    

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">Branch Name</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="reference_contact_number" name="reference_contact_number" type="number" required="required"
            class="form-control round-input " placeholder="Branch name" value="{{ old('reference_contact_number') }}" />

            <div class="invalid-feedback">
                Please enter total marks
             </div>    

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">IFSC Code</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="marks_ontain" name="marks_ontain" type="text" required="required"
            class="form-control round-input " placeholder="IFSC Code" value="{{ old('marks_ontain') }}" />

            <div class="invalid-feedback">
                Please enter marks obtain
             </div>    

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">Account number</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="percentage" name="percentage" type="text"  redobly="readonly" required="required"
            class="form-control round-input " placeholder="Account number" value="{{ old('percentage') }}" />

            <div class="invalid-feedback">
                Please enter percentage
             </div>    

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">Account type</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="reg_no" name="reg_no" type="number" required="required"
            class="form-control round-input " placeholder="Account type(Saving/Current)" value="{{ old('reg_no') }}" />

            <div class="invalid-feedback">
                Please enter registration no
             </div>    

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">UPLOAD BANK DETAILS</label>
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
            <label for="forl-label">6 MONTHS STATEMENT SHOWING SALARY</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="reference_person" name="reference_person" type="file" required="required"
            class="form-control round-input " />

            <div class="invalid-feedback">
                Please enter marksheet
             </div>    

        </div>
    </div>

    


</div>
<div class="row">
    <div class="col-lg-12">
        <center>

            <div class="form-group  pb-sm">
                <div class="text-danger asterik text-end mb-0 pb-0 d-mobileNone "></div>
                <button type="submit" class="btn btn-primary menu menu-big"
                  id="lead_callregister"> Save & Next </button>
              </div>
        </center>
    </div>
</div>

</form>