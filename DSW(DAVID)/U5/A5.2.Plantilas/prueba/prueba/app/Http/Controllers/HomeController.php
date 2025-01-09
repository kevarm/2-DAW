<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function about(){
        $title="Acerca de nosotros";
        $subtitle="Subtítulo";
        $description="Contenido";
        $author="Autor";

    return view('home.about',compact('title','subtitle','description','author'));
    }
}
