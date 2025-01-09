<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products=[
            'id','name','description','image','price'
        ];

        $title;
        $subtitle;
        $product;
        return view('product.index');
    }
}
