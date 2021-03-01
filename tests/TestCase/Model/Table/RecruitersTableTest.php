<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RecruitersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RecruitersTable Test Case
 */
class RecruitersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RecruitersTable
     */
    protected $Recruiters;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Recruiters',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Recruiters') ? [] : ['className' => RecruitersTable::class];
        $this->Recruiters = $this->getTableLocator()->get('Recruiters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Recruiters);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
