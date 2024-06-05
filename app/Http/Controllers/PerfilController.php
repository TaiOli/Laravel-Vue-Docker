<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    protected $perfil;
    public function __construct(){
        $this->perfil = new Perfil();
        
    }

    public function index()
    {
        return $this->perfil->all();
    }

    public function store(Request $request)
    {
        return $this->perfil->create($request->all());
    }
}
