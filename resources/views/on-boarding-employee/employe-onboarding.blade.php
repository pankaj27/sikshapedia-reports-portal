<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="Sikshapedia Employe Onboarding Form | sikshapedia Sales Portal" name="description">
    
    <title>Employe Onboarding Form | sikshapedia Sales Portal</title>
    <!-- FAVICONS -->
   
    <!-- CSS -->
    <link href="{{ asset('assets/frontend/onboarding/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/onboarding/css/style.css') }}" rel="stylesheet">
    <!-- FONT -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet">
    <style>
        .picture-container{
            position: relative;
            cursor: pointer;
            text-align: center;
        }
        .picture{
            width: 100px;
            height: 130px;
            background-color: #999999;
            border: 2px solid #CCCCCC;
            color: #FFFFFF;
            /*border-radius: 50%;*/
            margin: 0px auto;
            overflow: hidden;
            transition: all 0.2s;
            -webkit-transition: all 0.2s;
        }
        .picture:hover{
            border-color: #2ca8ff;
        }
        .content.ct-wizard-green .picture:hover{
            border-color: #05ae0e;
        }
        .content.ct-wizard-blue .picture:hover{
            border-color: #3472f7;
        }
        .content.ct-wizard-orange .picture:hover{
            border-color: #ff9500;
        }
        .content.ct-wizard-red .picture:hover{
            border-color: #ff3b30;
        }
        .picture input[type="file"] {
            cursor: pointer;
            display: block;
            height: 100%;
            left: 0;
            opacity: 0 !important;
            position: absolute;
            top: 0;
            width: 100%;
        }

        .picture-src{
            width: 100%;
            
        }
    </style>
