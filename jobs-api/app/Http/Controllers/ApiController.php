<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

abstract class ApiController
{
    protected $classe;

    protected $validation;

    public function index(Request $request)
    {
        return $this->classe::paginate($request->per_page);
    }

    public function show(int $id)
    {
        $data = $this->classe::find($id);
        if (is_null($data)) {
            return response()->json('', 204);
        }
        
        return response()->json($data);
    }
    
    public function store(Request $request)
    {
        $errorValidate = $this->checkErrorValidate($request);
        
        if($errorValidate) {
            return $errorValidate;
        }

        return response()
            ->json(
                $this->classe::create($request->all()),
                201
            );
    }

    public function update(int $id, Request $request)
    {
        $errorValidate = $this->checkErrorValidate($request);
        
        if($errorValidate) {
            return $errorValidate;
        }
        
        $data = $this->classe::find($id);
        if (is_null($data)) {
            return response()->json([
                'erro' => 'Not found'
            ], 404);
        }

        $request->password = Hash::make($request->password);

        $data->fill($request->all());
        $data->save();

        return $data;
    }

    public function destroy(int $id)
    {
        $qtddatasRemovidos = $this->classe::destroy($id);
        if ($qtddatasRemovidos === 0) {
            return response()->json([
                'erro' => 'Not found'
            ], 404);
        }

        return response()->json('', 204);
    }

    protected function checkErrorValidate(Request $request) {
        if(is_array($this->validation)) {
            $Validator = Validator::make($request->all(), $this->validation);

            if($Validator->fails()) {
                return response()->json(['error' => $Validator->errors()], 422);
            }
        }
    }
}
