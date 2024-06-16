<div class="modal" id="closeDealModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <img src="{{asset('assets/assets/img/sikshapedia.png')}}" alt="" class="modal-logo  ml-3" width="200">
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          
          @php($checkProposalsend = DB::table('mou_sents')->where('institute_id',$orggt->id)->first())
          
                      
        <div class="row">
          <div class="col-md-12"><center><h3>Close Deal</h3></center></div>
          <br><br>
        </div>
        @if(!empty($checkProposalsend))
        <form action="{{ route('send-invoice')}}" method="post" enctype="multipart/form-data" class="needs-validation @if ($errors->any()) was-validated @endif" novalidate>
          @csrf
          <div class="row">

              <div class="col-lg-12">
                  <a href="#" id="btn_click" onclick="close_show_hide_table()">View MOU Information</a>
                  <table class="table table-bordered tableDark tbl_open" id="tblopclose" style="width:100%">
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
                              <td>@php($product_name = DB::table('products')->where('id',$checkProposalsend->package_id)->first())
                                  {{$product_name->product_name}}</td>
                              <td><strong>PAYMENT OPTION</strong></td>
                              <td>
                                  @php($payment_name = DB::table('product_costs')->where('id',$checkProposalsend->payment_option)->first())
                                  @if($payment_name->product_cost_type == "INSTALLMENT"){{$payment_name->product_cost_type.'('.$payment_name->product_installment_number . " Installment)" }} @endif</td>
                          </tr>
                          <tr>
                              <td><strong>PRODUCT COST</strong></td>
                              <td>{{$payment_name->product_cost}}@if($payment_name->product_cost_type == "INSTALLMENT") {{"/Installment"}} @endif<br>
                                <span class="text-danger">Duration: {{$payment_name->instalment_duration}} {{$payment_name->duration_unit}}</span>
                              </td>
                              <td><strong>DISCOUNT (IF ANY)</strong></td>
                              <td>{{$checkProposalsend->discount}}</td>
                          </tr>
                          <tr>
                              <td><strong>TOTAL COST WITH GST(18%)</strong></td>
                              <td>{{$checkProposalsend->total_cose}}</td>
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
                  <input type="hidden" name="mou_id" id="mou_id" value="{{$checkProposalsend->id}}"/> 
                  <input type="hidden" name="college_address" id="college_address" value="{{ $visitors_list->institution_address}}"/>                </div>

              
                  <div class="col-lg-6">
                    <div class="form-group pb-3">
                      <div class="d-flex justify-content-between mb-2" >
                        <label for="forl-label">ACCOUNT NAME</label>
                        <div class="text-danger asterik text-end mb-0 pb-0">*</div>
                      </div>
                      <input type="text" name="account_name" id="account_name" class="form-control round-input" placeholder="Enter Account Name" required="required" >
                      
                      <div class="invalid-feedback">
                        Enter account name
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group pb-3">
                      <div class="d-flex justify-content-between mb-2" >
                        <label for="forl-label">INVOICE DESCRIPTION</label>
                        <div class="text-danger asterik text-end mb-0 pb-0">*</div>
                      </div>
                      <input type="text" name="invoice_desc" id="invoice_desc" class="form-control round-input" placeholder="Enter invoice description" required="required" >
                      
                     
                      <div class="invalid-feedback">
                        Enter invoice description
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group pb-3">
                      <div class="d-flex justify-content-between mb-2" >
                        <label for="forl-label">EXTRA DESCRIPTION</label>
                        
                      </div>
                      <input type="text" name="extra_desc" id="extra_desc" class="form-control round-input" placeholder="Enter extra description" >
                      
                     
                      
                    </div>
                  </div>
              
              

                <div class="col-lg-6">
                  <div class="form-group pb-3">
                    <div class="d-flex justify-content-between mb-2" >
                      <label for="forl-label">SELECTED PAYMENT STATUS</label>
                      <div class="text-danger asterik text-end mb-0 pb-0">*</div>
                    </div>
                    
                    <select class="form-control select2 round-input" name="payment_status" id="payment_status" required="required">
                      <option value="">Select Payment Status</option>
                      <option value="PAID">Paid</option>
                      <option value="NOT PAID">Not Paid</option>
                      
                    </select>
                    <div class="invalid-feedback">
                      Select payment status 
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
                          <a href="javascript:void()" onclick="get_preview_generated_invoice()">PREVIEW GENERATED INVOICE</a>
                      @else
                      <span style="color:red">Please Send MOU First*</span>
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

