<?php

namespace App\Http\Middleware;

use App\Models\Produto;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class EnsureProdutoOwner
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
        $produtoId = $request->route('id');
        if ($produtoId) {
            $produto = Produto::find($produtoId);
            if (!$produto || $produto->user_id !== $user->id) {
                return response()->json(['message' => 'Acesso negado. Você não é o dono deste produto.'], 403);
            }
        }
        
        return $next($request);
    }
}