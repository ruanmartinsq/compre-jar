<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pedidos = Pedido::with('user')->get();

        return response()->json($pedidos, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'data_pedido' => 'required|date',
            'status' => 'required|string|max:255',
        ]);

        $pedido = Pedido::create($request->all());

        return response()->json($pedido, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pedido = Pedido::with('user')->find($id);

        if (!$pedido) {
            return response()->json([
                'message' => 'Pedido not found'
            ], 404);
        }

        return response()->json($pedido, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pedido = Pedido::find($id);

        if (!$pedido) {
            return response()->json([
                'message' => 'Pedido not found'
            ], 404);
        }

        $request->validate([
            'user_id' => 'exists:users,id',
            'data_pedido' => 'date',
            'status' => 'string|max:255',
        ]);

        $pedido->update($request->all());

        return response()->json($pedido, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pedido = Pedido::find($id);

        if (!$pedido) {
            return response()->json([
                'message' => 'Pedido not found'
            ], 404);
        }

        $pedido->delete();

        return response()->json([
            'message' => 'Pedido deleted successfully'
        ], 200);
    }
}