</head>
<body>
    <!-- CONTAINER -->
    <div class="container d-flex align-items-center min-vh-100">
        <div class="row g-0 justify-content-center">
            <!-- TITLE -->
            <div class="col-lg-4 offset-lg-1 mx-0 px-0">
                <div id="title-container">
                    <img class="covid-image" src="{{asset('assets/frontend/onboarding/img/sikshapedia.png') }}">
                    <h2>Employee Onboarding</h2>
                    <h3>Registration Form</h3>
                    <p>Register with us to continue your Employment with us.Please provide your all information details step by step to complete the process.</p>
                </div>
            </div>
            <!-- FORMS -->
            <div class="col-lg-8 mx-0 px-0">
                <div class="progress">
                    <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="50" class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" style="width: 0%"></div>
                </div>
                <div id="qbox-container">
                    <form class="needs-validation" id="form-wrapper" method="post" name="form-wrapper" novalidate="">
                        <div id="steps-container">
                            <div class="step">
                                <h4>Personal Details</h4>
                                <div class="form-check ps-0 q-box">
                                    <div class="row">
                                        <div class="col-12 p-1">
                                            <div class="form-group ">
                                                
                                                <input type="text" class="form-control pb1" id="name" name="name"  placeholder="Enter name">
                                                
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 p-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control " id="fname" name="fname" placeholder="Enter father's name">
                                            </div>                                            
                                        </div>
                                        <div class="col-6 p-1">
                                            <div class="form-group">                                                
                                                <input type="text" class="form-control" id="mname" name="mname" placeholder="Enter mother's name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 p-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control " id="dob" name="dob" placeholder="select date of birth">
                                            </div>                                            
                                        </div>
                                        <div class="col-6 p-1">
                                            <div class="form-group">                                                
                                                <input type="text" class="form-control" id="birth_place" name="birth_place" placeholder="Enter place of birth">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 p-1">
                                            <div class="form-group">
                                                <select class="form-control" name="identification_mark" id="identification_mark">
                                                    <option value="">Do you have any identification mark?</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>                                            
                                        </div>
                                        <div class="col-6 p-1">
                                            <div class="form-group">                                                
                                                <select class="form-control" name="blood_group" id="blood_group">
                                                    <option value="">Select your Blood Group</option>
                                                    <option value="A+">A+</option>
                                                    <option value="A+">A-</option>
                                                    <option value="B+">B+</option>
                                                    <option value="B-">B-</option>
                                                    <option value="O+">O+</option>
                                                    <option value="O-">O-</option>
                                                    <option value="AB+">AB+</option>
                                                    <option value="AB-">AB-</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 p-1">
                                            <div class="form-group">
                                                <select class="form-control" name="identification_mark" id="identification_mark">
                                                    <option value="">Martial Status</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Not Married">Not Married</option>
                                                </select>
                                            </div>                                            
                                        </div>
                                        <div class="col-12 p-1">
                                            <div class="mb-3">
                                                <textarea class="form-control" id="present_address" name="present_address" rows="3" placeholder="Enter your present address.."></textarea>
                                              </div>
                                        </div>
                                        <div class="col-12 p-0">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                  Same as present address
                                                </label>
                                              </div>
                                        </div>
                                        <div class="col-12 p-0">
                                            <div class="mb-3">
                                                <textarea class="form-control" id="permanent_address" name="permanent_address" rows="3" placeholder="Enter your permanent address.."></textarea>
                                              </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4 p-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control " id="pan" name="pan" placeholder="Enter your PAN number">
                                            </div>                                            
                                        </div>
                                        <div class="col-4 p-1">
                                            <div class="form-group">                                                
                                                <input type="text" class="form-control" id="adhar_num" name="adhar_num" placeholder="Enter adhar number">
                                            </div>
                                        </div>

                                        <div class="col-4 p-1">
                                            <div class="form-group">                                                
                                                <input type="email" class="form-control" id="email_id" name="email_is" placeholder="Enter your email id">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-4 p-1">
                                            <div class="form-group">
                                                <input type="number" class="form-control " id="mobile_num" name="mobile" placeholder="10 digit Mobile number">
                                            </div>                                            
                                        </div>
                                        <div class="col-4 p-1">
                                            <div class="form-group">                                                
                                                <input type="text" class="form-control" id="emergency_number" name="emergency_number" placeholder="Emergency contact no">
                                            </div>
                                        </div>

                                        <div class="col-4 p-1">
                                            <div class="form-group">                                                
                                                <input type="email" class="form-control" id="spouce_no" name="spouce_no" placeholder="Parent/Spouce contact no.">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 p-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control " id="reference_name" name="reference_name" placeholder="One Reference name">
                                            </div>                                            
                                        </div>
                                        <div class="col-6 p-1">
                                            <div class="form-group">                                                
                                                <input type="number" class="form-control" id="reference_number" name="reference_number" placeholder="Reference contact no.">
                                            </div>
                                        </div>

                                        
                                    </div>

                                    <div class="row">
                                        <div class="col-4 p-1">
                                            <div class="picture-container">
                                                <div class="picture">
                                                    <img src="{{asset('assets/frontend/onboarding/img/image-preview.png')}}" class="picture-src" id="wizardPicturePreview" title="">
                                                    <input type="file" id="wizard-picture" class="">
                                                </div>
                                                 <h6 class="">Choose Your Photo</h6>                                        
                                            </div>                                            
                                        </div>
                                        <div class="col-4 p-1">
                                            <div class="picture-container">
                                                <div class="picture">
                                                    <img src="{{asset('assets/frontend/onboarding/img/image-preview.png')}}" class="picture-src" id="wizardPicturePreviewPan" title="">
                                                    <input type="file" id="wizard-picture-pan" class="">
                                                </div>
                                                 <h6 class="">Choose PAN Card</h6>                                        
                                            </div> 
                                        </div>

                                        <div class="col-4 p-1">
                                            <div class="picture-container">
                                                <div class="picture">
                                                    <img src="{{asset('assets/frontend/onboarding/img/image-preview.png')}}" class="picture-src" id="wizardPicturePreviewAdhar" title="">
                                                    <input type="file" id="wizard-picture-adhar" class="">
                                                </div>
                                                 <h6 class="">Choose ADHAR Card</h6>                                        
                                            </div> 
                                        </div>
                                    </div>


                                    
                                </div>
                            </div>
                            <div class="step">
                                <h4>Academic Details</h4>
                                <div class="form-check ps-0 q-box">
                                    <div class="row">
                                        <div class="col-12 p-1">
                                            
                                                
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-hover">
                                                      <thead>
                                                        <tr>
                                                            <th>
                                                                Name
                                                            </th>
                                                            <th>
                                                                Board Name
                                                            </th>
                                                            <th>
                                                                Year of Passing
                                                            </th>
                                                            <th>
                                                                Percentage(%)
                                                            </th>
                                                            <th>
                                                                Marksheet
                                                            </th>
                                                            <td>
                                                                Certificate
                                                            </td>
                                                        </tr>
                                                      </thead>
                                                      <tbody>
                                                            <tr>
                                                                <td>
                                                                    10th
                                                                </td>
                                                                <td>
                                                                    <select class="form-control">
                                                                        <option value="">Select Board</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control">
                                                                        <option value="">Year of Passing</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="percentage" class="form-control" placeholder="Percentage(%)"/>
                                                                </td>
                                                                <td>
                                                                    <div class="picture-container">
                                                                        <div class="picture" style="width:40px;">
                                                                            <img src="{{asset('assets/frontend/onboarding/img/image-preview.png')}}" class="picture-src" id="wizardPicturePreviewMarksheet" style="width:40px;" title="">
                                                                            <input type="file" id="wizard-picture-marksheet" class="">
                                                                        </div>
                                                                        <h6 class="">Choose Marksheet</h6>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="picture-container">
                                                                        <div class="picture" style="width:40px;height:">
                                                                            <img src="{{asset('assets/frontend/onboarding/img/image-preview.png')}}" class="picture-src" id="wizardPicturePreviewCertificate" style="width:40px;" title="">
                                                                            <input type="file" id="wizard-picture-certificate" class="">
                                                                        </div>
                                                                        <h6 class="">Choose Certificate</h6>
                                                                    </div>
                                                                </td>
                                                               
                                                            </tr>
                                                      </tbody>
                                                    </table>
                                                  </div>
                                                
                                           
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="step">
                                <h4>Are you having diarrhoea, stomach pain, conjunctivitis, vomiting and headache?</h4>
                                <div class="form-check ps-0 q-box">
                                    <div class="q-box__question">
                                        <input class="form-check-input question__input" id="q_3_yes" name="q_3" type="radio" value="Yes"> 
                                        <label class="form-check-label question__label" for="q_3_yes">Yes</label>
                                    </div>
                                    <div class="q-box__question">
                                        <input checked class="form-check-input question__input" id="q_3_no" name="q_3" type="radio" value="No"> 
                                        <label class="form-check-label question__label" for="q_3_no">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="step">
                                <h4>Have you traveled to any of these countries with the highest number of COVID-19 cases in the world for the past 2 weeks?</h4>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question">
                                                <input class="form-check-input question__input q-checkbox" id="q_4_uk" name="q_4" type="checkbox" value="uk"> 
                                                <label class="form-check-label question__label" for="q_4_uk">UK</label>
                                            </div>
                                        </div>
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question">
                                                <input class="form-check-input question__input" id="q_4_us" name="q_4" type="checkbox" value="us"> 
                                                <label class="form-check-label question__label" for="q_4_us">US</label>
                                            </div>
                                        </div>
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question">
                                                <input class="form-check-input question__input" id="q_4_br" name="q_3" type="checkbox" value="br"> 
                                                <label class="form-check-label question__label" for="q_4_br">Brazil</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question">
                                                <input class="form-check-input question__input" id="q_4_de" name="q_4" type="checkbox" value="de"> 
                                                <label class="form-check-label question__label" for="q_4_de">Germany</label>
                                            </div>
                                        </div>
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question">
                                                <input class="form-check-input question__input" id="q_4_in" name="q_4" type="checkbox" value="in"> 
                                                <label class="form-check-label question__label" for="q_4_in">India</label>
                                            </div>
                                        </div>
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question">
                                                <input class="form-check-input question__input" id="q_4_eu" name="q_4" type="checkbox" value="eu"> 
                                                <label class="form-check-label question__label" for="q_4_eu">Europe</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question">
                                                <input class="form-check-input question__input" id="q_4_none" name="q_4" type="checkbox" value="none"> 
                                                <label class="form-check-label question__label" for="q_4_none">I did not travelled to any of these countries</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="step">
                                <h4>Are you experiencing any of these serious symptoms of COVID-19 below?</h4>
                                <div class="row">
                                    <div class="form-check ps-0 q-box">
                                        <div class="q-box__question">
                                            <input class="form-check-input question__input" id="q_5_breathing" name="q_5_breathing" type="checkbox" value="breathing"> 
                                            <label class="form-check-label question__label" for="q_5_breathing">Difficulty breathing or shortness of breath</label>
                                        </div>
                                    </div>
                                    <div class="form-check ps-0 q-box">
                                        <div class="q-box__question">
                                            <input class="form-check-input question__input" id="q_5_chest" name="q_5_chest" type="checkbox" value="chest pain"> 
                                            <label class="form-check-label question__label" for="q_5_chest">Chest pain or pressure</label>
                                        </div>
                                    </div>
                                    <div class="form-check ps-0 q-box">
                                        <div class="q-box__question">
                                            <input class="form-check-input question__input" id="q_5_speech" name="q_5_speech" type="checkbox" value="speech problem"> 
                                            <label class="form-check-label question__label" for="q_5_speech">Loss of speech or movement</label>
                                        </div>
                                    </div>
                                    <div class="form-check ps-0 q-box">
                                        <div class="q-box__question">
                                            <input class="form-check-input question__input" id="q_5_pale" name="q_5_pale" type="checkbox" value="pale"> 
                                            <label class="form-check-label question__label" for="q_5_pale">Pale, gray or blue-colored skin, lips or nail beds</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="step">
                                <h4>Provide us with your personal information</h4>
                                <div class="mt-1">
                                    <label class="form-label">Complete Name:</label> 
                                    <input class="form-control" id="full_name" name="full_name" type="text">
                                </div>
                                <div class="mt-2">
                                    <label class="form-label">Complete Address:</label> 
                                    <input class="form-control" id="address" name="address" type="text">
                                </div>
                                <div class="mt-2">
                                    <label class="form-label">Email:</label> 
                                    <input class="form-control" id="email" name="email" type="email">
                                </div>
                                <div class="mt-2">
                                    <label class="form-label">Phone / Mobile Number:</label> 
                                    <input class="form-control" id="phone" name="phone" type="text">
                                </div>
                                <div class="row mt-2">
                                    <div class="col-lg-2 col-md-2 col-3">
                                        <label class="form-label">Age:</label>
                                        <div class="input-container">
                                            <input class="form-control" id="age" name="age" type="text">
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div id="input-container">
                                            <input class="form-check-input" name="gender" type="radio" value="male"> 
                                            <label class="form-check-label radio-lb">Male</label> 
                                            <input class="form-check-input" name="gender" type="radio" value="female"> 
                                            <label class="form-check-label radio-lb">Female</label> 
                                            <input checked class="form-check-input" name="gender" type="radio" value="undefined"> 
                                            <label class="form-check-label radio-lb">Rather not say</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="step">
                                <div class="mt-1">
                                    <div class="closing-text">
                                        <h4>That's about it! Stay healthy!</h4>
                                        <p>We will assess your information and will let you know soon if you need to get tested for COVID-19.</p>
                                        <p>Click on the submit button to continue.</p>
                                    </div>
                                </div>
                            </div>
                            <div id="success">
                                <div class="mt-5">
                                    <h4>Success! We'll get back to you ASAP!</h4>
                                    <p>Meanwhile, clean your hands often, use soap and water, or an alcohol-based hand rub, maintain a safe distance from anyone who is coughing or sneezing and always wear a mask when physical distancing is not possible.</p>
                                    <a class="back-link" href="">Go back from the beginning ➜</a>
                                </div>
                            </div>
                        </div>
                        <div id="q-box__buttons">
                            <button id="prev-btn" type="button">Previous</button> 
                            <button id="next-btn" type="button">Next</button> 
                            <button id="submit-btn" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- PRELOADER -->
    <div id="preloader-wrapper">
        <div id="preloader"></div>
        <div class="preloader-section section-left"></div>
        <div class="preloader-section section-right"></div>
    </div>
    <script src="{{ asset('assets/frontend/onboarding/js/script.js') }}">
    </script>


<script defer src="https://static.cloudflareinsights.com/beacon.min.js/v84a3a4012de94ce1a686ba8c167c359c1696973893317" integrity="sha512-euoFGowhlaLqXsPWQ48qSkBSCFs3DPRyiwVu3FjR96cMPx+Fr+gpWRhIafcHwqwCqWS42RZhIudOvEI+Ckf6MA==" data-cf-beacon='{"rayId":"85667ca67ca05526","version":"2024.2.0","token":"1bff91cd11f54ec58f75741ac691976b"}' crossorigin="anonymous"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
  $(document).ready(function(){
    // Prepare the preview for profile picture
        $("#wizard-picture").change(function(){
            readURL(this);
        });

        $("#wizard-picture-pan").change(function(){
            readURLPan(this);
        });

        $("#wizard-picture-adhar").change(function(){
            readURLAdhar(this);
        });
});
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
function readURLPan(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#wizardPicturePreviewPan').attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
function readURLAdhar(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#wizardPicturePreviewAdhar').attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
</body>
</html>