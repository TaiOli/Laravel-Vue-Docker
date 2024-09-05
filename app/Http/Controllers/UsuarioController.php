<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Perfil;
use App\Models\Endereco;
use App\Models\EnderecoUsuario;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="Minha API de Usuários",
 *     description="Descrição da API de Usuários",
 *     version="1.0.0"
 * )
 */

/**
 * @OA\Schema(
 *     schema="Usuario",
 *     type="object",
 *     @OA\Property(property="id", type="integer", description="ID do usuário"),
 *     @OA\Property(property="nome", type="string", description="Nome do usuário"),
 *     @OA\Property(property="email", type="string", format="email", description="Email do usuário"),
 * )
 */

class UsuarioController extends Controller
{

    protected $usuario;

    // Construtor
    public function __construct()
    {
        $this->usuario = new Usuario();
         
    }

    /**
     * @OA\Get(
     *     path="/api/usuario",
     *     summary="Lista todos os usuários",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de usuários",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Usuario"))
     *     )
     * )
     */

    // Retorna a lista
    public function index()
    {
        $usuarios = Usuario::with(['enderecos', 'perfil'])->get();
        return response()->json($usuarios);
    }

    /**
     * @OA\Post(
     *     path="/api/usuario",
     *     summary="Cria um novo usuário",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nome", "email"},
     *             @OA\Property(property="nome", type="string"),
     *             @OA\Property(property="email", type="string", format="email")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Usuário criado",
     *         @OA\JsonContent(ref="#/components/schemas/Usuario")
     *     )
     * )
     */
    
    // Cria um novo usuário
    public function store(Request $request) {

        return $this->usuario->create($request->all());
        return response()->json(['id' => $perfil->id]);
    }

     /**
     * @OA\Get(
     *     path="/api/usuario/{id}",
     *     summary="Mostra um usuário específico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalhes do usuário",
     *         @OA\JsonContent(ref="#/components/schemas/Usuario")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Usuário não encontrado"
     *     )
     * )
     */

    // Retorna os detalhes do usuário
    public function show(string $id)
    {
        $usuario = Usuario::with(['enderecos', 'perfil'])->findOrFail($id);
        return response()->json($usuario);
    }

    /**
     * @OA\Put(
     *     path="/api/usuario/{id}",
     *     summary="Atualiza um usuário existente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nome", type="string"),
     *             @OA\Property(property="email", type="string", format="email")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Usuário atualizado",
     *         @OA\JsonContent(ref="#/components/schemas/Usuario")
     *     )
     * )
     */

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

    /**
     * @OA\Delete(
     *     path="/api/usuario/{id}",
     *     summary="Deleta um usuário",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Usuário deletado com sucesso"
     *     )
     * )
     */

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