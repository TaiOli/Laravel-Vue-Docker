<?php

namespace App\Http\Controllers;

use App\Models\EnderecoUsuario;
use App\Models\Endereco;
use App\Models\Usuario;

use Illuminate\Http\Request;

class EnderecoUsuarioController extends Controller
{
    protected $enderecoUsuario;
    public function __construct(){
        $this->enderecoUsuario = new EnderecoUsuario();
        
    }

    public function index()
    {
        return $this->enderecoUsuario->all();
    }

    public function store(Request $request)
    {
        return $this->enderecoUsuario->create($request->all());
        return response()->json(['id' => $enderecoUsuario->id]);
    }

    public function show(string $id)
    {
        $enderecoUsuario = $this->enderecoUsuario->find($id);  
    }
}
