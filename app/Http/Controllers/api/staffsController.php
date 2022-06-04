<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\staffs;
use Illuminate\Http\Request;

class staffsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function checkLogin(Request $request){
        $staff = staffs::where('Email',$request->email)->where('Password',$request->password)->first();
        return $staff;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\staffs  $staffs
     * @return \Illuminate\Http\Response
     */
    public function show(staffs $staffs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\staffs  $staffs
     * @return \Illuminate\Http\Response
     */
    public function edit(staffs $staffs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\staffs  $staffs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, staffs $staffs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\staffs  $staffs
     * @return \Illuminate\Http\Response
     */
    public function destroy(staffs $staffs)
    {
        //
    }
}
