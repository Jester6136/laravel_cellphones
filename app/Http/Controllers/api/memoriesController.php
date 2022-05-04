<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\memories;
use Illuminate\Http\Request;

class memoriesController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $db = new memories();
        $db->ProductID = $request->ProductID;
        $db->MemoryName = $request->MemoryName;
        $db->Description = $request->Description;
        $db->save();
        return $db;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\memories  $memories
     * @return \Illuminate\Http\Response
     */
    public function show($productID)
    {
        $memories = memories::where('productID',$productID)->where('is_active',1)->get();
        return $memories;
    }

    public function getcolordetails($memoryID)
    {   
        $memories = memories::where('id',$memoryID)->where('is_active',1)->first();
        $colors = $memories->colors;
        foreach($colors as $color){
            $color->prices;
            $color->old_prices;
        }
        return $memories;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\memories  $memories
     * @return \Illuminate\Http\Response
     */
    public function edit($obj)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\memories  $memories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $db = memories::find($id);
        $db->MemoryName = $request->MemoryName;
        $db->Description = $request->Description;
        $db->save();

        return $db;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\memories  $memories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $db = memories::findOrFail($id);
        $db->is_active=0;
        $db->save();
        return $db;
    }
}
