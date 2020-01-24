<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pesquisar;

class PesquisaController extends Controller
{

    public function Buscar(Request $request){
        $pesquisar = new Pesquisar();
        $resultado = $pesquisar->Buscar($request);

        return $resultado;
    }
}
