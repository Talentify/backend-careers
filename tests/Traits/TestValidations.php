<?php


namespace Tests\Traits;


use App\Models\Recruiter;
use App\Repositories\BaseRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\RecruiterRepository;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Support\Facades\Lang;
use Tymon\JWTAuth\Facades\JWTAuth;

trait TestValidations
{
    protected function assertInvalidationInStoreAction(
        array $data,
        string $rule,
        $rulesParams = []
    )
    {
        $recruiter = $this->createRecruiter();
        $token = $recruiter['token'];

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$recruiter['token']}"
        ])->postJson($this->routeStore(), $data);

        $fields = array_keys($data);
        $this->assertInvalidationFields($response, $fields, $rule, $rulesParams);
    }

    protected function assertInvalidationInUpdateAction(
        array $data,
        string $rule,
        $rulesParams = []
    )
    {
        $response = $this->json('PUT', $this->routeUpdate(), $data);
        $fields = array_keys($data);
        $this->assertInvalidationFields($response, $fields, $rule, $rulesParams);
    }

    protected function assertInvalidationFields(
        TestResponse $response,
        array $fields,
        string $rule,
        array $ruleParams = []
    )
    {
        $response->assertStatus(422)
            ->assertJsonValidationErrors($fields);

        foreach ($fields as $field) {
            $fieldName = str_replace('_', ' ', $field);
            $response->assertJsonFragment([
                Lang::get("validation.{$rule}", ['attribute' => $fieldName] + $ruleParams)
            ]);
        }
    }

    /**
     * @param TestResponse $response
     * Methods for Create and Update
     */
    protected function assertWithValidationRequired(TestResponse $response)
    {
        $response->AssertStatus(422)
            ->assertJsonValidationErrors(['name'])
            ->assertJsonFragment([
                Lang::get('validation.required', ['attribute' => 'name'])
            ]);
    }

    private function createRecruiter(){
        $newRecruiter = factory(Recruiter::class)->create();
        $token = JWTAuth::fromUser($newRecruiter);

        $recruiter = [];
        $recruiter['id'] = $newRecruiter->id;
        $recruiter['company_id'] = 1;
        $recruiter['token'] = $token;

        return $recruiter;
    }
}
