<?php

namespace App\Http\Controllers\backend;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\CPU\Helpers;
use App\Models\MouSent;
use App\Models\Product;
use App\Models\Proposals;
use App\Mail\SendMouEmail;
use App\Mail\CloseDealEmail;
use App\Models\CallRegister;
use App\Models\FinalInvoice;
use Illuminate\Http\Request;
use App\Mail\TestEmailSender;
use App\Models\VisitRegister;
use App\Mail\ProposalEmailSender;
use App\Models\MouSentFirstParty;
use App\Models\MouSentSecondParty;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use App\Mail\CompleteDealSenderEmail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use App\Models\MemorandumOfUnderstanding;
use Illuminate\Support\Facades\Validator;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function generatePdf(Request $request)
    {
        // Create an instance of Dompdf
        $dompdf = new Dompdf();

        $visit_register_id = $request->visit_reg_id;

        $paymentid = $request->payment_option_id;

        $product_cost = $request->product_cost;

        $product_discount = $request->product_discount;

        $product_proposal = $request->proposal_valid;

        //return response()->json(['success'=>1,'dd'=>$visit_register_id,'ddt'=>$paymentid]);exit;

        //institute id 
        $regsidetails = VisitRegister::where('id',$visit_register_id)->first();

        //dd($paymentid);exit;

        //get institute_id 

        $institute_name = CallRegister::where('id',$regsidetails->institution_name)->first();

        $data['institute_name'] = $institute_name->organization_name;
        $data['institute_address'] = $regsidetails->institution_address;
        $data['inst_contact_person'] = $regsidetails->contact_person_name;

        //product_details 

        $productdd = DB::table('product_costs')->where('id',$paymentid)->first();


        $productname  = Product::where('id',$productdd->product_id)->first();

        $product_data['product_name'] = $productname->product_name ; 
        $product_data['product_features'] = $productname->product_features ; 

        $product_data['product_cost'] = $product_cost ;

        $product_data['product_discount'] =  $product_discount;

        $after_discount = floatval($product_cost) - floatval($product_discount);

        $product_data['gst_value'] = floatval($after_discount) *.18;

        $product_data['total_cost'] = $after_discount + floatval($product_data['gst_value']);

        $product_data['product_proposal'] =  $product_proposal;

        if($productdd->product_cost_type == 'INSTALLMENT'){
            $productbb = $productdd->product_installment_number . "- INSTALLMENT";

        }else{
            $productbb ="ONE TIME";
         }

        $product_data['payment_option'] = $productbb;

        $product_data['product_terms'] = $productdd->product_installment_terms;

        $product_data['cost_in_words'] = Helpers::convert_number_to_words($product_data['total_cost']);


       

        //exit;
        // Get HTML content from Blade views for each page
        $page1 = View::make('backend.proposal.page1')->render();
        $page2 = View::make('backend.proposal.page2',$data)->render();
        $page3 = View::make('backend.proposal.page3',$product_data)->render();
        $page4 = View::make('backend.proposal.page4')->render();
        $page5 = View::make('backend.proposal.page5',$product_data)->render();

        // Combine HTML content of all pages
        $html = "<html><body>{$page1}<div style='page-break-after: always;'></div>{$page2}<div style='page-break-after: always;'></div>{$page3}<div style='page-break-after: always;'></div>{$page4}<div style='page-break-after: always;'></div>{$page5}</body></html>";
        //$html = "<html><body>{$page5}</body></html>";
        // Load combined HTML content into Dompdf
        $dompdf->loadHtml($html);

        // Set paper size and orientation for the PDF
        $dompdf->setPaper('A3', 'portrait'); // Adjust paper size and orientation as needed
//A3: 'A3' - 297 x 420 mm or 11.7 x 16.5 inches
//A4: 'A4' - 210 x 297 mm or 8.3 x 11.7 inches
//A5: 'A5' - 148 x 210 mm or 5.8 x 8.3 inches
//Letter: 'letter' or '8.5x11' - 8.5 x 11 inches
//Legal: 'legal' or '8.5x14' - 8.5 x 14 inches
//Tabloid: 'tabloid' or '11x17' - 11 x 17 inches

        // (Optional) Set options if needed
        $options = new Options();
      $options->set('isRemoteEnabled', true);
	   $options->set('isHtml5ParserEnabled', true);
        $dompdf->setOptions($options);

        // Render the PDF
        $dompdf->render();

        // Get the generated PDF content
        $pdfContent = $dompdf->output();

        // Return the PDF content in the response with appropriate headers

        $proposal_file_name = strtoupper($data['institute_name'])."-".date('M-Y')."-CREATED-BY-".auth()->user()->name.date('d-m-Y').".pdf";

        $linkk = Storage::put("public/proposal/".$proposal_file_name,$pdfContent);
        //$filename =Storage::files('public/proposal/multi_page_pdf.pdf');
        if($linkk == true){

            $status = 1;
            $pdflink = env('APP_URL').'/storage/app/public/proposal/'.$proposal_file_name;
        }else{

            $status = 0;
            $pdflink = "";

        }


        return response()->json(['success'=>1,'pdf_link'=>$pdflink]);


        // return Response::make($pdfContent, 200, [
        //     'Content-Type' => 'application/pdf',
        //     'Content-Disposition' => 'inline; filename="multi_page_pdf.pdf"',
        // ]);
    }


    public function getPaymentOption(Request $request){

        $product_id = $request->product_id;
        $product_pay_option = DB::table('product_costs')->where('product_id',$product_id)->get();
        if(count($product_pay_option)>0){

            $opt ='<option value="">Select Payment Option</option>';
            foreach($product_pay_option as $lidd){
                if($lidd->product_cost_type =='INSTALLMENT'){
                    $opt .= '<option value="'.$lidd->id.'">'.$lidd->product_installment_number.'-'.$lidd->product_cost_type.'</option>' ;
                }else{

                    $opt .= '<option value="'.$lidd->id.'">'.$lidd->product_cost_type.'</option>' ;

                }
               
            }

            $status = 1;
        }else{

            $opt ='<option value="">Select Payment Option</option>';
            $status = 0;

        }


        return response()->json(['success'=>$status,'data'=>$opt]);
    }


    public function getProductCost(Request $request){

        $payment_id = $request->payment_id;
        $product_pay_option = DB::table('product_costs')->where('id',$payment_id)->first();
        if(!empty($product_pay_option)){

            
            $status = 1;
            $product_cost = $product_pay_option->product_cost;
            $installment_number = $product_pay_option->product_installment_number;
            $product_cos = ($product_cost) * ($installment_number);

            $product_discount = $product_pay_option->product_discount;

        }else{

            $product_cos = '';

            $product_discount = '';
            
            $status = 0;

        }


        return response()->json(['success'=>$status,'product_cost'=>$product_cos,'product_discount'=>$product_discount]);

    }


    public function sendProposal(Request $request){

        $validator = Validator::make($request->all(), [
            'institute_name' => 'required',
            'contact_person' => 'required',
            'mobile_number' => 'required|numeric|digits:10',
            'email_address' => 'required|email',
            'address' => 'required',
            'product'=>'required',
            'payment_option' => 'required',
            'product_cost' => 'required',
            'product_total_cost' =>'required',
            'proposal_valid_upto'=>'required',
            'email_message'=>'required',
            'email_cc'=>'required'
            
             ]);
            
            if ($validator->fails())
            {
                \LogActivity::addToLog('Validation Error occurred.'.json_encode($validator));
                return Redirect::back()->withInput()->withErrors($validator);
            }
            
            
            //generate pdf 

            $dompdf = new Dompdf();

        $visit_register_id = $request->visit_reg_id;

        $paymentid = $request->payment_option;

        $product_cost = $request->product_cost;

        $product_discount = $request->product_discount;

        $product_proposal = $request->proposal_valid_upto;

        //return response()->json(['success'=>1,'dd'=>$visit_register_id,'ddt'=>$paymentid]);exit;

        //institute id 
        $regsidetails = VisitRegister::where('id',$visit_register_id)->first();

        //dd($paymentid);exit;

        //get institute_id 

        $institute_name = CallRegister::where('id',$regsidetails->institution_name)->first();

        $data['institute_name'] = $institute_name->organization_name;
        $data['institute_address'] = $regsidetails->institution_address;
        $data['inst_contact_person'] = $regsidetails->contact_person_name;

        //product_details 

        $productdd = DB::table('product_costs')->where('id',$paymentid)->first();


        $productname  = Product::where('id',$productdd->product_id)->first();

        $product_data['product_name'] = $productname->product_name ; 
        $product_data['product_features'] = $productname->product_features ; 

        $product_data['product_cost'] = $product_cost ;

        $product_data['product_discount'] =  $product_discount;

        $after_discount = floatval($product_cost) - floatval($product_discount);

        $product_data['gst_value'] = floatval($after_discount) *.18;

        $product_data['total_cost'] = $after_discount + floatval($product_data['gst_value']);

        $product_data['product_proposal'] =  $product_proposal;

        if($productdd->product_cost_type == 'INSTALLMENT'){
            $productbb = $productdd->product_installment_number . "- INSTALLMENT";

        }else{
            $productbb ="ONE TIME";
         }

        $product_data['payment_option'] = $productbb;

        $product_data['product_terms'] = $productdd->product_installment_terms;

        $product_data['cost_in_words'] = Helpers::convert_number_to_words($product_data['total_cost']);



        //exit;
        // Get HTML content from Blade views for each page
        $page1 = View::make('backend.proposal.page1')->render();
        $page2 = View::make('backend.proposal.page2',$data)->render();
        $page3 = View::make('backend.proposal.page3',$product_data)->render();
        $page4 = View::make('backend.proposal.page4')->render();
        $page5 = View::make('backend.proposal.page5',$product_data)->render();

        // Combine HTML content of all pages
        $html = "<html><body>{$page1}<div style='page-break-after: always;'></div>{$page2}<div style='page-break-after: always;'></div>{$page3}<div style='page-break-after: always;'></div>{$page4}<div style='page-break-after: always;'></div>{$page5}</body></html>";
        //$html = "<html><body>{$page5}</body></html>";
        // Load combined HTML content into Dompdf
        $dompdf->loadHtml($html);

        // Set paper size and orientation for the PDF
        $dompdf->setPaper('A3', 'portrait'); // Adjust paper size and orientation as needed
        //A3: 'A3' - 297 x 420 mm or 11.7 x 16.5 inches
        //A4: 'A4' - 210 x 297 mm or 8.3 x 11.7 inches
        //A5: 'A5' - 148 x 210 mm or 5.8 x 8.3 inches
        //Letter: 'letter' or '8.5x11' - 8.5 x 11 inches
        //Legal: 'legal' or '8.5x14' - 8.5 x 14 inches
        //Tabloid: 'tabloid' or '11x17' - 11 x 17 inches

        // (Optional) Set options if needed
        $options = new Options();
      $options->set('isRemoteEnabled', true);
	   $options->set('isHtml5ParserEnabled', true);
        $dompdf->setOptions($options);

        // Render the PDF
        $dompdf->render();

        // Get the generated PDF content
        $pdfContent = $dompdf->output();

        // Return the PDF content in the response with appropriate headers

        $proposal_file_name = strtoupper($data['institute_name'])."-".date('M-Y')."-CREATED-BY-".auth()->user()->name.date('d-m-Y').".pdf";

        $linkk = Storage::put("public/proposal/".$proposal_file_name,$pdfContent);
        //$filename =Storage::files('public/proposal/multi_page_pdf.pdf');
        if($linkk == true){

            
            $pdflink = env('APP_URL').'/storage/app/public/proposal/'.$proposal_file_name;
        
            $imagepathlink = "storage/app/public/proposal/".$proposal_file_name;


            $response_flag = 0;
            $error='';
            try {
                $emailServices_smtp = Helpers::get_business_settings('mail_config');

                $emailexx = explode(",",$request->email_cc);

                array_push($emailexx,auth()->user()->email);
                
                if ($emailServices_smtp['status'] == 1) {
                    Mail::to($request->email_address)
                    ->cc($emailexx)
                    ->bcc(array('info@sikshapedia.com','pankaj.ssconline@gmail.com'))
                    ->send(new ProposalEmailSender($imagepathlink,$request->email_message));
                    $response_flag = 1;
                    $error='';
                
            

            //return response()->json(['success' => $response_flag,'error'=> $error]);


            $proposal = Proposals::firstOrNew(array('institute_id'=>$request->intsid));

            $proposal->institute_id= $request->intsid;
            $proposal->contact_person= $request->contact_person;
            $proposal->mobile_number= $request->mobile_number;
            $proposal->email_address= $request->email_address;
            $proposal->communicaton_address= $request->address;
            $proposal->product_id= $request->product;
            $proposal->payment_id= $request->payment_option;
            $proposal->product_cost= $request->product_cost;
            $proposal->product_gst= '18';
            $proposal->product_discount= $request->product_discount;
            $proposal->product_total_cost= $request->product_total_cost;
            $proposal->proposal_valid_upto=date('Y-m-d',strtotime($request->institute_name));
            $proposal->proposal_email_sent= 1;
            $proposal->email_sent_by= auth()->user()->id;
            $proposal->proposal_file= $proposal_file_name;
            $proposal->proposal_message_body= $request->email_message;

                $proposal->save();


                \LogActivity::addToLog('Proposal sent successfully');
            return Redirect::back()->with('success','Proposal sen successfully');

             
            
            }


        } catch (\Exception $exception) {
            $response_flag = 2;
            $error = $exception->getMessage();
        
            \LogActivity::addToLog('Emial not sent due to server problem');
            return Redirect::back()->with('error','Opps! something error ! please try after some times later'.$error);
        
        
        }




        }else{

            
            \LogActivity::addToLog('Pdf generation error occurred');
            return Redirect::back()->with('error','Opps! something error ! please try after some times later');
    
        }



    }

    public function displaywords($number){
        $words = array('0' => '', '1' => 'one', '2' => 'two',
        '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
        '7' => 'seven', '8' => 'eight', '9' => 'nine',
        '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
        '13' => 'thirteen', '14' => 'fourteen',
        '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
        '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
        '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
        '60' => 'sixty', '70' => 'seventy',
        '80' => 'eighty', '90' => 'ninety');
        $digits = array('', '', 'hundred', 'thousand', 'lakh', 'crore');
    
        $number = explode(".", $number);
        $result = array("","");
        $j =0;
        foreach($number as $val){
            // loop each part of number, right and left of dot
            for($i=0;$i<strlen($val);$i++){
                // look at each part of the number separately  [1] [5] [4] [2]  and  [5] [8]
    
                $numberpart = str_pad($val[$i], strlen($val)-$i, "0", STR_PAD_RIGHT); // make 1 => 1000, 5 => 500, 4 => 40 etc.
                if($numberpart <= 20){ // if it's below 20 the number should be one word
                    $numberpart = 1*substr($val, $i,2); // use two digits as the word
                    $i++; // increment i since we used two digits
                    $result[$j] .= $words[$numberpart] ." ";
                }else{
                    //echo $numberpart . "<br>\n"; //debug
                    if($numberpart > 90){  // more than 90 and it needs a $digit.
                        $result[$j] .= $words[$val[$i]] . " " . $digits[strlen($numberpart)-1] . " "; 
                    }else if($numberpart != 0){ // don't print zero
                        $result[$j] .= $words[str_pad($val[$i], strlen($val)-$i, "0", STR_PAD_RIGHT)] ." ";
                    }
                }
            }
            $j++;
        }
        if(trim($result[0]) != "") echo $result[0] . "Rupees ";
        if($result[1] != "") echo $result[1] . "Paise";
        echo " Only";
    }


    public function sendCompleteDeal(Request $request){

        $validator = Validator::make($request->all(), [
            'pay_amount' => 'required',
            'payment_date' => 'required',
            'payment_mode' => 'required',
            'transaction_no'=>'required',
            'subject' => 'required',
            'email_message'=>'required',
            'email_cc'=>'required'
            
             ]);
            
            if ($validator->fails())
            {
                \LogActivity::addToLog('Validation Error occurred.'.json_encode($validator));
                return Redirect::back()->withInput()->withErrors($validator);
            }
            
            
            //generate pdf 

            $dompdf = new Dompdf();

            $proposal_id = $request->proposal_id;

            //get institute name = 

            $instid  =DB::table('proposals')->where('id',$proposal_id)->first() ;

            $instname = DB::table('call_registers')->where('id',$instid->institute_id)->first();


            $data['institute_name'] = $instname->organization_name;
            $data['amout_paid'] = $request->pay_amount;
            $data['amount_paid_text'] = Helpers::convert_number_to_words($request->pay_amount);
            $data['tranaction_date'] = date('d.m.Y',strtotime($request->payment_date));
            $data['transaction_no'] = str_replace(" ","-",$request->payment_mode)."-".$request->transaction_no ;
            $data['Reg_txt'] = $request->subject;
            $data['amnttct'] = $request->pay_amount;
            $data['inv_no']= date('My')."/000".$proposal_id;



        //exit;
        // Get HTML content from Blade views for each page
        $page1 = View::make('backend.bills.page1', $data)->render();
       
        // Combine HTML content of all pages
        $html = "<html><body>{$page1}</body></html>";
        //$html = "<html><body>{$page5}</body></html>";
        // Load combined HTML content into Dompdf
        $dompdf->loadHtml($html);

        // Set paper size and orientation for the PDF
        $dompdf->setPaper('A3', 'portrait'); // Adjust paper size and orientation as needed
        //A3: 'A3' - 297 x 420 mm or 11.7 x 16.5 inches
        //A4: 'A4' - 210 x 297 mm or 8.3 x 11.7 inches
        //A5: 'A5' - 148 x 210 mm or 5.8 x 8.3 inches
        //Letter: 'letter' or '8.5x11' - 8.5 x 11 inches
        //Legal: 'legal' or '8.5x14' - 8.5 x 14 inches
        //Tabloid: 'tabloid' or '11x17' - 11 x 17 inches

        // (Optional) Set options if needed
        $options = new Options();
      $options->set('isRemoteEnabled', true);
	   $options->set('isHtml5ParserEnabled', true);
        $dompdf->setOptions($options);

        // Render the PDF
        $dompdf->render();

        // Get the generated PDF content
        $pdfContent = $dompdf->output();

        // Return the PDF content in the response with appropriate headers

        $proposal_file_name = strtoupper($data['institute_name'])."-".date('M-Y')."-BILL-CREATED-BY-".auth()->user()->name.date('d-m-Y').".pdf";

        $linkk = Storage::put("public/bills/".$proposal_file_name,$pdfContent);
        //$filename =Storage::files('public/proposal/multi_page_pdf.pdf');
        if($linkk == true){

            
            $pdflink = env('APP_URL').'/storage/app/public/bills/'.$proposal_file_name;
        
            $imagepathlink = "storage/app/public/bills/".$proposal_file_name;


            $response_flag = 0;
            $error='';
            try {
                $emailServices_smtp = Helpers::get_business_settings('mail_config');

                $emailexx = explode(",",$request->email_cc);

                array_push($emailexx,auth()->user()->email);
                
                if ($emailServices_smtp['status'] == 1) {
                    Mail::to($request->email_address)
                    ->cc($emailexx)
                    ->bcc(array('info@sikshapedia.com','pankaj.ssconline@gmail.com'))
                    ->send(new CompleteDealSenderEmail($imagepathlink,$request->email_message));
                    $response_flag = 1;
                    $error='';
                
            

            //return response()->json(['success' => $response_flag,'error'=> $error]);


            $proposal = Proposals::firstOrNew(array('institute_id' => $instid->institute_id));

            $proposal->generate_bill= $pdflink;
            $proposal->pay_amount= $request->pay_amount;
            $proposal->payment_date=  date('Y-m-d',strtotime($request->payment_date));
            $proposal->payment_mode= $request->payment_mode;
            $proposal->payment_subject= $request->subject;
            $proposal->bill_email_cc= $request->email_cc;
            $proposal->transaction_no= $data['transaction_no'];
            $proposal->is_bill_generated= 1;
            $proposal->proposal_message_body= $request->email_message;
           

                $proposal->save();


                \LogActivity::addToLog('Proposal sent successfully');
            return Redirect::back()->with('success','Proposal sent successfully');

             
            
            }


        } catch (\Exception $exception) {
            $response_flag = 2;
            $error = $exception->getMessage();
        
            \LogActivity::addToLog('Emial not sent due to server problem');
            return Redirect::back()->with('error','Opps! something error ! please try after some times later'.$error);
        
        
        }




        }else{

            
            \LogActivity::addToLog('Pdf generation error occurred');
            return Redirect::back()->with('error','Opps! something error ! please try after some times later');
    
        }


    }

    public function generateBillPdf(Request $request){

        
        // Create an instance of Dompdf
        $dompdf = new Dompdf();

        $proposal_id = $request->proposal_id;

        //get institute name = 

        $instid  =DB::table('proposals')->where('id',$proposal_id)->first() ;

        $instname = DB::table('call_registers')->where('id',$instid->institute_id)->first();


        $data['institute_name'] = $instname->organization_name;
        $data['amout_paid'] = $request->pay_amount;
        $data['amount_paid_text'] = Helpers::convert_number_to_words($request->pay_amount);
        $data['tranaction_date'] = date('d.m.Y',strtotime($request->payment_date));
        $data['transaction_no'] = str_replace(" ","-",$request->payment_mode)."-".$request->transaction_no ;
        $data['Reg_txt'] = $request->subject;
        $data['amnttct'] = $request->pay_amount;
        $data['inv_no']= date('My')."/000".$proposal_id;


        
        //exit;
        // Get HTML content from Blade views for each page
        $page1 = View::make('backend.bills.page1', $data)->render();
       
        // Combine HTML content of all pages
        $html = "<html><body>{$page1}</body></html>";
        //$html = "<html><body>{$page5}</body></html>";
        // Load combined HTML content into Dompdf
        $dompdf->loadHtml($html);

        // Set paper size and orientation for the PDF
        $dompdf->setPaper('A3', 'portrait'); // Adjust paper size and orientation as needed
        //A3: 'A3' - 297 x 420 mm or 11.7 x 16.5 inches
        //A4: 'A4' - 210 x 297 mm or 8.3 x 11.7 inches
        //A5: 'A5' - 148 x 210 mm or 5.8 x 8.3 inches
        //Letter: 'letter' or '8.5x11' - 8.5 x 11 inches
        //Legal: 'legal' or '8.5x14' - 8.5 x 14 inches
        //Tabloid: 'tabloid' or '11x17' - 11 x 17 inches

        // (Optional) Set options if needed
        $options = new Options();
      $options->set('isRemoteEnabled', true);
	   $options->set('isHtml5ParserEnabled', true);
        $dompdf->setOptions($options);

        // Render the PDF
        $dompdf->render();

        // Get the generated PDF content
        $pdfContent = $dompdf->output();

        // Return the PDF content in the response with appropriate headers

        // $proposal_file_name = strtoupper($data['institute_name'])."-".date('M-Y')."-BILLS-CREATED-BY-".auth()->user()->name.date('d-m-Y').".pdf";
        $proposal_file_name = "Test-INST-".date('M-Y')."-BILLS-CREATED-BY-".auth()->user()->name.date('d-m-Y').".pdf";

        $linkk = Storage::put("public/bills/".$proposal_file_name,$pdfContent);
        //$filename =Storage::files('public/proposal/multi_page_pdf.pdf');
        if($linkk == true){

            $status = 1;
            $pdflink = env('APP_URL').'/storage/app/public/bills/'.$proposal_file_name;
        }else{

            $status = 0;
            $pdflink = "";

        }


        return response()->json(['success'=>1,'pdf_link'=>$pdflink]);


    }


    public function generateMouPdf(Request $request){

         // Create an instance of Dompdf
         $dompdf = new Dompdf();

         $data=array();
 
         // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4');
 
        // Render the HTML as PDF
        //$dompdf->render();

        //post method 
        $mou_start_on = date('Y-m-d',strtotime($request->mou_start_date));
        $mou_valid_upto = date('Y-m-d',strtotime($request->mou_valid_upto));
        $institute_name = $request->party_name;
        $institute_address = $request->party_address;
        $mou_favour_name = $request->mou_favour_name ;
        $party_pan_no = $request->party_pan_no;
        $first_party_name=$request->first_party_name;
        $first_party_designation= $request->first_party_designation;
        $first_party_email = $request->first_party_email;
        $first_party_mobile = $request->first_party_mobile;
        $second_party_name = $request->second_party_name;
        $second_party_designation = $request->second_party_designation;
        $second_party_email = $request->second_party_email;
        $second_party_mobile=$request->second_party_mobile;
        $package_id = $request->package_id;
        $payment_option_id = $request->payment_option_id;
        $product_cost_with_gst = $request->product_cost;
        $product_discount = $request->product_discount;
        $proposal_id = $request->proposal_id;
        $intsid = $request->intsid;

        $mou_data = MouSent::firstOrNew(
            array(
                'proposal_id'=>$proposal_id,
                'institute_id'=>$intsid,
                'party_name'=>$institute_name,
                'address'=>$institute_address  ,
                'mou_start_on'=> $mou_start_on,
                'mou_valid_upto' => $mou_valid_upto
            
            ));

            $mou_data->proposal_id = $proposal_id;
            $mou_data->institute_id= $intsid ;
            $mou_data->party_name = $institute_name;
            $mou_data->address = $institute_address ;
            $mou_data->mou_start_on =  $mou_start_on;
            $mou_data->mou_valid_upto = $mou_valid_upto ;
            $mou_data->administrator_name = $mou_favour_name ;
            $mou_data->pan_no = $party_pan_no ;
            $mou_data->package_id = $package_id ;
            $mou_data->payment_option = $payment_option_id ;
            $mou_data->discount = $product_discount ;
            $mou_data->total_cose = $product_cost_with_gst ;

            $mou_data->save();

            $mouid = $mou_data->id;

            //isert into first party 

            for($i=0;$i<count($first_party_name); $i++){

                $first_party = MouSentFirstParty::firstOrNew(array(
                    'mou_id'=>$mouid,
                    'name'=> $first_party_name[$i],
                    'designation'=>$first_party_designation[$i],
                    'email_id'=>$first_party_email[$i],
                    'mobile_no'=>$first_party_mobile[$i],
                    
                ));

                $first_party->mou_id = $mouid;
                $first_party->name = $first_party_name[$i];
                $first_party->designation = $first_party_designation[$i];
                $first_party->email_id = $first_party_email[$i];
                $first_party->mobile_no = $first_party_mobile[$i];
                $first_party->save();
            }



            //insert to second party 

            for($i=0;$i<count($second_party_name); $i++){

                $second_party = MouSentSecondParty::firstOrNew(array(
                    'mou_id'=>$mouid,
                    'name'=> $second_party_name[$i],
                    'designation'=>$second_party_designation[$i],
                    'email_id'=>$second_party_email[$i],
                    'mobile_no'=>$second_party_mobile[$i],
                    
                ));

                $second_party->mou_id = $mouid;
                $second_party->name = $second_party_name[$i];
                $second_party->designation = $second_party_designation[$i];
                $second_party->email_id = $second_party_email[$i];
                $second_party->mobile_no = $second_party_mobile[$i];

                $second_party->save();


            }

         
 
        $data['content'] = MemorandumOfUnderstanding::all() ;
        $data['mouStartdate'] = date('jS F, Y',strtotime($mou_start_on));
        $data['collegeName'] = ucwords($institute_name);
        $data['collegeAddress'] = ucwords($institute_address);
        $data['collegeAdmin'] = "Mr./Ms.".ucwords($mou_favour_name);
        $data['panNo'] = strtoupper($party_pan_no);
        $data['mouValidUpto'] =date('jS F, Y',strtotime($mou_valid_upto));
        $data['first_part_contract'] = MouSentFirstParty::where('mou_id',$mouid)->get();
        $data['second_part_contract'] = MouSentSecondParty::where('mou_id',$mouid)->get();
        $data['package_id'] = $package_id;
        $data['payment_option_id'] = $payment_option_id;
        $data['discount'] = $product_discount;
        $data['product_cost'] = $product_cost_with_gst;
        
 
        $font = $dompdf->getFontMetrics()->get_font("helvetica", "bold");
        $dompdf->getCanvas()->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 10, array(0,0,0));
 
         
         //exit;
         // Get HTML content from Blade views for each page
         $page1 = View::make('backend.mou.pages', $data)->render();
         $page2 = View::make('backend.mou.page2',$data)->render();
         $page3 = View::make('backend.mou.page3',$data)->render();
         $page4 = View::make('backend.mou.page4',$data)->render();
         
        
         // Combine HTML content of all pages
         $html = "<html><body>{$page1}<div style='page-break-after: always;'></div>{$page2}<div style='page-break-after: always;'></div>{$page3}<div style='page-break-after: always;'></div>{$page4}</body></html>";
         //$html = "<html><body>{$page5}</body></html>";
         // Load combined HTML content into Dompdf
         $dompdf->loadHtml($html);
 
         // Set paper size and orientation for the PDF
         $dompdf->setPaper('A3', 'portrait'); // Adjust paper size and orientation as needed
         //A3: 'A3' - 297 x 420 mm or 11.7 x 16.5 inches
         //A4: 'A4' - 210 x 297 mm or 8.3 x 11.7 inches
         //A5: 'A5' - 148 x 210 mm or 5.8 x 8.3 inches
         //Letter: 'letter' or '8.5x11' - 8.5 x 11 inches
         //Legal: 'legal' or '8.5x14' - 8.5 x 14 inches
         //Tabloid: 'tabloid' or '11x17' - 11 x 17 inches
 
         // (Optional) Set options if needed
         $options = new Options();
       $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
         $dompdf->setOptions($options);
 
         // Render the PDF
         $dompdf->render();
 
         // Get the generated PDF content
         $pdfContent = $dompdf->output();
 
         // Return the PDF content in the response with appropriate headers
 
         $proposal_file_name = ucwords($institute_name)."-".date('M-Y')."-MOU-CREATED-BY-".auth()->user()->name.date('d-m-Y').".pdf";
         //$proposal_file_name = "Test-INST-".date('M-Y')."-MOU-CREATED-BY-".auth()->user()->name.date('d-m-Y').".pdf";
 
         $linkk = Storage::put("public/mou/".$proposal_file_name,$pdfContent);
         //$filename =Storage::files('public/proposal/multi_page_pdf.pdf');
         if($linkk == true){
 
             $status = 1;
             $pdflink = env('APP_URL').'/storage/app/public/mou/'.$proposal_file_name;
         }else{
 
             $status = 0;
             $pdflink = "";
 
         }
 
 
         return response()->json(['success'=>1,'pdf_link'=>$pdflink]);
 
 
    }

    public function generateMouPdfget(){

        // Create an instance of Dompdf
        $dompdf = new Dompdf();

        $data[]='Memorandum of ';

        // (Optional) Setup the paper size and orientation
       $dompdf->setPaper('A4');

       // Render the HTML as PDF
       //$dompdf->render();

       $data['content'] = MemorandumOfUnderstanding::all() ;
       $data['mouStartdate'] = " 14thFebruary 2024 ";
       $data['collegeName'] = "Swami Vivekananda Institute of Science and Technology";
       $data['collegeAddress'] = "Sonarpur Station road Karbala More Kolkata 700103";
       $data['collegeAdmin'] = "Mr. Sukanta Samanta";
       $data['panNo'] = "CHGPP2214J";
       $data['mouValidUpto'] ="06th January 2025";
       $data['first_part_contract'] = array(
        array(
            "name"=>"SUBHAJIT AS",
            "designation" => "Account Manager",
            "email_id" => "info@sikshapedia.com",
            "mobile_no"=> "9073403020"
        ),
        array(
            "name"=>"NIRMALENDU SARKAR",
            "designation" => "Area Manager",
            "email_id" => "pritam@sikshapedia.com",
            "mobile_no"=> "9830122122" 
        )
       );

       $data['second_part_contract'] = array(
        array(
            "name"=>"AVINANDAN GUPTA",
            "designation" => "Official",
            "email_id" => "abhinandan.gupta@gmail.com",
            "mobile_no"=> "9475637852/7908686944"
        ),
        
       );

       $font = $dompdf->getFontMetrics()->get_font("helvetica", "bold");
       $dompdf->getCanvas()->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 10, array(0,0,0));

        
        //exit;
        // Get HTML content from Blade views for each page
        $page1 = View::make('backend.mou.pages', $data)->render();
        $page2 = View::make('backend.mou.page2',$data)->render();
        $page3 = View::make('backend.mou.page3',$data)->render();
        $page4 = View::make('backend.mou.page4',$data)->render();
        
       
        // Combine HTML content of all pages
        $html = "<html><body>{$page1}<div style='page-break-after: always;'></div>{$page2}<div style='page-break-after: always;'></div>{$page3}<div style='page-break-after: always;'></div>{$page4}</body></html>";
        //$html = "<html><body>{$page5}</body></html>";
        // Load combined HTML content into Dompdf
        $dompdf->loadHtml($html);

        // Set paper size and orientation for the PDF
        $dompdf->setPaper('A3', 'portrait'); // Adjust paper size and orientation as needed
        //A3: 'A3' - 297 x 420 mm or 11.7 x 16.5 inches
        //A4: 'A4' - 210 x 297 mm or 8.3 x 11.7 inches
        //A5: 'A5' - 148 x 210 mm or 5.8 x 8.3 inches
        //Letter: 'letter' or '8.5x11' - 8.5 x 11 inches
        //Legal: 'legal' or '8.5x14' - 8.5 x 14 inches
        //Tabloid: 'tabloid' or '11x17' - 11 x 17 inches

        // (Optional) Set options if needed
        $options = new Options();
      $options->set('isRemoteEnabled', true);
       $options->set('isHtml5ParserEnabled', true);
        $dompdf->setOptions($options);

        // Render the PDF
        $dompdf->render();

        $dompdf->stream("dompdf_out.pdf", array("Attachment" => false));

        // // Get the generated PDF content
        // $pdfContent = $dompdf->output();

        // // Return the PDF content in the response with appropriate headers

        // // $proposal_file_name = strtoupper($data['institute_name'])."-".date('M-Y')."-BILLS-CREATED-BY-".auth()->user()->name.date('d-m-Y').".pdf";
        // $proposal_file_name = "Test-INST-".date('M-Y')."-MOU-CREATED-BY-".auth()->user()->name.date('d-m-Y').".pdf";

        // $linkk = Storage::put("public/mou/".$proposal_file_name,$pdfContent);
        // //$filename =Storage::files('public/proposal/multi_page_pdf.pdf');
        // if($linkk == true){

        //     $status = 1;
        //     $pdflink = env('APP_URL').'/storage/app/public/mou/'.$proposal_file_name;
        // }else{

        //     $status = 0;
        //     $pdflink = "";

        // }


        // return response()->json(['success'=>1,'pdf_link'=>$pdflink]);


   }

   public function sendMou(Request $request){


        $validator = Validator::make($request->all(), [
            'mou_start_date' => 'required',
            'mou_valid_upto' => 'required',
            'party_name' => 'required',
            'party_address' => 'required',
            'mou_favour_name' => 'required',
            'first_party_name' => 'required',
            'first_party_designation' => 'required',
            'first_party_email' =>'required',
            'first_party_mobile'=>'required',
            'second_party_name'=>'required',
            'second_party_designation' => 'required',
            'second_party_email' =>'required',
            'second_party_mobile'=>'required',
            'mou_product'=>'required',
            'mou_payment_option'=>'required',
            'mou_product_discount'=>'required',
            'mou_product_total_cost'=>'required',
            'subject'=>'required',
            'email_cc'=> 'required',
            'email_message'=>'required',
            

        
         ]);
        
            if ($validator->fails())
            {
                \LogActivity::addToLog('Validation Error occurred.'.json_encode($validator));
                return Redirect::back()->withInput()->withErrors($validator);
            }
        
                // Create an instance of Dompdf
                $dompdf = new Dompdf();

                $data=array();

                // (Optional) Setup the paper size and orientation
                $dompdf->setPaper('A4');

                // Render the HTML as PDF
                //$dompdf->render();

                //post method 
                $mou_start_on = date('Y-m-d',strtotime($request->mou_start_date));
                $mou_valid_upto = date('Y-m-d',strtotime($request->mou_valid_upto));
                $institute_name = $request->party_name;
                $institute_address = $request->party_address;
                $mou_favour_name = $request->mou_favour_name ;
                $party_pan_no = $request->pan_no;
                $first_party_name=$request->first_party_name;
                $first_party_designation= $request->first_party_designation;
                $first_party_email = $request->first_party_email;
                $first_party_mobile = $request->first_party_mobile;
                $second_party_name = $request->second_party_name;
                $second_party_designation = $request->second_party_designation;
                $second_party_email = $request->second_party_email;
                $second_party_mobile=$request->second_party_mobile;
                $package_id = $request->mou_product;
                $payment_option_id = $request->mou_payment_option;
                $product_cost_with_gst = $request->mou_product_total_cost;
                $product_discount = $request->mou_product_discount;
                $proposal_id = $request->proposal_id;
                $intsid = $request->intsid;

                $mou_data = MouSent::firstOrNew(
                    array(
                        'proposal_id'=>$proposal_id,
                        'institute_id'=>$intsid,
                        'party_name'=>$institute_name,
                        'address'=>$institute_address  ,
                        'mou_start_on'=> $mou_start_on,
                        'mou_valid_upto' => $mou_valid_upto
                    
                    ));

                    $mou_data->proposal_id = $proposal_id;
                    $mou_data->institute_id= $intsid ;
                    $mou_data->party_name = $institute_name;
                    $mou_data->address = $institute_address ;
                    $mou_data->mou_start_on =  $mou_start_on;
                    $mou_data->mou_valid_upto = $mou_valid_upto ;
                    $mou_data->administrator_name = $mou_favour_name ;
                    $mou_data->pan_no = $party_pan_no ;
                    $mou_data->package_id = $package_id ;
                    $mou_data->payment_option = $payment_option_id ;
                    $mou_data->discount = $product_discount ;
                    $mou_data->total_cose = $product_cost_with_gst ;

                    $mou_data->save();

                    $mouid = $mou_data->id;

                    //isert into first party 

                    for($i=0;$i<count($first_party_name); $i++){

                        $first_party = MouSentFirstParty::firstOrNew(array(
                            'mou_id'=>$mouid,
                            'name'=> $first_party_name[$i],
                            'designation'=>$first_party_designation[$i],
                            'email_id'=>$first_party_email[$i],
                            'mobile_no'=>$first_party_mobile[$i],
                            
                        ));

                        $first_party->mou_id = $mouid;
                        $first_party->name = $first_party_name[$i];
                        $first_party->designation = $first_party_designation[$i];
                        $first_party->email_id = $first_party_email[$i];
                        $first_party->mobile_no = $first_party_mobile[$i];
                        $first_party->save();
                    }



                    //insert to second party 

                    for($i=0;$i<count($second_party_name); $i++){

                        $second_party = MouSentSecondParty::firstOrNew(array(
                            'mou_id'=>$mouid,
                            'name'=> $second_party_name[$i],
                            'designation'=>$second_party_designation[$i],
                            'email_id'=>$second_party_email[$i],
                            'mobile_no'=>$second_party_mobile[$i],
                            
                        ));

                        $second_party->mou_id = $mouid;
                        $second_party->name = $second_party_name[$i];
                        $second_party->designation = $second_party_designation[$i];
                        $second_party->email_id = $second_party_email[$i];
                        $second_party->mobile_no = $second_party_mobile[$i];

                        $second_party->save();


                    }

                

                $data['content'] = MemorandumOfUnderstanding::all() ;
                $data['mouStartdate'] = date('jS F, Y',strtotime($mou_start_on));
                $data['collegeName'] = ucwords($institute_name);
                $data['collegeAddress'] = ucwords($institute_address);
                $data['collegeAdmin'] = "Mr./Ms.".ucwords($mou_favour_name);
                $data['panNo'] = strtoupper($party_pan_no);
                $data['mouValidUpto'] =date('jS F, Y',strtotime($mou_valid_upto));
                $data['first_part_contract'] = MouSentFirstParty::where('mou_id',$mouid)->get();
                $data['second_part_contract'] = MouSentSecondParty::where('mou_id',$mouid)->get();
                $data['package_id'] = $package_id;
                $data['payment_option_id'] = $payment_option_id;
                $data['discount'] = $product_discount;
                $data['product_cost'] = $product_cost_with_gst;
                

                // $font = $dompdf->getFontMetrics()->get_font("helvetica", "bold");
                // $dompdf->getCanvas()->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 10, array(0,0,0));

                
                //exit;
                // Get HTML content from Blade views for each page
                $page1 = View::make('backend.mou.pages', $data)->render();
                $page2 = View::make('backend.mou.page2',$data)->render();
                $page3 = View::make('backend.mou.page3',$data)->render();
                $page4 = View::make('backend.mou.page4',$data)->render();
                
                
                // Combine HTML content of all pages
                $html = "<html><body>{$page1}<div style='page-break-after: always;'></div>{$page2}<div style='page-break-after: always;'></div>{$page3}<div style='page-break-after: always;'></div>{$page4}</body></html>";
                //$html = "<html><body>{$page5}</body></html>";
                // Load combined HTML content into Dompdf
                $dompdf->loadHtml($html);

                // Set paper size and orientation for the PDF
                $dompdf->setPaper('A3', 'portrait'); // Adjust paper size and orientation as needed
                //A3: 'A3' - 297 x 420 mm or 11.7 x 16.5 inches
                //A4: 'A4' - 210 x 297 mm or 8.3 x 11.7 inches
                //A5: 'A5' - 148 x 210 mm or 5.8 x 8.3 inches
                //Letter: 'letter' or '8.5x11' - 8.5 x 11 inches
                //Legal: 'legal' or '8.5x14' - 8.5 x 14 inches
                //Tabloid: 'tabloid' or '11x17' - 11 x 17 inches

                // (Optional) Set options if needed
                $options = new Options();
                $options->set('isRemoteEnabled', true);
                $options->set('isHtml5ParserEnabled', true);
                    $dompdf->setOptions($options);

                    // Render the PDF
                    $dompdf->render();

                    // Get the generated PDF content
                    $pdfContent = $dompdf->output();

                // Return the PDF content in the response with appropriate headers


    // $proposal_file_name = strtoupper($data['institute_name'])."-".date('M-Y')."-BILLS-CREATED-BY-".auth()->user()->name.date('d-m-Y').".pdf";
    $proposal_file_name = strtoupper(ucwords($institute_name))."-MOU-".date('M-Y')."-CREATED-BY-".auth()->user()->name.date('d-m-Y').".pdf";

        $linkk = Storage::put("public/mou/".$proposal_file_name,$pdfContent);
        //$filename =Storage::files('public/proposal/multi_page_pdf.pdf');
        if($linkk == true){

            
            $pdflink = env('APP_URL').'/storage/app/public/mou/'.$proposal_file_name;
        
            $imagepathlink = "storage/app/public/mou/".$proposal_file_name;


            $response_flag = 0;
            $error='';
            try {
                $emailServices_smtp = Helpers::get_business_settings('mail_config');

                $emailexx = explode(",",$request->email_cc);

                array_push($emailexx,auth()->user()->email);

                //$second_party_email = implode(",",$second_party_email);
                
                if ($emailServices_smtp['status'] == 1) {
                    Mail::to($second_party_email)
                    ->cc($emailexx)
                    ->bcc(array('info@sikshapedia.com','pankaj.ssconline@gmail.com'))
                    ->send(new SendMouEmail($imagepathlink,$request->email_message));
                    $response_flag = 1;
                    $error='';
                
            

            //return response()->json(['success' => $response_flag,'error'=> $error]);


            
            $mou_data->mou_email_sent= 1;
            $mou_data->email_sent_by= auth()->user()->id;
            $mou_data->mou_file_name= $proposal_file_name;
            $mou_data->email_cc= $request->email_cc;
            $mou_data->email_message = $request->email_message;
            $mou_data->email_subject = $request->subject;

            $mou_data->save();


                \LogActivity::addToLog('Mou sent successfully');
            return Redirect::back()->with('success','Mou sent successfully');

             
            
            }


        } catch (\Exception $exception) {
            $response_flag = 2;
            $error = $exception->getMessage();
        
            \LogActivity::addToLog('Emial not sent due to server problem');
            return Redirect::back()->with('error','Opps! something error ! please try after some times later'.$error);
        
        
        }




        }else{

            
            \LogActivity::addToLog('Pdf generation error occurred');
            return Redirect::back()->with('error','Opps! something error ! please try after some times later');
    
        }



   }

   public function sendInvoice(Request $request){

        

                $validator = Validator::make($request->all(), [
                    'account_name' => 'required',
                    'invoice_desc' => 'required',
                    'payment_status' => 'required',
                    'subject' => 'required',
                    'email_cc' => 'required',
                    'email_message'=>'required'
                    
                    
                    ]);
                    
                    if ($validator->fails())
                    {
                        \LogActivity::addToLog('Validation Error occurred.'.json_encode($validator));
                        return Redirect::back()->withInput()->withErrors($validator);
                    }
                    
                    
                // Create an instance of Dompdf
                $dompdf = new Dompdf();

                $data=array();

                // (Optional) Setup the paper size and orientation
            $dompdf->setPaper('A4');

            // Render the HTML as PDF
            //$dompdf->render();

            //post method 
            
            $data['mou_id']= $request->mou_id;
            $data['account_name']= $request->account_name;
            $data['invoice_desc']= $request->invoice_desc;
            $data['extra_desc']= $request->extra_desc;
            $data['payment_status']= $request->payment_status;
            $data['college_address'] = $request->college_address;
            $data['descc'] = $request->invoice_desc;
            //$data['extra_desc'] = $request->extra_desc;

            //get mou info 

            $mouinfo = DB::table('mou_sents')->where('id',$request->mou_id)->first();
                
                //exit;
                // Get HTML content from Blade views for each page
                $page1 = View::make('backend.invoice.page1', $data)->render();
                
            
                // Combine HTML content of all pages
                $html = "<html><body>{$page1}</body></html>";
                //$html = "<html><body>{$page5}</body></html>";
                // Load combined HTML content into Dompdf
                $dompdf->loadHtml($html);

                // Set paper size and orientation for the PDF
                $dompdf->setPaper('A3', 'portrait'); // Adjust paper size and orientation as needed
                //A3: 'A3' - 297 x 420 mm or 11.7 x 16.5 inches
                //A4: 'A4' - 210 x 297 mm or 8.3 x 11.7 inches
                //A5: 'A5' - 148 x 210 mm or 5.8 x 8.3 inches
                //Letter: 'letter' or '8.5x11' - 8.5 x 11 inches
                //Legal: 'legal' or '8.5x14' - 8.5 x 14 inches
                //Tabloid: 'tabloid' or '11x17' - 11 x 17 inches

                // (Optional) Set options if needed
                $options = new Options();
            $options->set('isRemoteEnabled', true);
            $options->set('isHtml5ParserEnabled', true);
                $dompdf->setOptions($options);

                // Render the PDF
                $dompdf->render();

                // Get the generated PDF content
                $pdfContent = $dompdf->output();

    // Return the PDF content in the response with appropriate headers

    $proposal_file_name = strtoupper($request->institute_name)."-FINAL-INVOICE-".date('M-Y')."-CREATED-BY-".auth()->user()->name.date('d-m-Y').".pdf";

    $linkk = Storage::put("public/invoice/".$proposal_file_name,$pdfContent);
    //$filename =Storage::files('public/proposal/multi_page_pdf.pdf');
    if($linkk == true){

        
        $pdflink = env('APP_URL').'/storage/app/public/invoice/'.$proposal_file_name;
    
        $imagepathlink = "storage/app/public/invoice/".$proposal_file_name;


        $response_flag = 0;
        $error='';
        try {
            $emailServices_smtp = Helpers::get_business_settings('mail_config');

            $emailexx = explode(",",$request->email_cc);

            array_push($emailexx,auth()->user()->email);
            
            if ($emailServices_smtp['status'] == 1) {
                Mail::to($request->email_address)
                ->cc($emailexx)
                ->bcc(array('info@sikshapedia.com','pankaj.ssconline@gmail.com'))
                ->send(new CloseDealEmail($imagepathlink,$request->email_message));
                $response_flag = 1;
                $error='';
            
        

        //return response()->json(['success' => $response_flag,'error'=> $error]);


        $proposal = FinalInvoice::firstOrNew(array('mou_id'=>$request->mou_id));

        $proposal->mou_id= $request->intsid;
        $proposal->proposal_id=$mouinfo->proposal_id;
        $proposal->product_id= $mouinfo->package_id;
        $proposal->payment_id= $mouinfo->payment_option;
        $proposal->account_name= $request->account_name;
        $proposal->description= $request->invoice_desc;
        $proposal->extra_desc= $request->extra_desc;
        $proposal->total_cost= $mouinfo->total_cose;
        $proposal->discount= $mouinfo->discount;
        $proposal->invoice_file_name= $proposal_file_name;
        $proposal->email_cc= $request->email_cc;
        $proposal->email_subject=$request->subject;
        $proposal->payment_status= $request->payment_status;
        $proposal->email_sent_by= auth()->user()->id;
        $proposal->message_body= $request->email_message;
        $proposal->save();


            \LogActivity::addToLog('Final Invoice successfully');
        return Redirect::back()->with('success','Final Invoice sent successfully');

         
        
        }


    } catch (\Exception $exception) {
        $response_flag = 2;
        $error = $exception->getMessage();
    
        \LogActivity::addToLog('Emial not sent due to server problem');
        return Redirect::back()->with('error','Opps! something error ! please try after some times later'.$error);
    
    
    }




    }else{

        
        \LogActivity::addToLog('Pdf generation error occurred');
        return Redirect::back()->with('error','Opps! something error ! please try after some times later');

    }



   }

   public function generateInvoicePdf(Request $request){

    // Create an instance of Dompdf
    $dompdf = new Dompdf();

    $data=array();

    // (Optional) Setup the paper size and orientation
   $dompdf->setPaper('A4');

   // Render the HTML as PDF
   //$dompdf->render();

   //post method 
   
   $font = $dompdf->getFontMetrics()->get_font("helvetica", "bold");
   $dompdf->getCanvas()->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 10, array(0,0,0));
   $data['mou_id']= $request->mou_id;
   $data['account_name']= $request->account_name;
   $data['invoice_desc']= $request->invoice_desc;
   $data['extra_desc']= $request->extra_desc;
   $data['payment_status']= $request->payment_status;
   $data['college_address'] = $request->college_address;
   $data['descc'] = $request->invoice_desc;
   $data['extra_desc'] = $request->extra_desc;
    
    //exit;
    // Get HTML content from Blade views for each page
    $page1 = View::make('backend.invoice.page1', $data)->render();
     
   
    // Combine HTML content of all pages
    $html = "<html><body>{$page1}</body></html>";
    //$html = "<html><body>{$page5}</body></html>";
    // Load combined HTML content into Dompdf
    $dompdf->loadHtml($html);

    // Set paper size and orientation for the PDF
    $dompdf->setPaper('A3', 'portrait'); // Adjust paper size and orientation as needed
    //A3: 'A3' - 297 x 420 mm or 11.7 x 16.5 inches
    //A4: 'A4' - 210 x 297 mm or 8.3 x 11.7 inches
    //A5: 'A5' - 148 x 210 mm or 5.8 x 8.3 inches
    //Letter: 'letter' or '8.5x11' - 8.5 x 11 inches
    //Legal: 'legal' or '8.5x14' - 8.5 x 14 inches
    //Tabloid: 'tabloid' or '11x17' - 11 x 17 inches

    // (Optional) Set options if needed
    $options = new Options();
  $options->set('isRemoteEnabled', true);
   $options->set('isHtml5ParserEnabled', true);
    $dompdf->setOptions($options);

    // Render the PDF
    $dompdf->render();

    // Get the generated PDF content
    $pdfContent = $dompdf->output();

    // Return the PDF content in the response with appropriate headers

    // $proposal_file_name = strtoupper($data['institute_name'])."-".date('M-Y')."-BILLS-CREATED-BY-".auth()->user()->name.date('d-m-Y').".pdf";
    $proposal_file_name = "Test-INST-".date('M-Y')."-INVOICE-CREATED-BY-".auth()->user()->name.date('d-m-Y').".pdf";

    $linkk = Storage::put("public/invoice/".$proposal_file_name,$pdfContent);
    //$filename =Storage::files('public/proposal/multi_page_pdf.pdf');
    if($linkk == true){

        $status = 1;
        $pdflink = env('APP_URL').'/storage/app/public/invoice/'.$proposal_file_name;
    }else{

        $status = 0;
        $pdflink = "";

    }


    return response()->json(['success'=>1,'pdf_link'=>$pdflink]);

   }

   public function generateInvoicePdfGet(Request $request){

    $dompdf = new Dompdf();

    $data[]='Memorandum of ';

    // (Optional) Setup the paper size and orientation
   $dompdf->setPaper('A4');

   // Render the HTML as PDF
   //$dompdf->render();

   $data['content'] = MemorandumOfUnderstanding::all() ;


   $font = $dompdf->getFontMetrics()->get_font("helvetica", "bold");
   $dompdf->getCanvas()->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 10, array(0,0,0));

    
    //exit;
    // Get HTML content from Blade views for each page
    $page1 = View::make('backend.invoice.page1', $data)->render();
    
    
   
    // Combine HTML content of all pages
    $html = "<html><body>{$page1}</body></html>";
    //$html = "<html><body>{$page5}</body></html>";
    // Load combined HTML content into Dompdf
    $dompdf->loadHtml($html);

    // Set paper size and orientation for the PDF
    $dompdf->setPaper('A3', 'portrait'); // Adjust paper size and orientation as needed
    //A3: 'A3' - 297 x 420 mm or 11.7 x 16.5 inches
    //A4: 'A4' - 210 x 297 mm or 8.3 x 11.7 inches
    //A5: 'A5' - 148 x 210 mm or 5.8 x 8.3 inches
    //Letter: 'letter' or '8.5x11' - 8.5 x 11 inches
    //Legal: 'legal' or '8.5x14' - 8.5 x 14 inches
    //Tabloid: 'tabloid' or '11x17' - 11 x 17 inches

    // (Optional) Set options if needed
    $options = new Options();
  $options->set('isRemoteEnabled', true);
   $options->set('isHtml5ParserEnabled', true);
    $dompdf->setOptions($options);

    // Render the PDF
    $dompdf->render();

    $dompdf->stream("dompdf_out.pdf", array("Attachment" => false));


   }
}
