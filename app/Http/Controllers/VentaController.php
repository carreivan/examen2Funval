<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::all();
        return response()->json($ventas, 200);
    }

    public function show($id)
    {
        $venta = Venta::findOrFail($id);
        return response()->json($venta, 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cliente' => 'required|string',
            'fecha' => 'required|date',
            'total' => 'required|numeric',
            'observaciones' => 'nullable|string',
            'detalles' => 'required|array',
            'detalles.*.producto_id' => 'required|exists:productos,id',
            'detalles.*.cantidad' => 'required|numeric',
            'detalles.*.precio_unitario' => 'required|numeric',
        ]);

        $venta = Venta::create([
            'cliente' => $data['cliente'],
            'fecha' => $data['fecha'],
            'total' => $data['total'],
            'observaciones' => $data['observaciones'],
        ]);

        foreach ($data['detalles'] as $detalle) {
            DetalleVenta::create([
                'venta_id' => $venta->id,
                'producto_id' => $detalle['producto_id'],
                'cantidad' => $detalle['cantidad'],
                'precio_unitario' => $detalle['precio_unitario'],
            ]);
        }

        return response()->json(['message' => 'Venta registrada con éxito'], 201);
    }

    public function update(Request $request, $id)
    {
        // Implementa lógica para actualizar ventas si es necesario.
    }

    public function destroy($id)
    {
        // Implementa lógica para eliminar ventas si es necesario.
    }
}
