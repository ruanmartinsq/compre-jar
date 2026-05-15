<?php

namespace App\Http\Controllers;

use App\Models\ItemPedido;
use Illuminate\Http\Request;

class ItemPedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $itensPedido = ItemPedido::with(['usuario', 'produto'])->get();

        return response()->json($itensPedido, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
            'preco' => 'required|numeric|min:0',
        ]);

        $itemPedido = ItemPedido::create($request->all());

        return response()->json($itemPedido, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $itemPedido = ItemPedido::with(['usuario', 'produto'])->find($id);

        if (!$itemPedido) {
            return response()->json([
                'message' => 'ItemPedido not found'
            ], 404);
        }

        return response()->json($itemPedido, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $itemPedido = ItemPedido::find($id);

        if (!$itemPedido) {
            return response()->json([
                'message' => 'ItemPedido not found'
            ], 404);
        }

        $request->validate([
            'usuario_id' => 'exists:users,id',
            'produto_id' => 'exists:produtos,id',
            'quantidade' => 'integer|min:1',
            'preco' => 'numeric|min:0',
        ]);

        $itemPedido->update($request->all());

        return response()->json($itemPedido, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $itemPedido = ItemPedido::find($id);

        if (!$itemPedido) {
            return response()->json([
                'message' => 'ItemPedido not found'
            ], 404);
        }

        $itemPedido->delete();

        return response()->json([
            'message' => 'ItemPedido deleted successfully'
        ], 200);
    }
}