<?php

use App\Models\User;
use Illuminate\Http\Response;

class AuthenticationTest extends TestCase
{

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->post('/user', [
            'name' => 'Leandro',
            'email' => 'leandro@gmail.com',
            'password' => '123456',
        ]);

        $this->user = User::where('email', 'leandro@gmail.com')->first();
    }

    /**
     * User is able login
     *
     * @return void
     */
    public function testUserIsAbleLogin()
    {
        $token = $this->post('/login', [
            'email' => $this->user->email,
            'password' => '123456'
        ]);

        $this->user = User::where('email', 'leandro@gmail.com')->first();

        $this->assertResponseOk();
        $this->seeJsonContains(['token' => $this->user->token]);
    }

    /**
     * User password not match
     *
     * @return void
     */
    public function testUserPasswordNotMatch()
    {
        $token = $this->post('/login', [
            'email' => $this->user->email,
            'password' => '1234567'
        ]);

        $this->assertResponseStatus(Response::HTTP_BAD_REQUEST);
        $this->seeJsonContains([
            "message" => "Invalid Credentials",
        ]);
    }

    /**
     * User password is wrong
     *
     * @return void
     */
    public function testUserInvalidPasswordIsWrong()
    {

        $this->user->password = '123123';
        $this->user->save();

        $this->post('/login', [
            'email' => $this->user->email,
            'password' => '1234567'
        ]);

        $this->assertResponseStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
        $this->seeJsonContains([
            "message" => "Was not able to generate token",
        ]);
    }
}
