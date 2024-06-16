<div class="modal" id="mouModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <img src="{{asset('assets/assets/img/sikshapedia.png')}}" alt="" class="modal-logo  ml-3" width="200">
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
            
            @php($checkProposalsend = DB::table('proposals')->where('institute_id',$orggt->id)->first())
            
                        
          <div class="row">
            <div class="col-md-12"><h3>CREATE & SEND MOU</h3></div>
            <br><br>
          </div>
          @if(!empty($checkProposalsend))
          <form action="{{ route('send-mou')}}" method="post" enctype="multipart/form-data" class="needs-validation @if ($errors->any()) was-validated @endif" novalidate>
            @csrf
            <div class="row">

                <div class="col-lg-12">
                    <a href="#" id="btn_click" onclick="show_hide_table()">View Poposal Information</a>
                    <table class="table table-bordered tableDark tbl_open" id="tblop" style="width:100%">
                        <tbody>
                            <tr>
                                <td><strong>INSTITUTE NAME</strong></td>
                                <td>{{ $orggt->organization_name}}</td>
                                <td><strong>CONTACT PERSON</strong></td>
                                <td>{{ $visitors_list->contact_person_name}}</td>
                            </tr>
                            <tr>
                                <td><strong>MOBILE NUMBER</strong></td>
                                <td>{{ $visitors_list->mobile_1}}</td>
                                <td><strong>EMAIL ADDRESS</strong></td>
                                <td>{{ $visitors_list->institution_email_id}}</td>
                            </tr>
                            <tr>
                                <td><strong>COMMUNICATION ADDRESS</strong></td>
                                <td colspan="3">{{ $visitors_list->institution_address}}</td>
                            </tr>

                            <tr>
                                <td><strong>SELECTED PACKAGE</strong></td>
                                <td>@php($product_name = DB::table('products')->where('id',$checkProposalsend->product_id)->first())
                                    {{$product_name->product_name}}</td>
                                <td><strong>PAYMENT OPTION</strong></td>
                                <td>
                                    @php($payment_name = DB::table('product_costs')->where('id',$checkProposalsend->payment_id)->first())
                                    {{$payment_name->product_cost_type}}</td>
                            </tr>
                            <tr>
                                <td><strong>PRODUCT COST</strong></td>
                                <td>{{$checkProposalsend->product_cost}}</td>
                                <td><strong>DISCOUNT (IF ANY)</strong></td>
                                <td>{{$checkProposalsend->product_discount}}</td>
                            </tr>
                            <tr>
                                <td><strong>TOTAL COST WITH GST(18%)</strong></td>
                                <td>{{$checkProposalsend->product_total_cost}}</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>

                    <input type="hidden"  name="institute_name" id="institute_name"
                    class="form-control round-input" readonly="readonly" placeholder="Institute name" required="required"  value="{{ $orggt->organization_name}}" />
                    <input type="hidden" id="intsid" name="intsid" value="{{$orggt->id}}" />
                    <input type="hidden" id="visit_reg_id" name="visit_reg_id" value="{{$visitors_list->id}}" />
                    <input type="hidden" name="contact_person" id="contact_person"
                    class="form-control round-input" readonly="readonly" placeholder="Contact Person" required="required"  value="{{ $visitors_list->contact_person_name}}" />
                    <input type="hidden" name="mobile_number" id="mobile_number"
                    class="form-control round-input" reqdonly="readonly" placeholder="Mobile number" required="required" readonly="readonly" value="{{ $visitors_list->mobile_1}}" />
                    <input type="hidden" name="email_address" id="email_address"
                     class="form-control round-input" placeholder="Email address" readonly="readonly" required="required" value="{{ $visitors_list->institution_email_id}}" />
                     <textarea style="display:none;"  class="form-control round-input" name="address" placeholder="Communication address " readonly="readonly" required="required">{{ $visitors_list->institution_address}}</textarea>
                    <input type="hidden" name="proposal_id" id="proposal_id" value="{{$checkProposalsend->id}}"/>                </div>

                <div class="col-lg-6">
                    <div class="form-group pb-3">
                        <div class="d-flex justify-content-between mb-2" >
                          <label for="forl-label">MOU START ON</label>
                          <div class="text-danger asterik text-end mb-0 pb-0">*</div>
                        </div>
                        
                        <input type="date" name="mou_start_date" id="mou_start_date" 
                        class="form-control round-input"  required="required"   />
                        
                        <div class="invalid-feedback">
                          MOU Start date is required
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group pb-3">
                        <div class="d-flex justify-content-between mb-2" >
                          <label for="forl-label">VALID UPTO</label>
                          <div class="text-danger asterik text-end mb-0 pb-0">*</div>
                        </div>
                        
                        <input type="date" name="mou_valid_upto" id="mou_valid_upto" 
                        class="form-control round-input"  required="required"   />
                        
                        <div class="invalid-feedback">
                          MOU valid upto is required
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">

                    <div class="form-group pb-3">
                        <div class="d-flex justify-content-between mb-2" >
                          <label for="forl-label">PARTY NAME</label>
                          <div class="text-danger asterik text-end mb-0 pb-0">*</div>
                        </div>
                        
                        <input type="text" name="party_name" id="party_name" value="{{ $orggt->organization_name}}"
                        class="form-control round-input" placeholder="Party Name" required="required"  />
                        
                        <div class="invalid-feedback">
                          Party name is required
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">

                    <div class="form-group pb-3">
                        <div class="d-flex justify-content-between mb-2" >
                          <label for="forl-label">PARTY ADDRESS</label>
                          <div class="text-danger asterik text-end mb-0 pb-0">*</div>
                        </div>
                        
                        <textarea name="party_address" id="party_address"
                        class="form-control round-input" placeholder="Party address" required="required">{{$visitors_list->institution_address}}</textarea>
                        
                        <div class="invalid-feedback">
                          Party address is required
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">

                    <div class="form-group pb-3">
                        <div class="d-flex justify-content-between mb-2" >
                          <label for="forl-label">IN FAVOUR OF(Name of the Administrator)</label>
                          <div class="text-danger asterik text-end mb-0 pb-0">*</div>
                        </div>
                        
                        <input type="text" name="mou_favour_name" id="mou_favour_name"
                        class="form-control round-input" placeholder="Enter the MOU favour of the party" required="required">
                        
                        <div class="invalid-feedback">
                         In favour is required
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">

                    <div class="form-group pb-3">
                        <div class="d-flex justify-content-between mb-2" >
                          <label for="forl-label">PAN NO</label>
                          
                        </div>
                        
                        <input type="text" name="pan_no" id="pan_no"
                        class="form-control round-input" placeholder="Enter PAN No">
                        
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="d-flex justify-content-between mb-2" >
                        <label for="forl-label">Point of contact from first party</label>
                        <div class="text-danger asterik text-end mb-0 pb-0">*</div>
                    </div>
                    <table class="table table-bordered tableDark">
                        <thead>
                            <tr>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Designation
                                </th>
                                <th>
                                    Email Id
                                </th>
                                <th>
                                    Mobile
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" name="first_party_name[]" id="first_party_name_1"
                                    class="form-control round-input" placeholder="Enter name" value="PRALOY PANDA"> 
                                </td>

                                <td>
                                    <input type="text" name="first_party_designation[]" id="first_party_designation_1"
                                    class="form-control round-input" placeholder="Enter designation" value="Account Manager">
                                </td>
                                <td>
                                    <input type="text" name="first_party_email[]" id="first_party_email_1"
                                    class="form-control round-input" placeholder="Enter email" value="info@sikshapedia.com">
                                </td>
                                <td>
                                    <input type="text" name="first_party_mobile[]" id="first_party_mobile_1"
                                    class="form-control round-input" placeholder="Enter mobile No" value="7278423909">
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <input type="text" name="first_party_name[]" id="first_party_name_1"
                                    class="form-control round-input" placeholder="Enter name" value="NIRMALENDU SARKAR"> 
                                </td>

                                <td>
                                    <input type="text" name="first_party_designation[]" id="first_party_designation_1"
                                    class="form-control round-input" placeholder="Enter designation" value="Area Manager">
                                </td>
                                <td>
                                    <input type="text" name="first_party_email[]" id="first_party_email_1"
                                    class="form-control round-input" placeholder="Enter email" value="nirmalendu@sikshapedia.com">
                                </td>
                                <td>
                                    <input type="text" name="first_party_mobile[]" id="first_party_mobile_1"
                                    class="form-control round-input" placeholder="Enter mobile No" value="9830122122">
                                </td>
                            </tr>
                        </tbody>
                    </table>

                   
                </div>

                <div class="col-lg-12">
                    <div class="d-flex justify-content-between mb-2" >
                        <label for="forl-label">Point of contact from second party (<a href="#" onclick="add_another_contract()">Add Another Contarct Name</a>)</label>
                        <div class="text-danger asterik text-end mb-0 pb-0">*</div>
                    </div>
                    <table class="table table-bordered tableDark">
                        <thead>
                            <tr>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Designation
                                </th>
                                <th>
                                    Email Id
                                </th>
                                <th>
                                    Mobile
                                </th>
                                <th>
                                    Action
                                    <input type="hidden" id="btn_del" value="1">
                                </th>
                            </tr>
                        </thead>
                        <tbody id="second_party_table">
                            <tr>
                                <td>
                                    <input type="text" name="second_party_name[]" 
                                    class="form-control round-input" placeholder="Enter name" required="required" > 
                                    
                                    <div class="invalid-feedback">
                                        Name is required
                                    </div>
                                </td>

                                <td>
                                    <input type="text" name="second_party_designation[]" 
                                    class="form-control round-input" placeholder="Enter designation" required="required">
                                    <div class="invalid-feedback">
                                        Designation is required
                                    </div>
                                </td>
                                <td>
                                    <input type="email" name="second_party_email[]"
                                    class="form-control round-input" placeholder="Enter email" required="required">
                                    <div class="invalid-feedback">
                                        Email id is required
                                    </div>
                                </td>
                                <td>
                                    <input type="text" name="second_party_mobile[]"
                                    class="form-control round-input" placeholder="Enter mobile No" required="required">

                                    <div class="invalid-feedback">
                                        Mobile no is required
                                    </div>
                                </td>
                                <td>
                                    
                                </td>
                            </tr>

                            
                        </tbody>
                    </table>
                    
                </div>
                <div class="col-lg-6">
                    <div class="form-group pb-3">
                      <div class="d-flex justify-content-between mb-2" >
                        <label for="forl-label">SELECTED PACKAGE</label>
                        <div class="text-danger asterik text-end mb-0 pb-0">*</div>
                      </div>
                      
                      @php($product = DB::table('products')->get())
                      <select class="form-control select2 round-input" name="mou_product" id="mou_product" required="required" onchange="get_mou_product_type()">
                        <option value="">Select Product</option>
                        @foreach($product as $productlist)
        
                        <option value="{{$productlist->id}}" @if($checkProposalsend->product_id == $productlist->id )selected @endif>{{$productlist->product_name}}</option>
        
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
                        <label for="forl-label">SELECTED PAYMENT OPTION</label>
                        <div class="text-danger asterik text-end mb-0 pb-0">*</div>
                      </div>
                      
                      <select class="form-control select2 round-input" name="mou_payment_option" id="mou_payment_option" required="required" onchange="get_mou_product_cost()">
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
                        <label for="forl-label">PRODUCT DISCOUNT</label>
                        <div class="text-danger asterik text-end mb-0 pb-0">*</div>
                      </div>
                      
                      <input type="text" name="mou_product_discount" id="mou_product_discount"
                      class="form-control round-input" placeholder="Product discount"  value="{{old('product_discount')}}" onblur="get_mou_calculated()" />
                      
                      
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group pb-3">
                      <div class="d-flex justify-content-between mb-2" >
                        <label for="forl-label">TOTAL COST WITH GST(18%)</label>
                        <div class="text-danger asterik text-end mb-0 pb-0">*</div>
                      </div>
                      
                      <input type="text" name="mou_product_total_cost" id="mou_product_total_cost"
                      class="form-control round-input" readonly="readonly" placeholder="Product total cost" required="required" value="{{old('product_total_Cost')}}" />
                      
                      <div class="invalid-feedback">
                        Product total cost is required
                      </div>
                    </div>
                  </div>

                

                

                <div class="col-lg-6">

                    <div class="form-group pb-3">
                        <div class="d-flex justify-content-between mb-2" >
                          <label for="forl-label">SUBJECT</label>
                          <div class="text-danger asterik text-end mb-0 pb-0">*</div>
                        </div>
                        
                        <input type="text" name="subject" id="subject"
                        class="form-control round-input" placeholder="College Registration 2024-2025" required="required"  />
                        
                        <div class="invalid-feedback">
                          Subject is required
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

                    <div class="col-lg-6">

                      <div class="form-group pb-3">

                        @if(!empty($checkProposalsend))
                            <a href="javascript:void()" onclick="get_preview_generated_mou()">PREVIEW GENERATED MOU</a>
                        @else
                        <span style="color:red">Please Send Proposal First*</span>
                        @endif
                      </div>

                    </div>
               


            </div>








        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
            @if(!empty($checkProposalsend))
             <button type="submit" class="btn btn-primary menu"  style="float:left;">Submit</button>
             @else
            <button type="button" disabled="disabled" class="btn btn-primary menu"  style="float:left;">Submit</button>
            @endif
        </div>
        </form>
        
        @else
        
        <center><span style="color:red">Please Send Proposal First*</span></center>
        
        @endif
      </div>
    </div>
  </div>

</div>

