<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\invoices;
use App\Models\invoice_details;
use Illuminate\Http\Request;
use DateTime;

class invoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = invoices::where('is_active',1)->get();
        foreach($invoices as $invoice){
            $invoice->suppliers;
        }
        return $invoices;
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
        $invoice = new invoices();
        $invoice->supplier_id = $request->supplier_id;
        $invoice->staffID = $request->staffID;
        $invoice->invoice_date = new DateTime();
        $invoice->total = $request->total;
        $invoice->discount = $request->discount;
        $invoice->status = 4;
        $invoice->save();

        $id = $invoice->id;

        $invoice_details = $request['invoice_details'];
        foreach($invoice_details as $invoice_detail){
            $db_invoice_detail = new invoice_details();
            $db_invoice_detail->invoiceID = $id;
            $db_invoice_detail->colorID = $invoice_detail['colorID'];
            $db_invoice_detail->quantity = $invoice_detail['quantity'];
            $db_invoice_detail->discount = $invoice_detail['discount'];
            $db_invoice_detail->price = $invoice_detail['price'];
            $db_invoice_detail->total = $invoice_detail['total'];
            $db_invoice_detail->save();
        }
        return $invoice;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = invoices::find($id);
        $invoice_details = $invoice->invoice_details;
        $invoice->publishers;
        foreach($invoice_details as $invoice_detail){
            $color = $invoice_detail->color;
            $memory = $color->memory;
            $product = $memory->product;
            $color->ColorName = $product->ProductName . " | " . $memory->MemoryName . " | " . $color->ColorName;
            unset($color->memory);  
        }
        return $invoice;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices $invoices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $invoice = invoices::find($id);
        $invoice->supplier_id = $request->supplier_id;
        $invoice->staffID = $request->staffID;
        $invoice->total = $request->total;
        $invoice->discount = $request->discount;
        $invoice->status = 4;
        $invoice->save();

        $invoice_details = $request['invoice_details'];
        foreach($invoice_details as $invoice_detail){
            $db_invoice_detail = invoice_details::find($invoice_detail['id']);
            $db_invoice_detail->colorID = $invoice_detail['colorID'];
            $db_invoice_detail->quantity = $invoice_detail['quantity'];
            $db_invoice_detail->discount = $invoice_detail['discount'];
            $db_invoice_detail->price = $invoice_detail['price'];
            $db_invoice_detail->total = $invoice_detail['total'];
            $db_invoice_detail->save();
        }
        return $invoice;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoices $invoices)
    {
        //
    }
}
