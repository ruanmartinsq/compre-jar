<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $fillable = [
        'user_id',
        'data_pedido',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}