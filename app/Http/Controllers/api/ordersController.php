<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\colors;
use App\Models\orderdetails;
use App\Models\cart;
use App\Models\orders;
use App\Models\prices;
use Illuminate\Http\Request;

class ordersController extends Controller
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
        $order = new orders();
        $order->CustomerID = (int)$request->CustomerID;
        $order->DeliveryAddress = $request->Address;
        $order->Phone = $request->Phone;
        $order->Email = $request->Email;
        $order->Amount = $request->Amount;
        $order->is_active = 1;
        $order->Status = 1;
        $order->Description = $request->More;
        $order->save();

        $orderID = $order->id;
        $orderDetails = $request['OrderDetail'];
        foreach($orderDetails as $orderdetail){
            $db_orderdetail = new orderdetails();
            $db_orderdetail->OrderID = $orderID;
            $price = prices::where('colorID',$orderdetail['ColorID'])->where('EndDate',null)->first();
            $db_orderdetail->ColorID = (int)$orderdetail['ColorID'];
            $db_orderdetail->single_price = $price['Price'];
            $db_orderdetail->Quantity = (int)$orderdetail['Quantity'];

            $color = colors::find($db_orderdetail->ColorID);
            $color->Quantity = $color->Quantity - $db_orderdetail->Quantity;
            $color->save();
            $db_orderdetail->save();
        }

        cart::where('CustomerID',$order->CustomerID)->delete();
        return "success";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order= orders::where('is_active',1)->where('id',$id)->first();
        $order->customer;
        $orderdetails = $order->orderdetails;
        foreach($orderdetails as $orderdetail){
            $color = $orderdetail->color;
            $color->old_prices;
            $memory = $color->memory;
            $memory->product;
        }
        return $order;
    }

    public function get_all()
    {
        $orders= orders::where('is_active',1)->orderBy('created_at','DESC')->get();
        foreach($orders as $order){
            $order->customer;
            $orderdetails = $order->orderdetails;
            foreach($orderdetails as $orderdetail){ 
                $color = $orderdetail->color;
                $color->old_prices;
                $memory = $color->memory;
                $product = $memory->product;
                $name = $product->ProductName . ' | ' . $memory->MemoryName .' | '. $color->ColorName;
                $orderdetail->name = $name;
            }
        }
        return $orders;
    }

    public function showByCusID($id)
    {
        $order= orders::where('is_active',1)->where('CustomerID',$id)->orderBy('created_at','desc')->first();
        $order->customer;
        $orderdetails = $order->orderdetails;
        foreach($orderdetails as $orderdetail){
            $color = $orderdetail->color;
            $color->old_prices;
            $memory = $color->memory;
            $memory->product;
        }
        return $order;
    }

    public function update_status(Request $request){
        $db = orders::find($request->id);
        $db->Status = $request->Status;
        $db->save();
    }

    public function checkOrder($phone,$orderid)
    {
        $order= orders::where('is_active',1)->where('Phone',$phone)->where('id',$orderid)->first();
        if($order == null){
            return null;
        }
        $order->customer;
        $orderdetails = $order->orderdetails;
        foreach($orderdetails as $orderdetail){
            $color = $orderdetail->color;
            $color->old_prices;
            $memory = $color->memory;
            $memory->product;
        }
        return $order;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function editStatus($id)
    {
        $db = orders::find($id);
        $db->Status = 6;
        $db->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, orders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy(orders $orders)
    {
        //
    }

    public function getSellYear(){
        $order_group_by_month = orders::where('is_active',1)->where('Status',5)->whereYear('created_at',date('Y'))->get()->groupBy(function($data){
            return $data->created_at->format('m');
        });
        return $order_group_by_month;
    }

    public function getStatusAnalysis(){
        $orders = orders::where('is_active',1)->get();
        $status_1 = 0;
        $status_2 = 0;
        $status_3 = 0;
        $status_4 = 0;
        $status_5 = 0;
        $status_6 = 0;
        foreach($orders as $od){
            if($od->Status == 1){
                $status_1++;
            }
            else if($od->Status == 2){
                $status_2++;
            }
            else if($od->Status == 3){
                $status_3++;
            }
            else if($od->Status == 4){
                $status_4++;
            }
            else if($od->Status == 5){
                $status_5++;
            }
            else{
                $status_6++;
            }
        }
        return [$status_1,$status_2,$status_3,$status_4,$status_5,$status_6];
    }
}
