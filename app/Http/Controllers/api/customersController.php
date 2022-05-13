<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\customers;
use Illuminate\Http\Request;

class customersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return ' ngu';
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
     * @param  \App\Models\customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function show($customer)
    {
        // 
    }

    // public function show_cus($email,$password)
    // {
    //     return customers::where("Email",$email)->where("Password",$password)->first();
    // }

    public function show_cus(Request $customer)
    {
        $customer = customers::where("Email",$customer->email)->where("Password",$customer->password)->first();
        $carts = $customer->cart;
        if($carts == null){
            return 0;
        }
        $quantity = 0;
        foreach($carts as $cart){
            $quantity++;
        }
       
        $customer->Quantity = $quantity;
        return $customer;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function edit(customers $customers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, customers $customers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function destroy(customers $customers)
    {
        //
    }
}
