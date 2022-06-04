<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\orders;
use Barryvdh\DomPDF\Facade as PDF;

class PDFController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF($id,$staffName)
    {
        $order= orders::where('is_active',1)->where('id',$id)->first();
        $order->customer;
        $orderdetails = $order->orderdetails;
        foreach($orderdetails as $orderdetail){
            $product_name = '';
            $color = $orderdetail->color;
            $color->old_prices;
            $memory = $color->memory;
            $product = $memory->product;
            $product_name = $product->ProductName. " | " .$memory->MemoryName." | ".$color->ColorName;
            $orderdetail->product_name = $product_name;
        }
        $data = [
            'order' => $order,
            'staffName' => $staffName
        ];

        $pdf = PDF::loadView('admin_page.myPDF', $data);
     
        return $pdf->download('order.pdf');
    }
}
