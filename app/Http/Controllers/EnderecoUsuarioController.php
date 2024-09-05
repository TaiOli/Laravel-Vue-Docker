<?php

namespace App\Http\Controllers;

use App\Models\EnderecoUsuario;
use App\Models\Endereco;
use App\Models\Usuario;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="API de Endereços do Usuário",
 *     version="1.0.0",
 *     description="API para gerenciamento de endereços do usuário"
 * )
 */

 /**
 * @OA\Schema(
 *     schema="EnderecoUsuario",
 *     type="object",
 *     @OA\Property(property="id", type="integer", description="ID do endereço do usuário"),
 *     @OA\Property(property="usuario_id", type="integer", description="ID do usuário"),
 *     @OA\Property(property="endereco_id", type="integer", description="ID do endereço")
 * )
 */


class EnderecoUsuarioController extends Controller
{
    protected $enderecoUsuario;

    // Construtor
    public function __construct(){

        $this->enderecoUsuario = new EnderecoUsuario();
    }

    /**
     * @OA\Get(
     *     path="/api/endereco_usuario",
     *     summary="Lista todos os endereços dos usuários",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de endereços dos usuários",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/EnderecoUsuario"))
     *     )
     * )
     */

    // Retorna a lista
    public function index()
    {
        return $this->enderecoUsuario->all();
    }

    /**
     * @OA\Post(
     *     path="/api/endereco_usuario",
     *     summary="Cria um novo endereço de usuário",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"usuario_id", "endereco_id"},
     *             @OA\Property(property="usuario_id", type="integer", description="ID do usuário"),
     *             @OA\Property(property="endereco_id", type="integer", description="ID do endereço")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Endereço de usuário criado",
     *         @OA\JsonContent(ref="#/components/schemas/EnderecoUsuario")
     *     )
     * )
     */

    // Cria um novo usuário
    public function store(Request $request)
    {
        return $this->enderecoUsuario->create($request->all());
        return response()->json(['id' => $enderecoUsuario->id]);
    }

    /**
     * @OA\Get(
     *     path="/api/endereco_usuario/{id}",
     *     summary="Mostra um endereço de usuário específico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalhes do endereço de usuário",
     *         @OA\JsonContent(ref="#/components/schemas/EnderecoUsuario")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Endereço de usuário não encontrado"
     *     )
     * )
     */

    // Retorna os detalhes do usuário
    public function show(string $id)
    {
        $enderecoUsuario = $this->enderecoUsuario->find($id);  
    }
}