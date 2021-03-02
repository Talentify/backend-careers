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
        $payload = ['sub' => 1, 'exp' => time() + 600];
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


        //title:string description:string status:boolean address:string salary:decimal company:string user_id:integer created modified

        $this->assertResponseCode(200);
    }

}
