<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function read(){
        $record=Product::all();
        return response()->json($record->toArray(),200);
    }

    public function create(Request $request){
        $record=Product::create([
            'descripcion' => $request->get('descripcion'),
            'nombre' => $request->get('nombre'),
            'precio' => $request->get('precio'),
            'costo' => $request->get('costo'),
            'category_id' => $request->get('category_id'),
        ]);
        return response()->json($record->toArray());
    }

    public function update(Request $request,$id){
        $record=Product::find($id);
        $record->update([
            'descripcion'=> $request->get('descripcion'),
            'nombre' => $request->get('nombre'),
            'precio' => $request->get('precio'),
            'costo' => $request->get('costo'),
            'category_id' => $request->get('category_id')
        ]);
        return response()->json($record->toArray());
    }

    public function destroy($id){
        $record = Product::find($id);
        $record->delete();
        return response('Eliminado Correctamente',200);
    }

}
