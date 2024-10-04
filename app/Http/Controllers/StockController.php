<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockTracking;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    public function __construct()
    {

    }

    public function get(Request $request)
    {
      return $request->all();
    }


    public function create(Request $request)
    {
        $stock = new StockTracking();
        $stock->product_name = $request->input("product_name");
        $stock->product_price = $request->input("product_price");
        $stock->product_stock = $request->input("product_stock");
        $stock->user_id = Auth::user()->id;
        if($stock->save())
        {
            return response()->json([
                "status" => "success",
                "message" => "Stok Eklendi."
            ]);
        }else{
            return response()->json([
                "status" => "error",
                "message" => "Stok Eklenemedi."
            ]);
        }

    }

    public function update(Request $request)
    {
        $stock = StockTracking::where("id","=",$request->id)->first();
        $stock->product_name = $request->input("product_name");
        $stock->product_price = $request->input("product_price");
        $stock->product_stock = $request->input("product_stock");
        $stock->user_id = Auth::user()->id;
        if($stock->save())
        {
            return response()->json([
                "status" => "success",
                "message" => "Stok Düzenlendi."
            ],200);
        }else{
            return response()->json([
                "status" => "error",
                "message" => "Stok Düzenlenemedi."
            ],500);
        }
    }


    public function delete(Request $request)
    {
        $delete = StockTracking::where("id",$request->id)->first();
        if($delete){
            if($delete->delete()){
                return response()->json([
                    "status" => "success",
                    "message" => "Stok Silindi."
                ],200);
            }else {
                return response()->json([
                    "status" => "error",
                    "message" => "Stok Silinemedi."
                ],500);
            }
        }else {
            return response()->json([
                "status" => "error",
                "message" => "Böyle Bir Veri Yok."
            ],500);
        }
    }
}
