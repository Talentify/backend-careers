<?php

namespace Tests\Feature;

use App\Models\Position;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Tests\Traits\TestAssertJsonGragment;
use Tests\Traits\TestValidations;

class PositionTest extends TestCase
{
    use TestValidations, DatabaseMigrations, TestAssertJsonGragment;

    public function testCreateNewPosition()
    {
        $recruiter = $this->createRecruiter();
        $token = $recruiter['token'];

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$recruiter['token']}"
        ])->postJson('/api/v1/positions', [
            "title" => "Dev PHP",
            "description" => "Desc",
            "address" => "Address",
            "salary" => "15000",
            "status" => 1,
            "company_id" => 1,
            "recruiter_id" => 1
        ]);

        $response
            ->assertStatus(201)
            ->assertExactJson(["success" => "Position Created!"
            ]);
    }

    public function testGetPositions()
    {
        $recruiter = $this->createRecruiter();
        $token = $recruiter['token'];

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$token}",
        ])->json('GET', '/api/v1/positions');

        $response->assertStatus(200);
    }

    public function testGetPositionsOpenWithoutToken()
    {
        $position = factory(Position::class)->create();
        $response = $this->json('GET', '/api/v1/positions-open');
        $this->assertJsonFragmentTest($response);
    }

    public function testPositionsSearchAddressWithoutToken()
    {
        $position = factory(Position::class)->create();
        $response = $this->json('POST', '/api/v1/positions-open-search', [
            "address" => "Address Laravel"
        ]);
        $this->assertJsonFragmentTest($response);
    }

    public function testPositionsSearchCompanyWithoutToken()
    {
        $position = factory(Position::class)->create();
        $response = $this->json('POST', '/api/v1/positions-open-search', [
            "company_name" => "Foo Company"
        ]);
        $this->assertJsonFragmentTest($response);
    }

    public function testPositionsSearchSalaryWithoutToken()
    {
        $position = factory(Position::class)->create();
        $response = $this->json('POST', '/api/v1/positions-open-search', [
            "salary" => "17000"
        ]);
        $this->assertJsonFragmentTest($response);
    }

    public function testPositionsSearchKeywordWithoutToken()
    {
        $position = factory(Position::class)->create();
        $response = $this->json('POST', '/api/v1/positions-open-search', [
            "keyword" => "desc"
        ]);
        $this->assertJsonFragmentTest($response);
    }

    public function testShowPosition()
    {
        $recruiter = $this->createRecruiter();
        $token = $recruiter['token'];
        factory(Position::class)->create();

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$token}",
        ])->json('GET', "/api/v1/positions/1");

        $response->assertStatus(200);
    }

    public function testPositionNotFound()
    {
        $recruiter = $this->createRecruiter();
        $token = $recruiter['token'];

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$recruiter['token']}",
        ])->json('GET', "/api/v1/positions/10");

        $response
            ->assertStatus(404)
            ->assertExactJson([
                "error" => "Position Not Found."
            ]);
    }

    public function testGetPositionsWithoutToken()
    {
        $response = $this->get('/api/v1/positions');

        $response
            ->assertStatus(401)
            ->assertExactJson([
                "error" => "Authorization Token not found."
            ]);
    }

    public function testStoreWithRequiredFields()
    {
        $recruiter = $this->createRecruiter();
        $token = $recruiter['token'];

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$recruiter['token']}"
        ])->postJson('/api/v1/positions', [
            "title" => "",
            "description" => "",
            "address" => "",
            "salary" => "15000",
            "status" => 1,
            "company_id" => '',
            "recruiter_id" => ''
        ]);

        $this->assertInvalidationFields($response, ['title'], 'required', []);
        $this->assertInvalidationFields($response, ['description'], 'required', []);
        $this->assertInvalidationFields($response, ['address'], 'required', []);
        $this->assertInvalidationFields($response, ['company_id'], 'required', []);
        $this->assertInvalidationFields($response, ['recruiter_id'], 'required', []);

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$recruiter['token']}"
        ])->postJson('/api/v1/positions', [
            'title' => str_repeat('a', 256),
            'salary' => 'abc',
            'password' =>'123',
            'company_id' => 'a',
            "recruiter_id" => 'b'
        ]);
        $this->assertInvalidationFields($response, ['title'], 'max.string', ['max' => 190]);
        $this->assertInvalidationFields($response, ['salary'], 'numeric', []);
        $this->assertInvalidationFields($response, ['company_id'], 'numeric', []);
        $this->assertInvalidationFields($response, ['recruiter_id'], 'numeric', []);
    }

    public function testStoreWithInvalidCompanyIdAndRecruiterID()
    {
        $recruiter = $this->createRecruiter();
        $token = $recruiter['token'];

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$recruiter['token']}"
        ])->postJson('/api/v1/positions', [
            "title" => "",
            "description" => "",
            "address" => "",
            "salary" => 15000,
            "status" => 1,
            "company_id" => 999,
            "recruiter_id" => 999
        ]);

        $this->assertInvalidationFields($response, ['company_id'], 'exists', ['exists' => 'companies,id']);
        $this->assertInvalidationFields($response, ['recruiter_id'], 'exists', ['exists' => 'recruiters,id']);
    }

    public function testInvalidationData()
    {
        $data = ["title" => ''];
        $this->assertInvalidationInStoreAction($data, 'required');
        $this->assertInvalidationInUpdateAction($data, 'required');

        $data = ['title' => str_repeat('a', 256)];
        $this->assertInvalidationInStoreAction($data, 'max.string', ['max' => 190]);
        $this->assertInvalidationInUpdateAction($data, 'max.string', ['max' => 190]);

    }

    public function testUpdatePosition()
    {
        $recruiter = $this->createRecruiter();

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$recruiter['token']}"
        ])->postJson('/api/v1/positions', [
            "title" => "Dev PHP",
            "description" => "Desc",
            "address" => "Address",
            "salary" => "15000",
            "status" => 1,
            "company_id" => 1,
            "recruiter_id" => 1
        ]);

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$recruiter['token']}"
        ])->putJson("/api/v1/positions/1", [
            "title" => "Updated",
            "description" => "Updated",
            "address" => "Updated",
            "salary" => 1000,
            "status" => 1,
            "company_id" => 1,
            "recruiter_id" => 1
        ]);

        $response
            ->assertStatus(200)
            ->assertExactJson(["success" => "Position Updated!"
            ]);
    }

    public function testUpdatePositionWithoutToken()
    {
        $recruiter = $this->createRecruiter();

        $response = $this->putJson("/api/v1/positions/1", [
            "title" => "Updated",
            "description" => "Updated",
            "address" => "Updated",
            "salary" => 1000,
            "status" => 1,
            "company_id" => 1,
            "recruiter_id" => 1
        ]);

        $response
            ->assertStatus(401)
            ->assertExactJson(["error" => "Authorization Token not found."
            ]);
    }

    public function testUpdatePositionWithStringId()
    {
        $recruiter = $this->createRecruiter();

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$recruiter['token']}"
        ])->putJson("/api/v1/positions/a", [
            "title" => "Updated",
            "description" => "Updated",
            "address" => "Updated",
            "salary" => 1000,
            "status" => 1,
            "company_id" => 1,
            "recruiter_id" => 1
        ]);

        $response
            ->assertStatus(400)
            ->assertExactJson(["error" => "ID must be a number."]);
    }

    public function testUpdatePositionWithNoExistId()
    {
        $recruiter = $this->createRecruiter();

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$recruiter['token']}"
        ])->putJson("/api/v1/positions/100", [
            "title" => "Updated",
            "description" => "Updated",
            "address" => "Updated",
            "salary" => 1000,
            "status" => 1,
            "company_id" => 1,
            "recruiter_id" => 1
        ]);
        //dd($response);
        $response
            ->assertStatus(404)
            ->assertExactJson(["error" => "Position Not Found."]);
    }

    public function testUpdatePositionWithoutAuthorization()
    {
        $recruiter = $this->createRecruiter();
        $position = factory(Position::class)->create();

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$recruiter['token']}"
        ])->putJson("/api/v1/positions/{$position->id}", [
            "title" => "Updated",
            "description" => "Updated",
            "address" => "Updated",
            "salary" => 1000,
            "status" => 1,
            "company_id" => 1,
            "recruiter_id" => 1
        ]);

        $response
            ->assertStatus(401)
            ->assertExactJson(["error" => "This Recruiter is Not Allowed to Update this Position."
            ]);
    }

    public function testDeletePosition()
    {
        $recruiter = $this->createRecruiter();

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$recruiter['token']}"
        ])->postJson('/api/v1/positions', [
            "title" => "Dev PHP",
            "description" => "Desc",
            "address" => "Address",
            "salary" => "15000",
            "status" => 1,
            "company_id" => 1,
            "recruiter_id" => 1
        ]);

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$recruiter['token']}"
        ])->deleteJson("/api/v1/positions/1");

        $response
            ->assertStatus(200)
            ->assertExactJson(["success" => "Position Deleted."
            ]);
    }

    public function testDeletePositionWithToken()
    {
        $recruiter = $this->createRecruiter();
        $response = $this->deleteJson("/api/v1/positions/a");
        $response
            ->assertStatus(401)
            ->assertExactJson(["error" => "Authorization Token not found."
            ]);
    }

    public function testDeletePositionWithStringId()
    {
        $recruiter = $this->createRecruiter();

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$recruiter['token']}"
        ])->deleteJson("/api/v1/positions/a");

        $response
            ->assertStatus(400)
            ->assertExactJson(["error" => "ID must be a number."
            ]);
    }

    public function testDeletePositionWithNoExistId()
    {
        $recruiter = $this->createRecruiter();

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$recruiter['token']}"
        ])->deleteJson("/api/v1/positions/100");

        $response
            ->assertStatus(404)
            ->assertExactJson(["error" => "Position Not Found."
            ]);
    }

    public function testDeletePositionWithoutAuthorization()
    {
        $recruiter = $this->createRecruiter();
        $position = factory(Position::class)->create();

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$recruiter['token']}"
        ])->deleteJson("/api/v1/positions/{$position->id}");

        $response
            ->assertStatus(401)
            ->assertExactJson(["error" => "This Recruiter is Not Allowed to Delete this Position."
            ]);
    }

    protected function routeStore()
    {
        return '/api/v1/positions';
    }

    protected function routeUpdate()
    {
        return "/api/v1/positions/1";
    }
}
