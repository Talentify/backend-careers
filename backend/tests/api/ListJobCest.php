<?php 

namespace App\Tests\api;

use ApiTester;
use Faker\Factory;

class ListJobCest
{
    protected $faker;

    public function _before()
    {
        $this->faker = Factory::create('pt_BR');
        $this->faker->addProvider(new \Faker\Provider\pt_BR\Company($this->faker));
        $this->faker->addProvider(new \Faker\Provider\pt_BR\Address($this->faker));
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
    public function tryToTest(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('/jobs', $this->getData());

        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGET('/jobs');

        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $I->seeResponseJsonMatchesJsonPath('$.[*].title');
        $I->seeResponseJsonMatchesJsonPath('$.[*].description');
        $I->seeResponseJsonMatchesJsonPath('$.[*].status');
        $I->seeResponseJsonMatchesJsonPath('$.[*].salary');
    }
}
