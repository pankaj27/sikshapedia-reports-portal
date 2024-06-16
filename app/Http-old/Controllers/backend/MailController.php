<?php

namespace App\Http\Controllers\backend;


use App\CPU\Helpers;
use Illuminate\Http\Request;
use App\Models\BusinessSetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmailSender;

class MailController extends Controller
{
    
    public function update(Request $request)
    {
        $request->validate([
            "name" => 'required',
            "host" => 'required',
            "driver" => 'required',
            "port" => 'required',
            "username" => 'required',
            "email" => 'required',
            "encryption" => 'required',
            "password" => 'required',
        ]);

        

        BusinessSetting::where(['type' => 'mail_config'])->update([
            'value' => json_encode([
                "status" => 1,
                "name" => $request['name'],
                "host" => $request['host'],
                "driver" => $request['driver'],
                "port" => $request['port'],
                "username" => $request['username'],
                "email_id" => $request['email'],
                "encryption" => $request['encryption'],
                "password" => $request['password']
            ])
        ]);
        
        return back()->with('success','Successfully updated SMTP Settings!');
    }

    public function send(Request $request)
    {
        $response_flag = 0;
        $error='';
        try {
            $emailServices_smtp = Helpers::get_business_settings('mail_config');
            
            if ($emailServices_smtp['status'] == 1) {
                Mail::to($request->email)->send(new TestEmailSender());
                $response_flag = 1;
                $error='';
            }
        } catch (\Exception $exception) {
            $response_flag = 2;
            $error = $exception->getMessage();
        }

        return response()->json(['success' => $response_flag,'error'=> $error]);
    }
    
}
