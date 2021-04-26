<?php
/**
 * Created by PhpStorm.
 * UserController: Juliano Basso
 * Date: 07/12/2020
 * Time: 15:32
 */

namespace App\Http\Services;


use App\Model\User;
use Illuminate\Database\Eloquent\Model;
use Lindelius\JWT\Exception\JwtException;
use Lindelius\JWT\JWT;
use Lindelius\JWT\Algorithm\HMAC\HS256;

class JwtService extends JWT
{
    use HS256;

    public static function validateToken(string $token): bool
    {
        $decodedToken = self::decode($token);

        if (!$decodedToken->verify(env('JWT_KEY'))) {
            throw new JwtException('Invalid Token');
        }

        return true;
    }

    public static function decodeToken(string $token)
    {
        $decodedToken = self::decode($token);
        return $decodedToken->getClaim('data');
    }

    public static function generateToken(Model $data) : string
    {
        $jwt = self::create('HS256');

        $jwt->data = $data;
        $jwt->exp = time() + (100000);

        return $jwt->encode(env('JWT_KEY'));
    }

}
