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

    // Construtor
    public function __construct()
    {
        $this->usuario = new Usuario();
         
    }

    // Retorna a lista
    public function index()
    {
        $usuarios = Usuario::with(['enderecos', 'perfil'])->get();
        return response()->json($usuarios);
    }
 
    // Cria um novo usuário
    public function store(Request $request) {

        return $this->usuario->create($request->all());
        return response()->json(['id' => $perfil->id]);
    }

    // Retorna os detalhes do usuário
    public function show(string $id)
    {
        $usuario = Usuario::with(['enderecos', 'perfil'])->findOrFail($id);
        return response()->json($usuario);
    }

    // Atualiza os dados de um usuário
    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $usuario->nome = $request->input('nome');
        $usuario->email = $request->input('email');
        $usuario->cpf = $request->input('cpf');

        if ($request->has('perfil') && $request->input('perfil.nome')) {
            $perfil = $usuario->perfil; 
            $perfil->nome = $request->input('perfil.nome');
            $perfil->save();
        }

        $usuario->save();

        $enderecos = $request->input('enderecos');
        $enderecoIds = [];
        foreach ($enderecos as $enderecoData) {

            if (isset($enderecoData['id'])) {

                $endereco = Endereco::findOrFail($enderecoData['id']);
                $endereco->update($enderecoData);

            } else {
               
                $endereco = Endereco::create($enderecoData);
            }
            $enderecoIds[] = $endereco->id;
        }

        $usuario->enderecos()->sync($enderecoIds);

        return response()->json($usuario);
    }

    // Exclui um usuario
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);

        $enderecos = $usuario->enderecos()->get();
    
        foreach ($enderecos as $endereco) {
            $endereco->delete();
        }

        $usuario->perfil()->delete();

        $usuario->delete();

        return response()->json(['message' => 'Usuário excluído com sucesso!']);
    }

}