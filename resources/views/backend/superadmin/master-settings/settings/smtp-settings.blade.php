<?php 
 namespace App\CPU\Helpers;

?>

<!------------------- SITE NAME ------------------------------------------->
<div class="row">
    
    <div class="col-12">
        <div class="whiteBox p-4">
          <div class="row">
            <div class="col-md-12">
              <div class="card-flex">
                
                <div class="StatusBox">
                  
                    <button class="btn btn-primary menu menu-big" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false"
                                        aria-controls="collapseExample">
                                    <i class="tio-email-outlined"></i>
                                    Test Your Email Integration
                    </button>

                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            <form class="" action="javascript:">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group mb-2">
                                            <label for="inputPassword2"
                                                   class="sr-only">Email Id</label>
                                            <input type="email" id="test-email" class="form-control"
                                                   placeholder="Ex : jhon@email.com">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <button type="button" onclick="send_mail()" class="btn btn-success menu menu-big">
                                            <i class="tio-telegram"></i>
                                            Send Mail
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      @php($data_smtp= (new \App\CPU\Helpers)::get_business_settings('mail_config'))
      <form action="{{ route('update-smtp-settings')}}" method="post" enctype="multipart/form-data" class="needs-validation @if ($errors->any()) was-validated @endif" novalidate>
        @csrf
    <!---------------------------- SITE NAME ------------------------------------------->
    <div class="row">
    
        <div class="col-12">
            <div class="whiteBox p-4">
              <div class="row">
                <div class="col-md-12">
                  <div class="card-flex">
                    <div class="StatusBox col-md-12">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group pb-3">
                                        <div class="d-flex justify-content-between mb-2" >
                                            <label for="forl-label site-title">Mailer Name<span class="text-danger">(*)</span></label>               
                                        </div> 
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-group pb-3">
                                        <input required="required" id="name" name="name" type="text"
                                        class="form-control round-input " placeholder="Engter mailer name" value="{{$data_smtp['name']}}" />
                            
                                        <div class="invalid-feedback">
                                            Please enter mailer name.
                                        </div>
                                        @if ($errors->has('mailer_name'))
                                                            
                                            <div class="invalid-feedback"  >
                                                {{ $errors->first('mailer_name') }}
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
                                            <label for="forl-label">Host <span class="text-danger">(*)</span></label>               
                                        </div> 
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-group pb-3">
                                        <input required="required" id="host" name="host" type="text"
                                        class="form-control round-input " placeholder="Enter host name " value="{{$data_smtp['host']}}" />
                            
                                        <div class="invalid-feedback">
                                            Please enter host name.
                                        </div>
                                        @if ($errors->has('host_name'))
                                                            
                                            <div class="invalid-feedback"  >
                                                {{ $errors->first('host_name') }}
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
                                            <label for="forl-label">Mail Driver <span class="text-danger">(*)</span></label>               
                                        </div> 
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-group pb-3">
                                        <input required="required" id="driver" name="driver" type="text"
                                        class="form-control round-input " placeholder="Enter email driver" value="{{$data_smtp['driver']}}" />
                            
                                        <div class="invalid-feedback">
                                            Please enter email driver.
                                        </div>
                                        @if ($errors->has('mail_driver'))
                                                            
                                            <div class="invalid-feedback"  >
                                                {{ $errors->first('mail_driver') }}
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
                                            <label for="forl-label">Port <span class="text-danger">(*)</span></label>               
                                        </div> 
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-group pb-3">
                                        <input required="required" id="port" name="port" type="text"
                                        class="form-control round-input " placeholder="Enter email port" value="{{$data_smtp['port']}}"/>
                            
                                        <div class="invalid-feedback">
                                            Please enter mail port .
                                        </div>
                                        @if ($errors->has('mail_port'))
                                                            
                                            <div class="invalid-feedback"  >
                                                {{ $errors->first('mail_port') }}
                                            </div>
                                        @endif
                            
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group pb-3">
                                        <div class="d-flex justify-content-between mb-2" >
                                            <label for="forl-label">Username <span class="text-danger">(*)</span></label>               
                                        </div> 
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-group pb-3">
                                        <input required="required" id="username" name="username" type="text"
                                        class="form-control round-input " placeholder="Enter username" value="{{$data_smtp['username']}}" />
                            
                                        <div class="invalid-feedback">
                                            Please enter username.
                                        </div>
                                        @if ($errors->has('username'))
                                                            
                                            <div class="invalid-feedback"  >
                                                {{ $errors->first('username') }}
                                            </div>
                                        @endif
                            
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group pb-3">
                                        <div class="d-flex justify-content-between mb-2" >
                                            <label for="forl-label">Email Id <span class="text-danger">(*)</span></label>               
                                        </div> 
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-group pb-3">
                                        <input required="required" id="email" name="email" type="text"
                                        class="form-control round-input " placeholder="Enter email id " value="{{$data_smtp['email_id']}}" />
                            
                                        <div class="invalid-feedback">
                                            Please enter email id .
                                        </div>
                                        @if ($errors->has('email_id'))
                                                            
                                            <div class="invalid-feedback"  >
                                                {{ $errors->first('email_id') }}
                                            </div>
                                        @endif
                            
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group pb-3">
                                        <div class="d-flex justify-content-between mb-2" >
                                            <label for="forl-label">Email Encryption <span class="text-danger">(*)</span></label>               
                                        </div> 
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-group pb-3">
                                        <select class="form-control round-input" name="encryption" id="encryption" required="required">
                                            <option value="">--Select encryption type</option>
                                            <option value="ssl" @if($data_smtp['encryption'] == 'ssl') selected="selected" @endif>SSL</option>
                                            <option value="tls" @if($data_smtp['encryption'] == 'tls') selected="selected" @endif>TLS</option>
                                        </select>

                                        <div class="invalid-feedback">
                                            Please select encryption type.
                                        </div>
                                        @if ($errors->has('mail_encryption'))
                                                            
                                            <div class="invalid-feedback"  >
                                                {{ $errors->first('mail_encryption') }}
                                            </div>
                                        @endif
                            
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group pb-3">
                                        <div class="d-flex justify-content-between mb-2" >
                                            <label for="forl-label">Password <span class="text-danger">(*)</span></label>               
                                        </div> 
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-group pb-3">
                                        <input required="required" id="password" name="password" type="text"
                                        class="form-control round-input " placeholder="Ener your email password" value="{{$data_smtp['password']}}" />
                            
                                        <div class="invalid-feedback">
                                            Please enter email password .
                                        </div>
                                        @if ($errors->has('password'))
                                                            
                                            <div class="invalid-feedback"  >
                                                {{ $errors->first('password') }}
                                            </div>
                                        @endif
                            
                                    </div>
                                </div>
                            </div>
                            
                            
                            <!---------------------------- SITE Favicon & Logo ------------------------------------------->
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            <div class="row">
                                <div class="col-lg-12">
                                    <center>
                                        
                                            <div class="form-group  pb-sm">
                                                <div class="text-danger asterik text-end mb-0 pb-0 d-mobileNone "></div>
                                                <button type="submit" class="btn btn-primary menu menu-big "
                                                id="lead_callregister"> SUBMIT & UPDATE </button>
                                            </div>
                                        
                                    </center>
                                </div>
                            </div>
                            </form>
                            
                            <script>
                                
                            
                            
                                
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

    
</div>
<!---------------------------- SITE NAME ------------------------------------------->
</div>
<script>
    function ValidateEmail(inputText) {
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (inputText.match(mailformat)) {
            return true;
        } else {
            return false;
        }
    }

    function send_mail() {
        if (ValidateEmail($('#test-email').val())) {
            
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{route('send-smtp-test-mail')}}",
                        method: 'POST',
                        data: {
                            "email": $('#test-email').val()
                        },
                        beforeSend: function () {
                           $('.ajax-loader').css("visibility", "visible");
                        },
                        success: function (data) {
                            if (data.success === 2) {
                                toastr.error('Email configuration error!!');
                                //console.log(data.error)
                            } else if (data.success === 1) {
                                toastr.success('Email configured perfectly!');
                            } else {
                                toastr.info('Email status is not active!');
                            }
                        },
                        complete: function () {
                            $('.ajax-loader').css("visibility", "hidden");

                        }
                    });
                
            
        } else {
            toastr.error('Invalid Email address!!');
        }
    }
</script>


