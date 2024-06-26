<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $fillable = ['nome', 'email', 'cpf', 'perfil_id'];

    public function perfil()
    {
        return $this->belongsTo(Perfil::class);
    }

    public function enderecos()
    {
        return $this->belongsToMany(Endereco::class, 'endereco_usuario', 'usuario_id', 'endereco_id');
    }
}