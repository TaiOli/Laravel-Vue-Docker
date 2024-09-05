<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Usuario;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="API de Perfis",
 *     version="1.0.0",
 *     description="API para gerenciamento de Perfis"
 * )
 */

 /**
 * @OA\Schema(
 *     schema="Perfil",
 *     type="object",
 *     @OA\Property(property="id", type="integer", description="ID do perfil"),
 *     @OA\Property(property="nome", type="string", description="Nome do perfil")
 * )
 */


class PerfilController extends Controller
{

    protected $perfil;

    // Construtor
    public function __construct()
    {
        $this->perfil = new Perfil();
    }

    /**
     * @OA\Get(
     *     path="/api/perfil",
     *     summary="Lista todos os perfis",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de perfis",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Perfil"))
     *     )
     * )
     */

    // Retorna a lista
    public function index()
    {
        return $this->perfil->all();
    }

    /**
     * @OA\Post(
     *     path="/api/perfil",
     *     summary="Cria um novo perfil",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nome"},
     *             @OA\Property(property="nome", type="string", description="Nome do perfil")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Perfil criado",
     *         @OA\JsonContent(ref="#/components/schemas/Perfil")
     *     )
     * )
     */

    // Cria um novo usuário
    public function store(Request $request)
    {
        return $this->perfil->create($request->all());
    }

     /**
     * @OA\Put(
     *     path="/api/perfil/{id}",
     *     summary="Atualiza os dados de um perfil",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nome", type="string", description="Nome do perfil")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Perfil atualizado",
     *         @OA\JsonContent(ref="#/components/schemas/Perfil")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Perfil não encontrado"
     *     )
     * )
     */

    // Atualiza os dados de um usuário
    public function update(Request $request, string $id)
    {
        $perfil = Perfil::findOrFail($id);

        $perfil->nome = $request->input('nome');
        $perfil->save();

        return response()->json($perfil);
    }
}