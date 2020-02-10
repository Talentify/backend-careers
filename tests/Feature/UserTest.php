<?php

namespace Tests\Feature;

use Tests\ApplicationSetup;
use Laravel\Passport\Passport;
use App\Models\User;

class UserTest extends ApplicationSetup
{

    private $defaultUserStructure = [
        "name",
        "lastname",
        "email",
        "role_id",
        "created_at",
        "deleted_at",
        "updated_at",
    ];
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testListUserSuccessWithPagination()
    {
        $user = User::find(1);
        Passport::actingAs($user);

        $response = $this->json('GET', '/users', ['page' => 1, 'paginate' => 10]);

        $response->assertStatus(200);

        $userStructureWithPagination = $this->paginationStructure;
        $userStructureWithPagination['data'] = [
            '*' => $this->defaultUserStructure
        ];

        $response->assertJsonStructure($userStructureWithPagination);
    }

    public function testListUserSuccessWithoutPagination()
    {
        $user = User::find(1);
        Passport::actingAs($user);

        $response = $this->json('GET', '/users');

        $response->assertStatus(200);        

        $response->assertJsonStructure(['*' => $this->defaultUserStructure]);
    }

    public function testListUserSErrorWithoutPermission()
    {        
        $response = $this->json('GET', '/users');

        $response->assertStatus(401);        
    }

    public function testGetOneUserSuccess()
    {

        $data = factory(\App\Models\User::class)->create();

        $user = User::find($data->id);
        Passport::actingAs($user);

        $response = $this->json('GET', '/user/' . $data->id);
        $response->assertStatus(200);
        // $response->assertJsonFragment($data->toArray());
        $response->assertJsonStructure($this->defaultUserStructure);
        $this->assertDatabaseHas('users', $data->toArray());
    }

    public function testGetOneUserErrorWithoutPermission()
    {
        $response = $this->json('GET', '/user/' . rand());
        $response->assertStatus(401);
    }

    public function testCreateUserSuccess()
    {
        $data = factory(\App\Models\User::class)->make();
        $user = $data->toArray();
        $user['password'] = $user['password_confirmation'] = env('DEFAULT_APP_PASSWORD');

        $response = $this->json('POST', '/user', $user);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', $data->toArray());
    }

    public function testCreateUserErrorWithoutName()
    {
        $data = factory(\App\Models\User::class)->make();
        $user = $data->toArray();
        $user['password'] = $user['password_confirmation'] = env('DEFAULT_APP_PASSWORD');

        unset($user['name']);

        $response = $this->json('POST', '/user', $user);

        $response->assertStatus(422);
        $this->assertDatabaseMissing('users', $data->toArray());
    }

    public function testCreateUserErrorWithoutLastname()
    {
        $data = factory(\App\Models\User::class)->make();
        $user = $data->toArray();
        $user['password'] = $user['password_confirmation'] = env('DEFAULT_APP_PASSWORD');

        unset($user['lastname']);

        $response = $this->json('POST', '/user', $user);

        $response->assertStatus(422);
        $this->assertDatabaseMissing('users', $data->toArray());
    }

    public function testCreateUserErrorWithoutEmail()
    {
        $data = factory(\App\Models\User::class)->make();
        $user = $data->toArray();
        $user['password'] = $user['password_confirmation'] = env('DEFAULT_APP_PASSWORD');

        unset($user['email']);

        $response = $this->json('POST', '/user', $user);

        $response->assertStatus(422);
        $this->assertDatabaseMissing('users', $data->toArray());
    }

    public function testCreateUserErrorWithoutPassword()
    {
        $data = factory(\App\Models\User::class)->make();
        $user = $data->toArray();

        unset($user['password']);

        $response = $this->json('POST', '/user', $user);

        $response->assertStatus(422);
        $this->assertDatabaseMissing('users', $data->toArray());
    }

    public function testCreateUserErrorWithoutPasswordConfirmed()
    {
        $data = factory(\App\Models\User::class)->make();
        $user = $data->toArray();
        $user['password'] = env('DEFAULT_APP_PASSWORD');

        unset($user['email']);

        $response = $this->json('POST', '/user', $user);

        $response->assertStatus(422);
        $this->assertDatabaseMissing('users', $data->toArray());
    }

    public function testAdminUpdateUserSuccess()
    {
        $data = factory(\App\Models\User::class)->create();

        $user = User::find(1);
        Passport::actingAs($user);

        $newData = factory(\App\Models\User::class)->make();

        $response = $this->json('PUT', '/user/' . $data->id, $newData->toArray());

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', $newData->toArray());
    }

    public function testUpdateUserSuccess()
    {
        $data = factory(\App\Models\User::class)->create();

        $user = User::find($data->id);
        Passport::actingAs($user);

        $newData = factory(\App\Models\User::class)->make();

        $response = $this->json('PUT', '/user/' . $data->id, $newData->toArray());

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', $newData->toArray());
    }

    public function testUpdateUserErrorWithoutName()
    {
        $data = factory(\App\Models\User::class)->create();

        $user = User::find($data->id);
        Passport::actingAs($user);

        $newData = factory(\App\Models\User::class)->make();

        unset($newData->name);

        $response = $this->json('PUT', '/user/' . $data->id, $newData->toArray());

        $response->assertStatus(422);
    }

    public function testUpdateUserErrorWithoutLastname()
    {
        $data = factory(\App\Models\User::class)->create();

        $user = User::find($data->id);
        Passport::actingAs($user);

        $newData = factory(\App\Models\User::class)->make();

        unset($newData->lastname);

        $response = $this->json('PUT', '/user/' . $data->id, $newData->toArray());

        $response->assertStatus(422);

    }

    public function testUpdateUserErrorWithoutEmail()
    {
        $data = factory(\App\Models\User::class)->create();

        $user = User::find($data->id);
        Passport::actingAs($user);

        $newData = factory(\App\Models\User::class)->make();

        unset($newData->email);

        $response = $this->json('PUT', '/user/' . $data->id, $newData->toArray());

        $response->assertStatus(422);
    }

    public function testUpdateUserErrorWithoutPasswordConfirmed()
    {
        $data = factory(\App\Models\User::class)->create();

        $user = User::find($data->id);
        Passport::actingAs($user);

        $newData = factory(\App\Models\User::class)->make();

        $newData->password = env('DEFAULT_APP_PASSWORD');

        unset($newData->email);

        $response = $this->json('PUT', '/user/' . $data->id, $newData->toArray());

        $response->assertStatus(422);
    }

    public function testUpdateUserErrorUserWithoutPermission()
    {
        $data = factory(\App\Models\User::class)->create();

        $userLogin = factory(\App\Models\User::class)->create();

        $user = User::find($userLogin->id);
        Passport::actingAs($user);

        $newData = factory(\App\Models\User::class)->make();

        $response = $this->json('PUT', '/user/' . $data->id, $newData->toArray());

        $response->assertForbidden();
    }

    public function testDeleteUserSuccess()
    {
        $data = factory(\App\Models\User::class)->create();

        $user = User::find(1);
        Passport::actingAs($user);

        $response = $this->json('DELETE', '/user/' . $data->id);

        $response->assertStatus(200);
    }

    public function testDeleteUserErrorUserWithoutPermission()
    {
        $data = factory(\App\Models\User::class)->create();

        $user = User::find($data->id);
        Passport::actingAs($user);

        $response = $this->json('DELETE', '/user/' . $data->id);

        $response->assertForbidden();
    }
}
