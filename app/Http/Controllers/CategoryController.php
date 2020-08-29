<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function read(){
        $record = Category::all();
        return response()->json($record->toArray(),200);
    }

    public function create(Request $request){
        $record = Category::create([
            'nombre' => $request->get('nombre'),
            'descripcion' => $request->get('descripcion')
        ]);
        return response()->json($record->toArray());
    }

    public function update(Request $request,$id){
        $record = Category::find($id);
        $record->update([
            'nombre' => $request->get('nombre'),
            'descripcion' => $request->get('descripcion'),
        ]);
        return response()->json($record->toArray());
    }

    public function destroy($id){
        $record = Category::find($id);
        $record->delete();
        return response([],204);
    }
}
