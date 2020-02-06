<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PainelController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth');
   }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cadastro_vagas');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $titulo = $request->input('title');
        $descricao = $request->input('description');
        $status = $request->input('status');
        $endereco = $request->input('workplace');
        $salario = $request->input('salary');

        if(!empty($titulo) &&
           !empty($descricao) &&
           !empty($status)){
              $query = $this->conexao()->prepare("INSERT INTO vagas (title, `description`, `status`, workplace, salary) VALUES (?, ?, ?, ?, ?)");
              $query->bindParam(1, $titulo);
              $query->bindParam(2, $descricao);
              $query->bindParam(3, $status);
              $query->bindParam(4, $endereco);
              $query->bindParam(5, $salario);
              $returned = $query->execute();
              if($returned){
               $request->session()->flash('alert-success', 'Vaga cadastrada com sucesso !');
               return redirect('adm');
              }else{
               $request->session()->flash('alert-danger', 'Ooops, ocorreu um problema, tente novamente mais tarde !');
               return redirect('adm');
              }
           }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
