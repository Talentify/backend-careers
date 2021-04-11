<?php

namespace App\Http\Controllers\Api\Register;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterRecruiterController extends Controller
{
    public function register(Request $request)
    {
       try{

            $rules = [
                "name" => "required|min:5|max:80",
                'email' => "required|email",
                'username' => "required|min:3|max:50|unique:users,username",
                'password' => "required|min:6|max:20",
                // 'company' => "required|exists:companies,id"
                'company' => "required|",
                'company.name' => "required|min:5|max: 100"
            ];

            $input     = $request->only('name', 'email','password', 'username', 'company');
            $validator = Validator::make($input, $rules);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'error' => $validator->messages()]);
            }


            if( !Company::where('name', $request->company['name'])->exists()){
                $companyDb = Company::create([
                    "name" => $request->company['name']
                ]);
            }else{
                $companyDb = Company::where('name', $request->company['name'])->first();
            }


            $userDb = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'company_id' => $companyDb->id
            ]);

            // grab credentials from the request
            $credentials = $request->only('username', 'password');

            try {
                // attempt to verify the credentials and create a token for the user
                if (! $token = JWTAuth::attempt($credentials)) {
                    return response()->json(['error' => 'invalid_credentials'], 401);
                }
            } catch (JWTException $e) {
                // something went wrong whilst attempting to encode the token
                return response()->json(['error' => 'could_not_create_token'], 500);
            }

            //Get user authenticated
            $user = auth()->user();

            // all good so return the token
            return response()->json(compact('token', 'user'),201);
        }
        catch(Exception $e)
        {

            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
