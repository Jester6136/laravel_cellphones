<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\colors;
use DateTime;
use Faker\Core\Color;
use Illuminate\Http\Request;

class colorsController extends Controller
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
        $db = new colors();
        $db->ProductID = $request->ProductID;
        $db->MemoryID = $request->MemoryID;
        $db->ColorName = $request->ColorName;
        $db->ColorImage = $request->ColorImage;
        $db->Quantity = $request->Quantity;
        $db->save();

        $db->addprice($db->id,$request->Price,new DateTime()); 
        return $db;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\colors  $colors
     * @return \Illuminate\Http\Response
     */
    public function show(colors $colors)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\colors  $colors
     * @return \Illuminate\Http\Response
     */
    public function edit(colors $colors)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\colors  $colors
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $db = colors::find($id);
        $db->ProductID = $request->ProductID;
        $db->MemoryID = $request->MemoryID;
        $db->ColorName = $request->ColorName;
        $db->ColorImage = $request->ColorImage;
        $db->Quantity = $request->Quantity;
        $db->save();

        $db->updateprice($db->id,$request->Price,new DateTime()); 
        return $db;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\colors  $colors
     * @return \Illuminate\Http\Response
     */
    public function destroy(colors $colors)
    {
        //
    }
}
