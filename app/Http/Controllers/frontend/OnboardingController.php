<?php

namespace App\Http\Controllers\frontend;

use App\Models\OnboardingAcademicDetails;
use App\Models\OnboardingBankDetails;
use App\Models\OnboardingPastEmploymentDetails;
use App\Models\PostApplied;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\OnboardingStepForm;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\OnboardingPersonalDetails;
use Illuminate\Support\Facades\Validator;

class OnboardingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userid = Session::get('userId');
        $post_applied = PostApplied::where('status','Active')->get();

        if(isset($userid)){

        $check_personal_details = OnboardingStepForm::where('applicant_id',$userid)->where('personal_details',1)->first();
        $check_education_details = OnboardingStepForm::where('applicant_id',$userid)->where('education_details',1)->first();
        $check_employment_details = OnboardingStepForm::where('applicant_id',$userid)->where('past_employment_details',1)->first();
        $check_bank_details = OnboardingStepForm::where('applicant_id',$userid)->where('bank_details',1)->first();

        $is_final_dubmit = OnboardingStepForm::where('applicant_id',$userid)->where('is_final_submit',1)->first();

        if(isset($is_final_dubmit) && !empty($is_final_dubmit)){

            return redirect()->route('submit')
            ->with('success','You have successfully submitted your application. We have sent one confirmation mail to your registered mail for future reference');
        }

        if(empty($check_personal_details)){

            return redirect()->route('personal-details')
                    ->with('success','Please fill out Personal Details Information');;
        }else if(empty($check_education_details)){

            return redirect()->route('education-details')
            ->with('success','Please fill out Education Details Information');;
        }else if(empty($check_employment_details)){

            return redirect()->route('employment-details')
            ->with('success','Please fill out Employment Details Information');;
        }else if(empty($check_bank_details)){

            return redirect()->route('bank-details')
            ->with('success','Please fill out Bank Details Information');;
        }else{

            return redirect()->route('acknowledge-details')
            ->with('success','Please fill out Acknowledge Details information');; 
        }

        }else{

            return view('frontend.on-boarding-employee.applicant-form', compact('post_applied'));
        }
        

        
    }



    public function onboardingForm(Request $request){

        $userid = Session::get('userId');

        $check_personal_details = OnboardingStepForm::where('applicant_id',$userid)->where('personal_details',1)->first();
        $check_education_details = OnboardingStepForm::where('applicant_id',$userid)->where('education_details',1)->first();
        $check_employment_details = OnboardingStepForm::where('applicant_id',$userid)->where('past_employment_details',1)->first();
        $check_bank_details = OnboardingStepForm::where('applicant_id',$userid)->where('bank_details',1)->first();

        $is_final_dubmit = OnboardingStepForm::where('applicant_id',$userid)->where('is_final_submit',1)->first();

        if(isset($is_final_dubmit) && !empty($is_final_dubmit)){

            return redirect()->route('submit')
            ->with('success','You have successfully submitted your application. We have sent one confirmation mail to your registered mail for future reference');
        }

        if(empty($check_personal_details)){

            return redirect()->route('personal-details')
                    ->with('success','Please fill out Personal Details Information');;
        }else if(empty($check_education_details)){

            return redirect()->route('education-details')
            ->with('success','Please fill out Education Details Information');;
        }else if(empty($check_employment_details)){

            return redirect()->route('employment-details')
            ->with('success','Please fill out Employment Details Information');;
        }else if(empty($check_bank_details)){

            return redirect()->route('bank-details')
            ->with('success','Please fill out Bank Details Information');;
        }

        $post_applied = PostApplied::where('status','Active')->get();

        return view('frontend.on-boarding-employee.applicant-form', compact('post_applied'));
        
    }


    public function saveEmployeeOnboarding(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required|numeric|digits:10',
            
             ]);
            if ($validator->fails())
            {
               
                return Redirect::back()->withInput()->withErrors($validator);
            } 

        $onboarding_personal_details = OnboardingPersonalDetails::firstOrNew(
        array(
                    'candidate_name' => $request->name,
                    'mobile_number'=>$request->mobile,
                    'email_id'=>$request->email
                    
            ));

            $onboarding_personal_details->candidate_name = $request->name;
            $onboarding_personal_details->mobile_number = $request->mobile;
            $onboarding_personal_details->email_id = $request->email;

            $onboarding_personal_details->save();

            $user_id = $onboarding_personal_details->id;
            Session::put('userId', $user_id);

            return redirect('personal-details');
                    





    }

    public function personalDetails(Request $request){

        $post_applied = PostApplied::where('status','Active')->get();

        $userid = Session::get('userId');

        $post_applied = PostApplied::where('status','Active')->get();


        $userid = Session::get('userId');

        $state_list = DB::table('districts')->distinct()->get(['State']);

        $personal_details = OnboardingPersonalDetails::where('id',$userid)->first();

        $borad_list = DB::table('tenth_board')->orderBy('board_name','ASC')->get();
        
        $university_list = DB::table('universities')->orderBy('University','ASC')->get();

        $course_list = DB::table('course_list')->orderBy('course','ASC')->get();


        $tenth_academic_details = OnboardingAcademicDetails::where('applicant_id',$userid)->where('course_type','10th')->first();

        $twelve_academic_details = OnboardingAcademicDetails::where('applicant_id',$userid)->where('course_type','12th')->first();

        $ug_academic_details = OnboardingAcademicDetails::where('applicant_id',$userid)->where('course_type','UG')->first();

        $pg_academic_details = OnboardingAcademicDetails::where('applicant_id',$userid)->where('course_type','PG')->first();

        $other_academic_details = OnboardingAcademicDetails::where('applicant_id',$userid)->where('course_type','Other')->first();

        $employment_details = OnboardingPastEmploymentDetails::where('applicant_id',$userid)->get();

        $bank_details = DB::table('list_of_banks')->orderBy('bank_name','ASC')->get();

        $bank_information = OnboardingBankDetails::where('applicant_id',$userid)->first();

        $is_final_dubmit = OnboardingStepForm::where('applicant_id',$userid)->where('is_final_submit',1)->first();

        if(isset($is_final_dubmit) && !empty($is_final_dubmit)){

            return redirect()->route('submit')
            ->with('success','You have successfully submitted your application. We have sent one confirmation mail to your registered mail for future reference');
        }
     

       

        return view('frontend.on-boarding-employee.employe-onboarding-form', compact('bank_information','bank_details','employment_details','tenth_academic_details','twelve_academic_details','ug_academic_details','pg_academic_details','other_academic_details','course_list','university_list','borad_list','post_applied','userid','state_list','personal_details'));

    }


    public function savePersonalDetails(Request $request){

        $userid = Session::get('userId');

        $validator = Validator::make($request->all(), [
            'candidate_name' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'dob' => 'required',
            'birth_place' => 'required',
            'gender' => 'required',
            'blood_group' => 'required',
            'martial_status' => 'required',
            'spouce_name' => 'required',
            'nationality' => 'required',
            'religion' => 'required',
            'cast' => 'required',
            'house_name' => 'required',
            'locality_name' => 'required',
            'post_office' => 'required',
            'nearest_land_mrk' => 'required',
            'state' => 'required',
            'district' => 'required',
            'town' => 'required',
            'pincode' => 'required|numeric|digits:6',
            'police_station' => 'required',
            'permanent_house_name' => 'required',
            'permanent_locality_name' => 'required',
            'permanent_post_office' => 'required',
            'permanent_nearest_land_mrk' => 'required',
            'permanent_state' => 'required',
            'permanent_district' => 'required',
            'permanent_town' => 'required',
            'permanent_pincode' => 'required|numeric|digits:6',
            'permanent_police_station' => 'required',
            'pan_number'=>'required',
            'aadhaar'=>'required|numeric|digits:12',
            'mobile' => 'required|numeric|digits:10',
            'email' => 'required|email',
            'emergency' => 'required|numeric|digits:10',
            'spouce_number' => 'required|numeric|digits:10',
            'reference_person' => 'required',
            'reference_contact_number' => 'required|numeric|digits:10',
            
             ]);


            
            

            //check images are uploaded or not 
            $user_detail = OnboardingPersonalDetails::where('id',$userid)->first();

            

            if($user_detail->uploaded_photo == '' || $user_detail->uploaded_photo == null){

                $validator->after(function ($validator) {
                    $validator->errors()->add(
                        'upload_photo', 'Photo is required!'
                    );
                });

            } 
            if($user_detail->uploaded_pan_card == '' || $user_detail->uploaded_pan_card == null){

                $validator3 = Validator::make($request->all(), [
                    'upload_pan_card' => 'required|mimes:png,jpg,jpeg,PNG,JPG,JPEG|max:102400']);

                $validator->after(function ($validator) {
                        $validator->errors()->add(
                            'upload_pan_card', 'PAN card is required!'
                        );
                });

            } 
            if($user_detail->uploaded_adhaar_card== '' || $user_detail->uploaded_adhaar_card== null    ){
                
                
                
                $validator->after(function ($validator) {
                        $validator->errors()->add(
                            'upload_adhaar_card','Adhar card is required'
                        );
                });
           
             }

             if ($validator->fails())
             {
                
                 return Redirect::back()->withInput()->withErrors($validator);
             }
             

             
            



            $userPersonal_Details = OnboardingPersonalDetails::find($userid);

            $userPersonal_Details->fathers_name = $request->father_name;
            $userPersonal_Details->mothers_name = $request->mother_name;
            $userPersonal_Details->dob = $request->dob;
            $userPersonal_Details->place_of_birth = $request->birth_place;
            $userPersonal_Details->gender = $request->gender;
            $userPersonal_Details->blood_group = $request->blood_group;
            $userPersonal_Details->martial_status = $request->martial_status;
            $userPersonal_Details->spouce_name = $request->spouce_name;
            $userPersonal_Details->natiolity = $request->nationality;
            $userPersonal_Details->religion = $request->religion;
            $userPersonal_Details->cast = $request->cast;
            $userPersonal_Details->present_house_no = $request->house_name;
            $userPersonal_Details->present_locality_name = $request->locality_name;
            $userPersonal_Details->present_post_office = $request->post_office;
            $userPersonal_Details->present_land_mark = $request->nearest_land_mrk;
            $userPersonal_Details->present_state = $request->state;
            $userPersonal_Details->present_district = $request->district;
            $userPersonal_Details->present_city = $request->town;
            $userPersonal_Details->present_pincode = $request->pincode;
            $userPersonal_Details->present_policestation = $request->police_station;
            $userPersonal_Details->permanent_house_no = $request->permanent_house_name;
            $userPersonal_Details->permanent_locality_name = $request->permanent_locality_name;
            $userPersonal_Details->permanent_post_office = $request->permanent_post_office;
            $userPersonal_Details->permanent_land_mark =$request->permanent_nearest_land_mrk;
            $userPersonal_Details->permanent_state =$request->permanent_state;
            $userPersonal_Details->permanent_district =$request->permanent_district;
            $userPersonal_Details->permanent_city = $request->permanent_town;
            $userPersonal_Details->permanent_pincode = $request->permanent_pincode;
            $userPersonal_Details->permanent_policestation = $request->permanent_police_station;
            $userPersonal_Details->pan_number = $request->permanent_police_station;
            $userPersonal_Details->adhaar_number = $request->permanent_police_station;
            $userPersonal_Details->emergency_contact = $request->emergency;
            $userPersonal_Details->parent_spouce_contact = $request->spouce_number;
            $userPersonal_Details->reference_person_name = $request->reference_person;
            $userPersonal_Details->reference_contact_no =  $request->reference_contact_number;

            $userPersonal_Details->save();

            $stepform = new OnboardingStepForm();
            $stepform->applicant_id  = $userPersonal_Details->id;
            $stepform->personal_details = 1;
            $stepform->save();

             //dd($userPersonal_Details);

             //dd($stepform);

            return redirect()->route('education-details')
                ->with('success','You have successfully submitted Personal details');

            
            





    }

    public function educationDetails(Request $request){



        $userid = Session::get('userId');

        //check previous form is filled otr not 

        $check_personal_details = OnboardingStepForm::where('applicant_id',$userid)->where('personal_details',1)->first();

        if(empty($check_personal_details)){

            return redirect()->route('personal-details')
                    ->with('error','Please fill out Personal Details Form, after that you can access this Education Details Forms');;
        }

        $is_final_dubmit = OnboardingStepForm::where('applicant_id',$userid)->where('is_final_submit',1)->first();

        if(isset($is_final_dubmit) && !empty($is_final_dubmit)){

            return redirect()->route('submit')
            ->with('success','You have successfully submitted your application. We have sent one confirmation mail to your registered mail for future reference');
        }

        $post_applied = PostApplied::where('status','Active')->get();


        $userid = Session::get('userId');

        $state_list = DB::table('districts')->distinct()->get(['State']);

        $personal_details = OnboardingPersonalDetails::where('id',$userid)->first();

        $borad_list = DB::table('tenth_board')->orderBy('board_name','ASC')->get();
        
        $university_list = DB::table('universities')->orderBy('University','ASC')->get();

        $course_list = DB::table('course_list')->orderBy('course','ASC')->get();


        $tenth_academic_details = OnboardingAcademicDetails::where('applicant_id',$userid)->where('course_type','10th')->first();

        $twelve_academic_details = OnboardingAcademicDetails::where('applicant_id',$userid)->where('course_type','12th')->first();

        $ug_academic_details = OnboardingAcademicDetails::where('applicant_id',$userid)->where('course_type','UG')->first();

        $pg_academic_details = OnboardingAcademicDetails::where('applicant_id',$userid)->where('course_type','PG')->first();

        $other_academic_details = OnboardingAcademicDetails::where('applicant_id',$userid)->where('course_type','Other')->first();

        $employment_details = OnboardingPastEmploymentDetails::where('applicant_id',$userid)->get();

        $bank_details = DB::table('list_of_banks')->orderBy('bank_name','ASC')->get();

        $bank_information = OnboardingBankDetails::where('applicant_id',$userid)->first();
     

       

        return view('frontend.on-boarding-employee.employe-onboarding-form', compact('bank_information','bank_details','employment_details','tenth_academic_details','twelve_academic_details','ug_academic_details','pg_academic_details','other_academic_details','course_list','university_list','borad_list','post_applied','userid','state_list','personal_details'));

    }

    public function saveEducationDetails(Request $request){
        
        
        $userid = Session::get('userId');

        $validator = Validator::make($request->all(), [
            'tenth_board_name' => 'required',
            'tenth_passing_year' => 'required',
            'tenth_total_marks'=> 'required|numeric',
            'tenth_marks_ontain'=>'required|numeric',
            'tenth_percentage'=> 'required|numeric',
            'tenth_regno'=>'required',
            'twelve_board_name' => 'required',
            'twelve_passing_year' => 'required',
            'twelve_total_marks'=> 'required|numeric',
            'twelve_marks_ontain'=>'required|numeric',
            'twelve_percentage'=> 'required|numeric',
            'twelve_regno'=>'required',
            'twelve_stream'=>'required',
            'under_graduate_board' => 'required',
            'under_graduate_passing_year' => 'required',
            'under_graduate_total_marks'=> 'required|numeric',
            'under_graduate_marks_obtain'=>'required|numeric',
            'under_graduate_percentage'=> 'required|numeric',
            'under_graduate_course'=>'required',
            'under_graduate_major_subject'=>'required',
            'under_graduate_course_duration'=> 'required',
            

            
            
             ]);

             //check images are uploaded or not 
            $tenth_academic_details = OnboardingAcademicDetails::where('applicant_id',$userid)->where('course_type','10th')->first();

            

            if($tenth_academic_details->uploaded_registration == '' || $tenth_academic_details->uploaded_registration == null){

                $validator->after(function ($validator) {
                    $validator->errors()->add(
                        'tenth_reg_no', 'Please upload 10th registration certificate'
                    );
                });

            }
            
            if($tenth_academic_details->uploaded_marksheet == '' || $tenth_academic_details->uploaded_marksheet == null){

                $validator->after(function ($validator) {
                    $validator->errors()->add(
                        'tenth_marksheet', 'Please upload 10th marksheet'
                    );
                });

            }

            if($tenth_academic_details->uploaded_certificate == '' || $tenth_academic_details->uploaded_certificate == null){

                $validator->after(function ($validator) {
                    $validator->errors()->add(
                        'tenth_certificate', 'Please upload 10th certificate'
                    );
                });

            }




            $twelve_academic_details = OnboardingAcademicDetails::where('applicant_id',$userid)->where('course_type','12th')->first();

            

            if($twelve_academic_details->uploaded_registration == '' || $twelve_academic_details->uploaded_registration == null){

                $validator->after(function ($validator) {
                    $validator->errors()->add(
                        'twelve_reg_no', 'Please upload 12th registration certificate'
                    );
                });

            }
            
            if($twelve_academic_details->uploaded_marksheet == '' || $twelve_academic_details->uploaded_marksheet == null){

                $validator->after(function ($validator) {
                    $validator->errors()->add(
                        'twelve_marksheet', 'Please upload 12th marksheet'
                    );
                });

            }

            if($twelve_academic_details->uploaded_certificate == '' || $twelve_academic_details->uploaded_certificate == null){

                $validator->after(function ($validator) {
                    $validator->errors()->add(
                        'twelve_certificate', 'Please upload 12th certificate'
                    );
                });

            }


            $ug_academic_details = OnboardingAcademicDetails::where('applicant_id',$userid)->where('course_type','UG')->first();

            

            if($ug_academic_details->uploaded_registration == '' || $ug_academic_details->uploaded_registration == null){

                $validator->after(function ($validator) {
                    $validator->errors()->add(
                        'higher_reg_no', 'Please upload undergraduate registration certificate'
                    );
                });

            }
            
            if($ug_academic_details->uploaded_marksheet == '' || $ug_academic_details->uploaded_marksheet == null){

                $validator->after(function ($validator) {
                    $validator->errors()->add(
                        'higher_markshett', 'Please upload undergraduate marksheet'
                    );
                });

            }

            if($ug_academic_details->uploaded_certificate == '' || $ug_academic_details->uploaded_certificate == null){

                $validator->after(function ($validator) {
                    $validator->errors()->add(
                        'higher_certificate', 'Please upload undergraduate certificate'
                    );
                });

            }


            




            if ($validator->fails())
             {
                
                 return Redirect::back()->withInput()->withErrors($validator);
             }
             

             
            



            $find_tenth_academic_detrails = OnboardingAcademicDetails::find($tenth_academic_details->id);

            $find_tenth_academic_detrails->course_name = '10th';
            $find_tenth_academic_detrails->registration_no = $request->tenth_regno;
            $find_tenth_academic_detrails->board_name = $request->tenth_board_name;
            $find_tenth_academic_detrails->year_of_passing = $request->tenth_passing_year;
            $find_tenth_academic_detrails->total_marks = $request->tenth_total_marks;
            $find_tenth_academic_detrails->marks_obtain =$request->tenth_marks_ontain;
            $find_tenth_academic_detrails->percentage = $request->tenth_percentage;

            $find_tenth_academic_detrails->save();




            $find_twelve_academic_detrails = OnboardingAcademicDetails::find($twelve_academic_details->id);

            $find_twelve_academic_detrails->course_name = '12th';
            $find_twelve_academic_detrails->registration_no = $request->twelve_regno;
            $find_twelve_academic_detrails->board_name = $request->twelve_board_name;
            $find_twelve_academic_detrails->year_of_passing = $request->twelve_passing_year;
            $find_twelve_academic_detrails->total_marks = $request->twelve_total_marks;
            $find_twelve_academic_detrails->marks_obtain =$request->twelve_marks_ontain;
            $find_twelve_academic_detrails->percentage = $request->twelve_percentage;
            $find_twelve_academic_detrails->stream_name = $request->twelve_stream;

            $find_twelve_academic_detrails->save();



            $find_ug_academic_detrails = OnboardingAcademicDetails::find($ug_academic_details->id);

            $find_ug_academic_detrails->course_name = $request->under_graduate_course;
            $find_ug_academic_detrails->board_name = $request->under_graduate_board;
            $find_ug_academic_detrails->year_of_passing = $request->under_graduate_passing_year;
            $find_ug_academic_detrails->total_marks = $request->under_graduate_total_marks;
            $find_ug_academic_detrails->marks_obtain =$request->under_graduate_marks_obtain;
            $find_ug_academic_detrails->percentage = $request->under_graduate_percentage;
            $find_ug_academic_detrails->major_subject = $request->under_graduate_major_subject;
            $find_ug_academic_detrails->course_duration = $request->under_graduate_course_duration;

            $find_ug_academic_detrails->save();


            if($request->post_graduate_course !='' && $request->post_graduate_board !='' && $request->post_graduate_passing_year !=''
             && $request->p_total_marks!='' && $request->p_marks_ontain !='' && $request->p_percentage!='' && $request->post_graduate_major_subject !='' 
             && $request->post_graduate_course_duration!=''){
                $find_pg_academic_detrails = OnboardingAcademicDetails::firstOrNew(array('applicant_id' =>$userid,'course_type'=>'PG'));
                
                $find_pg_academic_detrails->course_name = $request->post_graduate_course;
                $find_pg_academic_detrails->board_name = $request->post_graduate_board;
                $find_pg_academic_detrails->year_of_passing = $request->post_graduate_passing_year;
                $find_pg_academic_detrails->total_marks = $request->p_total_marks;
                $find_pg_academic_detrails->marks_obtain =$request->p_marks_ontain;
                $find_pg_academic_detrails->percentage = $request->p_percentage;
                $find_pg_academic_detrails->major_subject = $request->post_graduate_major_subject;
                $find_pg_academic_detrails->course_duration = $request->post_graduate_course_duration;
                
                $find_pg_academic_detrails->save();

             }


            if($request->other_course_name !='' && $request->other_board_name !='' && $request->other_passing_year!='' && 
                $request->other_total_marks !='' && $request->other_marks_obtain !='' && $request->other_course_duration!=''){

                $find_other_academic_detrails = OnboardingAcademicDetails::firstOrNew(array('applicant_id' =>$userid,'course_type'=>'Other'));
            
                $find_other_academic_detrails->course_name = $request->other_course_name;
                $find_other_academic_detrails->board_name = $request->other_board_name;
                $find_other_academic_detrails->year_of_passing = $request->other_passing_year;
                $find_other_academic_detrails->total_marks = $request->other_total_marks;
                $find_other_academic_detrails->marks_obtain =$request->other_marks_obtain;
                $find_other_academic_detrails->course_duration = $request->other_course_duration;
                
                $find_other_academic_detrails->save();

            }


            $stepform = OnboardingStepForm::firstOrNew(array('applicant_id' =>$userid));
            $stepform->education_details= 1;
            $stepform->save();
 
            return redirect()->route('employment-details')
            ->with('success','You have successfully submitted Academic details');



    }



    public function employmentDetails(Request $request){

        $userid = Session::get('userId');

        //check previous form is filled otr not 

        $check_personal_details = OnboardingStepForm::where('applicant_id',$userid)->where('personal_details',1)->first();
        $check_education_details = OnboardingStepForm::where('applicant_id',$userid)->where('education_details',1)->first();

        $is_final_dubmit = OnboardingStepForm::where('applicant_id',$userid)->where('is_final_submit',1)->first();

        if(isset($is_final_dubmit) && !empty($is_final_dubmit)){

            return redirect()->route('submit')
            ->with('success','You have successfully submitted your application. We have sent one confirmation mail to your registered mail for future reference');
        }
       
        if(empty($check_personal_details)){

            return redirect()->route('personal-details')
                    ->with('error','Please fill out Personal Details Form, after that you can access this Education Details Forms');;
        }else if(empty($check_education_details)){

            return redirect()->route('education-details')
            ->with('error','Please fill out Education Details Form, after that you can access this Past Employment Details Forms');
        }

        $post_applied = PostApplied::where('status','Active')->get();


        $userid = Session::get('userId');

        $state_list = DB::table('districts')->distinct()->get(['State']);

        $personal_details = OnboardingPersonalDetails::where('id',$userid)->first();

        $borad_list = DB::table('tenth_board')->orderBy('board_name','ASC')->get();
        
        $university_list = DB::table('universities')->orderBy('University','ASC')->get();

        $course_list = DB::table('course_list')->orderBy('course','ASC')->get();


        $tenth_academic_details = OnboardingAcademicDetails::where('applicant_id',$userid)->where('course_type','10th')->first();

        $twelve_academic_details = OnboardingAcademicDetails::where('applicant_id',$userid)->where('course_type','12th')->first();

        $ug_academic_details = OnboardingAcademicDetails::where('applicant_id',$userid)->where('course_type','UG')->first();

        $pg_academic_details = OnboardingAcademicDetails::where('applicant_id',$userid)->where('course_type','PG')->first();

        $other_academic_details = OnboardingAcademicDetails::where('applicant_id',$userid)->where('course_type','Other')->first();

        $employment_details = OnboardingPastEmploymentDetails::where('applicant_id',$userid)->get();

        $bank_details = DB::table('list_of_banks')->orderBy('bank_name','ASC')->get();

        $bank_information = OnboardingBankDetails::where('applicant_id',$userid)->first();
     

       

        return view('frontend.on-boarding-employee.employe-onboarding-form', compact('bank_information','bank_details','employment_details','tenth_academic_details','twelve_academic_details','ug_academic_details','pg_academic_details','other_academic_details','course_list','university_list','borad_list','post_applied','userid','state_list','personal_details'));

    }

    public function saveEmploymentDetails(Request $request){

        $userid = Session::get('userId');

        for($i=1 ;$i<=$request->empid ;$i++){

            

            if( isset($_POST["company_name_$i"]) && !empty($_POST["company_name_$i"]) 
            && isset($_POST["joining_date_$i"]) && !empty($_POST["joining_date_$i"])
            && isset($_POST["releasing_date_$i"]) && !empty($_POST["releasing_date_$i"])
            && isset($_POST["resignation_reason_$i"]) && !empty($_POST["resignation_reason_$i"])
            && isset($_POST["salary_per_month_$i"]) && !empty($_POST["salary_per_month_$i"])
            && isset($_POST["post_name_$i"]) && !empty($_POST["post_name_$i"])
            && isset($_POST["posting_area_$i"]) && !empty($_POST["posting_area_$i"])
            && isset($_POST["reporting_to_$i"]) && !empty($_POST["reporting_to_$i"])
            && isset($_POST["company_contact_number_$i"]) && !empty($_POST["company_contact_number_$i"])
            && isset($_POST["company_email_id_$i"]) && !empty($_POST["company_email_id_$i"])
            && isset($_POST["company_website_$i"]) && !empty($_POST["company_website_$i"])       
        
            ){

                $company_name = $_POST["company_name_$i"];

                $brand_name = $_POST["brand_name_$i"];
    
                $joining_date = $_POST["joining_date_$i"];
    
                $releasing_date = $_POST["releasing_date_$i"];
    
                $resignation_reason = $_POST["resignation_reason_$i"];
    
                $salary_per_month = $_POST["salary_per_month_$i"];
    
                $post_name = $_POST["post_name_$i"];
    
                $posting_area = $_POST["posting_area_$i"];
    
                $reporting_to = $_POST["reporting_to_$i"];
    
    
                $company_contact_number = $_POST["company_contact_number_$i"];
    
                $company_email_id = $_POST["company_email_id_$i"];
    
                $company_website = $_POST["company_website_$i"];



                $find_post_employment_details = OnboardingPastEmploymentDetails::firstOrNew(array('applicant_id' =>$userid,'company_name'=>$company_name));
            
                //$find_post_employment_details->applicant_id = $userid;
                $find_post_employment_details->company_name= $company_name;
                $find_post_employment_details->brand_name= $brand_name;
                $find_post_employment_details->joining_date= $joining_date;
                $find_post_employment_details->releasing_date=$releasing_date;
                $find_post_employment_details->resignation_reason= $resignation_reason;

                $find_post_employment_details->salary_per_month= $salary_per_month;
                $find_post_employment_details->post_name= $post_name;
                $find_post_employment_details->posting_area= $posting_area;
                $find_post_employment_details->reporting_area=$reporting_to;
                $find_post_employment_details->company_contact_number= $company_contact_number;

                $find_post_employment_details->company_email=$company_email_id;
                $find_post_employment_details->company_website= $company_website;


                $find_post_employment_details->save();









            }
           




        }


        $stepform = OnboardingStepForm::firstOrNew(array('applicant_id' =>$userid));
        $stepform->past_employment_details= 1;
        $stepform->save();


        return redirect()->route('bank-details')
            ->with('success','You have successfully submitted past employment details');
        

    }

    public function bankDetails(Request $request){

        $userid = Session::get('userId');

        //check previous form is filled otr not 

        $check_personal_details = OnboardingStepForm::where('applicant_id',$userid)->where('personal_details',1)->first();
        $check_education_details = OnboardingStepForm::where('applicant_id',$userid)->where('education_details',1)->first();
        $check_employment_details = OnboardingStepForm::where('applicant_id',$userid)->where('past_employment_details',1)->first();

        $is_final_dubmit = OnboardingStepForm::where('applicant_id',$userid)->where('is_final_submit',1)->first();

        if(isset($is_final_dubmit) && !empty($is_final_dubmit)){

            return redirect()->route('submit')
            ->with('success','You have successfully submitted your application. We have sent one confirmation mail to your registered mail for future reference');
        }

        if(empty($check_personal_details)){

            return redirect()->route('personal-details')
                    ->with('error','Please fill out Personal Details Form, after that you can access this Education Details Forms');;
        }else if(empty($check_education_details)){

            return redirect()->route('education-details')
            ->with('error','Please fill out Education Details Form, after that you can access this Past Employment Details Forms');;
        }else if(empty($check_employment_details)){

            return redirect()->route('employment-details')
            ->with('error','Please fill out Employment Details Form, after that you can access this Bank Details Forms');;
        }

        $post_applied = PostApplied::where('status','Active')->get();


        $userid = Session::get('userId');

        $state_list = DB::table('districts')->distinct()->get(['State']);

        $personal_details = OnboardingPersonalDetails::where('id',$userid)->first();

        $borad_list = DB::table('tenth_board')->orderBy('board_name','ASC')->get();
        
        $university_list = DB::table('universities')->orderBy('University','ASC')->get();

        $course_list = DB::table('course_list')->orderBy('course','ASC')->get();


        $tenth_academic_details = OnboardingAcademicDetails::where('applicant_id',$userid)->where('course_type','10th')->first();

        $twelve_academic_details = OnboardingAcademicDetails::where('applicant_id',$userid)->where('course_type','12th')->first();

        $ug_academic_details = OnboardingAcademicDetails::where('applicant_id',$userid)->where('course_type','UG')->first();

        $pg_academic_details = OnboardingAcademicDetails::where('applicant_id',$userid)->where('course_type','PG')->first();

        $other_academic_details = OnboardingAcademicDetails::where('applicant_id',$userid)->where('course_type','Other')->first();

        $employment_details = OnboardingPastEmploymentDetails::where('applicant_id',$userid)->get();

        $bank_details = DB::table('list_of_banks')->orderBy('bank_name','ASC')->get();

        $bank_information = OnboardingBankDetails::where('applicant_id',$userid)->first();
     

       

        return view('frontend.on-boarding-employee.employe-onboarding-form', compact('bank_information','bank_details','employment_details','tenth_academic_details','twelve_academic_details','ug_academic_details','pg_academic_details','other_academic_details','course_list','university_list','borad_list','post_applied','userid','state_list','personal_details'));

    }

    public function saveBankDetails(Request $request){

        $userid = Session::get('userId');

        $validator = Validator::make($request->all(), [
                'account_name' => 'required',
                'bank_name' => 'required',
                'branch_name'=> 'required',
                'ifsc_code'=>'required',
                'account_number'=> 'required',
                'account_type'=>'required',
                
             ]);


             $bank_information = OnboardingBankDetails::where('applicant_id',$userid)->first();

            

            if($bank_information->uploaded_bank_details == '' || $bank_information->uploaded_bank_details == null){

                $validator->after(function ($validator) {
                    $validator->errors()->add(
                        'bank_details', 'Bank details is required!'
                    );
                });

            }
            
            if($bank_information->uploaded_salary_statement== '' || $bank_information->uploaded_salary_statement== null){

                $validator->after(function ($validator) {
                    $validator->errors()->add(
                        'salary_statement', 'Salary statement is required!'
                    );
                });

            }

            if ($validator->fails())
             {
                
                 return Redirect::back()->withInput()->withErrors($validator);
             }

             $bank_information = OnboardingBankDetails::find($bank_information->id);

             $bank_information->account_name= $request->account_name;
             $bank_information->bank_name= $request->bank_name;
             $bank_information->branch_name= $request->branch_name;
             $bank_information->ifsc_code= $request->ifsc_code;
             $bank_information->account_number= $request->account_number;
             $bank_information->account_type= $request->account_type;

             $bank_information->save();



            $stepform = OnboardingStepForm::firstOrNew(array('applicant_id' =>$userid));
            $stepform->bank_details= 1;
            $stepform->save();


            return redirect()->route('acknowledge-details')
                ->with('success','You have successfully submitted bank information details');


             






    }


    public function acknowledgeDetails(Request $request){

        $userid = Session::get('userId');

        //check previous form is filled otr not 

        $check_personal_details = OnboardingStepForm::where('applicant_id',$userid)->where('personal_details',1)->first();
        $check_education_details = OnboardingStepForm::where('applicant_id',$userid)->where('education_details',1)->first();
        $check_employment_details = OnboardingStepForm::where('applicant_id',$userid)->where('past_employment_details',1)->first();
        $check_bank_details = OnboardingStepForm::where('applicant_id',$userid)->where('bank_details',1)->first();
        $check_acknowledge_details = OnboardingStepForm::where('applicant_id',$userid)->where('acknowledgement_details',1)->first();

        

        if(empty($check_personal_details)){

            return redirect()->route('personal-details')
                    ->with('error','Please fill out Personal Details Form, after that you can access this Education Details Forms');;
        }else if(empty($check_education_details)){

            return redirect()->route('education-details')
            ->with('error','Please fill out Education Details Form, after that you can access this Past Employment Details Forms');;
        }else if(empty($check_employment_details)){

            return redirect()->route('employment-details')
            ->with('error','Please fill out Employment Details Form, after that you can access this Bank Details Forms');;
        }else if(empty($check_bank_details)){

            return redirect()->route('bank-details')
            ->with('error','Please fill out Bank Details Form, after that you can access this Acknowledge Details Forms');;
        }

        $post_applied = PostApplied::where('status','Active')->get();


        $userid = Session::get('userId');

        $state_list = DB::table('districts')->distinct()->get(['State']);

        $personal_details = OnboardingPersonalDetails::where('id',$userid)->first();

        $borad_list = DB::table('tenth_board')->orderBy('board_name','ASC')->get();
        
        $university_list = DB::table('universities')->orderBy('University','ASC')->get();

        $course_list = DB::table('course_list')->orderBy('course','ASC')->get();


        $tenth_academic_details = OnboardingAcademicDetails::where('applicant_id',$userid)->where('course_type','10th')->first();

        $twelve_academic_details = OnboardingAcademicDetails::where('applicant_id',$userid)->where('course_type','12th')->first();

        $ug_academic_details = OnboardingAcademicDetails::where('applicant_id',$userid)->where('course_type','UG')->first();

        $pg_academic_details = OnboardingAcademicDetails::where('applicant_id',$userid)->where('course_type','PG')->first();

        $other_academic_details = OnboardingAcademicDetails::where('applicant_id',$userid)->where('course_type','Other')->first();

        $employment_details = OnboardingPastEmploymentDetails::where('applicant_id',$userid)->get();

        $bank_details = DB::table('list_of_banks')->orderBy('bank_name','ASC')->get();

        $bank_information = OnboardingBankDetails::where('applicant_id',$userid)->first();
     

       

        return view('frontend.on-boarding-employee.employe-onboarding-form', compact('bank_information','bank_details','employment_details','tenth_academic_details','twelve_academic_details','ug_academic_details','pg_academic_details','other_academic_details','course_list','university_list','borad_list','post_applied','userid','state_list','personal_details'));


    }

    public function saveAcknowledgeDetails(Request $request){

        $userid = Session::get('userId');

        $validator = Validator::make($request->all(), [
                'acknowledge' => 'required',               
                
             ]);

        if ($validator->fails())
        {
                
            return Redirect::back()->withInput()->withErrors($validator);
        }


        $stepform = OnboardingStepForm::firstOrNew(array('applicant_id' =>$userid));
            $stepform->acknowledgement_details= 1;
            $stepform->is_final_submit= 1;
            $stepform->save();


            return redirect()->route('submit')
                ->with('success','You have successfully submitted your application. We have sent one confirmation mail to your registered mail for future reference');

    }


    public function applicationSubmit(Request $request){

        $userid = Session::get('userId');

        $check_personal_details = OnboardingStepForm::where('applicant_id',$userid)->where('personal_details',1)->first();
        $check_education_details = OnboardingStepForm::where('applicant_id',$userid)->where('education_details',1)->first();
        $check_employment_details = OnboardingStepForm::where('applicant_id',$userid)->where('past_employment_details',1)->first();
        $check_bank_details = OnboardingStepForm::where('applicant_id',$userid)->where('bank_details',1)->first();
        $check_acknowledge_details = OnboardingStepForm::where('applicant_id',$userid)->where('acknowledgement_details',1)->first();

        

        if(empty($check_personal_details)){

            return redirect()->route('personal-details')
                    ->with('error','Please fill out Personal Details Form, after that you can access this Education Details Forms');;
        }else if(empty($check_education_details)){

            return redirect()->route('education-details')
            ->with('error','Please fill out Education Details Form, after that you can access this Past Employment Details Forms');;
        }else if(empty($check_employment_details)){

            return redirect()->route('employment-details')
            ->with('error','Please fill out Employment Details Form, after that you can access this Bank Details Forms');;
        }else if(empty($check_bank_details)){

            return redirect()->route('bank-details')
            ->with('error','Please fill out Bank Details Form, after that you can access this Acknowledge Details Forms');;
        }else if(empty($check_acknowledge_details)){

            return redirect()->route('acknowledge-details')
            ->with('error','Please fill out Acknowledge details');;
        }
        $post_applied = PostApplied::where('status','Active')->get();


        

        $state_list = DB::table('districts')->distinct()->get(['State']);

        $personal_details = OnboardingPersonalDetails::where('id',$userid)->first();

        $borad_list = DB::table('tenth_board')->orderBy('board_name','ASC')->get();
        
        $university_list = DB::table('universities')->orderBy('University','ASC')->get();

        $course_list = DB::table('course_list')->orderBy('course','ASC')->get();


        $tenth_academic_details = OnboardingAcademicDetails::where('applicant_id',$userid)->where('course_type','10th')->first();

        $twelve_academic_details = OnboardingAcademicDetails::where('applicant_id',$userid)->where('course_type','12th')->first();

        $ug_academic_details = OnboardingAcademicDetails::where('applicant_id',$userid)->where('course_type','UG')->first();

        $pg_academic_details = OnboardingAcademicDetails::where('applicant_id',$userid)->where('course_type','PG')->first();

        $other_academic_details = OnboardingAcademicDetails::where('applicant_id',$userid)->where('course_type','Other')->first();

        $employment_details = OnboardingPastEmploymentDetails::where('applicant_id',$userid)->get();

        $bank_details = DB::table('list_of_banks')->orderBy('bank_name','ASC')->get();

        $bank_information = OnboardingBankDetails::where('applicant_id',$userid)->first();
     

       

        return view('frontend.on-boarding-employee.employe-onboarding-form', compact('bank_information','bank_details','employment_details','tenth_academic_details','twelve_academic_details','ug_academic_details','pg_academic_details','other_academic_details','course_list','university_list','borad_list','post_applied','userid','state_list','personal_details'));


    }

    public function getDistrictDetails(Request $request){

        $state_name = $request->state_name;
        $district_list = DB::table('districts')->where('State',$state_name)->get();
        if(count($district_list)>0){

            $opt ='<option value="">Select District</option>';
            foreach($district_list as $lidd){
                $opt .= '<option value="'.$lidd->District.'">'.$lidd->District.'</option>' ;
            }

            $status = 1;
        }else{

            $opt ='<option value="">Select District</option>';
            $status = 0;

        }


        return response()->json(['success'=>$status,'data'=>$opt]);



    }

    public function uploadFile(Request $request){

        $userid = Session::get('userId');

        if(isset($userid) && !empty($userid)){        

        $data = array();

        $validator = Validator::make($request->all(), [
             'file' => 'required|mimes:png,jpg,jpeg,PNG,JPG,JPEG|max:102400'
        ]);

        if ($validator->fails()) {

             $data['success'] = 0;
             $data['error'] = $validator->errors()->first('file');// Error response

        }else{
             if($request->file('file')) {

                  $file = $request->file('file');
                  $filename = Carbon::now()->toDateString() . "-" . uniqid() . "." . 'png';

                  // File extension
                  $extension = 'png'; //Carbon::now()->toDateString() . "-" . uniqid() . "." . $format

                  // File upload location
                  
                  $location = 'storage/app/public/personal_details/'.$request->filetype;

                  // Upload file
                  if($file->move($location,$filename)){

                     // File path
                  $filepath = url('storage/app/public/personal_details/'.$request->filetype.'/'.$filename);

                  

                  // Response
                  $data['success'] = 1;
                  $data['message'] = 'Uploaded Successfully!';
                  $data['filepath'] = $filepath;
                  $data['extension'] = $extension;

                  if($request->filetype == 'pan_card'){

                    DB::table('onboarding_personal_details')->where('id', $userid)->update(['uploaded_pan_card' => $filename]);

                  }else if($request->filetype == 'adhar_card'){
                    
                    DB::table('onboarding_personal_details')->where('id', $userid)->update(['uploaded_adhaar_card' => $filename]);

                  }else{

                    DB::table('onboarding_personal_details')->where('id', $userid)->update(['uploaded_photo' => $filename]);

                  }

                  


                  }else{

                    $data['success'] = 2;
                    $data['message'] = 'File location is not uploaded'; 

                  }
            
                 
             }else{
                  // Response
                  $data['success'] = 2;
                  $data['message'] = 'File is required to upload'; 
             }
        }

      }else{
         // Response
         $data['success'] = 0;
         $data['message'] = 'You do not have access to upload files'.$userid; 

      }

        return response()->json($data);
   }

   public function getDistrictDetailNew(Request $request){

    $state_name = $request->state_name;
    $district = $request->district_id;
        $district_list = DB::table('districts')->where('State',$state_name)->get();
        if(count($district_list)>0){

            $opt ='<option value="">Select District</option>';
            foreach($district_list as $lidd){
                if($district == $lidd->District ){

                    $opt .= '<option value="'.$lidd->District.'" selected="selected">'.$lidd->District.'</option>' ;

                }else{

                    $opt .= '<option value="'.$lidd->District.'">'.$lidd->District.'</option>' ;

                }
                
            }

            $status = 1;
        }else{

            $opt ='<option value="">Select District</option>';
            $status = 0;

        }


        return response()->json(['success'=>$status,'data'=>$opt]);

   }


   public function uploadAcademicFile(Request $request){

        

    $userid = Session::get('userId');

    if(isset($userid) && !empty($userid)){        

    $data = array();

    $validator = Validator::make($request->all(), [
         'file' => 'required|mimes:png,jpg,jpeg,PNG,JPG,JPEG|max:102400'
    ]);

    if ($validator->fails()) {

         $data['success'] = 0;
         $data['error'] = $validator->errors()->first('file');// Error response

    }else{
         if($request->file('file')) {

              $file = $request->file('file');
              $filename = Carbon::now()->toDateString() . "-" . uniqid() . "." . 'png';

              // File extension
              $extension = 'png'; //Carbon::now()->toDateString() . "-" . uniqid() . "." . $format

              // File upload location
              
              $location = 'storage/app/public/academic_details/'.$request->filetype;

              // Upload file
              if($file->move($location,$filename)){

                 // File path
              $filepath = url('storage/app/public/academic_details/'.$request->filetype.'/'.$filename);

              

              // Response
              $data['success'] = 1;
              $data['message'] = 'Uploaded Successfully!';
              $data['filepath'] = $filepath;
              $data['extension'] = $extension;

              

            //   if($request->filetype == 'pan_card'){

            //     DB::table('onboarding_personal_details')->where('id', $userid)->update(['uploaded_pan_card' => $filename]);

            //   }else if($request->filetype == 'adhar_card'){
                
            //     DB::table('onboarding_personal_details')->where('id', $userid)->update(['uploaded_adhaar_card' => $filename]);

            //   }else{

            //     DB::table('onboarding_personal_details')->where('id', $userid)->update(['uploaded_photo' => $filename]);

            //   }


                    if($request->filetype == 'tenth_reg_no'){

                        $academic_details = OnboardingAcademicDetails::firstOrNew(array('applicant_id' =>$userid,'course_type'=>'10th'));
                        
                        $academic_details->uploaded_registration = $filename;
                        $academic_details->applicant_id = $userid;
                        $academic_details->course_type = '10th';
                        
                        $academic_details->save();




                       
                    }else if($request->filetype == 'tenth_marksheet'){
                        
                        $academic_details = OnboardingAcademicDetails::firstOrNew(array('applicant_id' =>$userid,'course_type'=>'10th'));
                        
                        $academic_details->uploaded_marksheet = $filename;
                        $academic_details->applicant_id = $userid;
                        $academic_details->course_type = '10th';
                        
                        $academic_details->save();
                    
                    }else if($request->filetype == 'tenth_certificate'){

                        $academic_details = OnboardingAcademicDetails::firstOrNew(array('applicant_id' =>$userid,'course_type'=>'10th'));
                        
                        $academic_details->uploaded_certificate = $filename;
                        $academic_details->applicant_id = $userid;
                        $academic_details->course_type = '10th';
                        
                        $academic_details->save();
                        
                    
                    }else if($request->filetype == 'twelve_reg_no'){

                        $academic_details = OnboardingAcademicDetails::firstOrNew(array('applicant_id' =>$userid,'course_type'=>'12th'));
                        
                        $academic_details->uploaded_registration = $filename;
                        $academic_details->applicant_id = $userid;
                        $academic_details->course_type = '12th';
                        
                        $academic_details->save();
                    
                        
                    }else if($request->filetype == 'twelve_marksheet'){
                        $academic_details = OnboardingAcademicDetails::firstOrNew(array('applicant_id' =>$userid,'course_type'=>'12th'));
                        
                        $academic_details->uploaded_marksheet = $filename;
                        $academic_details->applicant_id = $userid;
                        $academic_details->course_type = '12th';
                        
                        $academic_details->save();
                    
                    }else if($request->filetype == 'twelve_certificate'){
                        
                        $academic_details = OnboardingAcademicDetails::firstOrNew(array('applicant_id' =>$userid,'course_type'=>'12th'));
                        
                        $academic_details->uploaded_certificate = $filename;
                        $academic_details->applicant_id = $userid;
                        $academic_details->course_type = '12th';
                        
                        $academic_details->save();
                    }
                    else if($request->filetype == 'higher_reg_no'){
                        
                        $academic_details = OnboardingAcademicDetails::firstOrNew(array('applicant_id' =>$userid,'course_type'=>'UG'));
                        
                        $academic_details->uploaded_registration = $filename;
                        $academic_details->applicant_id = $userid;
                        $academic_details->course_type = 'UG';
                        
                        $academic_details->save();
                        
                    }else if($request->filetype == 'higher_markshett'){
                        
                        $academic_details = OnboardingAcademicDetails::firstOrNew(array('applicant_id' =>$userid,'course_type'=>'UG'));
                        
                        $academic_details->uploaded_marksheet = $filename;
                        $academic_details->applicant_id = $userid;
                        $academic_details->course_type = 'UG';
                        
                        $academic_details->save();

                    }else if($request->filetype == 'higher_certificate'){
                        
                        $academic_details = OnboardingAcademicDetails::firstOrNew(array('applicant_id' =>$userid,'course_type'=>'UG'));
                        
                        $academic_details->uploaded_certificate = $filename;
                        $academic_details->applicant_id = $userid;
                        $academic_details->course_type = 'UG';
                        
                        $academic_details->save();
                    
                    }
                    else if($request->filetype == 'pg_reg_no'){
                    
                        $academic_details = OnboardingAcademicDetails::firstOrNew(array('applicant_id' =>$userid,'course_type'=>'PG'));
                        
                        $academic_details->uploaded_registration = $filename;
                        $academic_details->applicant_id = $userid;
                        $academic_details->course_type = 'PG';
                        
                        $academic_details->save();


                    }else if($request->filetype == 'pg_markshett'){
                       
                        $academic_details = OnboardingAcademicDetails::firstOrNew(array('applicant_id' =>$userid,'course_type'=>'PG'));
                        
                        $academic_details->uploaded_marksheet = $filename;
                        $academic_details->applicant_id = $userid;
                        $academic_details->course_type = 'PG';
                        
                        $academic_details->save();
                    
                    }else if($request->filetype == 'pg_certificate'){
                       
                        $academic_details = OnboardingAcademicDetails::firstOrNew(array('applicant_id' =>$userid,'course_type'=>'PG'));
                        
                        $academic_details->uploaded_certificate = $filename;
                        $academic_details->applicant_id = $userid;
                        $academic_details->course_type = 'PG';
                        
                        $academic_details->save();

                    }
                    else if($request->filetype == 'other_marksheet'){
                       
                        $academic_details = OnboardingAcademicDetails::firstOrNew(array('applicant_id' =>$userid,'course_type'=>'Other'));
                        
                        $academic_details->uploaded_marksheet = $filename;
                        $academic_details->applicant_id = $userid;
                        $academic_details->course_type = 'Other';
                        
                        $academic_details->save();
                    
                    }else if($request->filetype == 'other_certificate'){
                        
                        $academic_details = OnboardingAcademicDetails::firstOrNew(array('applicant_id' =>$userid,'course_type'=>'Other'));
                        
                        $academic_details->uploaded_certificate = $filename;
                        $academic_details->applicant_id = $userid;
                        $academic_details->course_type = 'Other';
                        
                        $academic_details->save();
                    
                    }

              


              }else{

                $data['success'] = 2;
                $data['message'] = 'File location is not uploaded'; 

              }
        
             
         }else{
              // Response
              $data['success'] = 2;
              $data['message'] = 'File is required to upload'; 
         }
    }

  }else{
     // Response
     $data['success'] = 0;
     $data['message'] = 'You do not have access to upload files'.$userid; 

  }

    return response()->json($data);
   }



   public function uploadPastEmploymentFile(Request $request){

        

        $userid = Session::get('userId');

        if(isset($userid) && !empty($userid)){        

        $data = array();

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:png,jpg,jpeg,PNG,JPG,JPEG|max:102400'
        ]);

        if ($validator->fails()) {

            $data['success'] = 0;
            $data['error'] = $validator->errors()->first('file');// Error response

        }else{
            if($request->file('file')) {

                $file = $request->file('file');
                $filename = Carbon::now()->toDateString() . "-" . uniqid() . "." . 'png';

                // File extension
                $extension = 'png'; //Carbon::now()->toDateString() . "-" . uniqid() . "." . $format

                // File upload location
                
                $location = 'storage/app/public/past_employment/'.$request->filetype;

                // Upload file
                if($file->move($location,$filename)){

                    // File path
                $filepath = url('storage/app/public/past_employment/'.$request->filetype.'/'.$filename);

                

                // Response
                $data['success'] = 1;
                $data['message'] = 'Uploaded Successfully!';
                $data['filepath'] = $filepath;
                $data['extension'] = $extension;

                

                

                        if($request->filetype == 'appointment_letter_'){

                            $pas_employment_details = OnboardingPastEmploymentDetails::firstOrNew(array('applicant_id' =>$userid,'company_name'=>strtoupper($request->company_name)));
                            
                            $pas_employment_details->company_name = strtoupper($request->company_name);
                            $pas_employment_details->applicant_id = $userid;
                            $pas_employment_details->uploaded_appointment_letter = $filename;
                            
                            $pas_employment_details->save();


                        
                        }else if($request->filetype == 'release_letter_'){
                            
                            $pas_employment_details = OnboardingPastEmploymentDetails::firstOrNew(array('applicant_id' =>$userid,'company_name'=>strtoupper($request->company_name)));
                            
                            $pas_employment_details->company_name = strtoupper($request->company_name);
                            $pas_employment_details->applicant_id = $userid;
                            $pas_employment_details->uploaded_release_letter = $filename;
                            
                            $pas_employment_details->save();
                        
                    }else if($request->filetype == 'salary_slip_'){

                            $pas_employment_details = OnboardingPastEmploymentDetails::firstOrNew(array('applicant_id' =>$userid,'company_name'=>strtoupper($request->company_name)));
                            
                            $pas_employment_details->company_name = strtoupper($request->company_name);
                            $pas_employment_details->applicant_id = $userid;
                            $pas_employment_details->uploaded_salary_slip = $filename;
                            
                            $pas_employment_details->save();
                            
                    }
                        

                


                }else{

                    $data['success'] = 2;
                    $data['message'] = 'File location is not uploaded'; 

                }
            
                
            }else{
                // Response
                $data['success'] = 2;
                $data['message'] = 'File is required to upload'; 
            }
        }

    }else{
        // Response
            $data['success'] = 0;
            $data['message'] = 'You do not have access to upload files'.$userid; 

        }

            return response()->json($data);
        }



    public function uploadBankDetails(Request $request){

        

        $userid = Session::get('userId');

        if(isset($userid) && !empty($userid)){        

        $data = array();

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:png,jpg,jpeg,PNG,JPG,JPEG|max:102400'
        ]);

        if ($validator->fails()) {

                $data['success'] = 0;
                $data['error'] = $validator->errors()->first('file');// Error response

            }else{
                if($request->file('file')) {

                    $file = $request->file('file');
                    $filename = Carbon::now()->toDateString() . "-" . uniqid() . "." . 'png';

                    // File extension
                    $extension = 'png'; //Carbon::now()->toDateString() . "-" . uniqid() . "." . $format

                    // File upload location
                    
                    $location = 'storage/app/public/bank_information/'.$request->filetype;

                    // Upload file
                    if($file->move($location,$filename)){

                        // File path
                    $filepath = url('storage/app/public/bank_information/'.$request->filetype.'/'.$filename);

                    

                    // Response
                    $data['success'] = 1;
                    $data['message'] = 'Uploaded Successfully!';
                    $data['filepath'] = $filepath;
                    $data['extension'] = $extension;

                    

                    

                            if($request->filetype == 'bank_details'){

                                $bank_information = OnboardingBankDetails::firstOrNew(array('applicant_id' =>$userid));
                                
                                $bank_information->applicant_id = $userid;
                                $bank_information->uploaded_bank_details= $filename;
                                
                                $bank_information->save();


                            
                            }else if($request->filetype == 'salary_statement'){
                                
                                $bank_information = OnboardingBankDetails::firstOrNew(array('applicant_id' =>$userid));
                                
                                $bank_information->applicant_id = $userid;
                                $bank_information->uploaded_salary_statement= $filename;
                                
                                $bank_information->save();
                            
                        }
                            

                    


                    }else{

                        $data['success'] = 2;
                        $data['message'] = 'File location is not uploaded'; 

                    }
                
                    
                }else{
                    // Response
                    $data['success'] = 2;
                    $data['message'] = 'File is required to upload'; 
                }
            }

        }else{
            // Response
                $data['success'] = 0;
                $data['message'] = 'You do not have access to upload files'.$userid; 

            }

            return response()->json($data);

    }




   
}
