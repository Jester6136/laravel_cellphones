<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\cart;
use Illuminate\Http\Request;

class cartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = cart::all();
        foreach($cart as $item){
            $color = $item->color;
            $new_price = $color->prices;
            $old_price = $color->old_prices;
            $item->new_price =$new_price->Price;
            if($old_price==null){
                $item->old_price =$new_price->Price;
            }
            else{
                $item->old_price =$old_price->Price;
            }
            $memory = $color->memory;
            $memory->product;
        }
        return $cart;
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
        $cart = new cart();
        $cart->CustomerID = $request->UserID;
        $cart->ColorID = $request->ColorID;
        $cart->save();
        return $cart;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cart $cart)
    {
        //
    }


    public function update_carts(Request $request)
    {
        $carts= $request->toArray();
        
        foreach($carts as $cart){
            $cart_update = cart::find($cart['id']);
            $cart_update->Quantity = $cart['Quantity'];
            $cart_update->save();
        }
        return $carts;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(cart $cart)
    {
        //
    }
}
