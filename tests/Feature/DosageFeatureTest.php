<?php

namespace Tests\Feature;

use App\Models\Culture;
use App\Models\Prague;
use App\Models\Product;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Dosage;
use Tymon\JWTAuth\Facades\JWTAuth;

class DosageFeatureTest extends TestCase
{
    use RefreshDatabase;

    private $token;

    protected function setUp(): void
    {
        parent::setUp();

        // configure the jwt and refresh expires to only 1 minute because it's a test.
        config(['jwt.ttl' => 1, 'refresh_ttl' => 1]);

        // create a user
        $user = factory(User::class)->create();

        // generate a JWT Token from user inserted in DB and save in $token property
        $this->token = JWTAuth::fromUser($user);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_can_list_dosages()
    {
        // create 10 dosages
        factory(Dosage::class, 10)->create();

        $response = $this->get('/api/dosages', ['Authorization' => 'Bearer ' . $this->token]);

        $response
            ->assertOk()
            ->assertJsonCount(10)
            ->assertJsonStructure([
                '*' => [
                    'id', 'dosage', 'product_id', 'culture_id', 'prague_id', 'product', 'culture', 'prague',
                        'created_at', 'updated_at'
                ]
            ]);
    }

    public function test_it_can_show_a_dosage()
    {
        $dosage = factory(Dosage::class)->create();

        $response = $this->get('/api/dosages/' . $dosage->id, ['Authorization' => 'Bearer ' . $this->token]);

        $response
            ->assertOk()
            ->assertJsonStructure([
                'id', 'dosage', 'product_id', 'culture_id', 'prague_id', 'product', 'culture', 'prague',
                    'created_at', 'updated_at'
            ]);
    }

    public function test_it_cant_show_a_dosage_with_nonexistent_id()
    {
        factory(Dosage::class)->create();

        $response = $this->get('/api/dosages/9999999', ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertNotFound();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_can_create_a_dosage()
    {
        // $dosage = factory(Dosage::class)->make();

        $response = $this->post('/api/dosages', [
            'dosage' => '236mL de Soda Caústica',
            'product_id' => factory(Product::class)->create()->id,
            'culture_id' => factory(Culture::class)->create()->id,
            'prague_id' => factory(Prague::class)->create()->id
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response
            ->assertCreated()
            ->assertJson([
                'dosage' => '236mL de Soda Caústica'
            ])
            ->assertJsonStructure([
                'id', 'dosage', 'product_id', 'culture_id', 'prague_id', 'created_at', 'updated_at'
            ]);

        $this->assertDatabaseCount('dosages', 1);

        $this->assertDatabaseHas('dosages', [
            'dosage' => '236mL de Soda Caústica'
        ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_create_a_dosage_name_that_already_exists()
    {
        // create a dosage in database
        $dosage = factory(Dosage::class)->create();

        $response = $this->post('/api/dosages', [
            'dosage' => $dosage->name,
            'product_id' => factory(Product::class)->create()->id,
            'culture_id' => factory(Culture::class)->create()->id,
            'prague_id' => factory(Prague::class)->create()->id
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        // make sure there are 1 only
        $this->assertDatabaseCount('dosages', 1);
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_create_a_dosage_without_required_dosage_product_culture_prague()
    {
        $response = $this->post('/api/dosages', [], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        $response = $this->post('/api/dosages', [
            'dosage'
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        $response = $this->post('/api/dosages', [
            'dosage',
            'product_id'
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        $response = $this->post('/api/dosages', [
            'dosage',
            'product_id',
            'culture_id'
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        $response = $this->post('/api/dosages', [
            'dosage',
            'product_id',
            'culture_id',
            'prague_id',
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        // make sure there are no dosage
        $this->assertDatabaseCount('dosages', 0);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_can_update_a_dosage()
    {
        $dosage = factory(Dosage::class)->create();

        $response = $this->put('/api/dosages/' . $dosage->id, [
            'dosage' => '1L de Água com gás',
            'product_id' => factory(Product::class)->create()->id,
            'culture_id' => factory(Culture::class)->create()->id,
            'prague_id' => factory(Prague::class)->create()->id
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response
            ->assertOk()
            ->assertJson([
                'dosage' => '1L de Água com gás'
            ])
            ->assertJsonStructure([
                'id', 'dosage', 'product_id', 'culture_id', 'prague_id',  'created_at', 'updated_at'
            ]);

        $this->assertDatabaseCount('dosages', 1);

        $this->assertDatabaseHas('dosages', [
            'dosage' => '1L de Água com gás'
        ]);

    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_update_to_a_dosage_name_that_already_exists()
    {
        // create a dosage in database
        $dosage1 = factory(Dosage::class)->create();
        $dosage2 = factory(Dosage::class)->create();

        $response = $this->put('/api/dosages/' . $dosage1->id, [
            'dosage' => $dosage2->dosage,
            'product_id' => factory(Product::class)->create()->id,
            'culture_id' => factory(Culture::class)->create()->id,
            'prague_id' => factory(Prague::class)->create()->id
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        $this->assertDatabaseCount('dosages', 2);

        $this->assertDatabaseHas('dosages', [
            'dosage' => $dosage1->dosage
        ]);

        $this->assertDatabaseHas('dosages', [
            'dosage' => $dosage2->dosage
        ]);
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_update_a_dosage_with_nonexistent_id()
    {
        $response = $this->put('/api/dosages/999999', [
            'dosage' => '1L de Coca-Cola fermentada',
            'product_id' => factory(Product::class)->create()->id,
            'culture_id' => factory(Culture::class)->create()->id,
            'prague_id' => factory(Prague::class)->create()->id
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertNotFound();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_update_a_dosage_without_a_without_required_dosage_product_culture_prague()
    {
        $dosage = factory(Dosage::class)->create();

        $response = $this->put('/api/dosages/' . $dosage->id, [], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        $response = $this->put('/api/dosages/' . $dosage->id, [
            'dosage',
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        $response = $this->put('/api/dosages/' . $dosage->id, [
            'dosage',
            'product_id',
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        $response = $this->put('/api/dosages/' . $dosage->id, [
            'dosage',
            'product_id',
            'culture_id',
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        $response = $this->put('/api/dosages/' . $dosage->id, [
            'dosage',
            'product_id',
            'culture_id',
            'prague_id',
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        // make sure there are no dosage
        $this->assertDatabaseCount('dosages', 1);
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_can_delete_a_dosage()
    {
        $dosage = factory(Dosage::class)->create();

        $response = $this->delete('/api/dosages/' . $dosage->id, [], ['Authorization' => 'Bearer ' . $this->token]);

        $response
            ->assertOk()
            ->assertJsonStructure([
                'id', 'dosage', 'product_id', 'culture_id', 'prague_id', 'created_at', 'updated_at'
            ]);

        $this->assertDatabaseCount('dosages', 0);

    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_delete_a_dosage_with_nonexistent_id()
    {
        factory(Dosage::class)->create();

        $response = $this->delete('/api/dosages/999999', [], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertNotFound();

        $this->assertDatabaseCount('dosages', 1);
    }
}
