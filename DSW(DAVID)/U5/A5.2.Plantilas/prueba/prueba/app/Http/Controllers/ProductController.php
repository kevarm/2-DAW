<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
    {
        public static $products=[
            [
                'id'=>1,
                'name'=>'Product1',
                'description'=>'description',
                'image'=>'/img/product1.jpg',
                'price'=>10
            ],
            [
                'id'=>2,
                'name'=>'Product2',
                'description'=>'description',
                'image'=>'/img/product2.jpg',
                'price'=>15   
            ],
            [
                'id'=>3,
                'name'=>'Product3',
                'description'=>'description',
                'image'=>'/img/product3.jpg',
                'price'=>12   
            ],
            [
                'id'=>4,
                'name'=>'Product4',
                'description'=>'description',
                'image'=>'/img/product4.jpg',
                'price'=>20  
            ]
            ];

        public function index(){
            $products=[
                'title'=>'Título',
                'subtitle'=> 'Nombre',
                'products'=>'Productos'
            ];
            return view('product.index');
        }
    }
