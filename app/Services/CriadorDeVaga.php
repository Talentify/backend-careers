<?php

namespace App\Services;

use App\Models\Vaga;
use Illuminate\Support\Facades\DB;

Class CriadorDeVaga{

    public function criarVaga( string $nomeVaga, string $descricao, string $situacao, float $salario ): Vaga {
        $vaga = new Vaga();
        DB::transaction( function () use(
            &$vaga,
            $nomeVaga,
            $descricao,
            $situacao,
            $salario ){
            $vaga = Vaga::create([
                'titulo' => $nomeVaga,
                'descricao' => $descricao,
                'situacao' => $situacao,
                'salario'  => $salario
            ]);
        });
        return $vaga;
    }

}