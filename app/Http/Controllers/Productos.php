<?php

namespace App\Http\Controllers;
use App\Producto;

use Illuminate\Http\Request;

class Productos extends Controller
{
    public function index()
    {
        return Producto::all();
    }

    public function delete($id)
    {
        $response = Producto::destroy($id);
        if($response == 0) { return 'failed'; }
        else {return $id;}
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'descripcion' => 'required|string',
            'fecha' => 'required|string',
            'visible' => 'required|integer',
            'filtro' => 'required|string',
        ]);
        
        $fin = Producto::create($data);
        return $fin;
    }
}
