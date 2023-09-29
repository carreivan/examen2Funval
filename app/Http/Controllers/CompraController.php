<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\DetalleCompra;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function index()
    {
        $compras = Compra::all();
        return response()->json($compras, 200);
    }

    public function show($id)
    {
        $compra = Compra::findOrFail($id);
        return response()->json($compra, 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'fecha' => 'required|date',
            'total' => 'required|numeric',
            'observaciones' => 'nullable|string',
            'detalles' => 'required|array',
            'detalles.*.producto_id' => 'required|exists:productos,id',
            'detalles.*.cantidad' => 'required|numeric',
            'detalles.*.precio_unitario' => 'required|numeric',
        ]);

        $compra = Compra::create([
            'proveedor_id' => $data['proveedor_id'],
            'fecha' => $data['fecha'],
            'total' => $data['total'],
            'observaciones' => $data['observaciones'],
        ]);

        foreach ($data['detalles'] as $detalle) {
            DetalleCompra::create([
                'compra_id' => $compra->id,
                'producto_id' => $detalle['producto_id'],
                'cantidad' => $detalle['cantidad'],
                'precio_unitario' => $detalle['precio_unitario'],
            ]);
        }

        return response()->json(['message' => 'Compra registrada con éxito'], 201);
    }
}
