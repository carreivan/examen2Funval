<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return response()->json($productos, 200);
    }

    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return response()->json($producto, 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
        ]);

        $producto = Producto::create($data);

        return response()->json(['message' => 'Producto creado con éxito'], 201);
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $data = $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
        ]);

        $producto->update($data);

        return response()->json(['message' => 'Producto actualizado con éxito'], 200);
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return response()->json(['message' => 'Producto eliminado con éxito'], 200);
    }
}
