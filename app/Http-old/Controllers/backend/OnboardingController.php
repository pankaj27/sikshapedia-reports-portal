<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OnboardingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        abort_if(!auth()->user()->can('onboarding-list'),403);

        $roles = DB::table('roles')->whereNotIn('name',['Superadmin','Admin'])->get();

        if(auth()->user()->roles->pluck('name')[0] == 'Superadmin'){

            return view('backend.superadmin.onboarding.list',compact('roles'));
        }
        
    }


    public function onBoardingData(Request $request){

        abort_if(!auth()->user()->can('onboarding-list'),403);

        $roles = DB::table('roles')->whereNotIn('name',['Superadmin','Admin'])->get();

        if(auth()->user()->roles->pluck('name')[0] == 'Superadmin'){

            return view('backend.superadmin.onboarding.list',compact('roles'));
        }

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
}
