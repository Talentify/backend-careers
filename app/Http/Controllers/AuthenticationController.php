<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;

class AuthenticationController extends Controller
{
    /**
     * Login user.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $user = User::where('email', $request->get('email'))->first();

        try {
            $decryptedUserPassword = Crypt::decrypt($user->password);
            if ($decryptedUserPassword !== $request->get('password')) {
                return $this->createApiResponseError('Invalid Credentials', Response::HTTP_BAD_REQUEST);
            }
        } catch (\Exception $e) {
            return $this->createApiResponseError('Was not able to generate token', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $user->token = sha1($user->id.time());
        $user->save();

        return $this->createApiResponse(['token' => $user->token]);
    }
}
