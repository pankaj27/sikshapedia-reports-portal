<form action="{{ route('update-general-settings')}}" method="post" enctype="multipart/form-data" class="needs-validation @if ($errors->any()) was-validated @endif" novalidate>
    @csrf
<!---------------------------- SITE NAME ------------------------------------------->
<div class="row">
    <div class="col-lg-4">
        <div class="form-group pb-3">
            <div class="d-flex justify-content-between mb-2" >
                <label for="forl-label site-title">Site Title <span class="text-danger">(*)</span></label>               
            </div> 
        </div>
    </div>
    <div class="col-lg-8">
        <div class="form-group pb-3">
            <input required="required" id="site_title" name="site_title" type="text"
              class="form-control round-input " placeholder="Site Title " value="@if(isset($general_settings->site_title)){{$general_settings->site_title}} @endif" />

              <div class="invalid-feedback">
                  Please enter site title.
              </div>
              @if ($errors->has('site_title'))
                                
                <div class="invalid-feedback"  >
                    {{ $errors->first('site_title') }}
                </div>
            @endif

        </div>
    </div>
</div>
<!---------------------------- SITE NAME ------------------------------------------->
<div class="row">
    <div class="col-lg-4">
        <div class="form-group pb-3">
            <div class="d-flex justify-content-between mb-2" >
                <label for="forl-label">Site Name <span class="text-danger">(*)</span></label>               
            </div> 
        </div>
    </div>
    <div class="col-lg-8">
        <div class="form-group pb-3">
            <input required="required" id="site_name" name="site_name" type="text"
              class="form-control round-input " placeholder="Site Name " value="@if(isset($general_settings->site_name)){{$general_settings->site_name}} @endif" />

              <div class="invalid-feedback">
                  Please enter site name.
              </div>
              @if ($errors->has('site_name'))
                                
                <div class="invalid-feedback"  >
                    {{ $errors->first('site_name') }}
                </div>
            @endif

        </div>
    </div>
</div>

<!---------------------------- SITE Email ------------------------------------------->
<div class="row">
    <div class="col-lg-4">
        <div class="form-group pb-3">
            <div class="d-flex justify-content-between mb-2" >
                <label for="forl-label">Site Email <span class="text-danger">(*)</span></label>               
            </div> 
        </div>
    </div>
    <div class="col-lg-8">
        <div class="form-group pb-3">
            <input required="required" id="site_email" name="site_email" type="email"
              class="form-control round-input " placeholder="Site Email " value="@if(isset($general_settings->site_email)){{$general_settings->site_email}} @endif" />

              <div class="invalid-feedback">
                  Please enter site email.
              </div>
              @if ($errors->has('site_email'))
                                
                <div class="invalid-feedback"  >
                    {{ $errors->first('site_email') }}
                </div>
            @endif

        </div>
    </div>
</div>



<!---------------------------- SITE Mobile ------------------------------------------->
<div class="row">
    <div class="col-lg-4">
        <div class="form-group pb-3">
            <div class="d-flex justify-content-between mb-2" >
                <label for="forl-label">Site Mobile <span class="text-danger">(*)</span></label>               
            </div> 
        </div>
    </div>
    <div class="col-lg-8">
        <div class="form-group pb-3">
            <input required="required" id="site_mobile" name="site_mobile" type="text"
              class="form-control round-input " placeholder="Site Mobile " value="@if(isset($general_settings->site_mobile)){{$general_settings->site_mobile}} @endif" />

              <div class="invalid-feedback">
                  Please enter site mobile .
              </div>
              @if ($errors->has('site_mobile'))
                                
                <div class="invalid-feedback"  >
                    {{ $errors->first('site_mobile') }}
                </div>
            @endif

        </div>
    </div>
</div>


<!---------------------------- SITE Favicon & Logo ------------------------------------------->
<div class="row">
    <div class="col-lg-4">
        <div class="form-group pb-3">
            <div class="d-flex justify-content-between mb-2" >
                <label for="forl-label">Site Logo & Favicon <span class="text-danger">(*)</span></label>               
            </div> 
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">UPLOAD FAVICON</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>

        
        <input  id="site_favicon" name="site_favicon" type="file" required="required"  onchange="uploadFiles(this.id)"
            class="form-control round-input " />
            <span class="text-primary" id="previous_upload_site_favicon">
                
            </span>
            <div class="invalid-feedback">
                Please upload  favicon
            </div> 
            
           

        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group pb-3">
        <div class="d-flex justify-content-between mb-2" >
            <label for="forl-label">UPLOAD LOGO</label>
            <div class="text-danger asterik text-end mb-0 pb-0">*</div>
        </div>

        
        <input  id="site_main_logo" name="site_main_logo" type="file" required="required"  onchange="uploadFiles(this.id)"
            class="form-control round-input " />
            <span class="text-primary" id="previous_upload_site_main_logo">
                
            </span>
            <div class="invalid-feedback">
                Please upload main logo
            </div> 
            
           

        </div>
    </div>
</div>










<div class="row">
    <div class="col-lg-12">
        <center>
            
                <div class="form-group  pb-sm">
                    <div class="text-danger asterik text-end mb-0 pb-0 d-mobileNone "></div>
                    <button type="submit" class="btn btn-primary menu menu-big "
                    id="lead_callregister"> Update </button>
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

   

    
</script>