<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Support\Str;
use App\Models\MouSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LinkController extends Controller
{
    public function create()
    {
        return view('create-link');
    }
 
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'institute_idd' => 'required',           
            
            ]);

            if ($validator->fails())
            {
                \LogActivity::addToLog('Validation Error occurred.'.json_encode($validator));
                return response()->json(['success'=>0,'message'=>'Institute id is required 1']);
            }

            try{

                $mouinfo = MouSent::where('institute_id',decrypt($request->institute_idd))->first();
               // return response()->json(['success'=>0,'message'=>$mouinfo]);
                if(isset($mouinfo) && !empty($mouinfo)){
                    //$originalUrl = route('upload-mou',encrypt($mouinfo->id));
                    //$link = Link::shortenUrl($originalUrl);
                    
                    //$linkk = Link::where('mou_id',$mouinfo->id)->first();
                    //$link-

                    $checkmoulinkexist = Link::where('mou_id',$mouinfo->id)->first();
                    if(isset($checkmoulinkexist) && !empty($checkmoulinkexist))
                    {

                        return response()->json(['success'=>1,'url_link'=>env('APP_URL').'/'.$checkmoulinkexist->short_url]);

                    }else{
                        $linki = Str::random(10);
                       
                        $linkk = new Link;
                        $linkk->mou_id = $mouinfo->id;
                        $linkk->short_url =$linki; 
                        $linkk->original_url =route('upload-mou',encrypt($mouinfo->id));
                        $linkk->save();
                        return response()->json(['success'=>1,'url_link'=>env('APP_URL').'/'.$linkk->short_url]);

                    }

                
                }else{
                
                    return response()->json(['success'=>0,'message'=>'Please send MOU First! then try to generate MOU']);

                }


            }catch(\Exception $e){

                return response()->json(['success'=>0,'message'=>$e->getMessage()]);

            } 

       
        
 
        
    }
 
    public function show($shortUrl)
    {
        $originalUrl = Link::where('short_url',$shortUrl)->first();
 
        if (empty($originalUrl)) {
            //abort(404);
            return redirect()->route('view-mou')->with('success','Link Expired');
        }
 
        return redirect($originalUrl->original_url);
    }
}
