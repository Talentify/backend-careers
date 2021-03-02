<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\PositionsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\Utility\Security;
use Firebase\JWT\JWT;

/**
 * App\Controller\PositionsController Test Case
 *
 * @uses \App\Controller\PositionsController
 */
class PositionsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Positions',
        'app.Users',
    ];

    protected $token;

    public function getToken()
    {
        $userTestId = 1;
        $payload = ['sub' => $userTestId, 'exp' => time() + 600];
        return JWT::encode($payload, Security::getSalt(), 'HS256');
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testAdd(): void
    {
        $this->post('/positions/add.json?token='.$this->getToken(), [
            "title" => "PHP Developer",
            "description" => "PHP7, API Development",
            "address" => "Orlando, Florida",
            "salary" => 8500.00,
            "company" => "Talentify"
        ]);

        $this->assertResponseCode(200);
    }

    public function testEditPosition(): void
    {
        $this->put('/positions/edit/1.json?token='.$this->getToken(), [
            "title" => "PHP Developer",
            "description" => "PHP7, API Development",
            "address" => "Orlando, Florida",
            "salary" => 8500.00,
            "company" => "Talentify"
        ]);

        $this->assertResponseCode(200);
    }

    public function testValidateEditPositionAnotherRecruiter(): void
    {
        $this->put('/positions/edit/2.json?token='.$this->getToken(), [
            "title" => "PHP Developer",
            "description" => "PHP7, API Development",
            "address" => "Orlando, Florida",
            "salary" => 8500.00,
            "company" => "Talentify"
        ]);

        $this->assertResponseCode(400);
    }

    public function testList(): void
    {
        $this->get('/positions/list.json');
        $this->assertResponseCode(200);
    }

    public function testSearchKeyWord(): void
    {
        $this->get('/positions/search.json?keyword=JAVA');
        $this->assertResponseCode(200);
        $this->assertResponseContains('JAVA');
    }

    public function testSearchSalary(): void
    {
        $this->get('/positions/search.json?salary=2500');
        $this->assertResponseCode(200);
        $this->assertResponseContains('salary');
    }

    public function testSearchAddress(): void
    {
        $this->get('/positions/search.json?address=Orlando');
        $this->assertResponseCode(200);
        $this->assertResponseContains('Orlando');
    }

    public function testSearchCompany(): void
    {
        $this->get('/positions/search.json?company=Google');
        $this->assertResponseCode(200);
        $this->assertResponseContains('Google');
    }


}
