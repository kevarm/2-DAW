<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function about(){
        $about=[
        'title'=>"Acerca de nosotros",
        'subtitle'=>"Subtítulo",
        'description'=>"Contenido",
        'author'=>"Autor"
        ];
    return view('home.about',$about);
    }

    public function index(){
        $index=[
            'title'=>"Home",
            'content'=>"Contenido principal"
        ];

    return view('home.index',$index);
    }
}
