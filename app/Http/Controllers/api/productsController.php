<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\colors;
use App\Models\memories;
use App\Models\products;
use Illuminate\Http\Request;
use DateTime;

class productsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = products::where('IsActive',1)->where('categoryID',11)->get();
        foreach ($products as $product) {
            $product->categories;
            $product->brands;
            $product->memories;
        }
        return ['products'=>$products];
    }

    public function get15procduct($categoryID)
    {
        $products = products::where('IsActive',1)->where('categoryID',$categoryID)->take(15)->orderBy('ReleaseDate','DESC')->get();
        foreach($products as $product){
            $product_id = $product->id;
            $product_name = $product->ProductName;
            $product_image = $product->image;

            $product->categories;
            $product->brands;

            $memories = $product->memories;
            foreach($memories as $memory){
                $memory->product_id = $product_id;
                $memory->ProductName = $product_name . " | " . $memory->MemoryName;
                $memory->image = $product_image;

                $min_price = 1000000000000000;
                $old_price = 0;
                $colors = $memory->colors;
                $image_product = "";
                foreach($colors as $color){
                    if($image_product==""){
                        $image_product = $color->ColorImage;
                    }
                    $price_new = $color->prices;
                    if($min_price>$price_new->Price){
                        $min_price = $price_new->Price;
                    }
                    $price_old = $color->old_prices;
                    if($color->old_prices != null){
                        if($old_price<$price_old->Price){
                            $old_price = $price_old->Price;
                        }
                    }
                    else
                        $old_price = $min_price;
                }
                $memory->image_product = $image_product;
                $memory->min_price = $min_price;
                $memory->old_price = $old_price;
            }
        }

        return $products;
    }

    public function getProductDetails($productID){
        $product = products::where('IsActive',1)->where('id',$productID)->first();
        $prices = [];

            $product->categories;
            $product->brands;
            $memories = $product->memories;
            foreach($memories as $memory){
                $new_price = 0;
                $old_price = null;
                $colors = $memory->colors;
                foreach($colors as $color){

                    $new_price = $color->prices->Price;
                    if($color->old_prices != null){
                        $old_price = $color->old_prices->Price;
                    }
                    else{
                        $old_price = $new_price;
                    }
                    
                }
                array_push($prices,[$old_price,$new_price]);
            }
        return [$product,$prices];
    }

    public function uploadFile(Request $request) {
        $type = $request->type;
        $data = $request->file('file');
        $filename = $request->file('file')->getClientOriginalName();
        $path = public_path('/assets/images/');
        $data->move($path, $filename);
        return response()->json([
            'success' => 'done',
            'valueimg'=>$data ]);
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
        
        $product = new products();
        $product->ProductName = $request->ProductName;
        $product->ReleaseDate = $request->DateRelease;
        $product->image = $request->ImageName;
        $product->BrandID = $request->BrandName;
        $product->CategoryID = $request->CategoryName;
        $product->Description = $request->Description;
        $product->save();

        $productID = $product->id;

        $memories = $request->Memories;
        foreach($memories as $memory_request){
            $memory = new memories();
            $memory->ProductID = $productID;

            $memory->MemoryName = $memory_request['MemoryName'];
            $memory->Description = $memory_request['Description'];
            $memory->save();
            $memoryID = $memory->id;
            $colors = $memory_request['Colors'];
            foreach($colors as $color_request){
                $color = new colors();
                $color->MemoryID = $memoryID;
                $color->ProductID = $productID;
                $color->Quantity = $color_request['Quantity'];
                $color->ColorImage = $color_request['ColorImage'];
                $color->ColorName = $color_request['ColorName'];
                $color->save();
                $color->addprice($color->id,$color_request['Price'],new DateTime());
            }
        }
        $product = products::where('IsActive',1)->where('id',$productID)->first();
        $product->categories;
        $product->brands;
        $product->memories;
        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show($productID)
    {
        $product = products::where('id',$productID)->first();
        $product->categories;
        $product->brands;
        $memories=$product->memories;
        foreach($memories as $memory){
            $colors = $memory->colors;
            foreach($colors as $color){
                $color->prices;
            }
        }
        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $db = products::find($id);
        $db->ProductName = $request->ProductName;
        $db->ReleaseDate = $request->ReleaseDate;
        $db->image = $request->image;
        $db->Description = $request->Description;
        $db->save();
        
        return $db;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $db = products::findOrFail($id);
        $db->IsActive=0;
        $db->save();
        return "Deleted";
    }
}
