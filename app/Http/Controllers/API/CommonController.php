<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Cache;

class CommonController extends BaseController
{
    protected $model;
    protected $resource;
    protected $arrayFieldsRequired;
    protected $messagesRequired     = ['required' => 'campo {:attribute} é obrigatório'];
    protected $msgErrorValidate     = "Erro de validação.";
    protected $msgSuccessList       = "Registros recuperados com sucesso.";
    protected $msgSuccessListOne    = "Registro recuperado com sucesso.";
    protected $msgSuccessCreate     = "Registro criado com sucesso.";
    protected $msgSuccessUpdate     = "Registro atualizado com sucesso.";
    protected $msgSuccessDelete     = "Registro removido com sucesso.";
    protected $msgNotFound          = "Registro não encontrado.";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $minutes = Carbon::now()->addMinutes(10);
        $data = Cache::remember("api::{$this->model}", $minutes, function () {
            return $this->resource::collection($this->model::all());
        });
        return $this->sendResponse($data, $this->msgSuccessList);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Cache::forget("api::{$this->model}");
        $input = $request->all();
        $validator = Validator::make($input, $this->arrayFieldsRequired ?? [], $this->messagesRequired);
        if ($validator->fails()) {
            return $this->sendError($this->msgErrorValidate, $validator->errors());
        }
        $model = new $this->resource($this->model::create($input));
        return $this->sendResponse($model, $this->msgSuccessCreate);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = $this->model::find($id);
        if (is_null($model)) {
            return $this->sendError($this->msgNotFound);
        }
        return $this->sendResponse(new $this->resource($model), $this->msgSuccessListOne);
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
        Cache::forget("api::{$this->model}");
        $model = $this->model::find($id);
        if (is_null($model)) {
            return $this->sendError($this->msgNotFound);
        }
        $input = $request->all();
        $validator = Validator::make($input, $this->arrayFieldsRequired ?? [], $this->messagesRequired);
        if ($validator->fails()) {
            return $this->sendError($this->msgErrorValidate, $validator->errors());
        }
        $model->fill($input)->save();
        return $this->sendResponse(new $this->resource($model), $this->msgSuccessUpdate);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cache::forget("api::{$this->model}");
        $model = $this->model::find($id);
        if (is_null($model)) {
            return $this->sendError($this->msgNotFound);
        } elseif ($model->delete()) {
            return $this->sendResponse(new $this->resource($model), $this->msgSuccessDelete);
        }
    }
}
