<?php

namespace App\Http\Controllers;

use App\Models\Endereco;

use Illuminate\Http\Request;

class EnderecoController extends Controller
{

    protected $endereco;

    // Construtor
    public function __construct()
    {
        $this->endereco = new Endereco();
    }

    // Retorna a lista
    public function index()
    {
        return $this->endereco->all();
    }

    // Cria um novo usuário
    public function store(Request $request)
    {
        return $this->endereco->create($request->all());
        return response()->json(['id' => $endereco->id]);
    }

    // Retorna os detalhes do usuário
    public function show(string $id)
    {
        $endereco = $this->endereco->find($id);  
    }

}