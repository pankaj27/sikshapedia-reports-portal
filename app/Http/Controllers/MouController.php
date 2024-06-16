<?php

namespace App\Http\Controllers;

use App\Mail\SignedMouConfirmation;
use App\Models\MouSent;
use App\Models\Proposals;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class MouController extends Controller
{
    
    public function index(Request $request, $id){

        $id = decrypt($id);

        //get mou details 
        $mou = MouSent::find($id);
        if(isset($mou)){
            $status = 1 ;
            if($mou->mou_sign_copy_uploaded_status == '' || $mou->mou_sign_copy_uploaded_status == null || $mou->mou_sign_copy_uploaded_status =='Rejected' || $mou->mou_sign_copy_uploaded_status='Re-Upload')
           
            return view('mou-upload.validation',compact('mou','status'));

        }else{
            $status = 0;
            return view('mou-upload.validation',compact('mou','status'));

        }
        
    }

    public function indexNew(Request $request){
        $status = 0;
            return view('mou-upload.validation',compact('status'));

    }

    public function indexNewP(Request $request){

        $credentials = $request->validate([
            'email' => 'required|email',
            'file' => 'required'
        ]);

        //check email is valid or invalid 

        $email_valid  = Proposals::where('email_address', $request->email)->first();
        //print_r(decrypt($request->file_id));exit;
        if(isset($email_valid) && !empty($email_valid)){

            //get mou info 
            $mou_info = MouSent::find(decrypt($request->file_id));
            if(isset($mou_info) && !empty($mou_info)){
                $file = $request->file('file');
                $filename = Carbon::now()->toDateString() . "-" . uniqid() . "." . $file->getClientOriginalExtension();
                $location = 'storage/app/public/signed_mou/'.$request->filetype;

                if($file->move($location,$filename)){

                    $mou_info->signed_mou_copy = $filename ;
                    $mou_info->mou_signed_copy_upload_by = $request->email ;
                    $mou_info->mou_sign_copy_uploaded_status = 'Verification Pending' ;

                    if($mou_info->save()){

                        $imagepathlink = "storage/app/public/signed_mou/".$mou_info->signed_mou_copy;

                       if(Mail::to($request->email)
                        ->bcc(array('info@sikshapedia.com','patrapankaj36@gmail.com'))
                        ->send(new SignedMouConfirmation($imagepathlink))){

                            return redirect()->route('success-mou')->with('success','Successfully Uploaded Signed MOU! An confirmation email has been sent top your registered email');

                        }else{

                            return redirect()->route('success-mou')->with('success','Successfully Uploaded Signed MOU');

                        }
                        
                    }else{

                        return back()->with('error','Ops! some technical issue occurred ! please try after some times later');


                    }





                }else{

                    return back()->with('error','Ops! some technical issue occurred ! please try after some times later');


                }


            }else{

                return back()->with('error','This link has been expired! Try after some time later');

            }


        }else{

            return back()->with('error','Please provide registered emil id for Upload Signed MOU');


        }


    }

    public function success(Request $request){

        return view('mou-upload.success');
    }
}
