<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $table = 'enderecos';

    protected $fillable = ['rua', 'cidade', 'estado', 'cep'];

   public function usuarios()
   {
      return $this->belongsToMany(Usuario::class, 'endereco_usuario', 'endereco_id', 'usuario_id');
   }
}