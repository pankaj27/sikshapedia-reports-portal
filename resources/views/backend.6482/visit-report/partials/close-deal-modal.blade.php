<div class="modal" id="closeDealModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <img src="{{asset('assets/assets/img/sikshapedia.png')}}" alt="" class="modal-logo  ml-3" width="200">
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12"><h3><center>Close Deal</center></h3></div>
            <br><br>
          </div>
          <form action="{{ route('send-proposal')}}" method="post" enctype="multipart/form-data" class="needs-validation @if ($errors->any()) was-validated @endif" novalidate>
            @csrf
            <div class="row">
                <div class="col-lg-6">
                  <div class="form-group pb-3">
                    <div class="d-flex justify-content-between mb-2" >
                      <label for="forl-label">INSTITUTE NAME</label>
                      <div class="text-danger asterik text-end mb-0 pb-0">*</div>
                    </div>
                    
                    <input type="text" name="institute_name" id="institute_name"
                    class="form-control round-input" readonly="readonly" placeholder="Institute name" required="required"  value="{{ $orggt->organization_name}}" />
                    <input type="hidden" id="intsid" name="intsid" value="{{$orggt->id}}" />
                    <input type="hidden" id="visit_reg_id" name="visit_reg_id" value="{{$visitors_list->id}}" />
                    <div class="invalid-feedback">
                      Institute name is required
                    </div>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group pb-3">
                    <div class="d-flex justify-content-between mb-2" >
                      <label for="forl-label">CONTACT PERSON</label>
                      <div class="text-danger asterik text-end mb-0 pb-0">*</div>
                    </div>
                    
                    <input type="text" name="contact_person" id="contact_person"
                    class="form-control round-input" readonly="readonly" placeholder="Contact Person" required="required"  value="{{ $visitors_list->contact_person_name}}" />
                    
                    <div class="invalid-feedback">
                      Contact person name is required
                    </div>
                  </div>
                </div>


            </div>


            <div class="row">
              <div class="col-lg-6">
                <div class="form-group pb-3">
                  <div class="d-flex justify-content-between mb-2" >
                    <label for="forl-label">MOBILE NUMBER</label>
                    <div class="text-danger asterik text-end mb-0 pb-0">*</div>
                  </div>
                  
                  <input type="text" name="mobile_number" id="mobile_number"
                  class="form-control round-input" reqdonly="readonly" placeholder="Mobile number" required="required" readonly="readonly" value="{{ $visitors_list->mobile_1}}" />
                  
                  <div class="invalid-feedback">
                    Mobile no is required
                  </div>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="form-group pb-3">
                  <div class="d-flex justify-content-between mb-2" >
                    <label for="forl-label">EMAIL ADDRESS</label>
                    <div class="text-danger asterik text-end mb-0 pb-0">*</div>
                  </div>
                  
                  <input type="text" name="email_address" id="email_address"
                  class="form-control round-input" placeholder="Email address" readonly="readonly" required="required" value="{{ $visitors_list->institution_email_id}}" />
                  
                  <div class="invalid-feedback">
                    Email address is required
                  </div>
                </div>
              </div>


          </div>



          


        <div class="row">
          <div class="col-lg-12">
            <div class="form-group pb-3">
              <div class="d-flex justify-content-between mb-2" >
                <label for="forl-label">COMMUNICATION ADDRESS</label>
                <div class="text-danger asterik text-end mb-0 pb-0">*</div>
              </div>
              
              <textarea class="form-control round-input" name="address" placeholder="Communication address " readonly="readonly" required="required">{{ $visitors_list->institution_address}}</textarea>
              <div class="invalid-feedback">
                Address is required
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-6">
            <div class="form-group pb-3">
              <div class="d-flex justify-content-between mb-2" >
                <label for="forl-label">SELECT PRODUCT</label>
                <div class="text-danger asterik text-end mb-0 pb-0">*</div>
              </div>
              
              @php($product = DB::table('products')->get())
              <select class="form-control select2 round-input" name="product" id="product" required="required" onchange="get_product_type()">
                <option value="">Select Product</option>
                @foreach($product as $productlist)

                <option value="{{$productlist->id}}">{{$productlist->product_name}}</option>

                @endforeach
              </select>
              <div class="invalid-feedback">
                Select any one product
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="form-group pb-3">
              <div class="d-flex justify-content-between mb-2" >
                <label for="forl-label">PAYMENT OPTION</label>
                <div class="text-danger asterik text-end mb-0 pb-0">*</div>
              </div>
              
              <select class="form-control select2 round-input" name="payment_option" id="payment_option" required="required" onchange="get_product_cost()">
                <option value="">Select Payment Option</option>
                
              </select>
              <div class="invalid-feedback">
                Select payment option type 
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="form-group pb-3">
              <div class="d-flex justify-content-between mb-2" >
                <label for="forl-label">PRODUCT COST</label>
                <div class="text-danger asterik text-end mb-0 pb-0">*</div>
              </div>
              
              <input type="text" name="product_cost" id="product_cost"
              class="form-control round-input" placeholder="Product cost" required="required" value="{{old('product_cost')}}" onblur="get_calculated()" />
              
              <div class="invalid-feedback">
                Product cost is required
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="form-group pb-3">
              <div class="d-flex justify-content-between mb-2" >
                <label for="forl-label">PRODUCT DISCOUNT</label>
                <div class="text-danger asterik text-end mb-0 pb-0">*</div>
              </div>
              
              <input type="text" name="product_discount" id="product_discount"
              class="form-control round-input" placeholder="Product discount"  value="{{old('product_discount')}}" onblur="get_calculated()" />
              
              
            </div>
          </div>

          <div class="col-lg-6">
            <div class="form-group pb-3">
              <div class="d-flex justify-content-between mb-2" >
                <label for="forl-label">TOTAL COST WITH GST(18%)</label>
                <div class="text-danger asterik text-end mb-0 pb-0">*</div>
              </div>
              
              <input type="text" name="product_total_cost" id="product_total_cost"
              class="form-control round-input" readonly="readonly" placeholder="Product total cost" required="required" value="{{old('product_total_Cost')}}" />
              
              <div class="invalid-feedback">
                Product total cost is required
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="form-group pb-3">
              <div class="d-flex justify-content-between mb-2" >
                <label for="forl-label">PROPOSAL VALID UPTO</label>
                <div class="text-danger asterik text-end mb-0 pb-0">*</div>
              </div>
              
              <input type="date" name="proposal_valid_upto" id="proposal_valid_upto"
              class="form-control round-input" placeholder="Proposal valid upto Person" required="required" value="{{old('proposal_valid_upto')}}" />
              
              <div class="invalid-feedback">
                Proposal valid upto is required
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="form-group pb-3">
              <div class="d-flex justify-content-between mb-2" >
                <label for="forl-label">Email cc:</label>
                <div class="text-danger asterik text-end mb-0 pb-0">*</div>
              </div>
              
              <input type="text" name="email_cc" id="email_cc"
              class="form-control round-input" placeholder="Enter email id seperated by comma(,)" required="required" value="{{old('email_cc')}}" />
              
              <div class="invalid-feedback">
                Email CC is required
              </div>
            </div>
          </div>


      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="form-group pb-3">
            <div class="d-flex justify-content-between mb-2" >
              <label for="forl-label">MESSAGE</label>
              <div class="text-danger asterik text-end mb-0 pb-0">*</div>
            </div>
            
            <textarea class="form-control round-input" id="email_message" placeholder="Email body message" name="email_message" required="required">{{old('email_message')}}</textarea>
            
            <div class="invalid-feedback">
              Message is required
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="form-group pb-3">
            
            <a href="javascript:void()" onclick="get_preview_proposal()">PREVIEW PROPOSAL</a>
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