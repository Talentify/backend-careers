<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\PositionsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

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

    /**
     * Test index method
     *
     * @return void
     */
    public function testAdd(): void
    {
        $this->post('/positions/add.json', [
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
