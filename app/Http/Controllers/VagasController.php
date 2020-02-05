<?php

namespace App\Http\Controllers;

use App\Models\Vaga;
use Illuminate\Http\Request;
use App\Http\Requests\VagasFormRequest;
use App\Services\{CriadorDeVaga, RemovedorDeVaga};

class VagasController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $vagas = Vaga::query()
        ->orderby('titulo')
        ->get();
        $mensagem = $request->session()->get('mensagem');
        //dd($vaga);
        return view('vagas.index', compact('vagas', 'mensagem'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vagas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VagasFormRequest $request, CriadorDeVaga $criadorVaga)
    {
        //dd($request);
        $titulo = $request->titulo;
        $descricao = $request->descricao;
        $situacao = $request->situacao;
        $salario = $request->salario;

        $vaga = $criadorVaga->criarVaga(
            $titulo,
            $descricao,
            $situacao,
            $salario
        );

        $request->session()->flash('mensagem', "Vaga ( {$vaga->nome} ), adicionada com sucesso");
        return redirect()->route('vagas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vagas = Vaga::find( $id );
        return view('vagas.show', compact('vagas') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $novoNome = $request->titulo ?? 'PHP'; // As funções colocadas passando os request parecem não funcionar
        $vaga = Vaga::find( $id );
        $vaga->titulo = $novoNome;
        $vaga->save();
        return redirect()->route('vagas.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $novoNome = $request->titulo;
        dd($novoNome);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id, RemovedorDeVaga $removerVaga)
    {

        $nomeVaga = $removerVaga->removerVaga($id);
        $request->session()->flash('mensagem', "Vaga $nomeVaga removida com sucesso");
        return redirect()->route('vagas.index');
    }
}
