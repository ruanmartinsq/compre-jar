<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Attributes\Table;

#[Fillable(['pedido_id','produto_id','quantidade','preco'])]
#[Table('itens_pedidos')]
class ItemPedido extends Model
{
    use SoftDeletes;

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }

    public function produto()
    {
        return $this->hasOne(Produto::class, 'id', 'produto_id');
    }
}