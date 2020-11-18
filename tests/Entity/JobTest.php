<?php
namespace App\Tests\Entity;

use App\Entity\Job;
use App\Entity\Workplace;
use App\Exceptions\EmptyException;
use App\Exceptions\TooLongException;
use App\Interfaces\DoctrineEntityInterface;
use PHPUnit\Framework\TestCase;

class JobTest extends TestCase
{
    /**
     * @var Job
     */
    private Job $job;

    public function setUp(): void
    {
        $this->job = new Job();
    }

    public function testInstanceOfDoctrineEntityInterface(): void
    {
        $this->assertInstanceOf(DoctrineEntityInterface::class, $this->job);
    }

    /**
     * @return array
     */
    public function validIdentifierProvider(): array
    {
        $randomIdentifier = rand(1);
        return [
            'random integer identifier' => [$randomIdentifier, $randomIdentifier]
        ];
    }

    /**
     * @return array
     */
    public function invalidIdentifierProvider(): array
    {
        return [
            'null identifier' => [null, EmptyException::class]
        ];
    }

    /**
     * @param string $value
     * @param string $expected
     *
     * @dataProvider validIdentifierProvider
     */
    public function testSuccessIdentifierGetterAndSetter(string $value, string $expected): void
    {
        $this->assertSuccessGettersAndSetters($value, $expected, 'Identifier');
    }

    /**
     * @param $value
     * @param string $expected
     *
     * @dataProvider invalidIdentifierProvider
     */
    public function testFailureSetIdentifier($value, string $expected): void
    {
        $this->assertFailureSetters($value, $expected, 'Identifier');
    }

    /**
     * @return array
     */
    public function validTitleProvider(): array
    {
        $titleUpTo256Characters = str_repeat('a', rand(1, 256));
        return [
            'non-empty string title' => ['title', 'title'],
            'string title with up to 256 characters' => [$titleUpTo256Characters, $titleUpTo256Characters]
        ];
    }

    /**
     * @return array
     */
    public function invalidTitleProvider(): array
    {
        return [
            'empty string title' => ['', EmptyException::class],
            'string title longer than 256 characters' => [str_repeat('a', rand(257)), TooLongException::class]
        ];
    }

    /**
     * @param string $value
     * @param string $expected
     *
     * @dataProvider validTitleProvider
     */
    public function testSuccessTitleGetterAndSetter(string $value, string $expected): void
    {
        $this->assertSuccessGettersAndSetters($value, $expected, 'title');
    }

    /**
     * @param string $value
     * @param string $expected
     *
     * @dataProvider invalidTitleProvider
     */
    public function testFailureSetTitle(string $value, string $expected): void
    {
        $this->assertFailureSetters($value, $expected, 'title');
    }

    /**
     * @return array
     */
    public function validDescriptionProvider(): array
    {
        $descriptionUpTo10000Characters = str_repeat('a', rand(1, 10000));
        return [
            'non-empty string description' => ['description', 'description'],
            'string description with up to 10000 characters' => [$descriptionUpTo10000Characters, $descriptionUpTo10000Characters]
        ];
    }

    /**
     * @return array
     */
    public function invalidDescriptionProvider(): array
    {
        return [
            'empty description' => ['', EmptyException::class],
            'string title longer than 10000 characters' => [str_repeat('a', rand(10001)), TooLongException::class]
        ];
    }

    /**
     * @param string $value
     * @param string $expected
     *
     * @dataProvider validDescriptionProvider
     */
    public function testSuccessDescriptionGetterAndSetter(string $value, string $expected): void
    {
        $this->assertSuccessGettersAndSetters($value, $expected, 'description');
    }

    /**
     * @param string $value
     * @param string $expected
     *
     * @dataProvider invalidDescriptionProvider
     */
    public function testFailureSetDescription(string $value, string $expected): void
    {
        $this->assertFailureSetters($value, $expected, 'description');
    }

    /**
     * @return array
     */
    public function validStatusProvider(): array
    {
        return [
            'active status' => [true, true],
            'inactive status' => [false, false]
        ];
    }

    /**
     * @return array
     */
    public function invalidStatusProvider(): array
    {
        return [
            'empty status' => [null, EmptyException::class]
        ];
    }

    /**
     * @param bool $value
     * @param bool $expected
     *
     * @dataProvider validStatusProvider
     */
    public function testSuccessStatusGetterAndSetter(bool $value, bool $expected): void
    {
        $this->assertSuccessGettersAndSetters($value, $expected, 'status');
    }

    /**
     * @param $value
     * @param string $expected
     *
     * @dataProvider invalidStatusProvider
     */
    public function testFailureSetStatus($value, string $expected): void
    {
        $this->assertFailureSetters($value, $expected, 'status');
    }

    /**
     * @return array
     */
    public function validWorkplaceProvider(): array
    {
        $workplaceMock = $this->createMock(Workplace::class);
        return [
            'null workplace' => [null, null],
            'workplace class' => [$workplaceMock, $workplaceMock]
        ];
    }

    public function invalidWorkplaceProvider(): array
    {
        return [
            'not an instance of Workplace' => [new \stdClass(), \TypeError::class]
        ];
    }

    /**
     * @param $value
     * @param $expected
     *
     * @dataProvider validWorkplaceProvider
     */
    public function testSuccessWorkplaceGetterAndSetter($value, $expected): void
    {
        $this->assertInstanceOf(Job::class, $this->job->setWorkplace($value));
        if ($value instanceof Workplace === false) {
            $this->assertSame($expected, $this->job->getWorkplace());
        } else {
            $this->assertInstanceOf(Workplace::class, $this->job->getWorkplace());
        }
    }

    /**
     * @param $value
     * @param string $expected
     *
     * @dataProvider invalidWorkplaceProvider
     */
    public function testFailureSetWorkplace($value, string $expected): void
    {
        $this->assertFailureSetters($value, $expected, 'workplace');
    }

    /**
     * @return array
     */
    public function validSalaryProvider(): array
    {
        return [
            'float salary' => [1.1, 1.1],
            'integer salary' => [1, 1.0],
            'null salary' => [null, null]
        ];
    }

    /**
     * @return array
     */
    public function invalidSalaryProvider(): array
    {
        return [
            'not a number salary' => ['USD 100', \TypeError::class]
        ];
    }

    /**
     * @param $value
     * @param $expected
     *
     * @dataProvider validSalaryProvider
     */
    public function testSuccessSalaryGetterAndSetter($value, $expected): void
    {
        $this->assertSuccessGettersAndSetters($value, $expected, 'salary');
    }

    /**
     * @param $value
     * @param string $expected
     *
     * @dataProvider invalidSalaryProvider
     */
    public function testFailureSetSalary($value, string $expected): void
    {
        $this->assertFailureSetters($value, $expected, 'salary');
    }

    /**
     * @param $value
     * @param $expected
     * @param string $variable
     */
    private function assertSuccessGettersAndSetters($value, $expected, string $variable): void
    {
        $setMethod = 'set' . ucfirst($variable);
        $getMethod = 'get' . ucfirst($variable);
        $this->assertInstanceOf(Job::class, $this->job->$setMethod($value));
        $this->assertSame($expected, $this->job->$getMethod());
    }

    /**
     * @param $value
     * @param $expected
     * @param string $variable
     */
    private function assertFailureSetters($value, $expected, string $variable): void
    {
        $setMethod = 'set' . ucfirst($variable);
        $this->expectException($expected);
        $this->job->$setMethod($value);
    }
}