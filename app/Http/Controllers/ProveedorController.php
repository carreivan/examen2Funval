<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::all();
        return response()->json($proveedores, 200);
    }

    public function show($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return response()->json($proveedor, 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string',
            'direccion' => 'nullable|string',
            'telefono' => 'nullable|string',
        ]);

        $proveedor = Proveedor::create($data);

        return response()->json(['message' => 'Proveedor creado con éxito'], 201);
    }

    public function update(Request $request, $id)
    {
        $proveedor = Proveedor::findOrFail($id);

        $data = $request->validate([
            'nombre' => 'required|string',
            'direccion' => 'nullable|string',
            'telefono' => 'nullable|string',
        ]);

        $proveedor->update($data);

        return response()->json(['message' => 'Proveedor actualizado con éxito'], 200);
    }

    public function destroy($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->delete();

        return response()->json(['message' => 'Proveedor eliminado con éxito'], 200);
    }
}
