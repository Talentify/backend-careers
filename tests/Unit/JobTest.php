<?php

namespace Tests\Unit;

use App\Exceptions\EmptyException;
use App\Exceptions\InvalidException;
use App\Models\Job;
use PHPUnit\Framework\TestCase;

class JobTest extends TestCase
{
    public function setUp(): void
    {
        $this->job = new Job([
            'title' => 'Testador de Software',
            'description' => 'Testador de Software testa software',
            'status' => 1
        ]);
    }

    public function test_ShouldInsert_WhenValidParams()
    {
        $id = $this->job->insert();

        $job = $this->job->getById($id);

        $this->assertEquals($id, $job['id']);
        $this->assertEquals($this->job->getTitle(), $job['title']);
        $this->assertEquals($this->job->getDescription(), $job['description']);
        $this->assertEquals($this->job->getStatus(), $job['status']);
        $this->assertEquals($this->job->getSalary(), $job['salary']);
        $this->assertEquals($this->job->getWorkplace(), $job['workplace']);
    }

    public function test_ShouldUpdate_WhenValidParams()
    {
        $id = $this->job->insert();

        $job = $this->job->getById($id);

        $this->job = new Job($job);
        $this->job->setTitle('Testador 2');
        $this->job->setDescription('Testador 2 é o segundo testador.');
        $this->job->setSalary(4000.00);
        $this->job->setWorkplace('Itabaúna, SE');
        $this->job->setStatus(0);
        $this->job->update();

        $job = $this->job->getById($id);

        $this->assertEquals($id, $job['id']);
        $this->assertEquals($this->job->getTitle(), $job['title']);
        $this->assertEquals($this->job->getDescription(), $job['description']);
        $this->assertEquals($this->job->getStatus(), $job['status']);
        $this->assertEquals($this->job->getSalary(), $job['salary']);
        $this->assertEquals($this->job->getWorkplace(), $job['workplace']);
    }

    public function test_ShouldList()
    {
        $this->closeAll();

        $this->job->insert();

        $newJob = new Job([
            'title' => 'Testador 2',
            'description' => 'Teste 2 de testador',
            'status' => 0
        ]);
        $newJob->insert();

        $listAll  = $this->job->all(0);
        $listOpen = $this->job->all();

        $this->assertGreaterThanOrEqual(2, count($listAll));
        $this->assertEquals(1, count($listOpen));
    }

    public function test_ShouldRemove()
    {
        $id = $this->job->insert();

        $job = $this->job->getById($id);

        $this->job = new Job($job);
        $this->job->remove();

        $job = $this->job->getById($id);
        $this->assertFalse($job);
    }

    public function test_ShouldThrowException_When_EmptyTitle()
    {
        $this->job->setTitle('');
        $this->expectException(EmptyException::class);
        $this->job->validate();
    }

    public function test_ShouldThrowException_When_InvalidTitle()
    {
        $this->job->setTitle(\Illuminate\Support\Str::random(300));
        $this->expectException(InvalidException::class);
        $this->job->validate();
    }

    public function test_ShouldThrowException_When_EmptyDesc()
    {
        $this->job->setDescription('');
        $this->expectException(EmptyException::class);
        $this->job->validate();
    }

    public function test_ShouldThrowException_When_InvalidDesc()
    {
        $this->job->setDescription(\Illuminate\Support\Str::random(20000));
        $this->expectException(InvalidException::class);
        $this->job->validate();
    }

    public function test_ShouldThrowException_When_InvalidStatus()
    {
        $this->job->setStatus(2);
        $this->expectException(InvalidException::class);
        $this->job->validate();
    }

    public function closeAll()
    {
        $dns = env('DB_CONNECTION') .
            ':host=' . env('DB_HOST') .
            ((!empty(env('DB_PORT'))) ? (';port=' . env('DB_PORT')) : '') .
            ';dbname=' . env('DB_DATABASE') . ';charset=utf8';

        $pdo = new \PDO($dns, env('DB_USERNAME'), env('DB_PASSWORD'));
        $pdo->query('UPDATE job SET status=0 WHERE status=1');
    }

    public function tearDown(): void
    {
        $this->job->remove();
    }
}
