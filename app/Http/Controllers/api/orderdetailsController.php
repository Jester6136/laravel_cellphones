<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\orderdetails;
use App\Models\orders;
use Illuminate\Http\Request;

class orderdetailsController extends Controller
{
    public function getTopProductSell(){
        $orderdetails = orderdetails::take(5)->whereMonth('created_at', date('m'))->orderBy('Quantity','DESC')->get();
        foreach($orderdetails as $orderdetail){
            $color = $orderdetail->color;
            $memory = $color->memory;
            $product = $memory->product;
            $name = $product->ProductName . ' | ' . $memory->MemoryName .' | '. $color->ColorName;
            $orderdetail->name = $name;
        }
        return $orderdetails;    
    }

    public function total(){
        $orderdetails = orderdetails::whereMonth('created_at', date('m'))->get();
        $total = 0;
        foreach($orderdetails as $orderdetail){
            $total +=$orderdetail->Quantity * $orderdetail->single_price;
        }
        return $total;    
    }

    public function count_order(){
        $orders = orders::whereDate('created_at', '=', date('Y-m-d'))->get();
        return $orders->count();
    }

    
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\orderdetails  $orderdetails
     * @return \Illuminate\Http\Response
     */
    public function show(orderdetails $orderdetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\orderdetails  $orderdetails
     * @return \Illuminate\Http\Response
     */
    public function edit(orderdetails $orderdetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\orderdetails  $orderdetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, orderdetails $orderdetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\orderdetails  $orderdetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(orderdetails $orderdetails)
    {
        //
    }
}
