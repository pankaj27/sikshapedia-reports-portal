<div class="d-flex justify-content-between align-items-center mb-4">
    
    <div class="d-flex align-items-center">
        
        <a href="{{route('product-settings')}}" class="btn btn-primary menu menu-big">View Product</a>
    </div>
</div>
<style>
    .buttonIn { 
        width: 100%; 
        position: relative; 
    } 
      
    
      
    .clearnew { 
        position: absolute; 
        right: 1%; 
        z-index: 2; 
        top: 12%; 
        height: 20%; 
        cursor: pointer; 
        
    } 
</style>
<form action="{{ route('store-product')}}" method="post" enctype="multipart/form-data" class="needs-validation @if ($errors->any()) was-validated @endif" novalidate>
    @csrf
<!---------------------------- SITE NAME ------------------------------------------->
<div class="row">
    <div class="col-lg-3">
        <div class="form-group pb-3">
            <div class="d-flex justify-content-between mb-2" >
                <label for="forl-label site-title">Product Title <span class="text-danger">(*)</span></label>               
            </div> 
        </div>
    </div>
    <div class="col-lg-9">
        <div class="form-group pb-3">
            <input required="required" id="product_title" name="product_title" type="text"
              class="form-control round-input m-2 " placeholder="Product Title" />

              <div class="invalid-feedback">
                  Please enter product title.
              </div>
              @if ($errors->has('product_title'))
                                
                <div class="invalid-feedback"  >
                    {{ $errors->first('product_title') }}
                </div>
            @endif

        </div>
    </div>
</div>
<!---------------------------- SITE NAME ------------------------------------------->
<div class="row">
    <div class="col-lg-3">
        <div class="form-group pb-3">
            <div class="d-flex justify-content-between mb-2" >
                <label for="forl-label">Product Features<span class="text-danger">(*)</span></label>               
            </div> 
        </div>
    </div>
    <div class="col-lg-9">
        <div class="form-group pb-3">
            
            <input required="required" id="product_features_1" name="product_features[]" required="required" type="text"
              class="form-control round-input m-2" placeholder="add product features"  />
              
            </div>
              <input type="hidden" name="features_number" id="features_number" value="1" />
              <div class="invalid-feedback">
                  Please enter product features
              </div>
              @if ($errors->has('product_features_1'))
                                
                <div class="invalid-feedback"  >
                    {{ $errors->first('product_features_1') }}
                </div>
             @endif
             
             
             <div class="col-12" id="product_feat">

             </div>
             &nbsp;&nbsp;
             <button type="button" class="btn btn-primary menu btn-sm " style="float:right;" onclick="add_more_features()">Add More  Features</button>

             <br>

        </div>
    </div>
</div>

<!---------------------------- SITE Email ------------------------------------------->
<div class="row">
    <div class="col-lg-3">
        <div class="form-group pb-3">
            <div class="d-flex justify-content-between mb-2" >
                <label for="forl-label">Product one time cost <span class="text-danger">(*)</span></label>               
            </div> 
        </div>
    </div>
    <div class="col-lg-9">
        <div class="form-group pb-3">
            <input required="required" id="product_one_time_cost" name="product_one_time_cost" type="text"
              class="form-control round-input m-2" placeholder="Product one time cost  " />

              <div class="invalid-feedback">
                  Please enter product one tiime cost
              </div>
              @if ($errors->has('product_one_time_cost'))
                                
                <div class="invalid-feedback"  >
                    {{ $errors->first('product_one_time_cost') }}
                </div>
            @endif

        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3">
        <div class="form-group pb-3">
            <div class="d-flex justify-content-between mb-2" >
                <label for="forl-label">Product Discount<span class="text-danger">(*)</span></label>               
            </div> 
        </div>
    </div>
    <div class="col-lg-9">
        <div class="form-group pb-3">
            <input required="required" id="product_dicount" name="product_dicount" type="text"
              class="form-control round-input m-2 " placeholder="Product discount  "  />

              <div class="invalid-feedback">
                  Please enter product discount
              </div>
              @if ($errors->has('product_one_time_cost'))
                                
                <div class="invalid-feedback"  >
                    {{ $errors->first('product_one_time_cost') }}
                </div>
            @endif

        </div>
    </div>
</div>



<!---------------------------- SITE Mobile ------------------------------------------->
<div class="row">
    <div class="col-lg-3">
        <div class="form-group pb-3">
            <div class="d-flex justify-content-between mb-2" >
                <label for="forl-label">Installment Cost<span class="text-danger">(*)</span></label>               
            </div> 
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group pb-3">
            <input  id="installment_no_1" name="installment_no_1" type="text"
              class="form-control round-input m-2 " placeholder="Installment no Ex: 2 "  />

              <input type="hidden" id="installmentno" name="installmentno" value="1">
              

        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group pb-3">
            
            <input  id="installment_cost_1" name="installment_cost_1" type="text"
              class="form-control round-input m-2 " placeholder="Installment cost "  />
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group pb-3">
            
            <input  id="installment_terms_1" name="installment_terms_1" type="text"
              class="form-control round-input m-2 " placeholder="Installment terms  "  />

        </div>
    </div>

    <div class="col-12" id="installment_feet">
        
        &nbsp;&nbsp;
        
    </div>
    <div class="col-12">
        <button type="button" class="btn btn-primary menu btn-sm " style="float:right;" onclick="add_more_installment()">Add More  Installment</button>

    </div>
    

    
             




