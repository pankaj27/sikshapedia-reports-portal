<?php use Illuminate\Support\Facades\DB;
?>
@php($orggt = DB::table('call_registers')->where('id',$visitors_list->institution_name)->first())
                
@extends('backend.layout.app')
@section('title','Details Visit Report of {{ $orggt->organization_name}} | sikshapedia Sales Portal')
@section('content')
<div class="mainCon">
    <div class="d-flex flex-md-row flex-sm-column sm-col justify-content-md-between pb-4">
      <h2 class="heading blue-text">Detail Visit Report of {{ $orggt->organization_name}} </h2>
      <!-- <a href="#" class="btn btn-primary menu">+ New Report</a> -->
    </div>

    <!--content start-->

    

    <div class="row">
      <div class="col-12">
        <div class="whiteBox p-4">
          <div class="row">
            <div class="col-md-12">
              <div class="card-flex">
                <div class="firstBox">
                  <h4>Institution Name</h4>
                  <p class="mb-0" id="coll_nm">{{ $orggt->organization_name}}</p>
                </div>
                <div class="sectBox">
                  <h4>Institution Address</h4>
                  <p class="mb-0" id="coll_add">{{$visitors_list->institution_address}}, {{$visitors_list->city}}, {{$visitors_list->district}},{{$visitors_list->state}},{{$visitors_list->pin}}</p>
                </div>
                <div class="StatusBox">
                  <p class="mb-0" id="coll_status"></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row" id="visitDetailList">
        <div class="col-12"><div class="whiteBox p-4 mt-4">
            <div class="row"><div class="col-md-12">
                <div class="card-flex-details">
                    <div class="fiBox "><div class="mb-4">
                        <h4>Contact Persone Name</h4>
                        <p class="mb-0">{{$visitors_list->contact_person_name}}</p>
                    </div>
                    <div class="mb-4">
                        <h4>Primary Mobile Number</h4>
                        <p class="mb-0">{{$visitors_list->mobile_1}}</p>
                    </div>
                    <div>
                        <h4>Secondary Mobile Number</h4>
                        <p class="mb-0">{{$visitors_list->mobile_2}}</p>
                    </div>
                </div>
                <div class=" midBox">
                    <div class="mb-4">
                        <h4>Institution Email</h4>
                        <p class="mb-0">{{$visitors_list->institution_email_id}}</p>
                    </div>
                    <div class="mb-4">
                        <h4>Status</h4>
                        <p class="mb-0">
                            <span class="text-success">{{$visitors_list->visit_status}}</span>
                        </p>
                    </div>
                    <div>
                        <h4>Special Notes</h4>
                        <p class="mb-0">{{$visitors_list->special_note}}</p>
                    </div>
                </div>
                <div class="laBox ">
                    <div class="mb-4">
                        <div class="">
                            @if($visitors_list->images)
                                <img src="{{asset('storage/app/public/doc_images/'.$visitors_list->images) }}" alt="" class="round-darkinput thumb" id="">
                            @endif
                        </div>
                    </div>
                    <div class="mb-4">
                        <h6>Visit Date &amp; Time</h6>
                        <p class="mb-0">{{date('d/m/Y',strtotime($visitors_list->visit_date))}} {{$visitors_list->appointment_time}}</p>
                    </div>
                    <div>
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                <a href="javascript:void(0)" class="yellow-btn-radius my-1" data-bs-toggle="modal" data-bs-target="#sendProposalModal" data-bs-target="#staticBackdrop" >Send Proposal</a>
                             </li>
                             <li class="list-inline-item">
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript:void(0)" class="deepGreen-btn-radius my-1">Complete Deal</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript:void(0)" class="red-btn-radius my-1">Close Lead</a>
                            </li>
                        </ul>

                        <div class="modal" id="sendProposalModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                        
                              <!-- Modal Header -->
                              <div class="modal-header">
                                <img src="{{asset('assets/assets/img/sikshapedia.png')}}" alt="" class="modal-logo  ml-3" width="200">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>
                        
                              <!-- Modal body -->
                              <div class="modal-body">
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
                    </div>
                    <div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
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
  function get_product_type(){

    
    if($("#product").val() !='' || $("#product").val()!='0'){

        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
        
      $.ajax({
        url: "{{ route('get-payment_option') }}",
        type: 'POST',
        data: {
          product_id: $("#product").val(),
        
          },
          beforeSend: function () {
                            $('.ajax-loader').css("visibility", "visible");
          },
        success: function(result){
          
        

          if(result.success == 1){
            toastr.success('Payment option fetch successfully!!');
            $("#payment_option").html(result.data);

          }else{
            toastr.error('opps! some error occurred!!');
            $("#payment_option").html(result.data);
        

          }

          

        },
        complete: function () {
          
          $('.ajax-loader').css("visibility", "hidden");

        }
      
      
      });


    }else{
      toastr.error('opps! Please select any one product!!');
      $("#payment_option").html('<option value="">Select Payment Option</option>');

      $("#product_cost").val();

      $("#product_discount").html();

      $("#product_total_cost").html();

    }

  }


  function get_product_cost(){

    $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
      
    $.ajax({
      url: "{{ route('get-product-cost') }}",
      type: 'POST',
      data: {
        payment_id: $("#payment_option").val(),
      
        },
        beforeSend: function () {
                           $('.ajax-loader').css("visibility", "visible");
        },
      success: function(result){
        
      

        if(result.success == 1){
          toastr.success('Product cost fetch successfully!!');

          var product_cost = result.product_cost;
          var product_discount = result.product_discount;
          var product_gst = 18 ;

          calculate_product_cost(product_cost,product_discount,product_gst);
          

        }else{
          toastr.error('opps! some error occurred!!');
          
          $("#product_cost").val();
          $("#product_discount").val();
          $("#product_total_cost").val();

        }

        

      },
      complete: function () {
        
        $('.ajax-loader').css("visibility", "hidden");

      }
    
    
    });

  }

  function calculate_product_cost(cost,discount,gst){

    if(cost == "" || cost == 0 || isNaN(cost)){

      var pcost = 0;
    }else{

      var pcost = parseFloat(cost);
    }

    if(discount == "" || discount == 0 || isNaN(discount)){

      var pdiscount = 0;
    
    }else{

      var pdiscount = parseFloat(discount);

    }

    var totalcost = (parseFloat(pcost) - parseFloat(pdiscount)) + ((parseFloat(pcost) - parseFloat(pdiscount))*.18);
    $("#product_cost").val(pcost.toFixed(2));
    $("#product_discount").val(pdiscount.toFixed(2));
    $("#product_total_cost").val(totalcost.toFixed(2));

  }

  function get_calculated(){
    var pcost = parseFloat($("#product_cost").val());

    var discount = parseFloat($("#product_discount").val());

    var product_gst = 18;

    calculate_product_cost(pcost,discount,product_gst);
  }

  function get_preview_proposal(){
    var instid  = $("#intsid").val();
    var product_id  = $("#product").val();
    var payment_option = $("#payment_option").val();
    var product_cost = $("#product_cost").val();
    var product_discount = $("#product_discount").val();
    var product_total_cost = $("#product_total_cost").val();
    var proposal_valid = $("#proposal_valid_upto").val();
    
   

    if(product_id !='' && payment_option!='' && parseFloat(product_cost)>0 && parseFloat(product_total_cost)>0 && proposal_valid!=''  )
    {
      
      //var url = '{{ route("proposal.generatepdf", array(encrypt('+payment_option+'),encrypt('+payment_option+'))) }}';
      
      console.log(instid);

      $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
        
      $.ajax({
        url: "{{ route('proposal.generatepdf') }}",
        type: 'POST',
        data: {
          inst_id: $("#intsid").val(),
          payment_option_id: $("#payment_option").val(),
          product_cost:$("#product_cost").val(),
          product_discount:$("#product_discount").val(),
          proposal_valid:$("#proposal_valid_upto").val()

        
          },
          beforeSend: function () {
                            $('.ajax-loader').css("visibility", "visible");
          },
        success: function(result){
          
        console.log(result);

          if(result.success == 1){
            toastr.success('Proposal link generated successfully');
            
            console.log(result.pdf_link);
            window.open(result.pdf_link,"_blank");

          }else{
            toastr.error('opps! some error occurred!!');
            console.log(result.pdf_link);
        

          }

          

        },
        complete: function () {
          
          $('.ajax-loader').css("visibility", "hidden");

        }
      
      
      });





    }else{

      toastr.error('opps! Plesae select product and payment option and product cost and product total cost and proposal valid upto is required!!');
    }
    

  }
</script>

@endsection