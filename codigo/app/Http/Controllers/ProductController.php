<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Models\Product;
use Config, Auth;

class ProductController extends Controller
{
    public function getProduct($id, $slug){
        $product = Product::findorFail($id);
        $data = [
            'product' => $product
        ];
        return view('product.product_single', $data);
    }
}
