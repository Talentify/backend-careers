<?php

namespace App\Http\Controllers;

use PDO;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('login');
    }


    public function validarUsuario($usuario, $senha){
      $query = $this->conexao()->prepare("SELECT id FROM users WHERE email = ? AND password = ?");
      $query->bindParam(1, $usuario);
      $query->bindParam(2, $senha);
      $query->execute();
      $data = $query->fetchObject();
      return ($query->rowCount() > 0) ? $this->montaSessao($data->id) : false;
    }

    public function montaSessao($id){
       (!isset($_SESSION)) && session_start();
       Auth::loginUsingId($id, true);
       return true;
    }

    public function logar(Request $request){
       $usuario = $request->input('usuario');
       $senha = $request->input('senha');

       if(!empty($usuario) && !empty($senha)){
         if($this->validarUsuario($usuario, $senha)){
            return redirect('adm');
         }else{
            $request->session()->flash('alert-danger', 'Usuário Inválido !');
            return redirect('login');
         }
       }

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
        //
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

    public function logout(){
      Auth::logout();
      return Redirect::route('lista.vagas');
    }
}
