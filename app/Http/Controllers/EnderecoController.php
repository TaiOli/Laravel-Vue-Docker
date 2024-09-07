<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="API de Endereços",
 *     version="1.0.0",
 *     description="API para gerenciamento de endereços"
 * )
 */

 /**
 * @OA\Schema(
 *     schema="Endereco",
 *     type="object",
 *     required={"logradouro", "numero", "bairro", "cidade", "estado", "cep"},
 *     @OA\Property(property="id", type="integer", description="ID do endereço"),
 *     @OA\Property(property="logradouro", type="string", description="Logradouro do endereço"),
 *     @OA\Property(property="numero", type="string", description="Número do endereço"),
 *     @OA\Property(property="bairro", type="string", description="Bairro do endereço"),
 *     @OA\Property(property="cidade", type="string", description="Cidade do endereço"),
 *     @OA\Property(property="estado", type="string", description="Estado do endereço"),
 *     @OA\Property(property="cep", type="string", description="CEP do endereço")
 * )
 */

class EnderecoController extends Controller
{

    protected $endereco;

    // Construtor
    public function __construct()
    {
        $this->endereco = new Endereco();
    }

     /**
     * @OA\Get(
     *     path="/api/endereco",
     *     summary="Lista todos os endereços",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de endereços",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Endereco"))
     *     )
     * )
     */

    // Retorna a lista
    public function index()
    {
        return $this->endereco->all();
    }

     /**
     * @OA\Post(
     *     path="/api/endereco",
     *     summary="Cria um novo endereço",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"logradouro", "numero", "bairro", "cidade", "estado", "cep"},
     *             @OA\Property(property="logradouro", type="string"),
     *             @OA\Property(property="numero", type="string"),
     *             @OA\Property(property="bairro", type="string"),
     *             @OA\Property(property="cidade", type="string"),
     *             @OA\Property(property="estado", type="string"),
     *             @OA\Property(property="cep", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Endereço criado",
     *         @OA\JsonContent(ref="#/components/schemas/Endereco")
     *     )
     * )
     */

    // Cria um novo usuário
    public function store(Request $request)
    {
        return $this->endereco->create($request->all());
        return response()->json(['id' => $endereco->id]);
    }

   /**
     * @OA\Get(
     *     path="/api/endereco/{id}",
     *     summary="Mostra um endereço específico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalhes do endereço",
     *         @OA\JsonContent(ref="#/components/schemas/Endereco")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Endereço não encontrado"
     *     )
     * )
     */
    
    // Retorna os detalhes do usuário
    public function show(string $id)
    {
        $endereco = $this->endereco->find($id);  
    }

}