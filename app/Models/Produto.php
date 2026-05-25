<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['ean', 'user_id', 'nome','descricao','preco','quantidade','categoria'])]
class Produto extends Model
{
    use SoftDeletes;
}