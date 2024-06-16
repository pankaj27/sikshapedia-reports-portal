<?php

namespace App\Http\Controllers\backend;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Models\MemorandumOfUnderstanding;

class MemorandamOfUnderstanding extends Controller
{
    //

    public function index(Request $request): View
    {
        
        
        $mou = MemorandumOfUnderstanding::orderBy('id','ASC')->get();
        return view('backend.superadmin.master-settings.master-settings',compact('mou'));
    }

    
}
