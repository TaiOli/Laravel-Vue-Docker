<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EnderecoUsuario extends Pivot
{
    protected $table = 'endereco_usuario';

    protected $fillable = ['usuario_id', 'endereco_id'];
}