<?php
namespace Tests;

use Mockery;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApplicationSetup extends TestCase
{
    use RefreshDatabase;

    public $paginationStructure = [
        'current_page',
        'data',
        'first_page_url',
        'from',
        'last_page',
        'last_page_url',
        'next_page_url',
        'path',
        'per_page',
        'prev_page_url',
        'to',
        'total',        
    ];

    /**
     * @inheritdoc
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
        $this->artisan('passport:install');
    }

    protected function generateUser()
    {
        $data = factory(\App\Models\User::class)->create();
        return $data;
    }

    protected function logUserFull($userName)
    {
        $postData = [
            "grant_type" => "password",
            "client_id" => env('TESTING_PASSPORT_ID'),
            "client_secret" => env('TESTING_PASSPORT_SECRET'),
            "username" => $userName,
            "password" => env('DEFAULT_APP_PASSWORD'),
            "scope" => ''
        ];

        $response = $this->json('POST', '/token', $postData);

        $authUser = $response->json();

        return $authUser;
    }

    protected function logUser($userName)
    {
        $authUser = $this->logUserFull($userName);
        return $authUser['access_token'];
    }

    protected function logout()
    {
        Auth::logout();
        Session::flush();
    }

    /**
     * @after
     */
    public function cleanTransaction()
    {
        Mockery::close();
        // DB::rollBack();
        // DB::disconnect();
    }

    
}