<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Perfil;
use App\Models\Endereco;
use App\Models\EnderecoUsuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{

    protected $usuario;
    public function __construct(){
        $this->usuario = new Usuario();
         
    }

    public function index()
    {
        $usuarios = Usuario::with(['enderecos', 'perfil'])->get();
        return response()->json($usuarios);
    }
 
    public function store(Request $request) {
        return $this->usuario->create($request->all());
        return response()->json(['id' => $perfil->id]);
    }

    public function show(string $id)
    {
        $usuario = $this->usuario->find($id);  
    }

}
