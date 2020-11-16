<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobsController extends Controller
{
    public function index(Request $request)
    {
        /**
         * @todo implementar cacheamento
         */
        return Job::paginate($request->per_page);
    }

    public function show(int $id)
    {
        $data = Job::find($id);
        if (is_null($data)) {
            return response()->json('', 204);
        }
        
        return response()->json($data);
    }
    
    public function store(Request $request)
    {   
        $Validator = Validator::make($request->all(), [
            'title'         => 'required|max:255',
            'description'   => 'required|max:10000'
        ]);

        if($Validator->fails()) {
            return response()->json(['error' => $Validator->errors()], 422);
        }

        return response()
            ->json(
                Job::create($request->all()),
                201
            );
    }

    public function update(int $id, Request $request)
    {
        $Validator = Validator::make($request->all(), [
            'title'         => 'required|max:255',
            'description'   => 'required|max:10000'
        ]);

        if($Validator->fails()) {
            return response()->json(['error' => $Validator->errors()], 422);
        }
        
        $data = Job::find($id);
        if (is_null($data)) {
            return response()->json([
                'erro' => 'Not found'
            ], 404);
        }

        $data->fill($request->all());
        $data->save();

        return $data;
    }

    public function destroy(int $id)
    {
        $qtddatasRemovidos = Job::destroy($id);
        if ($qtddatasRemovidos === 0) {
            return response()->json([
                'erro' => 'Not found'
            ], 404);
        }

        return response()->json('', 204);
    }
}
