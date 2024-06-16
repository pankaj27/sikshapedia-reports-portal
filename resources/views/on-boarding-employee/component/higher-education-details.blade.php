<div class="row">
    <div class="col-lg-12">
        <strong>Higher Education Details</strong>
    </div>
    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">Board Name</label>
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
            <label for="forl-label">passing Year</label>
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
            <label for="forl-label">Total Marks</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="reference_contact_number" name="reference_contact_number" type="number" required="required"
            class="form-control round-input " placeholder="Total Marks" value="{{ old('reference_contact_number') }}" />

            <div class="invalid-feedback">
                Please enter total marks
             </div>    

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">Marks obtain</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="marks_ontain" name="marks_ontain" type="text" required="required"
            class="form-control round-input " placeholder="Marks obtain" value="{{ old('marks_ontain') }}" />

            <div class="invalid-feedback">
                Please enter marks obtain
             </div>    

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">Percentage</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="percentage" name="percentage" type="text"  redobly="readonly" required="required"
            class="form-control round-input " placeholder="Percentage" value="{{ old('percentage') }}" />

            <div class="invalid-feedback">
                Please enter percentage
             </div>    

        </div>
    </div>

    

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">Course</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="reg_no" name="reg_no" type="number" required="required"
            class="form-control round-input " placeholder="Course" value="{{ old('reg_no') }}" />

            <div class="invalid-feedback">
                Please enter registration no
             </div>    

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">Stream</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="reg_no" name="reg_no" type="number" required="required"
            class="form-control round-input " placeholder="Stream(Science/Arts/Commerce)" value="{{ old('reg_no') }}" />

            <div class="invalid-feedback">
                Please enter registration no
             </div>    

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">Course Duration</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="course_duration" name="course_duration" type="number" required="required"
            class="form-control round-input " placeholder="Course duration" value="{{ old('reg_no') }}" />

            <div class="invalid-feedback">
                Please enter registration no
             </div>    

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">UPLOAD REGISTRATION</label>
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
            <label for="forl-label">UPLOAD MARKSHEET</label>
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
            <label for="forl-label">UPLOAD CERTIFICATE</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>
        
        <input  id="reference_person" name="reference_person" type="file" required="required"
            class="form-control round-input " />

            <div class="invalid-feedback">
                Please enter Reference Name
             </div>    

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
            <div class="d-flex justify-content-between mb-2" >
                
                <br>
                
            </div>
            
            <button type="button" class="btn btn-danger">ADD MORE EDUCATION</button>

            </div>
       
    </div>
</div>