</div>


<!---------------------------- SITE Favicon & Logo ------------------------------------------->



<div class="row">
    <div class="col-lg-12">
        <center>
            
                <div class="form-group  pb-sm">
                    <div class="text-danger asterik text-end mb-0 pb-0 d-mobileNone "></div>
                    <button type="submit" class="btn btn-primary menu menu-big "
                    id="lead_callregister"> CREATE NEW PRODUCT </button>
                </div>
            
        </center>
    </div>
  </div>
</form>

<script>
    

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

       var size=(files[0].size)/1000;
       //console.log(size);
       if(size>100){

        //alert ('hello');

        toastr.error(ff+ " File is too big! File size should be under 100KB", "Error!", {
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

       }else{

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

	   
	}

    function add_more_features(){

        var features_number = parseInt($("#features_number").val());

        var newfeatures_number = features_number+1;

        $("#features_number").val(newfeatures_number);

       
            var emp = '<div class="buttonIn" id="button_id_'+newfeatures_number+'"><input required="required" id="product_features_'+newfeatures_number+'" name="product_features[]" type="text" class="form-control round-input m-2"  placeholder="add product features"  /><span id="button_idn_'+newfeatures_number+'" class="clearnew" onclick="delete_input(this.id)"><i class="glyphicon glyphicon-trash text-danger"></i></span> </div>';
            

            $("#product_feat").append(emp);

    }

    function delete_input(id){

        var idsplit = id.split("_");
        //alert(idsplit);
        if(confirm('are you sure? You want to delete ?')){
            var features_number = parseInt($("#features_number").val());

            var newfeatures_number = features_number-1;

            $("#features_number").val(newfeatures_number);
            $("#button_id_"+idsplit[2]).remove();
        }


    }

    function add_more_installment(){

        var features_number = parseInt($("#installmentno").val());

        var newfeatures_number = features_number+1;

        $("#installmentno").val(newfeatures_number);

       
            var emp = '';
            emp += '<div class="row" id="btndele_'+newfeatures_number+'"><div class="col-lg-3">';
            emp += '<div class="form-group pb-3">';
            emp += '<div class="d-flex justify-content-between mb-2" >';
            emp += '<label for="forl-label"></label>';               
            emp += '</div>'; 
            emp += '</div>';
            emp += '</div>';
            emp += '<div class="col-lg-3">';
            emp += '<div class="form-group pb-3">';
            emp += '<input required="required" id="installment_no_'+newfeatures_number+'" name="installment_no_'+newfeatures_number+'" type="text"  class="form-control round-input m-2 " placeholder="Installment no Ex: 2 "  />';
            emp += '</div>';
            emp += '</div>';
            emp += '<div class="col-lg-3">';
            emp += '<div class="form-group pb-3">';
            
            emp +='<input required="required" id="installment_cost_'+newfeatures_number+'" name="installment_cost_'+newfeatures_number+'" type="text" class="form-control round-input m-2 " placeholder="Installment cost "  />';
            emp +='</div>';
            emp +='</div>';
            emp +='<div class="col-lg-2">';
            emp +='<div class="form-group pb-3">';
            
            emp +='<input required="required" id="installment_terms_'+newfeatures_number+'" name="installment_terms_'+newfeatures_number+'" type="text" class="form-control round-input m-2 " placeholder="Installment terms  "  />';

            emp +='</div>';
            emp +='</div>';
            emp +='<div class="col-lg-1">';
            emp +='<div class="form-group pb-3">';
            
            emp +='<span style="position:relative;top:15px;" id="deletebutton_idn_'+newfeatures_number+'" class="btn btn-default btn-sm" onclick="deletebtn_input(this.id)"><img src="{{asset('assets/assets/img/delete-icon.png')}}" style="width:20px;"></span>';

            emp +='</div>';
            emp +='</div></div>';

            $("#installment_feet").append(emp);
    }

    function deletebtn_input(id){

        var idsplit = id.split("_");
        //alert(idsplit);
        if(confirm('are you sure? You want to delete ?')){
            var features_number = parseInt($("#installmentno").val());

            var newfeatures_number = features_number-1;

            $("#installmentno").val(newfeatures_number);
            
            $("#btndele_"+idsplit[2]).remove();
        }
    }

   

    
</script>