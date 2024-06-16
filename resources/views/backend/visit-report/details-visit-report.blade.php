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
                  <input type="hidden" name="institute_idd" id="institute_idd" value="{{encrypt($orggt->id)}}">
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
                                <a href="javascript:void(0)" class="deepGreen-btn-radius my-1" data-bs-toggle="modal" data-bs-target="#completeDealModal" data-bs-target="#staticBackdrop">Complete Deal</a>
                            </li>

                            <li class="list-inline-item">
                              <a href="javascript:void(0)" class="teal-btn-radius my-1" data-bs-toggle="modal" data-bs-target="#mouModal" data-bs-target="#staticBackdrop">Send MOU</a>
                            </li>

                            <li class="list-inline-item">
                                <a href="javascript:void(0)" class="red-btn-radius my-1" data-bs-toggle="modal" data-bs-target="#closeDealModal" data-bs-target="#staticBackdrop">Close Lead</a>
                            </li>

                            <li class="list-inline-item">
                              <a href="javascript:void(0)" class="deepGreen-btn-radius my-1" onclick="get_generated_mou_upload_link()">Generate Link(MOU Upload)</a>
                            </li>
                        </ul>

                        <!----  Send Proposal Modal -->
                        @include('backend.visit-report.partials.send-proposal-modal')

                        <!----  Complete Deal Modal -->
                       @include('backend.visit-report.partials.complete-deal-modal')


                       <!----  Mou Deal Modal -->
                       @include('backend.visit-report.partials.mou-modal')
                       
                       


                        <!----  Closed Proposal Modal -->
                        @include('backend.visit-report.partials.close-deal-modal')


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
  function get_mou_product_type(){   

   
    if($("#mou_product").val() !='' || $("#mou_product").val()!='0'){

          $.ajaxSetup({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
          });

          $.ajax({
          url: "{{ route('get-payment_option') }}",
          type: 'POST',
          data: {
            product_id: $("#mou_product").val(),

            },
            beforeSend: function () {
                              $('.ajax-loader').css("visibility", "visible");
            },
          success: function(result){
            
          console.log(result);

            if(result.success == 1){
              toastr.success('Payment option fetch successfully!!');
              $("#mou_payment_option").html(result.data);

            }else{
              toastr.error('opps! some error occurred22!!');
              $("#mou_payment_option").html(result.data);


            }

            

          },
          complete: function () {
            
            $('.ajax-loader').css("visibility", "hidden");

          }


          });


          }else{
          toastr.error('opps! Please select any one product!!');
          $("#mou_payment_option").html('<option value="">Select Payment Option</option>');

          $("#mou_product_cost").val();

          $("#mou_product_discount").html();

          $("#mou_product_total_cost").html();

          }





  }
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
          
        console.log(result);

          if(result.success == 1){
            toastr.success('Payment option fetch successfully!!');
            $("#payment_option").html(result.data);

          }else{
            toastr.error('opps! some error occurred22!!');
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

  function get_mou_product_cost(){

    
    $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
      
    $.ajax({
      url: "{{ route('get-product-cost') }}",
      type: 'POST',
      data: {
        payment_id: $("#mou_payment_option").val(),
      
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

          mou_calculate_product_cost(product_cost,product_discount,product_gst);
          

        }else{
          toastr.error('opps! some error occurred!!');
          
          $("#mou_product_cost").val();
          $("#mou_product_discount").val();
          $("#mou_product_total_cost").val();

        }

        

      },
      complete: function () {
        
        $('.ajax-loader').css("visibility", "hidden");

      }
    
    
    });

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

  function mou_calculate_product_cost(cost,discount,gst){

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
      $("#mou_product_cost").val(pcost.toFixed(2));
      $("#mou_product_discount").val(pdiscount.toFixed(2));
      $("#mou_product_total_cost").val(totalcost.toFixed(2));

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

  function mou_get_calculated(){
    var pcost = parseFloat($("#mou_product_cost").val());

    var discount = parseFloat($("#mou_product_discount").val());

    var product_gst = 18;

    mou_calculate_product_cost(pcost,discount,product_gst);
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
          intsid: $("#intsid").val(),
          visit_reg_id:$("#visit_reg_id").val(),
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
            
            console.log(result);
            window.open(result.pdf_link,"_blank");

          }else{
            toastr.error('opps! some error occurred!!');
            console.log(result);
        

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

  function get_preview_bill_proposal(){
    var proposal_id  = $("#proposal_id").val();
    var pay_amount  = $("#pay_amount").val();
    var payment_date = $("#payment_date").val();
    var payment_mode = $("#payment_mode").val();
    var transaction_no = $("#transaction_no").val();
    var subject = $("#subject").val();
    var email_cc = $("#email_cc").val();
    
   

    if(proposal_id !='')
    {
      
      //var url = '{{ route("proposal.generatepdf", array(encrypt('+payment_option+'),encrypt('+payment_option+'))) }}';
      
      //console.log(instid);

      $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
        
      $.ajax({
        url: "{{ route('bills.generatepdf') }}",
        type: 'POST',
        data: {
          proposal_id:proposal_id,
          pay_amount:pay_amount,
          payment_date: payment_date,
          payment_mode:payment_mode,
          transaction_no:transaction_no,
          subject:subject,
          email_cc:email_cc

        
          },
          beforeSend: function () {
                            $('.ajax-loader').css("visibility", "visible");
          },
        success: function(result){
          
        console.log(result);

          if(result.success == 1){
            toastr.success('Bill link generated successfully');
            
            console.log(result);
            window.open(result.pdf_link,"_blank");

          }else{
            toastr.error('opps! some error occurred!!');
            console.log(result);
        

          }

          

        },
        complete: function () {
          
          $('.ajax-loader').css("visibility", "hidden");

        }
      
      
      });





    }else{

      toastr.error('opps! Plesae select Payemnt date and payment mode, Transaction no, Subject  is required!!');
    }
    

  }

  function show_hide_table(){

      $("#tblop").toggleClass("tbl_close");
  
  }

  function close_show_hide_table(){

    $("#tblopclose").toggleClass("tbl_close");

}

  function add_another_contract(){

    var btngg = $("#btn_del").val();

    btngg = btngg + 1;

    var tbl = '';
    tbl +='<tr id="row_'+btngg+'">';
      tbl +='<td>';
      tbl +='<input type="text" name="second_party_name[]" class="form-control round-input" placeholder="Enter name" required="required" > ';
                                     
      tbl +='<div class="invalid-feedback">Name is required</div>';
      tbl +='</td>';

      tbl +='<td>';
        tbl +='<input type="text" name="second_party_designation[]" class="form-control round-input" placeholder="Enter designation" required="required">';
        tbl +='<div class="invalid-feedback">Designation is required</div>';
        tbl +='</td>';
        tbl +='<td>';
        tbl +='<input type="email" name="second_party_email[]" class="form-control round-input" placeholder="Enter email" required="required">';
        tbl +='<div class="invalid-feedback">Email id is required </div>';
        tbl +='</td>';
        tbl +='<td>';
        tbl +='<input type="text" name="second_party_mobile[]" class="form-control round-input" placeholder="Enter mobile No" required="required">';

        tbl +='<div class="invalid-feedback">Mobile no is required</div>';
        tbl +='</td>';
        tbl +='<td>';
        tbl +='<button type="button" id="btn_'+btngg+'" class="btn-close" onclick="deleteroebutton(this.id)"  ></button>';
        tbl +='</td>';
        tbl +='</tr>';

        $("#second_party_table").append(tbl);
  }

    

  function deleteroebutton(id){
    var idsplit = id.split("_");

    $("#row_"+idsplit[1]).remove();

  }
  function get_preview_generated_mou(){

var instid  = $("#intsid").val();
var product_id  = $("#mou_product").val();
var payment_option = $("#mou_payment_option").val();
var product_cost = $("#mou_product_cost").val();
var product_discount = $("#mou_product_discount").val();
var product_total_cost = $("#mou_product_total_cost").val();
var party_name = $("#party_name").val();
var party_address = $("#party_address").val();
var mou_favour_name = $("#mou_favour_name").val();
var mou_start_date = $("#mou_start_date").val();
var mou_valid_upto = $("#mou_valid_upto").val();
var party_name = $("#party_name").val();

var first_party_name = [];
var first_party_designation=[];
var first_party_email = [];
var first_party_mobile = [];
var second_party_name = [];
var second_party_designation=[];
var second_party_email = [];
var second_party_mobile = [];

$("input[name='first_party_name[]']").each(function() {
   var value = $(this).val();
   if (value) {
     first_party_name.push(value);
   }
});

$("input[name='first_party_designation[]']").each(function() {
   var value = $(this).val();
   if (value) {
     first_party_designation.push(value);
   }
});

$("input[name='first_party_email[]']").each(function() {
   var value = $(this).val();
   if (value) {
     first_party_email.push(value);
   }
});
   

$("input[name='first_party_mobile[]']").each(function() {
   var value = $(this).val();
   if (value) {
     first_party_mobile.push(value);
   }
});



$("input[name='second_party_name[]']").each(function() {
   var value = $(this).val();
   if (value) {
     second_party_name.push(value);
   }
});

$("input[name='second_party_designation[]']").each(function() {
   var value = $(this).val();
   if (value) {
     second_party_designation.push(value);
   }
});

$("input[name='second_party_email[]']").each(function() {
   var value = $(this).val();
   if (value) {
     second_party_email.push(value);
   }
});
   

$("input[name='second_party_mobile[]']").each(function() {
   var value = $(this).val();
   if (value) {
     second_party_mobile.push(value);
   }
});
   


if(mou_start_date!='' && mou_valid_upto!='' 
 // &&
 // first_party_name.length !== 0 && first_party_designation.length !== 0 && first_party_email.length !== 0 && first_party_mobile.length !== 0 &&
 // second_party_name.length !== 0 && second_party_designation.length !== 0 && second_party_email.length !== 0 && second_party_mobile.length !== 0

)
{
 
 //var url = '{{ route("proposal.generatepdf", array(encrypt('+payment_option+'),encrypt('+payment_option+'))) }}';
 
 //console.log(instid);

 $.ajaxSetup({
   headers: {
   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
 });
   
 $.ajax({
   url: "{{ route('mou.generatepdf') }}",
   type: 'POST',
   data: {
     intsid: $("#intsid").val(),
     proposal_id : $("#proposal_id").val(),
     vist_reg_id:$("#visit_reg_id").val(),
     package_id:$("#mou_product").val(),
     payment_option_id: $("#mou_payment_option").val(),
     product_cost:$("#mou_product_total_cost").val(),
     product_discount:$("#mou_product_discount").val(),
     proposal_valid:$("#proposal_valid_upto").val(),
     mou_start_date:$("#mou_start_date").val(),
     mou_valid_upto:$("#mou_valid_upto").val(),
     party_name:$("#party_name").val(),
     party_address:$("#party_address").val(),
     mou_favour_name:$("#mou_favour_name").val(),
     party_pan_no:$("#pan_no").val(),
     first_party_name:first_party_name,
     first_party_designation:first_party_designation,
     first_party_email:first_party_email,
     first_party_mobile:first_party_mobile,
     second_party_name:second_party_name,
     second_party_designation:second_party_designation,
     second_party_email:second_party_email,
     second_party_mobile:second_party_mobile
     

   
     },
     beforeSend: function () {
                       $('.ajax-loader').css("visibility", "visible");
     },
   success: function(result){
     
   console.log(result);

     if(result.success == 1){
       toastr.success('MOU link generated successfully');
       
       console.log(result);
       window.open(result.pdf_link,"_blank");

     }else{
       toastr.error('opps! some error occurred!!');
       console.log(result);
   

     }

     

   },
   complete: function () {
     
     $('.ajax-loader').css("visibility", "hidden");

   }
 
 
 });





}else{

  toastr.error('opps! Plesae select product and payment option and product cost and product total cost and mou Start ,Mou Valid upto , First party name, Second party is required!!');
}

}

  function get_preview_generated_invoice(){

     var instid  = $("#mou_id").val();
     var accout_name = $("#account_name").val();
     var payment_status = $("#payment_status").val();
     

    

    
   

    if(instid!='' && accout_name!='' && payment_status !=''  )
    {
      
      //var url = '{{ route("proposal.generatepdf", array(encrypt('+payment_option+'),encrypt('+payment_option+'))) }}';
      
      //console.log(instid);

      $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
        
      $.ajax({
        url: "{{ route('closeDeal.generateInvoice') }}",
        type: 'POST',
        data: {
          intsid: $("#intsid").val(),
          mou_id: $("#mou_id").val(),
          account_name:$("#account_name").val(),
          payment_status:$("#payment_status").val(),
          invoice_desc:$("#invoice_desc").val(),
          extra_desc:$("#extra_desc").val(),
          college_address:$("#college_address").val()
          
        
          },
          beforeSend: function () {
                            $('.ajax-loader').css("visibility", "visible");
          },
        success: function(result){
          
        console.log(result);

          if(result.success == 1){
            toastr.success('Invoice link generated successfully');
            
            console.log(result);
            window.open(result.pdf_link,"_blank");

          }else{
            toastr.error('opps! some error occurred!!');
            console.log(result);
        

          }

          

        },
        complete: function () {
          
          $('.ajax-loader').css("visibility", "hidden");

        }
      
      
      });





     }else{

       toastr.error('opps! Plesae select product and payment option and product cost and product total cost and mou Start ,Mou Valid upto , First party name, Second party is required!!');
     }

  }

  function get_generated_mou_upload_link(){

    var institute_idd  = $("#institute_idd").val();
    //alert(institute_idd);
    

    if(institute_idd !='')
    {
      
     
     

      $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
        
      $.ajax({
        url: "{{ route('link.store') }}",
        type: 'POST',
        data: {
          institute_idd: $("#institute_idd").val(),
          
          },
          beforeSend: function () {
                            $('.ajax-loader').css("visibility", "visible");
          },
        success: function(result){
          
        console.log(result);

          if(result.success == 1){
            toastr.success('Mou Upload link Copied successfully');

            var rrt = navigator.clipboard.writeText(result.url_link);
            
            console.log(rrt);
            //window.open(result.pdf_link,"_blank");

          }else{
            toastr.error(result.message);
            // console.log(result);
            // toastr.error(result.message);
        

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