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
                                <a href="javascript:void(0)" class="deepGreen-btn-radius my-1" data-bs-toggle="modal" data-bs-target="#completeDealModal" data-bs-target="#staticBackdrop">Complete Deal</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript:void(0)" class="red-btn-radius my-1" data-bs-toggle="modal" data-bs-target="#closeDealModal" data-bs-target="#staticBackdrop">Close Lead</a>
                            </li>
                        </ul>

                        <!----  Send Proposal Modal -->
                        @include('backend.visit-report.partials.send-proposal-modal')

                        <!----  Complete Deal Modal -->
                       @include('backend.visit-report.partials.complete-deal-modal')
                       


                        <!----  Send Proposal Modal -->
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
</script>

@endsection