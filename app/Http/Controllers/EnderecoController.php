<?php

namespace App\Http\Controllers;

use App\Models\Endereco;

use Illuminate\Http\Request;

class EnderecoController extends Controller
{

protected $endereco;
    public function __construct(){
        $this->endereco = new Endereco();
        
    }

    public function index()
    {
        return $this->endereco->all();
    }

    public function store(Request $request)
    {
        return $this->endereco->create($request->all());
        return response()->json(['id' => $endereco->id]);
    }

    public function show(string $id)
    {
        $endereco = $this->endereco->find($id);  
    }

}