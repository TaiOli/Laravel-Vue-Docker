<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Usuario;
use Illuminate\Http\Request;

class PerfilController extends Controller
{

    protected $perfil;

    // Construtor
    public function __construct()
    {
        $this->perfil = new Perfil();
    }

    // Retorna a lista
    public function index()
    {
        return $this->perfil->all();
    }

    // Cria um novo usuário
    public function store(Request $request)
    {
        return $this->perfil->create($request->all());
    }

    // Atualiza os dados de um usuário
    public function update(Request $request, string $id)
    {
        $perfil = Perfil::findOrFail($id);

        $perfil->nome = $request->input('nome');
        $perfil->save();

        return response()->json($perfil);
    }
}