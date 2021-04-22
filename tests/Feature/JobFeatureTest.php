<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProductFeatureTest extends TestCase
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
    public function test_it_can_list_products()
    {
        // create 10 products
        factory(Product::class, 10)->create();

        $response = $this->get('/api/products', ['Authorization' => 'Bearer ' . $this->token]);

        $response
            ->assertOk()
            ->assertJsonCount(10)
            ->assertJsonStructure([
                '*' => [
                    'id', 'name', 'created_at', 'updated_at'
                ]
            ]);
    }

    public function test_it_can_show_a_product()
    {
        $product = factory(Product::class)->create();

        $response = $this->get('/api/products/' . $product->id, ['Authorization' => 'Bearer ' . $this->token]);

        $response
            ->assertOk()
            ->assertJsonStructure([
                'id', 'name', 'created_at', 'updated_at'
            ]);
    }

    public function test_it_cant_show_a_product_with_nonexistent_id()
    {
        // create 10 products
        factory(Product::class)->create();

        $response = $this->get('/api/products/9999999', ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertNotFound();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_can_create_a_product()
    {
        $product = factory(Product::class)->make();

        $response = $this->post('/api/products', [
            'name' => $product->name
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response
            ->assertCreated()
            ->assertJson([
                'name' => $product->name
            ])
            ->assertJsonStructure([
                'id', 'name', 'created_at', 'updated_at'
            ]);

        $this->assertDatabaseCount('products', 1);

        $this->assertDatabaseHas('products', [
            'name' => $product->name
        ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_create_a_product_name_that_already_exists()
    {
        // create a product in database
        $product = factory(Product::class)->create();

        // Following redirects. Try to create a product with a name that already exists
        $response = $this->post('/api/products', [
            'name' => $product->name
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        // make sure there are 1 only
        $this->assertDatabaseCount('products', 1);
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_create_a_product_without_required_name()
    {
        $response = $this->post('/api/products', [], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        $response = $this->post('/api/products', [
            'name'
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        // make sure there are no product
        $this->assertDatabaseCount('products', 0);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_can_update_a_product()
    {
        $product = factory(Product::class)->create();

        $response = $this->put('/api/products/' . $product->id, [
            'name' => 'Sprite 2L sem açúcar'
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response
            ->assertOk()
            ->assertJson([
                'name' => 'Sprite 2L sem açúcar'
            ])
            ->assertJsonStructure([
                'id', 'name', 'created_at', 'updated_at'
            ]);

        $this->assertDatabaseCount('products', 1);

        $this->assertDatabaseHas('products', [
            'name' => 'Sprite 2L sem açúcar'
        ]);

    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_update_to_a_product_name_that_already_exists()
    {
        // create a product in database
        $product1 = factory(Product::class)->create();
        $product2 = factory(Product::class)->create();

        // Following redirects. Try to create a product with a name that already exists
        $response = $this->put('/api/products/' . $product1->id, [
            'name' => $product2->name
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        $this->assertDatabaseCount('products', 2);

        $this->assertDatabaseHas('products', [
            'name' => $product1->name
        ]);

        $this->assertDatabaseHas('products', [
            'name' => $product2->name
        ]);
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_update_a_product_with_nonexistent_id()
    {
        $response = $this->put('/api/products/999999', [
            'name' => 'Testando'
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertNotFound();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_update_a_product_without_a_required_name()
    {
        $product = factory(Product::class)->create();

        $response = $this->put('/api/products/' . $product->id, [], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        $response = $this->put('/api/products/' . $product->id, [
            'name'
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(422);

        // make sure there are no product
        $this->assertDatabaseCount('products', 1);
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_can_delete_a_product()
    {
        $product = factory(Product::class)->create();

        $response = $this->delete('/api/products/' . $product->id, [], ['Authorization' => 'Bearer ' . $this->token]);

        $response
            ->assertOk()
            ->assertJsonStructure([
                'id', 'name', 'created_at', 'updated_at'
            ]);

        $this->assertDatabaseCount('products', 0);

    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_cannot_delete_a_product_with_nonexistent_id()
    {
        factory(Product::class)->create();

        $response = $this->delete('/api/products/999999', [], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertNotFound();

        $this->assertDatabaseCount('products', 1);
    }
}
