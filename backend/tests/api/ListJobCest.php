<?php 

namespace App\Tests\api;

use ApiTester;
use Faker\Factory;

class ListJobCest
{
    protected $faker;
    protected $token;

    public function _before()
    {
        $this->faker = Factory::create('pt_BR');
        $this->faker->addProvider(new \Faker\Provider\pt_BR\Company($this->faker));
        $this->faker->addProvider(new \Faker\Provider\pt_BR\Address($this->faker));
    }
    private function login(ApiTester $I)
    {
        if (is_null($this->token)) {
            $I->haveHttpHeader('Content-Type', 'application/json');
            $I->sendPOST('/login', ['username' => 'test', 'password' => 'test']);

            $this->token = json_decode($I->grabResponse(), true)['token'];
        }

        $I->amBearerAuthenticated($this->token);
    }
    private function getData()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->text,
            'status' => 'active',
            'salary' => 10000.50,
            'workspace' => [
                'street' => $this->faker->streetName,
                'number' => rand(100, 200),
                'city' => $this->faker->city,
                'state' => $this->faker->stateAbbr,
                'postcode' => $this->faker->postcode,
            ]
        ];
    }

    /**
     * @group list
     */
    public function tryToListJobs(ApiTester $I)
    {
        $this->login($I);

        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('/jobs', $this->getData());

        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGET('/jobs-active');

        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $I->seeResponseJsonMatchesJsonPath('$.[*].title');
        $I->seeResponseJsonMatchesJsonPath('$.[*].description');
        $I->seeResponseJsonMatchesJsonPath('$.[*].status');
        $I->seeResponseJsonMatchesJsonPath('$.[*].salary');
    }
}
