<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pedido;

class EnsurePedidoOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        $pedidoId = $request->route('id');
        if ($pedidoId) {
            $pedido = Pedido::find($pedidoId);
            if (!$pedido || $pedido->user_id !== $user->id) {
                return response()->json(['message' => 'Acesso negado. Você não é o dono deste pedido.'], 403);
            }
        }
        return $next($request);
    }
}