<?php

namespace App\Http\Controllers;

use App\Models\EnderecoUsuario;
use App\Models\Endereco;
use App\Models\Usuario;

use Illuminate\Http\Request;

class EnderecoUsuarioController extends Controller
{
    protected $enderecoUsuario;

    // Construtor
    public function __construct(){

        $this->enderecoUsuario = new EnderecoUsuario();
    }

    // Retorna a lista
    public function index()
    {
        return $this->enderecoUsuario->all();
    }

    // Cria um novo usuário
    public function store(Request $request)
    {
        return $this->enderecoUsuario->create($request->all());
        return response()->json(['id' => $enderecoUsuario->id]);
    }

    // Retorna os detalhes do usuário
    public function show(string $id)
    {
        $enderecoUsuario = $this->enderecoUsuario->find($id);  
    }
}