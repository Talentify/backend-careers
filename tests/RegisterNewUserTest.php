<?php

use App\Models\User;
use Illuminate\Http\Response;

class RegisterNewUserTest extends TestCase
{
    /**
     * User display validation errors.
     *
     * @return void
     */
    public function testUserDisplaysValidationErrors()
    {
        $this->post('/user', []);

        $this->assertResponseStatus(Response::HTTP_BAD_REQUEST);
        $this->seeJsonEquals([
            'message' => 'The given data was invalid.',
            'errors' => [
                'name' => ['The name field is required.'],
                'email' => ['The email field is required.'],
                'password' => ['The password field is required.'],
            ]
        ]);
    }

    /**
     * I Can create a new user.
     *
     * @return void
     */
    public function testDisplayErrorWheUserHasSameEmail()
    {
        $user = User::create([
            'name' => 'Leandro',
            'email' => 'leandro@gmail.com',
            'password' => '123456'
        ]);

        $this->post('/user', [
            'name' => 'Leandro',
            'email' => 'leandro@gmail.com',
            'password' => '123456'
        ]);

        $this->assertResponseStatus(Response::HTTP_BAD_REQUEST);
        $this->seeJsonEquals([
            'message' => 'The given data was invalid.',
            'errors' => [
                'email' => ['The email has already been taken.'],
            ]
        ]);
    }

    /**
     * I Can create a new user.
     *
     * @return void
     */
    public function testICanCreateANewUser()
    {
        $data = $this->post('/user', [
            'name' => 'Leandro',
            'email' => 'lenadro@gmail.com',
            'password' => '123456'
        ]);

        $this->assertResponseStatus(Response::HTTP_CREATED);
        $this->seeJsonContains([
            'name' => 'Leandro',
            'email' => 'lenadro@gmail.com'
        ]);
    }
}
