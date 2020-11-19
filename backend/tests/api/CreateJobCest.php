<?php 

namespace App\Tests\api;

use ApiTester;
use Faker\Factory;

class CreateJobCest
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
            'status' => rand(0,1) ? 'active' : 'inactive',
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
     * @group ok
     */
    public function tryToCreateJob(ApiTester $I)
    {
        $data = $this->getData();

        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('/jobs', $data);

        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $I->seeResponseContainsJson($data);
    }
    public function tryToCreateJobWithoutWorkspace(ApiTester $I)
    {
        $data = $this->getData();
        unset($data['workspace']);

        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('/jobs', $data);

        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $I->seeResponseContainsJson($data);
    }
    /**
     * @group validator 
     */
    public function tryToCreateJobWitoutTitle(ApiTester $I)
    {
        $data = $this->getData();
        unset($data['title']);

        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('/jobs', $data);

        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::BAD_REQUEST);
    }
    /**
     * @group validator 
     */
    public function tryToCreateJobWitoutDescription(ApiTester $I)
    {
        $data = $this->getData();
        unset($data['description']);

        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('/jobs', $data);

        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::BAD_REQUEST);
    }
    /**
     * @group validator 
     */
    public function tryToCreateJobWitoutStatus(ApiTester $I)
    {
        $data = $this->getData();
        unset($data['status']);

        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('/jobs', $data);

        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::BAD_REQUEST);
    }
     /**
     * @group invalid-status 
     */
    public function tryToCreateJobWithInvalidStatus(ApiTester $I)
    {
        $data = $this->getData();
        $data['status'] = 'waiting';

        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('/jobs', $data);

        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::BAD_REQUEST);
    }

}
