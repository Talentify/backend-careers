<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Vaga;

Class RemovedorDeVaga {

    public function removerVaga( int $vagaId): string {
        $nomeVaga = '';
        DB::transaction( function () use ( $vagaId, &$nomeVaga ){
            $vaga = Vaga::find($vagaId);
            $vaga->delete();
        });
        return $nomeVaga;
    }
}