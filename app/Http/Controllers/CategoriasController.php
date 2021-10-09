<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function add(Request $request){
        $array = ['error' => ''];
        // if($request->input('event')){
        //     Produtos::create($request->input('event'));
        // }
        return $array;
    }

    public function edit(Request $request){
        $array = ['error' => ''];
        
        return $array;
    }
}
